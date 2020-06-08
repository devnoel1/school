<?php

$cls_id = $_GET['cls_id'];

if(isset($_POST['ok'])){
        
            $ca1=$_POST['ca1'];      
            $ca2=$_POST['ca2'];
            $ca3=$_POST['ca3'];
            $exams=$_POST['exams'];	
            $abs =@$_POST['abs'];
            $std_id = $_POST['std_id'];
            
            
            $sub = $handle->query("select COUNT(std_id) AS total_std from sub_reg where cls_id = '$cls_id' and sub_id ='$sub_id' and section='$sec' " );
    
    $total_std = 0;
while($row=mysqli_fetch_assoc($sub)){
		$value=$row['total_std'];
		$total_std+=$value;
		}

    $avg = 0.0;
     
        
        $total=0;
       


       
	
    $total=$ca1+$ca2+$ca3+$exams;
    
    
    $avg = $total/$total_std;
    
    
    $result = $handle->query("update result set ca1='$ca1', ca2 ='$ca2', ca3='$ca3', exams='$exams', abs='$abs', total = '$total',cls_avg='$avg' 
           where std_id='$std_id' and cls_id='$cls_id' and sub_id='$sub_id' and section='$sec' and ses_id = '$session' and term_id = '$term' ");
    /*
   $result = $handle->query("insert into result(std_id,sub_id,cls_id,ca1,ca2,ca3,exams,term_id,ses_id,total,cls_avg,section)
   values('$std_id[$a]','$sub_id','$cls_id','$ca1[$a]','$ca2[$a]','$ca3[$a]','$exams[$a]','$term',
                       '$session','$total','$avg[$a]','$sec') ");
     * 
     */
     
    

       
    
        
			
	}
	if(@$result){
	
            //updating position
       $update = $handle->query("UPDATE result SET sub_position = @curRank:=0 WHERE cls_id = '$cls_id'
                and sub_id='$sub_id' and ses_id = '$session'
                and term_id = '$term' and section='$sec' order by total DESC");
        
         $update = $handle->query("UPDATE result join(SELECT std_id,
               total,
              IF(total=@_last_age,@curRank:=@curRank,@curRank:=@_sequence) AS position,
              @_sequence:=@_sequence+1,@_last_age:=total
    FROM  result r, (SELECT @curRank := 1, @_sequence:=1, @_last_age:=0) r
    WHERE cls_id = '$cls_id' and sub_id='$sub_id'  and ses_id = '$session'
                and term_id = '$term' and section='$sec' ORDER BY  total DESC) as positions  USING(total)
    SET  result.sub_position = positions.position ");
         echo "<meta http-equiv=\"refresh\"content=\"1;url=staff-dashboard.php?ass&add_ass&sub_id=$sub_id&cls_id=$cls_id\">";
         
        }
 

?>
<div id="editAss<?=$st;?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title text-uppercase">Edit Assesment</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
        <?php
        
            $view = $handle->fetch("select *,student.std_id,student.surname,student.other_name,student.middle_name,
                subject.sub_name,subject.sub_id,term.term_id,term.term_name,acc_session.ses_id,acc_session.ses_name
                     from result
                join student on student.std_id = result.std_id
                join subject on subject.sub_id = result.sub_id   
                join term on term.term_id = result.term_id 
                join acc_session on acc_session.ses_id = result.ses_id
                where result.sub_id = '$sub_id' and result.std_id='$st' and result.section = '$sec'
                and result.term_id = '$term' and result.ses_id ='$session' and result.cls_id = '$cls_id'  ");
        ?>
      <div class="modal-body">
          <h6><?=$v['surname']." ".$v['middle_name']." ".$v['other_name'];?></h6>
          <h6>Subject : <?=$view['sub_name'];?></h6>
           <h6>Term : <?=$view['term_name'];?></h6>
            <h6>Session  : <?=$view['ses_name'];?></h6>
          <form method="post">
              <input type="hidden" name="std_id" value="<?=$st;?>">
              <div class="form-group">
                  <label>CA1</label>
                  <input type="number" max="10" min="1" value="<?=$view['ca1'];?>" class="form-control" name="ca1">
              </div>
              <div class="form-group">
                  <label>CA2</label>
                  <input type="number" max="10" min="1" value="<?=$view['ca2'];?>" class="form-control" name="ca2">
              </div>
              <div class="form-group">
                  <label>CA3</label>
                  <input type="number" max="10" min="1" value="<?=$view['ca3'];?>" class="form-control" name="ca3">
              </div>
              <div class="form-group">
                  <label>EXAMS</label>
                  <input type="number" max="70" min="1" class="form-control" value="<?=$view['exams'];?>" name="exams">
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-block btn-primary" name="ok">
              </div>
          </form>
        
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>