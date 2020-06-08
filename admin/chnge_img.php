<?php
 if(isset($_POST['chng'])){
     
     $file_name = $_FILES['passport']['name'];
     $tmp_name = $_FILES['passport']['tmp_name'];
     $std_id = $view_st['std_id'];
     
      //getting file extention
         $file_ext =@strtolower(end(explode('.', $file_name)));
         
         //renaming file
        $name = str_replace($file_name, "",$std_id.".".$file_ext);
        
        $curent_photo = "../img/photo/".$view_st['photo'];
        
        unlink($curent_photo);
     
        $photo = move_uploaded_file($tmp_name, "../img/photo/". $name);
        
     $handle->query("update student set photo= '$name' where std_id = '$std_id' ");
     
    
     
     
 }
?>
<!-- The Modal -->
<div class="modal" id="chngImage">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Change Picture</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
    <div class="modal-body">
          <div class="container" style="margin-left:  10%">
             <!-- <img height="250"  width="250" style="margin: 5px 0px 0px 3px;"
                   src="<?="../img/photo/".$view_st['photo']?>"/>-->
              <form method="post" enctype="multipart/form-data" style="width: 300px;">
                  <div  style="margin-bottom: 5%; margin-top: 5%;">
                    <div id="status"></div>
                    <label>Passport</label>
                    <input type="file" name="passport" onchange="checkPassport()"
                           id="passport" class="form-control" required="">
                </div>
                <div class="form-group">
                    <button type="submit" id="btnSubmit" name="chng" class="btn btn-block btn-primary">Submit</button>
                </div>
            </form>
          </div>
        </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
