<?php
    session_start();
    
    include '../config/config.php';
    
    $status ="";
    $handle = new config();
    
    $section = $_SESSION['ses_id'];
    $term = $_SESSION['term_id'];
    
    $user = $_SESSION['user'];
    
   $row = $handle->fetch("select * from login where username ='$user' ");

    $sec = $row['section'];

    $sumS = 0;
    $sumT = 0;
    $sumC = 0;
    $sumF = 0;
    $sumSub = 0;
    $sumM = 0;


    //counting number of students
    $student= $handle->query("select COUNT(*) AS value from student where section = '$sec'");
    while($row=mysqli_fetch_assoc($student)){
      $value=$row['value'];
      $sumS+=$value;
      }

      //counting number of staff
    $techers = $handle->query("select COUNT(*) AS value from staff where section = '$sec'");  
    while($row=mysqli_fetch_assoc($techers)){
      $value=$row['value'];
      $sumT+=$value;
      }
      //counting the number of subjects
      $subject= $handle->query("select COUNT(*) AS value from subject where section = '$sec'");
      while($row=mysqli_fetch_assoc($subject)){
        $value=$row['value'];
        $sumSub+=$value;
        }
        //counting number of classese
        $class= $handle->query("select COUNT(*) AS value from class where section = '$sec'");
        while($row=mysqli_fetch_assoc($class)){
          $value=$row['value'];
          $sumC+=$value;
          }
      //counting number of form masters
      $form_master= $handle->query("select COUNT(*) AS value from form_master where section = '$sec'");
      while($row=mysqli_fetch_assoc($form_master)){
        $value=$row['value'];
        $sumM+=$value;
        }
      //totel fees payment
      $fees= $handle->query("select COUNT(*) AS value from fees where section = '$sec'");
      while($row=mysqli_fetch_assoc($fees)){
        $value=$row['value'];
        $sumF+=$value;
        }  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
      Admin-dashboard
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
 
</head>

<body class="" onload="demo.showNotification('top','left')">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      
      <div class="logo">
        <a href="" class="simple-text logo-normal text-white">
          SCHOOL MANAGEMENT
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li <?php if(isset($_GET['dash'])) echo 'class="active"' ?> >
              <a class="text-white"  href="admin-dashboard.php?dash">
              <i class="nc-icon nc-bank text-white"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li <?php if(isset($_GET['std'])) echo 'class="active"' ?> >
              <a class="text-white" href="admin-dashboard.php?std">
              <i class="nc-icon nc-single-02 text-white"></i>
              <p>Students</p>
            </a>
          </li>
          <li <?php if(isset($_GET['tch'])) echo 'class="active"' ?>>
              <a class="text-white" href="admin-dashboard.php?tch">
              <i class="nc-icon nc-single-02 text-white"></i>
              <p>Teachers</p>
            </a>
          </li>
          <li <?php if(isset($_GET['cl'])) echo 'class="active"' ?>>
              <a class="text-white" href="admin-dashboard.php?cl">
              <i class="nc-icon nc-hat-3 text-white"></i>
              <p>Classes</p>
            </a>
          </li>
          <li <?php if(isset($_GET['sb'])) echo 'class="active"' ?>>
              <a class="text-white" href="admin-dashboard.php?sb">
              <i class="nc-icon nc-single-copy-04 text-white"></i>
              <p>Subjects</p>
            </a>
          </li>
          <li <?php if(isset($_GET['calen'])) echo 'class="active"' ?>>
              <a class="text-white" href="admin-dashboard.php?calen">
              <i class="nc-icon nc-calendar-60 text-white"></i>
              <p>Calender</p>
            </a>
          </li>
          <li <?php if(isset($_GET['fe'])) echo 'class="active"' ?>>
              <a class="text-white" href="admin-dashboard.php?fe">
              <i class="nc-icon nc-money-coins text-white"></i>
              <p>Fees</p>
            </a>
          </li>
          <li <?php if(isset($_GET['re'])) echo 'class="active"' ?>>
              <a class="text-white" href="admin-dashboard.php?re">
              <i class="nc-icon nc-trophy text-white"></i>
              <p>Result</p>
            </a>
          </li>
          <li <?php if(isset($_GET['cut_off'])) echo 'class="active"' ?>>
              <a class="text-white" href="admin-dashboard.php?cut_off">
              <i class="nc-icon nc-diamond text-white"></i>
              <p>Cut-Off Point</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
              <a class="navbar-brand" href="admin-dashboard.php?dash"><?=$sec;?> School Admin Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
   
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-circle-10"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="admin-dashboard.php?profile">Profile</a>
                    <?php 
                            $for_pas = $user;
                    ?>
                  <a class="dropdown-item" data-toggle="modal" data-target="#pswModal<?=$for_pas?>" href="#">Change Pasword</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../logout.php"><span><i class="nc-icon nc-user-run"></i></span> Logout</a>
                </div>
              </li>
 
            </ul>
          </div>
        </div>
      </nav>
  
      <div class="content">
          <?php
           if(isset($_GET['dash'])){
               ?>
          <div class="alert alert-info alert-with-icon alert-dismissible fade show" data-notify="container">
                          <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                          <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                          <span data-notify="message">Welcome to <?=$sec;?> school <?=$user;?> dashboard </span>
                        </div>

                    <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-02 text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Students</p>
                      <p class="card-title"><?=$sumS;?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                    <a href="admin-dashboard.php?std">view</a>
                </div>
              </div>
            </div>
          </div>
            
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-02 text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Teachers</p>
                      <p class="card-title"><?=$sumT;?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="admin-dashboard.php?tch">view</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-copy-04 text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Subjects</p>
                      <p class="card-title"><?=$sumSub;?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="admin-dashboard.php?sb">view</a>
                </div>
              </div>
            </div>
          </div>
            
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-hat-3 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Classes</p>
                      <p class="card-title"><?=$sumC;?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="admin-dashboard.php?cl">view</a>
                </div>
              </div>
            </div>
          </div>
            
         <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-trophy text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Result</p>
                      <p class="card-title">+45K
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="admin-dashboard.php?re">view</a>
                </div>
              </div>
            </div>
          </div>
            
                     <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Fees</p>
                      <p class="card-title"><?=$sumF;?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="admin-dashboard.php?fe">view</a>
                </div>
              </div>
            </div>
          </div>
        </div>
          <?php
           }elseif(isset ($_GET['std'])){
               $admission = $handle->numRows("select * from operations where section='$sec' and status='1' ");
               if($admission > 0){
                   $status = ' <span class="text-success">Active</span>';
               }else{
                   $status = ' <span class="text-danger">closed</span>';
               }
               ?>
          <div style="float: right">
              <h6>Admission Status :<?=$status;?></h6>
              <a class="btn btn-success btn-sm" href="process.php?open&sectn=<?=$sec?>">Open Admission</a>
              <a class="btn btn-danger btn-sm" href="process.php?close&sectn=<?=$sec?>">Close Admission</a>
          </div>
          <h3>Students</h3>
          
          <hr/>
              
          <?php
          //students 
                if(isset($_GET['std']) and !isset($_GET['add_newstd']) and !isset($_GET['add_returnstd']) and !isset($_GET['add_registra']) and !isset($_GET['view_std'])){
                  $operator = 'admin';
                    ?>
       <div class="container">
              <div class="container">
                  <a href="admin-dashboard.php?std&add_newstd" class="btn btn-success">Register New Student  <span><i class="fa fa-user-plus"></i></span></a>
                  <a href="admin-dashboard.php?std&add_returnstd" class="btn btn-danger">Register Returning Student   <span><i class="fa fa-user-plus"></i></span></a>
                  <a href="admin-dashboard.php?std&add_registra" class="btn btn-warning">Add Registra   <span><i class="fa fa-user-plus"></i></span></a>
              </div>
           <h5>List Of All Students</h5>
              <div class="table-responsive-sm">
                  <table class="table table-bordered" width="60%">
                      <tr>
                          <th width="20">SN</th>
                          <th>Reg Number</th>
                          <th>Name</th>
                          <th>Class</th>
                          <th>Gender</th>
                          <th colspan="2">ACTION</th>
                      </tr>
                      <?php
                        $view = $handle->fetchQuery("select *,class.cls_id,class.cls_name from student
                           left join class on class.cls_id = student.cls_id
                                 where student.section = '$sec' ");
                        $sno = 1;
                        for($s=0;isset($view[$s]); $s++):
                            
                           $regno = $view[$s]['std_id'];
                                
                      ?>
                      <tr>
                          <td><?=$sno++;?></td>
                          <td><?="JIS/".substr_replace($regno,"/", 4, 0);?></td>
                          <td><?=$view[$s]['surname']." ".$view[$s]['middle_name']." ".$view[$s]['other_name'];?></td>
                          <td><?=$view[$s]['cls_name'];?></td>
                          <td><?=$view[$s]['gender'];?></td>
                          <td width="20"><a href="admin-dashboard.php?std&view_std=<?=$handle->validate($view[$s]['std_id']);?>" class="btn btn-success"><i class="fa fa-pencil"></i></a></td>
                          <td width="20"><a href="process.php?delete&del_student&id=<?=$handle->validate($view[$s]['std_id']);?>&sectn=<?=$sec;?>" class="btn btn-danger"><i class="fa fa-trash"></i></td>
                      </tr>
                      <?php
                        endfor;
                      ?>
                  </table>
              </div>
                
              
          </div>
         
                 <?php 
                }else if(isset($_GET['std']) and isset($_GET['add_newstd']) and !isset($_GET['add_returnstd']) and !isset($_GET['view_std'])){
                 ?>
           <a href="admin-dashboard.php?std" class="btn btn-info">List OF Students</a>
          <h6>Register New Students</h6>
         <?php include "addnew_std.php";?>
          <?php
                }else if(isset($_GET['std']) and isset($_GET['add_returnstd']) and !isset($_GET['view_std'])){
                    ?>
           <a href="admin-dashboard.php?std" class="btn btn-info">List OF Students</a>
                 <h6>Register Returning Student</h6>
          <?php
                }else if(isset($_GET['std']) and isset($_GET['add_registra']) and !isset($_GET['view_std']) and !isset($_GET['view_std'])){
                    ?> 
                     <a href="admin-dashboard.php?std" class="btn btn-info">List OF Students</a>
                   
                   <div class="row">
                       <div class="col-md-6">
                           <h6>Add Registrar</h6>
                           <form method="post" action="process.php?sectn=<?=$sec?>&add_regtrs" style="width: 50%; margin-left: 20%;">
                               <?php
                                if(isset($_GET['msg'])){
                                    echo $_GET['msg'];
                                }
                               ?>
                        <div class="form-group">
                            <select class="form-control" name="stf_id" required="">
                                <option value="">select staff</option>
                                 <?php
                            $stf = $handle->fetchQuery("select * from staff where section = '$sec'");
                            foreach ($stf as $view):
                          ?>
                          <option value="<?=$view['stf_id'];?>"><?=$view['name'];?></option>
                          <?php
                      endforeach;
                          ?>
                            </select>
                        </div>
                               <div class="form-group">
                                   <button type="submit" class="btn btn-sm btn-block btn-success">submit</button>
                               </div>
                    </form>
                       </div>
                       <div class="col-md-6">
                           <h6>List Of Registrars</h6>
                           <div class="table-responsive-sm">
                               <table class="table-sm table-bordered" width="100%">
                                   <tr>
                                        <td>SN</td>
                                        <td>Name</td>
                                        <td width="20%">Action</td>
                                    </tr>
                                    <?php
                                        $view = $handle->fetchQuery("select registras.id,registras.stf_id,registras.section,
                                                staff.stf_id,staff.name 
                                               from registras join staff on registras.stf_id  = staff.stf_id where 
                                               registras.section='$sec'");
                                        $sno =1;
                                        for($q=0; isset($view[$q]); $q++):
                                    ?>
                                    <tr>
                                        <td><?=$sno++;?></td>
                                        <td><?=$view[$q]['name'];?></td>
                                        <td><a href="process.php?delete&del_reg=<?=$handle->validate($view[$q]['id']);?>" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                    <?php
                                    endfor;
                                    ?>
                               </table>
                               
                           </div>
                       </div>
                   </div>
             <?php   
          //teachers
                }else if(isset($_GET['std']) and isset($_GET['view_std']) and !isset($_GET['add_returnstd'])){
                    $std_id = $_GET['view_std'];
              
              $view_st = $handle->fetch("select *,class.cls_id,class.cls_name from student 
                  join class on class.cls_id = student.cls_id
                     where std_id = '$std_id'");
                        ?>
                     <form method="post" action="process.php?edit_profile&student&sectn=<?=$sec?>&id=<?=$handle->validate($view_st['std_id']);?>&editor=<?php echo 'admin' ?>" enctype="multipart/form-data">
        <?php
            if(isset($_GET['msg'])){
                echo $_GET['msg'];
                $c = $handle->validate($view_st['std_id']);
                 echo "<meta http-equiv=\"refresh\"content=\"8;url=staff-dashboard.php?std&single_std=$c\">";
            }
            ?>
                          <a href="admin-dashboard.php?std" class="btn btn-info">Back</a>
       <h6>Edit Student Profile</h6>
        <div class="row">
            
            <div>
             <img height="100"  width="100" style="margin: 5px 0px 0px 3px;" src="<?="../img/photo/".$view_st['photo']?>">
 <div style="margin-top: -25px;margin-left: 4px; background-color:  green; width: 100px; position:  absolute;">
     <a href="#" class="text-white-50" role="button" data-toggle="modal" data-target="#chngImage">Edit Photo</a>
     <br/>
 </div>
  </div>
        </div>
            <br/>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Class</label>
                    <select class="form-control" name="cls_id">
                        <option value="<?=$view_st['cls_id'];?>"><?=$view_st['cls_name'];?></option>
                        <?php
                            $class = $handle->fetchQuery("select * from class where section = '$sec' ");
                             foreach ($class as $view):
                            ?>
                            <option value="<?=$view['cls_id'];?>"><?=$view['cls_name'];?></option>
                            <?php
                            endforeach;
                            ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <label>Registration Number<span class="text-danger">*</span></label>
                <input type="text" name="sname" class="form-control" value="<?="JIS/".substr_replace($view_st['std_id'],"/", 4, 0);?>" disabled="">
            </div>
            <div class="col-4">
                <label>Surname<span class="text-danger">*</span></label>
                <input type="text" name="sname" class="form-control" value="<?=$view_st['surname'];?>" required="">
            </div>
            <div class="col-4">
                <label>Middle Name</label>
                <input type="text" name="mname" class="form-control" value="<?=$view_st['middle_name'];?>" required="">
            </div>
            <div class="col-4">
                <label>Last Name<span class="text-danger">*</span></label>
                <input type="text" name="lname" class="form-control" value="<?=$view_st['other_name'];?>" required="">
            </div>
        </div>
            <br/>
        <div class="row">
            <div class="col-4">
                <label>Gender <span class="text-danger">*</span></label>
                <select class="form-control" name="gender" required="">
                    <option value="<?=$view_st['gender'];?>">select--Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="col-4">
                <label>State of Origin <span class="text-danger">*</span></label>
                <input type="text" name="state" class="form-control" value="<?=$view_st['soo'];?>" required="">
            </div>
            <div class="col-4">
                <label>Local Government <span class="text-danger">*</span></label>
                <input type="text" name="lga" class="form-control" value="<?=$view_st['lga'];?>" required="">
            </div>
        </div>
            <br/>
            <div class="row">
                <div class="col-4">
                    <label>Date OF Birth <span class="text-danger">*</span></label>
                    <input type="date" name="dob" class="form-control" value="<?=$view_st['dob'];?>" required="">
                </div>
                 <div class="col-4">
                    <label>Current Age <span class="text-danger">*</span></label>
                    <input type="number" name="age" class="form-control" value="<?=$view_st['cage'];?>" required="">
                </div>
            </div>
            <br/>
            <div class="row">
                 <h6>Medical report</h6>
            </div>
            <div class="row">
               
                <div class="col-4">
                    <label>Blood Group <span class="text-danger">*</span></label>
                    <input type="text" name="blood_g" class="form-control" value="<?=$view_st['blg'];?>" required="">
                </div>
                 <div class="col-4">
                    <label>Genotype <span class="text-danger">*</span></label>
                    <input type="text" name="genotype" class="form-control" value="<?=$view_st['gnt'];?>" required="">
                </div>
            </div>
            <br/>
            <div class="row">
                <h6 class="text-info">Family Information</h6>
            </div>
            <br/>
            <div class="row">
                <div class="col-4">
                    <label>Family Name</label>
                    <input type="text" name="fname" class="form-control" value="<?=$view_st['fan'];?>" >
                </div>
                <div class="col-4">
                    <label>Fathers Name <span class="text-danger">*</span></label>
                    <input type="text" name="father_name" class="form-control" value="<?=$view_st['fname'];?>" required="">
                </div>
               
                <div class="col-4">
                    <label>Mothers Name</label>
                    <input type="text" name="mothers_name" class="form-control" value="<?=$view_st['mname'];?>" required="">
                </div>
                
            </div>
            <br/>
            <div class="row">
                <label>Residents Address</label>
                <textarea class="form-control" cols="3" name="address" value="<?=$view_st['address'];?>"><?=$view_st['address'];?></textarea>
            </div>
            <br/>
            <div class="row">
                <div class="col-4">
                    <label>Phone Number1</label>
                   <input type="number" name="phone1" class="form-control" value="<?=$view_st['phone1'];?>" required="">
                </div>
                <div class="col-4">
                    <label>Phone Number 2</label>
                   <input type="number" name="phone2" class="form-control" value="<?=$view_st['phone2'];?>">
                </div>
            </div>
            <br/>
           
            <br/>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-warning">Submit</button>
            </div>
         
    </form>

                   <?php  
                }
           }else if(isset($_GET['tch'])){
                     ?>
          <h3>Teachers</h3>
          <hr/>
          <?php
          if(isset($_GET['tch']) and !isset($_GET['add_tch'])){
             ?>
             <div class="container">
                 <a class="btn btn-info" href="admin-dashboard.php?tch&add_tch">Add Staff <span><i class="nc-icon nc-simple-add"></i></span></a>
          </div>
          <div class="container">
              <div class="table-responsive-sm">
                  <h5>List Of Staff</h5>
                  <table class="table " width="60%">
                      <thead class="text-primary">
                          <tr>
                                <th width="20">SN</th>
                                <th>Staff Reg no</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Phone No</th>
                                <th colspan="2">ACTION</th>
                         </tr>
                      </thead>
                      <tbody>
                          <?php
                            $view1 = $handle->query("select * from staff where section = '$sec' ORDER BY name ASC");
                            $sno=1;
                           // for($i=1; isset($view1[$i]); $i++):
                           foreach ($view1 as $view):
                          ?>
                         <tr class="text-uppercase">
                          <td><?=$sno++;?></td>
                          <td><?=$view['stf_id'];?></td>
                          <td><?=$view['name'];?></td>
                          <td><?=$view['gender'];?></td>
                          <td><?=$view['phone'];?></td>
                          <td width="20"><a href="#" class="btn btn-success"><i class="fa fa-eye"></i></td>
                          <td width="20"><a href="process.php?delete&del_staff&id=<?=$handle->validate($view['stf_id']);?>&sectn=<?=$sec;?>" class="btn btn-danger"><i class="fa fa-trash"></i></td>
                      </tr> 
                      <?php
                    endforeach;
                   //     endfor;
                      ?>
                      </tbody>
                      
                  </table>
              </div>
          </div>
          <?php
          }elseif (isset($_GET['tch']) and isset($_GET['add_tch'])) {
                  ?>
          <a href="admin-dashboard.php?tch" class="btn btn-primary">List Of All Teachers</a>
          
          <div class="container" style="width: 50%">
              <h5>Add Staff</h5>
              <hr/>
              <form method="post" action="process.php?sectn=<?=$handle->validate($sec)?>&add_tch">
                  <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="tch_name" class="form-control" placeholder="Enter Staff Name..." required="">
                  </div>
                  <div class="form-group">
                      <label>Gender</label>
                      <select name="gender" class="form-control" required="">
                          <option value="">Select Gender</option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Phone Number</label>
                      <input type="number" name="tch_phone" class="form-control" placeholder="Enter Staff Phone Number...">
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-success btn-block">Submit</button>
                  </div>
              </form>
          </div>
          
          <?php
              }
         //class section
           }else if(isset($_GET['cl'])){
                     ?>
          <h3>Class</h3>
          <hr/>
         <?php
          if(isset($_GET['cl']) and !isset($_GET['add_cl']) and !isset($_GET['add_ms'])){
              ?>
           <div  class="container">
              <ul class="nav nav-pills">
                  <li class="nav-item"><a href="admin-dashboard.php?cl&add_cl" class="btn btn-info">Add class</a></li>
                  <li class="nav-item"><a href="admin-dashboard.php?cl&add_ms" class="btn btn-warning">Add Form Master</a></li>
              </ul>
             
              <h5>List OF Classes</h5>
              <div class="table-responsive-sm">
                  <table class=" table table-sm table-bordered" width="60%">
                      <tr>
                          <th width="20">Sn</th>
                          <th>Class Name</th>
                          <th>Class Arm</th>
                          <th>Form Master</th>
                      </tr>
                      
                      <?php
                      $arm = "";
                        $class_view = $handle->fetchQuery("select class.cls_name,class.cls_arm,class.cls_id,class.section,
                            form_master.cls_id,form_master.stf_id,staff.stf_id,staff.name
                                 from class left join form_master on class.cls_id = form_master.cls_id 
                                left join staff on form_master.stf_id = staff.stf_id where class.section = '$sec'
                                 ");
                        $sno = 1;
                        foreach($class_view as $view):
                            if($view['cls_arm']=="JS"){
                                $arm = "junior class";
                            }elseif ($view['cls_arm']=='SS') {
                                      $arm = "senior class";
                                  }
                      ?>
                      <tr class="text-uppercase">
                          <td><?=$sno++?></td>
                          <td><?=$view['cls_name'];?></td>
                          <td><?=$arm?></td>
                          <td><?=$view['name'];?></td>
                          <td width="20"><a href="process.php?delete&del_class&id=<?=$handle->validate($view['cls_name']);?>&sectn=<?=$handle->validate($sec);?>" class="btn btn-danger"><i class="fa fa-trash"></i></td>
                      </tr>
                      <?php
                  endforeach;
                      ?>
                  </table>
              </div>
          </div>
         <?php     
          }else if(isset($_GET['cl']) and isset($_GET['add_cl'])){
          ?>
          <a class="btn btn-primary" href="admin-dashboard.php?cl">List Of Class</a>
          <div class="container" style="width: 50%">
              <h5>Add Class</h5>
              <form method="post" action="process.php?sectn=<?=$handle->validate($sec)?>&add_cls">
                  <div class="form-group">
                      <label>Class Name</label>
                      <input type="text" name="cls_name" class="form-control" placeholder="Enter Class name..." required="">
                  </div>
                  <div class="form-group">
                      <label>Class Arm</label>
                      <select name="cls_arm" class="form-control" required="">
                          <option value="">Select Class Arm</option>
                          <option value="SS">Senior Class</option>
                          <option value="JS">Junior Class</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-info btn-block">Submit</button>
                  </div> 
              </form>
          </div>
          <?php
          }else if(isset($_GET['cl']) and isset($_GET['add_ms'])){
            ?>
          <a class="btn btn-primary" href="admin-dashboard.php?cl">List Of Class</a>
          <div class="container" style="width:50%">
              <h5>Add Form Master</h5>
              <form method="post" action="process.php?sectn=<?=$handle->validate($sec)?>&add_ms">
              <?php
              if(isset($_GET['error'])){
                    echo '<div class="alert alert-danger">FORM MASTER ALREADY ALLOCATED TO THIS CLASS</div>';
              }
              ?>
                  <div class="form-group">
                      <select name="tch_name" class="form-control" required="">
                          <option value="">Select Staff name</option>
                          <?php
                            $stf = $handle->fetchQuery("select * from staff where section = '$sec'");
                            foreach ($stf as $view):
                          ?>
                          <option value="<?=$view['stf_id'];?>"><?=$view['name'];?></option>
                          <?php
                      endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <select name="cls" class="form-control" required="">
                          <option value="">Select Class</option>
                           <?php
                            $cl = $handle->fetchQuery("select * from class where section = '$sec'");
                            foreach ($cl as $view):
                          ?>
                          <option value="<?=$view['cls_id'];?>"><?=$view['cls_name'];?></option>
                          <?php
                      endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <button type="submit" name="ok" class="btn btn-info btn-block">Submit</button>
                  </div>
              </form>
          </div>     
        <?php
          }
            //subject Section
           }else if(isset($_GET['sb'])){
                     ?>
          <h3>Subjects</h3>
          <hr/>
           <?php
            if(isset($_GET['sb']) and !isset($_GET['comb_sub']) and !isset($_GET['assign_sub']) and !isset($_GET['add_sub'])){
                ?>
          <div class="container">
              <a class=" btn btn-outline-info" href="admin-dashboard.php?sb&add_sub">Add Subject</a>
              <a class=" btn btn-outline-success" href="admin-dashboard.php?sb&comb_sub">Combine Subject</a>
              <a class="btn btn-outline-danger" href="admin-dashboard.php?sb&assign_sub">Assign Teacher</a>
              
              <div class="table-responsive-sm">
                  <table class="table table-bordered" width="60%">
                      <thead>
                        <tr>
                          <th width="20">SN</th>
                          <th>Name</th>
                          <th colspan="2"></th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                              $sql = $handle->query("select * from subject where section='$sec' ");
                              $sn=1;
                              while($view = mysqli_fetch_assoc($sql)):
                                  
                            ?>
                          <tr class="text-uppercase">
                                <td><?=$sn++;?></td>
                                <td><?=$view['sub_name'];?></td>
                                <td width="20"><a class="btn btn-success" data-toggle="modal" data-target="#myModal<?=$check=$view['sub_id'];?>" href=""><i class="fa fa-eye"></i></a></td>
                                <td width="20"><a href="process.php?delete&del_subject&id=<?=$handle->validate(['sub_id']);?>&sectn=<?=$handle->validate($sec);?>" class="btn btn-danger"><i class="fa fa-trash"></i></td>
                            </tr>
                               <?php include './model.php';?>
                            <?php
                              endwhile;
                            ?>
                      </tbody>
                  </table>
              </div>
          </div>
          
          <?php      
            }else if(isset($_GET['sb']) and isset($_GET['comb_sub'])){
                ?>
          <a href="admin-dashboard.php?sb" class="btn btn-info">List of Subjects</a>
          <div class="container" style="width:50%;">
              <h5>Combine Subject To Class</h5>
              <form method="post" action="process.php?sectn=<?=$handle->validate($sec)?>&comb_sub">
                  <?php
                    if(isset($_GET['msg'])){
                        echo $msg = '<div class="alert alert-success">subject comblined successfuly</div>';
                    }elseif(isset($_GET['error'])){
                        echo '<div class="alert alert-danger">SUBJECT ALREADY COMBINED TO THIS CLASS</div>';
                    }
                  ?>
                  <div class="form-group">
                      <label>Subject</label>
                      <select name="sub" class="form-control" required="">
                          <option value="">select subject</option>
                          <?php
                            $sub = $handle->fetchQuery("select * from subject where section = '$sec'");
                            foreach ($sub as $view):
                          ?>
                          <option value="<?=$view['sub_id'];?>"><?=$view['sub_name'];?></option>
                          <?php
                        endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Class</label>
                      <select name="class" class="form-control" required="">
                          <option value="">select class</option>
                         <?php
                            $sub = $handle->fetchQuery("select * from class where section = '$sec'");
                            foreach ($sub as $view):
                          ?>
                          <option value="<?=$view['cls_id'];?>"><?=$view['cls_name'];?></option>
                          <?php
                        endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <button type="submit" class="btn btn-info btn-block">Submit</button>
                  </div>
              </form>
          </div>
          
          <?php      
            } else if(isset($_GET['sb']) and isset($_GET['assign_sub'])) {
                ?>
          <a href="admin-dashboard.php?sb" class="btn btn-info">List of Subjects</a>
          <div class="container" style="width:50%">
              <h5>Assign Subject to Staff</h5>
              
              <form method="post" action="process.php?sectn=<?=$handle->validate($sec)?>&assign_sub">
                 <?php
                    if(isset($_GET['msg'])){
                        echo $msg = '<div class="alert alert-success">subject assigned successfuly</div>';
                    }elseif(isset($_GET['error'])){
                        echo '<div class="alert alert-danger">STAFF ALREADY ALLOCATED TO THIS SUBJECT FOR THIS CLASS</div>';
                    }
                  ?>
                  <div class="form-group">
                      <label>Subject</label>
                      <select name="sub" class="form-control" required="">
                          <option value="">select subject</option>
                         
                          <?php
                            $sub = $handle->fetchQuery("select * from subject where section = '$sec'");
                            foreach ($sub as $view):
                          ?>
                          <option value="<?=$view['sub_id'];?>"><?=$view['sub_name'];?></option>
                          <?php
                        endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Class</label>
                      <select name="class" class="form-control" required="">
                          <option value="">select class</option>
                          <?php
                            $sub = $handle->fetchQuery("select * from class where section = '$sec'");
                            foreach ($sub as $view):
                          ?>
                          <option value="<?=$view['cls_id'];?>"><?=$view['cls_name'];?></option>
                          <?php
                        endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Staff</label>
                      <select name="staff" class="form-control" required="">
                          <option value="">select staff</option>
                          <?php
                            $sub = $handle->fetchQuery("select * from staff where section = '$sec'");
                            foreach ($sub as $view):
                          ?>
                          <option value="<?=$view['stf_id'];?>"><?=$view['name'];?></option>
                          <?php
                        endforeach;
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-info btn-block">Submit</button>
                  </div>
              </form>
          </div>
          <?php
            }else if(isset($_GET['sb']) and isset($_GET['add_sub'])){
                ?>
          <a href="admin-dashboard.php?sb" class="btn btn-info">List of Subjects</a>
          <div class="container" style="width:50%;">
              <h5>Add Subject</h5>
              <form method="post" action="process.php?sectn=<?=$sec?>&add_sub">
                  <div class="form-group">
                      <label>Subject Name</label>
                      <input type="text" name="sub_name" class="form-control" placeholder="enter subject name" required="">
                  </div>
                  <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-info btn-block">Submit</button>
                  </div>
              </form>
          </div>
          
          <?php
            }
           //calender section
           }else if(isset ($_GET['calen'])){
                     ?>
          <h3>Calender</h3>
          <hr/>
            <div class="container">
                  <?php
                  if(isset($_GET['calen']) and !isset($_GET['new_ses']) and !isset($_GET['new_term']) and !isset($_GET['push_calen'])){
                    ?>
                    <div class="container">
            <a class=" btn btn-info" href="admin-dashboard.php?calen&new_ses">New Session</a>
              <a class=" btn btn-success" href="admin-dashboard.php?calen&new_term">New Term</a>
              <a class="btn btn-danger" href="process.php?act_calender&push&sectn=<?=$sec?>"><i class="fa fa-check"></i> Push Calender</a>
            </div>
                <?php
                        if(isset($_GET['msg'])){
                            echo $_GET['msg'];
                            
                            echo "<meta http-equiv=\"refresh\"content=\"8;url=admin-dashboard.php?calen\">";
                        }
                
                ?>
                  <h3>Active Calender</h3>
                  <div class="table-responsive-sm">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                <th>S/N</th>
                                <th>Session</th>
                                <th>Term</th>
                                <th>Term Start</th>
                                <th>Term End</th>
                                <th>Session Start</th>
                                <th>Session End</th>
                                <th>Status</th>
                             </tr>
                          </thead>
                          
                          <tbody>
                              <?php
                                    $see = $handle->query("select 
                                    act_cal.id,act_cal.ses_id,act_cal.term_id,act_cal.term_start,act_cal.term_end,act_cal.status,act_cal.section,
                                    acc_session.ses_id,acc_session.ses_name,acc_session.ses_start,acc_session.ses_end,
                                    term.term_id,term.term_name
                                     from act_cal
                                     left join acc_session on act_cal.ses_id=acc_session.ses_id
                                     left join term on term.term_id=act_cal.term_id order by status DESC
                                     ");
                                    $no=1;
                                    $active="";
                                    while($view = mysqli_fetch_assoc($see)):
                                    
                                      if($view['status'] == 1){
                                          $active = '<button class="btn btn-success btn-sm btn-round">ACTIVE</div>';
                                      }else{
                                          $active = '<button class="btn btn-danger btn-sm btn-round">DEACTIVATED</div>';
                                      }
                              ?>
                            <tr>
                                    <td><?=$no++?></td>
                                    <td><?=$view['ses_name'];?></td>
                                    <td><?=$view['term_name'];?></td>
                                    <td><?=$view['term_start'];?></td>
                                    <td><?=$view['term_end'];?></td>
                                    <td><?=$view['ses_start'];?></td>
                                    <td><?=$view['ses_end'];?></td>
                                    <td><?=$active;?></td>
                            </tr>
                            <?php
                        endwhile;
                            ?>
                          </tbody>
                      </table>
                  </div>
                <?php
                  }
                 else if(isset($_GET['calen']) and isset($_GET['new_ses'])){
                        ?>
                        <a class=" btn btn-info" href="admin-dashboard.php?calen">Active Calender</a>
                      <h3>New Session</h3>
                      <div class="container w-50" >
                          <form method="post" action="process.php?sectn=<?=$sec?>&act_calender&new_ses">
                          <div class="form-group">
                              <label>Session</label>
                              <input type="text" name="ses" class="form-control" placeholder="Enter Session Name">
                          </div>
                          <div class="form-group">
                              <label>Session Start</label>
                              <input type="date" name="ses_start" class="form-control">
                          </div>
                              <div class="form-group">
                              <label>Session Stop</label>
                              <input type="date" name="ses_end" class="form-control">
                          </div>
                          <div class="form-group">
                              <button type="submit" class="btn btn-block btn-primary">Submit</button>
                          </div> 
                        </form>
                      </div>
                        <?php
                      }elseif (isset($_GET['calen']) and isset($_GET['new_term'])) {
                        ?>
                        <a class=" btn btn-info" href="admin-dashboard.php?calen">Active Calender</a>
                        <h3>New Term</h3>
                        <div class="container w-50" >
                          <form method="post" action="process.php?sectn=<?=$sec?>&act_calender&new_term">
                          <div class="form-group">
                              <label>Session</label>
                              <select name="ses" class="form-control">
                                  <option value="">select session</option>
                                  <?php
                                    $result = $handle->fetchQuery("select * from acc_session ");
                                    foreach($result as $v):
                                  ?>
                                  <option value="<?=$v['ses_id'];?>"><?=$v['ses_name'];?></option>
                                  <?php
                                    endforeach;
                                  ?>
                              </select>
                          </div>
                              <div class="form-group">
                              <label>Term</label>
                              <select name="term" class="form-control">
                                  <option value="">select term</option>
                                  <?php
                                    $result = $handle->fetchQuery("select * from term ");
                                    foreach($result as $v):
                                  ?>
                                  <option value="<?=$v['term_id'];?>"><?=$v['term_name'];?></option>
                                  <?php
                                    endforeach;
                                  ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Term Start</label>
                              <input type="date" name="term_start" class="form-control">
                          </div>
                         <div class="form-group">
                              <label>Term Stop</label>
                              <input type="date" name="term_end" class="form-control">
                          </div>
                          <div class="form-group">
                              <button type="submit" class="btn btn-block btn-primary">Submit</button>
                          </div>    
                        </form>
                      </div>
                      <?php  
                      }
                  ?>
            </div>
          <?php
          //fees section
}else if(isset ($_GET['fe'])){
                     ?>
          <h3>Fees</h3>
          <hr/>
          <?php
          if(isset($_GET['fe']) and !isset($_GET['apv_fee']) and !isset($_GET['add_cash'])){
              ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="nav nav-pills">
                  <li class=" nav-item">
                      <a class="btn btn-info" href="admin-dashboard.php?fe&apv_fee">Approve Fees</a>
                  </li>
                  <li class=" nav-item">
                      <a class="btn btn-danger" href="admin-dashboard.php?fe&add_cash">Add Cashier</a>
                  </li>
              </ul>
                    </div>
                    <div class="col-lg-6">
                        <?php
                            $cash= $handle->query("select cashier.stf_id,cashier.section,staff.stf_id,staff.name from cashier 
                                join staff on staff.stf_id = cashier.stf_id
                                    where cashier.section ='$sec'");
                            $vcash = mysqli_fetch_assoc($cash);
                        ?>
                        <h6>CASHIER : <?=$vcash['name'];?></h6>
                    </div>
                </div>
              <div class="table-responsive-sm">
                  <table class="table table-sm table-bordered" width="60%">
                  <thead>
                      <tr>
                          <th width="20">SN</th>
                          <th>Reg No</th>
                          <th>Name</th>
                          <th>Class</th>
                          <th>Session</th>
                          <th>Term</th>
                          <th>Amount</th>
                          <th>Approved By</th>
                          <th>Status</th>
                      </tr>
                  </thead>    

                  <tbody>    
                  <?php
                    $result = $handle->query("select fees.std_id,fees.term_id,fees.ses_id,fees.cls_id,fees.approved_by,fees.status,
                    fees.section,fees.amount,staff.stf_id,staff.name,
                    class.cls_id,class.cls_name,
                    term.term_id,term.term_name,
                    acc_session.ses_id,acc_session.ses_name,
                    student.std_id,student.surname,student.surname,student.other_name,student.middle_name
                     from fees
                     left join staff on fees.approved_by = staff.stf_id
                     join class on class.cls_id = fees.cls_id
                     join term on term.term_id = fees.term_id
                     join acc_session on acc_session.ses_id = fees.ses_id
                     join student  on student.std_id = fees.std_id where fees.section ='$sec'
                     ");
                    $no=1;
                    $status = "";
                   while($view = mysqli_fetch_assoc($result)):

                    if($view['status'] == 1){
                        $status = '<button class="btn btn-success btn-sm btn-round">PAYED</div>';
                    }
                  ?>
                      <tr>
                          <td><?=$no++;?></td>
                          <td><?=$view['std_id'];?></td>
                          <td><?=$view['surname'];?></td>
                          <td><?=$view['cls_name'];?></td>
                          <td><?=$view['ses_name'];?></td>
                          <td><?=$view['term_name'];?></td>
                          <td><?="NGN ".$view['amount'];?></td>
                          <td><?=$view['approved_by'];?></td>
                          <td><?=$status?></td>
                      </tr>
                    <?php
                    endwhile;
                    ?>  
                  </tbody>    
                  </table>
              </div>
          </div>
          <?php
          }else  if(isset($_GET['fe']) and isset($_GET['apv_fee'])){
              ?>
          <div class="row">
              <div class="col-lg-3">
                  <a class="btn btn-info btn-sm" href="admin-dashboard.php?fe">Back</a>
              </div>
              <div class="col-lg-9">
                  <div class="container" style="width:50%;">
              <?php include "appv_fees.php";?>
          </div>
              </div>
          </div>
          
           
          <?php
          }elseif (isset($_GET['fe']) and isset($_GET['add_cash'])) {
            ?>
           <ul class="nav nav-pills">
                  <li class=" nav-item">
                      <a class="btn btn-info" href="admin-dashboard.php?fe">Back</a>
                  </li>
                  
              </ul>
            <div class="container" style="width : 40%;">
                 <h3>Add Cashier</h3>
                <form method="post" action="process.php?add_cash&sectn=<?=$sec;?>">
                  <div class="form-group">
                      <label>Staff</label>
                      <select name="stf_id" class="form-control">
                                  <option value="">select staff</option>
                                  <?php
                                    $result = $handle->fetchQuery("select * from staff where section = '$sec' ");
                                    foreach($result as $v):
                                  ?>
                                  <option value="<?=$v['stf_id'];?>"><?=$v['name'];?></option>
                                  <?php
                                    endforeach;
                                  ?>
                              </select>
                  </div>
                  <div class="form-group">
                      <input type="submit" class="btn btn-block btn-primary">
                  </div>
                </form>
            </div>
      <?php      
          }
    //result section
}else if(isset ($_GET['re']) and !isset($_GET['check_std'])){
                     ?>
         
          <h3>Result Check</h3>
          <hr/>
          <div class="container" style="width: 40%">
              <form method="post" action="admin-dashboard.php?re&check_std">
                  <div class="form-group">
                      <label>Session:</label>
                      <select name="session" class="form-control">
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
                      <select name="class" class="form-control">
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
          <?php
           }else if(isset ($_GET['re']) and isset($_GET['check_std'])){
               ?>
          <div class="table-responsive-sm">
              <table class="table table-sm table-bordered" width="100%">
                  <thead>
                      <tr>
                          <th width="5%">SN</th>
                          <th>Name</th>
                          <th>Class</th>
                          <th width="5%">ACTION</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      $sess_id = $_POST['session'];
                      $term = $_POST['term'];
                      $class_id = $_POST['class'];
                      $sno =1;
                        $view = $handle->fetchQuery("select *,class.cls_id,class.cls_name from  student
                            join class on class.cls_id = student.cls_id
                                where student.cls_id ='$class_id' ");
                        for($i=0; isset($view[$i]); $i++):
                      ?>
                      <tr>
                          <td><?=$sno++;?></td>
                          <td class="text-capitalize"><?=$view[$i]['surname']." ".$view[$i]['middle_name']." ".$view[$i]['other_name'];?></td>
                          <td class="text-uppercase"><?=$view[$i]['cls_name'];?></td>
                          <td><a href="result.php?std_id=<?=$handle->validate($view[$i]['std_id']);?>&cls=<?=$class_id;?>&term=<?=$term;?>&ses=<?=$sess_id;?>&sec=<?=$sec;?>&checker=<?php echo "admin";?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
                      </tr>
                      <?php
                  endfor;
                      ?>
                  </tbody>
              </table>
          </div>
          
          <?php
           }
           else if(isset($_GET['profile'])){
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
                      <img class="avatar border-gray" src="../img/gallery/3.jpg" alt="...">
                    <h5 class="title">User</h5>
                  </a>
                  <p class="description">
                    Subjects Assigned
                  </p>
                </div>
                <p class="description text-center">
                <ol>
                    <li>Mathematics</li>
                </ol>
                </p>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                      <h5>12
                        <br>
                        <small> Class</small>
                      </h5>
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
                <h5 class="card-title">Edit Profile</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Staff ID</label>
                        <input type="text" class="form-control" disabled="" placeholder="" value="1233">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" value="michael23">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" placeholder="Email">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" placeholder="Company" value="Chet">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" placeholder="Last Name" value="Faker">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" placeholder="Home Address" value="Melbourne, Australia">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" placeholder="City" value="Melbourne">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" class="form-control" placeholder="Country" value="Australia">
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
            </div>
          </div>
        </div>
          <?php
           }else if(isset($_GET['cut_off']) and !isset($_GET['cut_off_edit'])){
               ?>
          <h6>Cut-OOf Point</h6>
          <hr/>
          <div class="row">
              <div class="col-md-4">
                  <form method="post" action="process.php?sectn=<?=$handle->validate($sec);?>&cut_off">
                      <?php
                        if(isset($_GET['msg'])){
                            echo $_GET['msg'];
                            echo "<meta http-equiv=\"refresh\"content=\"8;url=admin-dashboard.php?cut_off\">";
                            
                        }
                      
                      ?>
                      <div class="form-group">
                            <h6>Set  Cut-off point</h6>
                            <input type="number" class="form-control" placeholder="cut-off point" name="cut_off">
                        </div>
                        <div class="form-group">
                            <select name="ses_id" class="form-control">
                                <option readonly>select --Session</option>
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
                      <div class=" form-group">
                          <button type="submit" class="btn btn-dark btn-block">Submit</button>
                      </div>
                  </form>
              </div>
              
              <div class="col-md-6">
                  <div class="table-responsive-sm">
                      <table class="table table-sm table-bordered">
                          <tr>
                              <th>Session</th>
                              <th>Cut-Off Point</th>
                              <th></th>
                          </tr>
                          <?php
                            $view = $handle->fetchQuery("select *,acc_session.ses_id
                                     from cut_off 
                                    join acc_session on acc_session.ses_id = cut_off.ses_id                                     
                                    where section='$sec'");
                            for($c=0 ; isset($view[$c]);$c++):
                          ?>
                          <tr>
                              <td><?=$view[$c]['ses_name'];?></td>
                              <td><?=$view[$c]['cut_of'];?></td>
                              <td width="5%"><a href="admin-dashboard.php?cut_off&cut_off_edit=<?=$handle->validate($view[$c]['id']);?>" class="btn btn-primary">Edit</a></td>
                          </tr>
                          <?php
                          endfor;
                          ?>
                      </table>
                  </div>
              </div>
          </div>
          
          <?php
           }if (isset($_GET['cut_off_edit'])){
               $view = $handle->fetch("select * from cut_off where id = '".$_GET['cut_off_edit']."'");
               ?>
          <form method="post" action="process.php?cut_off_edit=<?=$handle->validate($_GET['cut_off_edit']);?>" style="width: 40%;">
              <div class="form-group">
                  <input type="number" class="form-control" value="<?=$view['cut_of'];?>" name="cut_of">
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </form>
          
          
          <?php
           }
          ?>            
  </div>
</div>

    </div>
  
  <!--   Core JS Files   -->
  <script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/core/popper.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <script src="../demo/demo/demo.js"></script>
  <script src="../js/plugins/bootstrap-notify.js"></script>
  <script src="../js/form_Validate.js"></script>
  
  <?php include "change_psword.php";?> 
    <?php include "chnge_img.php";?> 
        <script type="text/javascript">
           $('.input-images').imageUploader();
           
            function checkPassport(){
                var fileInput = document.getElementById('passport');
    var filePath = fileInput.value;
    var fileSize = fileInput.files[0].size;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
        document.getElementById('status').innerHTML ='<font class="text-danger">Please upload file having extensions PNG,JPG,JPEG,GIF only.</font>';
         
          
        if(document.getElementById('agree').checked){
            document.getElementById('btnSubmit').disabled=true;
        }else{
             document.getElementById('btnSubmit').disabled=true;
        }
         
        fileInput.value = '';
       
        return false;
    }else
        if(fileSize > 2097152){
            document.getElementById('status').innerHTML ='<font class="text-danger">file size should be at most 2MB.</font>';
              
        if(document.getElementById('agree').checked){
            document.getElementById('btnSubmit').disabled=true;
        }else{
             document.getElementById('btnSubmit').disabled=true;
        }
        }
           else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('status').innerHTML ='';
                document.getElementById('status').innerHTML = '<img width="150" height="150" src="'+e.target.result+'"/>';
                 
                  
        if(document.getElementById('agree').checked){
            document.getElementById('btnSubmit').disabled=true;
        }else{
             document.getElementById('btnSubmit').disabled=true;
        }
            };
            reader.readAsDataURL(fileInput.files[0]);
         }
       
        }
    }
          
</script>

</body>

</html>
