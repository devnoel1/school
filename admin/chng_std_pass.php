<div id="pswModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
<?php

               ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
           <h4 class="modal-title">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
          <form method="post" action="process.php?change_psw&id=<?=$_SESSION['user'];?>">
              <div class="form-group">
                  <label>Old Password</label>
                  <input type="text" name="old_psw" class="form-control" id="old_psw" onkeyup="StdcheckPsw()" placeholder="Enter Old Password" required=""/>
                   <span id="old_psw-status" style="font-size:12px;"></span> 
              </div>
              <div class="form-group">
                  <label>New Password</label>
                  <input type="password" name="new_psw" id="new_psw" onkeyup="check_pass()" class="form-control" placeholder="Enter New Password" required=""/>
              </div>
              <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" name="cfm_psw" id="cfm_psw" onkeyup="check_pass()" class="form-control" placeholder="Re-EnterS Password" required=""/>
                  <span id="msg"></span>
              </div>
              <div class="form-group">
                  <input type="submit" name="submit" id="submit" disabled="" class="btn btn-info btn-block"/>
              </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


