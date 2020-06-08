<?php
     session_start();
    
    include '../config/config.php';
    
    $handle = new config();
    
    $username = $_SESSION['user'];
    
     $u = substr($username, 4);
     $no = substr($u, 0,4);
     $y = substr($u,5);
     
     $user = $no.$y;
     
    
    $section = $handle->fetch("select * from login where username = '$username' ");
    
    $sec = $section['section'];
    
   $user_info = $handle->fetch("select *,class.cls_id,class.cls_name from student 
        join class on class.cls_id =  student.cls_id      
                where std_id = '$user'");
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
      Student-dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <link href="../css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
 <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="../demo/demo.css" rel="stylesheet" />
  <style type="text/css">
      body{
          background-color: lightyellow;
      }
  </style>
    </head>
    <body>
        <div class="wrapper">
                  <nav class="navbar navbar-dark navbar-absolute bg-danger navbar-expand-lg fixed-top">
          <div class="container">
          
              <a class="navbar-brand" href="std_dashboard.php?dash">Student Dashboard</a>
              
              
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
   
              <ul class="navbar-nav ml-auto">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-circle-10"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    
                    <a class="dropdown-item" href="std_dashboard.php?profile">Profile</a>
                   <a class="dropdown-item" data-toggle="modal" data-target="#pswModal" href="#">Change Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../logout.php"><span><i class="nc-icon nc-user-run"></i></span> Logout</a>
                </div>
              </li>
 
            </ul>
          </div>
        </div>
      </nav>
            
            <br/><br/><br/>
                <div class="container pt-5">
                    
                     <?php
                    if(isset($_GET['msg'])){
                        echo $_GET['msg'];
                        echo "<meta http-equiv=\"refresh\"content=\"8;url=std_dashboard.php?dash\">";
                    }
                ?>
                        <div class="row">
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                  <img src="../img/encroll-img.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                      <img class="avatar border-gray" src="<?="../img/photo/".$user_info['photo'];?>" alt="...">
                    <h5 class="title text-capitalize"><?=$user_info['surname']." ".$user_info['middle_name']." ".$user_info['other_name'];?></h5>
                  </a>
                  <p class="description text-capitalize">
                      Class : <?=$user_info['cls_name'];?>
                  </p>
                  <p class="description">
                      Gender : <?=$user_info['gender'];?>
                  </p>
                </div>
                <p class="description text-center">
                </p>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                        <h6 class="text-uppercase"><?=$user_info['cls_name'];?>
                        <br>
                        <small>Class</small>
                      </h6>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5>2
                        <br>
                        <small> Subjects</small>
                      </h5>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-8">
              
            <div class="card card-user">
               
              <div class="card-header">
                  <ul class="nav nav-tabs" id="myTab">
                    <li class="nav-item active"><a href="#edit" class="nav-link" data-toggle="tab">Edit Profile</a></li>
                    <li class="nav-item"><a href="#result" class="nav-link" data-toggle="tab">Check Result</a></li>
                    <li class="nav-item"><a href="#ass" class="nav-link" data-toggle="tab">Assignment</a></li>
               </ul>
                
              </div>
              <div class="card-body">
                  <div class="tab-content">
                      
                      <div class="tab-pane active" id="edit">
                          <h5 class="card-title">Edit Profile</h5>
           <form method="post" action="process.php?edit_profile&student&sectn=<?=$handle->validate($sec)?>&id=<?=$handle->validate($user_info['std_id']);?>&editor=<?php echo 'std' ?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Student ID</label>
                        <input type="text" class="form-control" disabled="" placeholder="" value="<?="JIS/".substr_replace($user_info['std_id'],"/", 4, 0);?>">
                      </div>
                    </div>
                    
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Surname</label>
                        <input type="text" class="form-control" name="sname" value="<?=$user_info['surname'];?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="mname" value="<?=$user_info['middle_name'];?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Other Name</label>
                        <input type="text" class="form-control" name="lname" value="<?=$user_info['other_name'];?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                      <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="<?=$user_info['gender'];?>"><?=$user_info['gender'];?></option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="<?=$user_info['address'];?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>State Of Origin</label>
                        <input type="text" class="form-control" name="state" value="<?=$user_info['soo'];?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>L G A</label>
                        <input type="text" class="form-control" name="lga" value="<?=$user_info['lga'];?>">
                      </div>
                    </div>
                      <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Date Of Birth</label>
                        <input type="text" class="form-control" name="dob" value="<?=$user_info['dob'];?>">
                      </div>
                    </div>
                  </div>
                              
                   <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Age</label>
                        <input type="text" class="form-control" name="age" value="<?=$user_info['cage'];?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Blood Group</label>
                        <input type="text" class="form-control" name="blood_g" value="<?=$user_info['blg'];?>">
                      </div>
                    </div>
                      <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Geno Type</label>
                        <input type="text" class="form-control" name="genotype" value="<?=$user_info['gnt'];?>">
                      </div>
                    </div>
                  </div>  
                              
                 <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Family Name</label>
                        <input type="text" class="form-control" name="fname" value="<?=$user_info['fan'];?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Fathers Name</label>
                        <input type="text" class="form-control" name="father_name" value="<?=$user_info['fname'];?>">
                      </div>
                    </div>
                      <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Mothers Name</label>
                        <input type="text" class="form-control" name="mothers_name" value="<?=$user_info['mname'];?>">
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Pnone Number 1</label>
                        <input type="text" class="form-control" name="phone1" value="<?=$user_info['phone1'];?>">
                      </div>
                    </div>
                    <div class="col-md-6 px-1">
                      <div class="form-group">
                        <label>Phone Number 2</label>
                        <input type="text" class="form-control" name="phone2" value="<?=$user_info['phone2'];?>">
                      </div>
                    </div>
                     
                  </div>  
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Update Profile</button>
                    </div>
                  </div>
                </form>
                      </div>
                      
                      <div class="tab-pane" id="result">
                          
                          <h5 class="card-title">Check Result</h5>
                          <div class="container" style="width: 50%">
                              <form method="post" action="process.php?check_result">
                  <div class="form-group">
                      <input type="hidden" name="sec" value="<?=$sec;?>">
                      <input type="hidden" name="std_id" value="<?=$user_info['std_id'];?>">
                      <label>Session:</label>
                      <select name="ses" class="form-control">
                          <option value="">Select session</option>
                         <?php
                                $term = $handle->fetchQuery("select * from acc_session");
                                foreach($term as $view):
                          ?>
                          <option value="<?=$view['ses_id']?>"><?=$view['ses_name']?></option>
                          <?php
                      endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Term:</label>
                      <select name="term" class="form-control">
                          <option value="">Select Term</option>
                          <?php
                                $term = $handle->fetchQuery("select * from term");
                                foreach($term as $view):
                          ?>
                          <option value="<?=$view['term_id']?>"><?=$view['term_name']?></option>
                          <?php
                      endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Class:</label>
                      <select name="cls_id" class="form-control">
                          <option value="">Select Class</option>
                          <?php
                                $term = $handle->fetchQuery("select * from class where section = '$sec'");
                                foreach($term as $view):
                          ?>
                          <option value="<?=$view['cls_id']?>"><?=$view['cls_name']?></option>
                          <?php
                      endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <button type="submit" name="check" class="btn btn-danger btn-block">Check</button>
                  </div>
              </form>
                          </div>
                      </div>
                      <div class="tab-pane" id="ass">
                          <h5 class="card-title">Assignment</h5>
                          <div class="list-group">

                          <?php
                          $class = $user_info['cls_id'];
                            $ass = $handle->query("select assignment.sub_id,assignment.cls_id,assignment.files,
                                subject.sub_id,subject.sub_name
                                    from assignment join subject on subject.sub_id = assignment.sub_id
                                where cls_id = '$class' ");
                            $row = mysqli_num_rows($ass);
                            if($row > 0){
                                while ($view = mysqli_fetch_array($ass)){
                                    ?>
       <a href="files/<?=$handle->validate($view['files']);?>" class="list-group-item text-capitalize"><?=$handle->validate($view['sub_name']);?></a>
                          <?php
                                }
                            }else{
                                echo '<div class="alert alert-info">no Assignment have being posted</div>';
                            }
                          ?>
                           </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
                </div>
        </div>
        
       <?php include "./chng_std_pass.php";?>  
          <!--   Core JS Files   -->
  <script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/core/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <script src="../demo/demo/demo.js"></script>
  <script src="../js/plugins/bootstrap-notify.js"></script>
  <script src="../js/form_Validate.js"></script>
      
    <script type="text/javascript">
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');
    }
});

</script>


<script type="text/javascript">
    function StdcheckPsw() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_std_psw.php",
data:'old_psw='+$("#old_psw").val(),
type: "POST",
success:function(data){
$("#old_psw-status").html(data);
$("#loaderIcon").hide();

},
error:function (){}
});

}
    </script>
  
    </body>
</html>
