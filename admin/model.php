<div id="myModal<?=$check?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <?php
        $query = $handle->fetch("select * from subject where sub_id = '$check'");
      ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title text-uppercase"><?=$query['sub_name'];?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
          <ul class="list-group mb-5">
              <li class="list-group-item list-group-item-primary text-uppercase">Subject Combined To</li>
              <?php
               $query2 = $handle->query("select sub_comb.id,sub_comb.sub_id,sub_comb.cls_id,sub_comb.section,
                                         subject.sub_id,subject.sub_name,class.cls_id,class.cls_name
                                           from sub_comb 
                                        left JOIN subject on sub_comb.sub_id=subject.sub_id
                                         left  JOIN class ON sub_comb.cls_id=class.cls_id
                                           where sub_comb.sub_id = '$check'");
               $sno=1;
               while ($view= mysqli_fetch_assoc($query2)):
              ?>
              <li class="list-group-item text-uppercase"><span><i class="fa fa-check-circle"></i></span> <?=$view['cls_name'];?> 
                  <span class="btn btn-info btn-sm"><?=$view['section']." "."section";?></span> 
                  <span style="float: right">
                      <a href="process.php?delete&del_sub_comb&sub_id=<?=$view['id'];?>&sectn=<?=$sec;?>"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></span>
              </li>
              <?php
          endwhile;
              ?>
          </ul>
          
          <ul class="list-group ">
              <li class="list-group-item list-group-item-success text-uppercase">Subject Assigned To</li>
              <?php
               $query2 = $handle->query("select sub_assign.id,sub_assign.cls_id,sub_assign.sub_id,sub_assign.stf_id,sub_assign.section,
                                         subject.sub_id,subject.sub_name,
                                         class.cls_id,class.cls_name,
                                         staff.stf_id,staff.name
                                         from sub_assign
                                      left  JOIN subject on sub_assign.sub_id=subject.sub_id
                                      left  JOIN class ON sub_assign.cls_id=class.cls_id
                                      left  JOIN staff on sub_assign.stf_id = staff.stf_id
                                        where sub_assign.sub_id = '$check'");
               while ($view= mysqli_fetch_assoc($query2)):
              ?>
              <li class="list-group-item text-uppercase text-sm"> <?=$view['name'];?>
                  <span class="btn btn-round btn-sm btn-warning">  <?=$view['cls_name'];?></span>
                  <span class="btn btn-round btn-sm btn-info">  <?=$view['section']." "."section";?></span>
                  <span style="float: right"><a href="process.php?delete&del_assign_sub&sub_id=<?=$view['id'];?>&sectn=<?=$sec;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></span>
              </li>
              <?php
          endwhile;
              ?>
          </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>