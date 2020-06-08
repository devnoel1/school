<?php
    session_start();
    
    include '../config/config.php';
    
    $handle = new config();
    
    //setting upacademic calender
    $session = $_SESSION['ses_id'];
    $term = $_SESSION['term_id'];
    
    //setting up user id
    $user = $_SESSION['user'];

   $row = $handle->fetch("select * from login where username ='$user' ");

    $sec =$handle->validate($row['section']);
    
    
    $sumS = 0;
    $sumA = 0;
    $sumC = 0;
    $sumF = 0;
    $sumSub = 0;
    $sumM = 0;

$sql = $handle->query("select * from form_master where stf_id = '$user'");
$cl = mysqli_fetch_assoc($sql);
$class = $cl['cls_id'];
    
    //counting number of students
    $student= $handle->query("select COUNT(*) AS value from student where section = '$sec' and cls_id = '$class' ");
    while($row=mysqli_fetch_assoc($student)){
      $value=$row['value'];
      $sumS+=$value;
      }

      //counting number of staff
    $assignment = $handle->query("select COUNT(*) AS value from assignment where section = '$sec' and stf_id = '$user'");  
    while($row=mysqli_fetch_assoc($assignment)){
      $value=$row['value'];
      $sumA+=$value;
      }
      //counting the number of subjects
      $subject= $handle->query("select COUNT(sub_id) AS value from sub_assign where section = '$sec' and stf_id = '$user'");
      while($row=mysqli_fetch_assoc($subject)){
        $value=$row['value'];
        $sumSub+=$value;
        }
        //counting number of classese
        $class= $handle->query("select COUNT(cls_id) AS value  from sub_assign where section = '$sec' and stf_id = '$user' ");
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
      Staff-dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <link href="../css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
  <style type="text/css">
      .tab-pane{
          padding-top: 3%;
      }
  </style>

 
</head>

<body class="">
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
              <a class="text-white"  href="staff-dashboard.php?dash">
              <i class="nc-icon nc-bank text-white"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li <?php if(isset($_GET['ass'])) echo 'class="active"' ?>>
              <a class="text-white" href="staff-dashboard.php?ass">
              <i class="nc-icon nc-single-02 text-white"></i>
              <p>Assesment</p>
            </a>
          </li>
          <li <?php if(isset($_GET['as'])) echo 'class="active"' ?>>
              <a class="text-white" href="staff-dashboard.php?as">
              <i class="nc-icon nc-book-bookmark text-white"></i>
              <p>Assignment</p>
            </a>
          </li>
          
          <?php
              $check = $handle->numRows("select * from form_master where stf_id = '$user' ");
              if($check > 0){
                ?>
          <li><a><h6 class="text-primary">Form Masters</h6></a></li>
            <li <?php if(isset($_GET['comp'])) echo 'class="active"' ?>>
              <a class="text-white" href="staff-dashboard.php?comp">
              <i class="nc-icon nc-hat-3 text-white"></i>
              <p>Compile Result</p>
            </a>
          </li>
         <li <?php if(isset($_GET['std'])) echo 'class="active"' ?> >
              <a class="text-white" href="staff-dashboard.php?std">
              <i class="nc-icon nc-single-02 text-white"></i>
              <p>Students</p>
            </a>
          </li>
          <li <?php if(isset($_GET['re'])) echo 'class="active"' ?>>
              <a class="text-white" href="staff-dashboard.php?re">
              <i class="nc-icon nc-trophy text-white"></i>
              <p>Result</p>
            </a>
          </li>
                <?php
              }
              
            $cashier = $handle->numRows("select * from cashier where section ='$sec' and stf_id = '$user'");
            
            if($cashier > 0){
          ?>
           <li><a><h6 class="text-primary">CASHIER</h6></a></li>
          <li <?php if(isset($_GET['fe'])) echo 'class="active"' ?>>
              <a class="text-white" href="staff-dashboard.php?fe">
              <i class="nc-icon nc-money-coins text-white"></i>
              <p>Fees</p>
            </a>
          </li>
          <?php
            }
            
            $operation = $handle->numRows("select * from registras where section='$sec' and stf_id='$user' ");
            
              if($operation > 0){
          ?>
           <li><a><h6 class="text-primary">Registration</h6></a></li>
          <li <?php if(isset($_GET['reg'])) echo 'class="active"' ?>>
              <a class="text-white" href="staff-dashboard.php?reg">
              <i class="nc-icon nc-user text-white"></i>
              <p>Register Student</p>
            </a>
          </li>
          <?php
          
              }
          ?>
          
          
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
              <a class="navbar-brand" href="staff-dashboard.php?dash"><?=$sec?> School Teachers Dashboard</a>
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
                    <?php
                        $for_pas = substr($user,4,4);    
                    ?>
                    <a class="dropdown-item" href="staff-dashboard.php?profile">Profile</a>
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
          //teachers dashborad
 if(isset($_GET['dash'])){
               ?>
          <div class="alert alert-info alert-with-icon alert-dismissible fade show" data-notify="container">
                          <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                          <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                          <span data-notify="message">Welcome to <?=$sec;?> school dashboard</span>
                        </div>
          <?php
          $checkreg = $handle->numRows("select * from operations where section='$sec' and status='1' ");
          
          if($checkreg > 0){
              echo '<div class="alert alert-success alert-with-icon alert-dismissible fade show" data-notify="container">
                          <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                          <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                          <span data-notify="message">Registration is on going</span>
                        </div>';
          }else{
              echo '<div class="alert alert-danger alert-with-icon alert-dismissible fade show" data-notify="container">
                          <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                          </button>
                          <span data-notify="icon" class="nc-icon nc-bell-55"></span>
                          <span data-notify="message">Registration is Closed!</span>
                        </div>';
          }
          ?>
                    <div class="row">
                        
                         
                <?php
                if($check > 0 or $check = 0){
                ?>
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
                    <a href="staff-dashboard.php?std">view</a>
                </div>
              </div>
            </div>
          </div>
            <?php
                }?>
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
                      <p class="card-category">Assignment</p>
                      <p class="card-title"><?=$sumA;?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="staff-dashboard.php?as">view</a>
                </div>
              </div>
            </div>
          </div>
            
          <?php
              //if($check > 0){
          ?>
         <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-bookmark-2 text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Subject</p>
                      <p class="card-title"><?=$sumSub;?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="staff-dashboard.php?ass">view</a>
                </div>
              </div>
            </div>
          </div>
         <?php
            //  }else{
                ?>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-hat-3 text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Class</p>
                      <p class="card-title"><?=$sumC;?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a >view</a>
                </div>
              </div>
            </div>
          </div>

           <?php     
           //   }
         ?>   

        </div>
          <?php
          
          
          //list of students in the class
 }elseif(isset ($_GET['std'])){
               ?>
          <h3>Students</h3>
          <hr/>
          <?php
          if(isset($_GET['std']) and !isset($_GET['single_std'])){
              ?>
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
                      $sql = $handle->query("select * from form_master where stf_id = '$user'");
$cl = mysqli_fetch_assoc($sql);
$class = $cl['cls_id'];
                        $view = $handle->fetchQuery("select *,class.cls_id,class.cls_name from student
                           left join class on class.cls_id = student.cls_id
                                 where student.section = '$sec' and student.cls_id = '$class' ");
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
                          <td width="20"><a href="staff-dashboard.php?std&single_std=<?=$handle->validate($view[$s]['std_id']);?>" class="btn btn-success"><i class="fa fa-pencil"></i></a></td>
                          <td width="20"><a href="process.php?delete&del_student&id=<?=$handle->validate($view[$s]['std_id']);?>&sectn=<?=$handle->validate($sec);?>" class="btn btn-danger"><i class="fa fa-trash"></i></td>
                      </tr>
                      <?php
                        endfor;
                      ?>
                  </table>
          </div>
         <?php     
          }else if(isset($_GET['std']) and isset($_GET['single_std'])){
              
              $std_id = $_GET['single_std'];
              
              $view_st = $handle->fetch("select * from student where std_id = '$std_id'");
              
              ?>
          
          <ul class="nav nav-pills" id="myTab">
              <li class="nav-item"><a class=" nav-link btn btn-success" href="staff-dashboard.php?std">Back</a></li>
                  <li class="nav-item"><a class="nav-link active btn btn-warning" data-toggle="tab" href="#profile">Edit Profile</a></li>
                  <li class="nav-item"><a class="nav-link btn btn-info" data-toggle="tab" href="#sub_reg">Register Subject</a></li>
              </ul>
          <h6>Student Information</h6>

<div>             
  <div class="tab-content">
  <div class="tab-pane active" id="profile">
   <h6>Edit Student Profile</h6>
    <div>
             <img height="100"  width="100" style="margin: 5px 0px 0px 3px;" src="<?="../img/photo/".$view_st['photo']?>">
 <div style="margin-top: -25px;margin-left: 4px; background-color:  green; width: 100px; position:  absolute;">
     <a href="#" class="text-white-50" role="button" data-toggle="modal" data-target="#a">Edit Photo</a>
 </div>
  </div>
          <br/><br/>
          <h6 >Registration number : <span class="text-danger"><?="JIS/".substr_replace($view_st['std_id'],"/", 4, 0);?></span></h6>
 <form method="post" action="process.php?edit_profile&student&sectn=<?=$sec?>&id=<?=$handle->validate($view_st['std_id']);?>&editor=<?php echo 'staff' ?>" enctype="multipart/form-data">
        <?php
            if(isset($_GET['msg'])){
                echo $_GET['msg'];
                $c =$handle->validate($view_st['std_id']);
                 echo "<meta http-equiv=\"refresh\"content=\"8;url=staff-dashboard.php?std&single_std=$c\">";
            }
            ?>
       
        <div class="row">
        </div>
            <br/>
        <div class="row">
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
                <label>Resedental Address</label>
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
                  </div>
                  <div class="tab-pane" id="sub_reg">
                      <form method="post" action="process.php?reg_sub&sectn=<?=$sec?>">
            
                          
                                <?php
                                
                                              if(isset($_GET['msg'])){
                echo $_GET['msg'];
            }
                                //student id
                                 $std_id = $_GET['single_std'];
                                 
                                 //class id
                                 $sql = $handle->fetch("select * from form_master where stf_id = '$user'");
                                  $class = $sql['cls_id'];
                            
                          
                       
                             
                               $sub  = $handle->fetchQuery("select *,subject.sub_name from sub_comb
                                    join subject on sub_comb.sub_id = subject.sub_id where sub_comb.cls_id='$class'
                                          ");
                                ?>
                                <input type="hidden" name="std_id" value="<?=$std_id;?>">
                                <input type="hidden" name="cls_id" value="<?=$class;?>">
                                 
                                 <div class="form-group">
                                     <input type="checkbox" class="b" onChange="selectAll(this)"> Select All
                                 </div>
                            <?php
                                for($i = 0;isset($sub[$i]); $i++):
                                    
                                  $sub_id = $sub[$i]['sub_id'];
                                    
                                 $check = $handle->numRows("select * from sub_reg where sub_id = '$sub_id' and std_id = '$std_id' ");
                            ?>
                            <div class="form-group">
                                
                                <input type="checkbox" name="subject[]" value="<?=$sub[$i]['sub_id'];?>" <?php if($check > 0):echo 'checked=""';endif;?>>
                                <span class="text-capitalize"><?=$sub[$i]['sub_name'];?></span>
                            </div>
                            <?php
                              endfor;
                              ?>
                                <div class="form-group">
                                 <button type="submit" class="btn btn-sm btn-primary" name="submit">Submit</button>
                              </div>
                            </form>
                  </div>
              </div>
          </div>
          <?php
          }
          ?>
         <?php
         
         
         //checking of result
           }
           else if(isset ($_GET['re']) and $check >0){
                     ?>
          <h3>Result Check</h3>
          <hr/>
          <div class="row">
                     <form method="post" class="form-inline">
                         
                                 <div class="form-group">
                                    <select name="term" class="form-control text-capitalize">
                                        <option value="">select term</option>
                                        <?php
                                              $term = $handle->fetchQuery("select * from term");
                                              foreach ($term as $view):
                                        ?>
                                        <option value="<?=$view['term_id'];?>"><?=$view['term_name'];?></option>
                                        <?php
                                    endforeach;
                                        ?>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                  <input type="submit" class="btn btn-success btn-block" value="CHECK">
                                 </div>
                              
                 </form>
      
          </div>
          <div class="row">
              <h6>List OF Students</h6>
              <table class="table table-sm table-bordered" width="100%">
                  <tr>
                      <th width="10%" align="center">SN</th>
                      <th width="30%">Registration No</th>
                      <th>Name</th>
                      <th width="10%" align="center">Action</th>
                  </tr>
                  <?php
                  $sql = $handle->query("select * from form_master where stf_id = '$user'");
$cl = mysqli_fetch_assoc($sql);
$class = $cl['cls_id'];

                   if(isset($_POST['term'])){
                      $sess_id = $_SESSION['ses_id'];
                      $term = $_POST['term'];
                      //$class_id = $_POST['class'];
                      $sno =1;
                        $view = $handle->fetchQuery("select *,class.cls_id,class.cls_name from  student
                            join class on class.cls_id = student.cls_id
                                where student.cls_id ='$class' ");
                        for($i=0; isset($view[$i]); $i++):
                  ?>
                  <tr>
                      <td align="center"><?=$sno++;?></td>
                      <td class="text-uppercase"><?="JIS/".substr_replace($view[$i]['std_id'],"/", 4, 0);?></td>
                      <td class="text-capitalize"><?=$view[$i]['surname']." ".$view[$i]['middle_name']." ".$view[$i]['other_name'];?></td>
                      
                      <td align="center"><a href="result.php?std_id=<?=$handle->validate($view[$i]['std_id']);?>&cls=<?=$handle->validate($class);?>&term=<?=$handle->validate($term);?>&ses=<?=$handle->validate($sess_id);?>&sec=<?=$sec;?>&checker=<?php echo "staff";?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a></td>
                  </tr>
                  <?php
                  endfor;
                   }
                  ?>
              </table>
          </div>
       
          <?php
          
          
          
          //students asssesment
}else if(isset($_GET['ass'])){
              ?>
                   <h3>Assessment</h3>
                   <hr>
                  
              <?php
           if(isset($_GET['ass']) and !isset($_GET['add_ass'])){
            ?>
                       <div class="list-group">
                         <h2>Subjects TO Be Accessed</h2>
                       <?php
                         $sub = $handle->query("select sub_assign.stf_id,sub_assign.sub_id,sub_assign.cls_id,sub_assign.section,
                               subject.sub_id,subject.sub_name,class.cls_id,class.cls_name
                         from sub_assign
                         join subject on sub_assign.sub_id = subject.sub_id
                         join class on sub_assign.cls_id = class.cls_id
                         where sub_assign.section ='$sec' and sub_assign.stf_id = '$user' ");
                         $row_check = mysqli_num_rows($sub);
                         $no = 1;
                         if($row_check > 0 ){

                           while($view = mysqli_fetch_assoc($sub)){
                       ?>
                         <a class="list-group-item list-group-item text-uppercase text-danger"
                            href="staff-dashboard.php?ass&add_ass&sub_id=<?=$view['sub_id'];?>&cls_id=<?=$view['cls_id'];?>">
                             <h6><span><?=$no++?>
                           .</span>
                           <span class="btn btn-info btn-sm" style="float: right">
                           <?=$view['cls_name']?></span>    
                             <?=$view['sub_name'];?>   </h6> </a>
                         <?php
                           }
                            }else{
                               echo '<div class="text-danger p-4">no subject assigned to you yet</div>';
                           }
                         ?>
                       </div>
                       
                   <div class="container-fluid">
                             <?php
        }else if(isset($_GET['ass']) and isset($_GET['add_ass'])){
            echo '<a class="btn btn-info" href="staff-dashboard.php?ass">Back</a><br/><br/>';
                   include "assesment.php";
        }
                       ?>
                   </div>
                   <?php
          
          
          
          //compiling result
}else if(isset($_GET['comp'])){
               ?>
          <h3>Compile Result</h3>
          <hr/>
          <?php
          if(isset($_GET['comp']) and !isset($_GET['comp_single'])){
              ?>
         <div class="container">
              <div class="table-responsive-sm">
                  <table class="table table-bordered" width="100%">
                      <tr>
                          <th width="5%">SN</th>
                          <th>Registration No</th>
                          <th>Name</th>
                          <th>Class</th>
                          <th width="40">ACTION</th>
                      </tr>
                      <?php
                         $sql = $handle->query("select * from form_master where stf_id = '$user'");
                            $cl = mysqli_fetch_assoc($sql);
                            $class = $cl['cls_id'];
                        $view = $handle->fetchQuery("select *,class.cls_id,class.cls_name from student
                           left join class on class.cls_id = student.cls_id
                                 where student.section = '$sec' and student.cls_id = '$class' ");
                        $sno = 1;
                        for($s=0;isset($view[$s]); $s++):
                            
                            $regno = $view[$s]['std_id'];
                       $check = $handle->numRows("SELECT * from compiled 
                          where std_id ='$regno' and cls_id='$class'  and ses_id ='$session' and term_id='$term' and section='$sec' ");

                           
                      ?>
                      <tr>
                          <td><?=$sno++;?></td>
                          <td><?="JIS/".substr_replace($regno,"/", 4, 0);?></td>
                          <td><?=$view[$s]['surname']." ".$view[$s]['middle_name']." ".$view[$s]['other_name'];?></td>
                          <td><?=$view[$s]['cls_name'];?></td>
                          <td>
                              <?php
                              if($check >0){
                                              
                                                  echo '<font class="text-success"> <i class="fa fa-check-circle"></i></font>';
                                              }else{
                                                  ?>
                              <a class="btn btn-success" href="staff-dashboard.php?comp&comp_single&std_id=<?=$regno;?>"><i class=" fa fa-pencil"></i></a>
                                                  </td>
                                                  <?php
                                              }
                                                  ?>
                          </td>
                          
                      </tr>
                      <?php
                  endfor;
                      ?>
                  </table>
              </div>
          </div>
          <?php
          }else if(isset($_GET['comp']) and isset($_GET['comp_single'])){
              ?>
          <a class="btn btn-success" href="staff-dashboard.php?comp">Back</a>
          <h6>Student Result</h6>
          <?php include 'result_compile.php';?>
          <?php
          }
         
}elseif (isset ($_GET['as'])) {
            ?>
          <h3>Assignment</h3>
           <hr/>
        <?php
        if(isset($_GET['as']) and !isset($_GET['add_as'])){
            ?>
              <a class="btn btn-danger" href="staff-dashboard.php?as&add_as">Add Assignment</a>
          <div class="container">
              <h5>Uploaded Assignment</h5>
              <div class="table-responsive-sm">
              <table class="table table-striped table-bordered" width="50%">
                  <tr>
                      <th width="20">SN</th>
                      <th>Suject</th>
                      <th>Class</th>
                      
                  </tr>
                  <?php
                        $result = $handle->query("select assignment.ass_id,assignment.sub_id,assignment.cls_id,assignment.section,assignment.stf_id,
                            subject.sub_id,subject.sub_name,class.cls_id,class.cls_name
                            from assignment join subject on assignment.sub_id = subject.sub_id
                            join class on assignment.cls_id = class.cls_id where assignment.section = '$sec'
                                and assignment.stf_id = '$user'
                                ");
                        $no = 1;
                        while($view = mysqli_fetch_array($result)):
                  ?>
                  <tr class="text-uppercase">
                      <td><?=$no++;?></td>
                      <td><?=$view['sub_name'];?></td>
                      <td><?=$view['cls_name'];?></td>
                      <td width="20"><a class="btn btn-info" href="#"><i class="fa fa-eye"></i></a></td>
                      <td width="20"><a class="btn btn-danger" href="process.php?delete&del_as&id=<?=$handle->validate($view['ass_id']);?>&sectn=<?=$sec;?>"><i class="fa fa-trash"></i></a></td>
                  </tr>
                  <?php
                          endwhile;
                  ?>
              </table>
              </div>
          </div>
           <?php
        }else if(isset($_GET['as']) and isset($_GET['add_as'])){
             
            ?>
              <a href="staff-dashboard.php?as" class="btn btn-warning">List Of Assignment</a>
              <div class="container" style="width:50%;">
                  <h5>Upload Assignment</h5>
                  
                   <?=@$_GET['msg'];?>
                  <form method="post" action="process.php?sectn=<?=$sec;?>&add_as&staff=<?=$handle->validate($user);?>"
                        enctype="multipart/form-data">
                     
                      <div class="form-group">
                          <label>Subject</label>
                          <select name="sub" class="form-control text-uppercase">
                              <option value="">Select Subject</option>
                              <?php
                               $sub = $handle->query("select sub_assign.stf_id,sub_assign.sub_id,sub_assign.section,
                                                        subject.sub_id,subject.sub_name
                                                        from sub_assign join subject on subject.sub_id = sub_assign.sub_id
                                                        where stf_id = '$user' and sub_assign.section = '$sec' ");
                                while ($view = mysqli_fetch_array($sub)): 
                              ?>
                              <option value="<?=$view['sub_id'];?>" ><?=$view['sub_name']?></option>
                              <?php
                              endwhile;
                              ?> 
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Class</label>
                          <select name="class" class="form-control text-uppercase">
                              <option value="">Select Class</option>
                              <?php
                                $class = $handle->query("select sub_assign.stf_id,sub_assign.cls_id,sub_assign.section,
                                                        class.cls_id,class.cls_name
                                                        from sub_assign join class on class.cls_id = sub_assign.cls_id
                                                        where stf_id = '$user' and sub_assign.section = '$sec' ");
                                while ($view = mysqli_fetch_array($class)): 
                              ?>
                              <option value="<?=$view['cls_id'];?>"><?=$view['cls_name']?></option>
                              <?php
                              endwhile;
                              ?> 
                          </select>
                      </div>
                       <div class="form-group">
                           <label>Click To Select File</label>
                           <input type="file" name="file" class="form-control">
                       </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-info btn-block">Upload</button>
                      </div>
                          
                  </form>
              </div>
           
        <?php   
        }
    
}else if(isset($_GET['profile'])){
    
    $result = $handle->fetch("select * from staff where stf_id = '$user'");
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
                      <h5 class="title text-capitalize"><?=$result['name'];?></h5>
                  </a>
                  <p class="description">
                    Subjects Assigned
                  </p>
                </div>
                <p class="description text-center">
                <ol>
                    <?php
                      $sub = $handle->query("select sub_assign.stf_id,sub_assign.sub_id,sub_assign.section,
                                                        subject.sub_id,subject.sub_name
                                                        from sub_assign join subject on subject.sub_id = sub_assign.sub_id
                                                        where stf_id = '$user' and sub_assign.section = '$sec' ");
                      while ($view = mysqli_fetch_array($sub)):
                    ?>
                    <li class="text-uppercase"><?=$view['sub_name'];?></li>
                    <?php
                endwhile;
                    ?>
                </ol>
                </p>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                      <h5><?=$sumC;?>
                        <br>
                        <small> Class</small>
                      </h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                      <h5><?=$sumSub;?>
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
                
                  <form method="post" action="process.php?edit_profile&staff&sec=<?=$sec;?>&id=<?=$handle->validate($result['stf_id']);?>">
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Staff ID</label>
                        <input type="text" class="form-control" disabled="" placeholder="" value="<?=$result['stf_id'];?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      
                    </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="<?=$result['email'];?>">
                      </div>
                    </div> 
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Company" value="<?=$result['name'];?>">
                      </div>
                    </div>
                      
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Home Address" value="<?=$result['address'];?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" class="form-control" placeholder="City" value="<?=$result['city'];?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control" placeholder="Country" value="<?=$result['country'];?>">
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
}else if(isset($_GET['sub'])){
          ?>
          <div class="container">
            <h3>Subjects</h3>
          </div>

          <?php
}else if(isset ($_GET['fe'])){
            ?>
      <h3>Fees</h3>
          <hr/>
          <?php
          if(isset($_GET['fe']) and !isset($_GET['apv_fee']) and !isset($_GET['add_cash'])){
              ?>
            <div class="container">
              <ul class="nav nav-pills">
                  <li class=" nav-item">
                      <a class="btn btn-info" href="staff-dashboard.php?fe&apv_fee">Approve Fees</a>
                  </li>
              </ul>
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
                    student.std_id,student.surname,student.surname,student.middle_name
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
                  <a class="btn btn-info btn-sm" href="staff-dashboard.php?fe">Back</a>
              </div>
              <div class="col-lg-9">
                  <div class="container" style="width:50%;">
              <?php include "appv_fees.php";?>
          </div>
              </div>
          </div>
          
          <?php
          }  
}else if(isset ($_GET['reg'])){
    ?>
          <h3>Register Student</h3>
          <hr/>
          <?php
          $query = $handle->numRows("select * from operations where section='$sec' and status='1' ");
          
          if($query > 0){
              $operator = 'staff';
             include "addnew_std.php";
          }else{
              echo '<div class="alert alert-danger">Registration is Closed</div>';
          }
          ?>

 <?php
} 
     ?>
            
  </div>
          
          

      </div>

    </div>
    
 <?php include "change_psword.php";?>   
  <!--   Core JS Files   -->
  <script src="../js/jquery-3.2.1.min.js"></script>

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="../js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <script src="../js/form_Validate.js"></script>
  
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
  
  <script>
      function selectAll(ele){
          var checkboxes = document.getElementsByName('subject[]');
          var bb = document.getElementsByClassName('b');
          
          if(ele.checked == true){
               for (var i =0; i < checkboxes.length; i++){
              checkboxes[i].checked = true;
            }
          }else{
               for (var i =0; i < checkboxes.length; i++){
              checkboxes[i].checked = false;
            } 
          }
         
     
      }
  </script>
   <script>
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
</body>

</html>
