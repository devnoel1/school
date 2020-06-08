<?php
session_start();
include '../config/config.php';

$handle = new config();

$curent_ses = $_SESSION['ses_id'];

$sec = @$_GET['sectn'];
    //addmin class
if(isset($_GET['add_cls'])){
    
    $cls_id = $handle->validate($_POST['cls_name']);
      $cls_name =  $handle->validate($_POST['cls_name']);
      $cls_arm =  $handle->validate($_POST['cls_arm']);
      $sec = $_GET['sectn'];
      
       $handle->query("insert into class(cls_id,cls_name,cls_arm,section) values('$cls_id','$cls_name','$cls_arm','$sec') ");
       
            header("location:admin-dashboard.php?cl");
        
      
      
      //adding form master
  }else if(isset($_GET['add_ms'])){
      
      $sec = $_GET['sectn'];
      $stf_id = $handle->validate($_POST['tch_name']);
      $cls = $handle->validate($_POST['cls']);
      
      $check= $handle->numRows("select * from form_master where cls_id = '$cls' ");
      
      if($check > 0){
           header("location:admin-dashboard.php?cl&add_ms&error"); 
      } else {
            
     $handle->query("insert into form_master (stf_id,cls_id,section) values('$stf_id','$cls','$sec')");
  
      header("location:admin-dashboard.php?cl"); 
    
    }
   
      //adding staff
  }elseif(isset ($_GET['add_tch'])){

       $sec = $_GET['sectn'];
      
       $min = 1111;
       $max = 9999;
       
       $num = mt_rand($min, $max);
       
       $stf_id = "jps/".$num."/stf";
      $name = $handle->validate($_POST['tch_name']);
      $gender = $handle->validate($_POST['gender']);
      $phone = $handle->validate($_POST['tch_phone']);

      //user authentication
      $password = $handle->validate("0000");
      $role =  $handle->validate("staff");
      
       $handle->query("insert into staff (stf_id,name,gender,phone,section) values('$stf_id','$name','$gender','$phone','$sec')");
                //populating login table
       $handle->query("insert into login (username,password,role,section) value('$stf_id','$password','$role','$sec')");   
       

      header("location:admin-dashboard.php?tch"); 
        
      
  }elseif(isset ($_GET['add_sub'])){
     $sub_id  =$handle->validate(uniqid());
     $sub_name = $handle->validate($_POST['sub_name']);
     $sec = $handle->validate($_GET['sectn']);
    
     $handle->query("insert into subject (sub_id,sub_name,section) values('$sub_id','$sub_name','$sec')");
     
     
     header("location:admin-dashboard.php?sb");
     
    
     //combine subject
  }elseif(isset($_GET['comb_sub'])){
          
      $sub = $handle->validate($_POST['sub']);
      $cls = $handle->validate($_POST['class']);
      $sec = $_GET['sectn'];
      
      $check = $handle->numRows("select * from sub_comb where sub_id = '$sub' and cls_id='$cls' and section ='$sec' ");
      
      if($check > 0){

            
            header("location:admin-dashboard.php?sb&comb_sub&error");
            

      }else{

      $handle->query("insert into sub_comb (sub_id,cls_id,section) values('$sub','$cls','$sec')");
                
                header("location:admin-dashboard.php?sb&comb_sub&msg");
              
         }
      
      
      
  }elseif(isset ($_GET['assign_sub'])){
      
      $sub = $handle->validate($_POST['sub']);
      $cls = $handle->validate($_POST['class']);
      $stf = $handle->validate($_POST['staff']);
      $sec = $_GET['sectn'];
      
      //checking if suject is already assignd to the staff for same class
      $check = $handle->numRows("select * from sub_assign where sub_id = '$sub' and stf_id='$stf' and cls_id='$cls' and section ='$sec'");
      
      if($check > 0){

                header("location:admin-dashboard.php?sb&assign_sub&error");   
           
      }else{ 

      $handle->query("insert into sub_assign (sub_id,cls_id,stf_id,section) values('$sub','$cls','$stf','$sec')");
          
            header("location:admin-dashboard.php?sb&assign_sub&msg");
      }
      
  }elseif(isset($_GET['delete'])){
      
     if(isset($_GET['del_sub_comb'])){

         $id = $_GET['sub_id'];
         
         $handle->query("delete from sub_comb where id='$id' ");
        
         header("location:admin-dashboard.php?sb");
        
        
     }else if(isset($_GET['del_assign_sub'])){
         
          $id = $_GET['sub_id'];
         $handle->query("delete from sub_assign where id='$id' ");
         
         header("location:admin-dashboard.php?sb");
         
  
     }elseif(isset($_GET['del_staff'])){
         //deleting staff
      $id = $_GET['id'];
      $handle->query("delete from staff where stf_id='$id' ");
      $handle->query("delete from login where username = '$id' ");
      //redirectiong
  
      header("location:admin-dashboard.php?tch");
     
  
  //deleting student
     }elseif(isset($_GET['del_student'])){
      $id = $_GET['id'];
      $handle->query("delete from student where std_id='$id' ");

   
      header("location:admin-dashboard.php?std");
  
      //deleting class
     }elseif (isset($_GET['del_class'])) {
  
      $id = $_GET['id'];
  
      $handle->query("delete from class where cls_id ='$id' ");

      header("location:admin-dashboard.php?cl");
  
      //deleting subject
     }elseif (isset($_GET['del_subject'])) {
      $id = $_GET['id'];
      $handle->query("delete from subject where sub_id='$id' ");

      header("location:admin-dashboard.php?sb");
     
      //deleting assignment
    }elseif (isset($_GET['del_as'])) {
      $id = $_GET['id'];
        
      $check  =$handle->query("select *  from assignment where ass_id = '$id' ");
      
      $file = mysqli_fetch_array($check);
      
      $f=$file['files'];
      
      unlink("files/".$f);
     
      $handle->query("delete from assignment where ass_id='$id' ");

      header("location:staff-dashboard.php?as");
       
     //deleting registra
    }else if(isset($_GET['del_reg'])){
        $id = $_GET['del_reg'];
        
        $handle->query("delete from registras where id ='$id' ");
        
         header("location:admin-dashboard.php?std&add_registra");
    }
  
     //working on accademic calender
  }elseif(isset($_GET['act_calender'])){
  
          if(isset($_GET['new_ses'])){
                  
              $ses_id = uniqid();
              $ses = $handle->validate($_POST['ses']);
              $ses_start = $handle->validate($_POST['ses_start']);
              $ses_End = $handle->validate($_POST['ses_end']);
  
              $handle->query("insert into acc_session(ses_id,ses_name,ses_start,ses_end) values('$ses_id','$ses','$ses_start','$ses_End')");

              header("location:admin-dashboard.php?calen");
  
          }else if (isset($_GET['new_term'])) {
  
              $ses = $handle->validate($_POST['ses']);
              $term =$handle->validate($_POST['term']);
              $term_start = $handle->validate($_POST['term_start']);
              $term_end =$handle->validate($_POST['term_end']);
              $sec = $_GET['sectn'];
  
             
              
              $handle->query("update act_cal set status = 0 ");
  
              $handle->query("insert into act_cal(ses_id,term_id,term_start,term_end,section,status) 
              values('$ses','$term','$term_start','$term_end','$sec',1) ");
              
              $get_count = $handle->fetch("select * from acc_session where ses_id = '$ses'");
              $no = $get_count['term_count'];
              
              $cucount = $no+1;
              
              $handle->query("update acc_session set term_count = '$cucount' where ses_id='$ses' ");
  
              header("location:admin-dashboard.php?calen");
  
          }elseif(isset($_GET['push'])){
              
              $get_count = $handle->fetch("select * from acc_session where ses_id = '$curent_ses'");
              $no = $get_count['term_count'];
              
              if($no == 3){
              //promoting ss3
                  $handle->query("update student set cls_id = 'graduated' where cls_id='sss3' ");
                  //promoting ss2
                  $handle->query("update student set cls_id = 'sss3' where cls_id='sss2' ");
                  //promoting ss1
                  $handle->query("update student set cls_id = 'sss2' where cls_id ='sss1'  ");
                  //promoting js3
                  $handle->query("update student set cls_id = 'sss1' where cls_id = 'jss3' ");
                  //promoting jss2
                  $handle->query("update student set cls_id = 'jss3' where cls_id = 'jss2'");
                  //promoting jss1
                  $handle->query("update student set cls_id = 'jss2' where cls_id = 'jss1'");
                  
                  
                  $msg = '<div class="alert alert-success">Promotions have being done successfuly</div>';
              }else{
                  $msg = '<div class="alert alert-warning">is not yet time for promotion wait for third term</div>';
              }
                  
                  header("location:admin-dashboard.php?calen&msg=$msg");
          }
  
  }elseif(isset($_GET['apv_fee'])){
  
              $std_reg = $handle->validate($_POST['std_reg']);
              $cls =$handle->validate($_POST['cls']);
              $ses = $handle->validate($_POST['ses']);
              $term =$handle->validate($_POST['term']);
              $amount =$handle->validate($_POST['amount']);
              $sec = $_GET['sectn'];
              $user = $_GET['user'];
              
              $u = substr($std_reg, 4);
               $no = substr($u, 0,4);
                 $y = substr($u,5);
                 
                 $std_reg = $no.$y;
  
              $handle->query("insert into fees (std_id,term_id,cls_id,ses_id,amount,section,status,approved_by) 
              values('$std_reg','$term','$cls','$ses','$amount','$sec',1,'$user')");

                    $check = $handle->numRows("select * from staff where stf_id = '$user' ");
                    
                    if($check > 0){
                        header("location:staff-dashboard.php?fe");
                    }else{
              header("location:admin-dashboard.php?fe");
                    }

  }elseif (isset ($_GET['add_as'])) {
      
      $sub_id = $handle->validate($_POST['sub']);
      $cls_id = $handle->validate($_POST['class']);
      $staff = @$_GET['staff'];
      
      //getting file data
         $file_name = $_FILES['file']['name'];
         $file_size = $_FILES['file']['size'];
         $tmp_name = $_FILES['file']['tmp_name'];
         $file_type = $_FILES['file']['type'];
         
         //getting file extention
         $file_ext =@strtolower(end(explode('.', $file_name)));
        $extention = array("pdf","docx");
        
        if(in_array($file_ext, $extention)== FALSE){
             $error[] = '<div class="alert alert-danger">upload PDF file or DOCS file </div>';
         }
         
         //sending data
         if(empty($error) == TRUE){
             
             $audio = move_uploaded_file($tmp_name, "files/". $file_name);
         
             $sql =$handle->query("insert into assignment (sub_id,cls_id,stf_id,section,files)
                      values('$sub_id','$cls_id','$staff','$sec','$file_name')");
            
           

           //  $msg = '<div class="alert alert-success">Assignment Uploaded Successfuly</div>';
             
              header("location:staff-dashboard.php?as");
         } else {
             foreach ($error as $errors){
                 $msg = $errors;
             }
           header("location:staff-dashboard.php?as&add_as&msg=$msg");
             
         }
    
}else if(isset($_GET['edit_profile'])){
    $id =@$_GET['id'];
    
    if(isset($_GET['staff'])){
        
        $email =$handle->validate($_POST['email']);
        $name = $handle->validate($_POST['name']);
          $email = $handle->validate($_POST['email']);
           $city = $handle->validate($_POST['city']);
            $address = $handle->validate($_POST['address']);
             $country = $handle->validate($_POST['country']);
             
                
  $handle->query("update staff set name = '$name', email = '$email', city='$city', address = '$address', country = '$country' where stf_id ='$id' ");
        
  
  header("location:staff-dashboard.php?profile");
  
  //update student students
    }else if(isset($_GET['student'])){
        
        $std_id = $handle->validate($_GET['id']);
        
    $sname = $handle->validate($_POST['sname']);
    $cls_id = @$handle->validate($_POST['cls_id']);
    $mname = $handle->validate($_POST['mname']);
    $lname = $handle->validate($_POST['lname']);
    $gender =$handle->validate($_POST['gender']);
    $state = $handle->validate($_POST['state']);
    $lga = $handle->validate($_POST['lga']);
    $dob = $handle->validate($_POST['dob']);
    $age = $handle->validate($_POST['age']);
    $blood_g = $handle->validate($_POST['blood_g']);
    $genotype = $handle->validate($_POST['genotype']);
    $fname = $handle->validate($_POST['fname']);
    $father_name = $handle->validate($_POST['father_name']);
    $mother_name = $handle->validate($_POST['mothers_name']);
    $address = $handle->validate($_POST['address']);
    $phone1 = $handle->validate($_POST['phone1']);
    $phone2 = $handle->validate($_POST['phone2']);
    
   
            
             $handle->query("update student set surname='$sname',other_name='$lname',middle_name='$mname',
        gender='$gender',soo='$state',lga='$lga',dob='$dob',cage='$age',blg='$blood_g', cls_id = '$cls_id',
         ,gnt='$genotype',fan='$fname',fname='$father_name',mname='$mother_name',address='$address',
        phone1='$phone1',phone2='$phone2' where section = '$sec' and std_id = '$std_id' ") ;
     
         $msg = '<div class="alert alert-success">student information was updated successfuly</div>';
         
         if($_GET['editor'] == 'staff'){
             header("location:staff-dashboard.php?std&single_std=$std_id&msg=$msg");
         }else if($_GET['editor'] == 'std'){
             header("location:std_dashboard.php?dash&msg=$msg");
         }else if($_GET['editor'] == 'admin'){
             header("location:admin-dashboard.php?std&msg=$msg");
         }
     
        
    }
    
    //changing password
}else if(isset($_GET['change_psw'])){
    $id = $_GET['id'];
    
    $new_psw = $handle->validate($_POST['new_psw']);
   
   $handle->query("update login set password = '$new_psw' where username = '$id' ");
    
    $check = $handle->fetch("select * from login where username = '$id' ");
    $role = $check['role'];
    
    if($role == "student"){
        header("location:std_dashboard.php?dash");
    }elseif ($role == "admin") {
        header("location:admin-dashboard.php?dash");
    }elseif ($role == "staff"){
        header("location:staff-dashboard.php?profile");
    }
    //adding cashier
}else if(isset($_GET['add_cash'])){
    
    $stf_id = $handle->validate(($_POST['stf_id']));
    
    
    $check  =$handle->numRows("select * from cashier where section = '$sec' ");
    
    if($check > 0 ){
        
     $handle->query("update cashier set stf_id = '$stf_id' where section = '$sec'  ");
     
    }else{
        
    $handle->query("insert into cashier (stf_id,section) values('$stf_id','$sec')");
    
    }
    
    header("location:admin-dashboard.php?fe");
   
    
}else if(isset($_GET['add_regtrs'])){
    
    $stf_id = $handle->validate($_POST['stf_id']);
    
    $check = $handle->numRows("select * from registras where stf_id ='$stf_id' ");
    
    if($check > 0){
        $msg = '<div class="alert alert-danger">staff already exist!</div>';
        header("location:admin-dashboard.php?std&add_registra&msg=$msg");
    }else{
    $handle->query("insert into registras (stf_id,section) values('$stf_id','$sec')");
     $msg = '<div class="alert alert-success">Added successfuly</div>';
    header("location:admin-dashboard.php?std&add_registra&msg=$msg");
    }
}elseif(isset ($_GET['open'])){
   $handle->query("update operations set status='1' where section='$sec' ");
   header("location:admin-dashboard.php?std");
}else if(isset($_GET['close'])){
   $handle->query("update operations set status='0' where section='$sec' ");
   header("location:admin-dashboard.php?std"); 
}elseif(isset($_GET['add_std'])){
    
    $y = date("Y");
    
    $year = substr($y, "0", "2");
    
  $count = $handle->fetch("select * from reg_no_count");
  
  $number = $count['cont'];
   
  $number +=1;
  
$reg = str_pad($number, 4, "0", STR_PAD_LEFT);

$handle->query("update reg_no_count set cont='$number' where id = '1' ");

     
    $std_id =$reg.$year;
   
    $sname = $handle->validate($_POST['sname']);
    $mname = $handle->validate($_POST['mname']);
    $lname = $handle->validate($_POST['lname']);
    $gender = $handle->validate($_POST['gender']);
    $cls_id = $handle->validate($_POST['cls_id']);
    $state = $handle->validate($_POST['state']);
    $lga = $handle->validate($_POST['lga']);
    $dob = $handle->validate($_POST['dob']);
    $age = $handle->validate($_POST['age']);
    $blood_g = $handle->validate($_POST['blood_g']);
    $genotype = $handle->validate($_POST['genotype']);
    $fname = $handle->validate($_POST['fname']);
    $father_name = $handle->validate($_POST['father_name']);
    $mother_name = $handle->validate($_POST['mothers_name']);
    $address = $handle->validate($_POST['address']);
    $phone1 = $handle->validate($_POST['phone1']);
    $phone2 = $handle->validate($_POST['phone2']);
    $password = "0000";
    $role = "student";
    

      //getting file data
         $file_name = $_FILES['image']['name'];
         $file_size = $_FILES['image']['size'];
         $tmp_name = $_FILES['image']['tmp_name'];
         $file_type = $_FILES['image']['type'];
         
         //getting file extention
         $file_ext =@strtolower(end(explode('.', $file_name)));
         
         //renaming file
        $name = str_replace($file_name, "",$std_id.".".$file_ext);
         
       //requiredfile extention
         $extention = array("jpg","jpeg","gif","png");
         
         if(in_array($file_ext, $extention)== FALSE){
             $error[] = '<div class="alert alert-danger">invalid file,only  upload PNG,JPG,JPEG,GIF  image files </div>';
         }
        
         //required file size
         if($file_size > 2097152){
             $error [] = '<div class="alert alert-danger">size of file must be 2MB</div>';
         }
       
         //sending data
         if(empty($error) == TRUE){
             
             $photo = move_uploaded_file($tmp_name, "../img/photo/". $name);
         
            
             $handle->query("insert into student (cls_id,std_id,surname,other_name,middle_name,
        gender,soo,lga,dob,cage,blg,gnt,fan,fname,mname,address,phone1,phone2,photo,section)
             values('$cls_id','$std_id','$sname','$lname','$mname','$gender','$state','$lga','$dob',
            '$age','$blood_g','$genotype','$fname','$father_name',
            '$mother_name','$address','$phone1','$phone2','$name','$sec'
            )") ;
             
             $std = "jis/".substr_replace($std_id,"/", 4, 0);
        $handle->query("insert into login (username,password,role,section) values('$std','$password','$role','$sec')");
           
            
         
             $msg = '<div class="alert alert-success">Student Added Successfuly</div>';
         } else {
             foreach ($error as $errors){
                 $msg = $errors;
             }
             
         }
         
         if($_GET['operator'] == 'admin'){
         header("location:admin-dashboard.php?std&add_newstd&msg=$msg");
         }else if($_GET['operator']== 'staff'){
             header("location:staff-dashboard.php?reg&msg=$msg");
         }
         
    
}else if(isset ($_GET['reg_sub'])){
    
          
            $checkbox=@$_POST['subject'];
            $std_id = $handle->validate($_POST['std_id']);
            $cls = $handle->validate($_POST['cls_id']);
		//sending registered courses to database
            
            $check = $handle->numRows("select * from sub_reg where std_id = '$std_id' and section='$sec' ");
	
            if($check > 0 ){
                        $handle->query("delete from sub_reg where std_id = '$std_id' and section='$sec' ");
                        if (isset($_POST['subject']) && !empty($_POST['subject'])) {								
								
								
                    foreach ($_POST['subject'] as $id) {					
					
					//registring subjects
                        $insert = $handle->query("insert into sub_reg(std_id,cls_id,sub_id,section) "
                                . "values('$std_id','$cls','$id','$sec')");
					
						
                        if (!$insert) {
                            die('not worked: ' . mysql_error());
                        } 

                           
                        }
                         $msg = '<div class="alert alert-success">registration was successfull</div>';
                   header("location:staff-dashboard.php?std&single_std=$std_id&msg=$msg");
                    }
            }else{
		  if (isset($_POST['subject']) && !empty($_POST['subject'])) {								
								
								
                    foreach ($_POST['subject'] as $id) {					
					
					//registring subjects
                        $insert = $handle->query("insert into sub_reg(std_id,cls_id,sub_id,section) "
                                . "values('$std_id','$cls','$id','$sec')");
					
						
                        if (!$insert) {
                            die('not worked: ' . mysql_error());
                        } 

                           
                        }
                         $msg = '<div class="alert alert-success">registration was successfull</div>';
                   header("location:staff-dashboard.php?std&single_std=$std_id&msg=$msg");
                    }
             
            }	
	
     
    
    
}else if(isset($_GET['check_result'])){
    
     $std_id = $_POST['std_id'];
        $cls_id =$handle->validate($_POST['cls_id']);
        $term = $handle->validate($_POST['term']);
        $ses = $handle->validate($_POST['ses']);
        $sec = $handle->validate($_POST['sec']);
        $checker = "std";
        
        //check if fees is paid
        
        $fees = $handle->numRows("select * from fees where std_id ='$std_id' 
               and cls_id='$cls_id' and ses_id='$ses' and term_id='$term' and section='$sec' ");
        
        $compiled = $handle->numRows("select * from compiled where std_id ='$std_id' 
               and cls_id='$cls_id' and ses_id='$ses' and term_id='$term' and section='$sec' ");
        
        if($fees > 0){
            if($compiled > 0){
                header("location:result.php?std_id=$std_id&cls=$cls_id&term=$term&ses=$ses&sec=$sec&checker=$checker");
            } else {
                $msg = '<div class="alert alert-warning">result not compiled!</div>';
                header("location:std_dashboard.php?dash&msg=$msg");
            }
            
        }else{
            $msg = '<div class="alert alert-warning">You have not paid your termly school fees!</div>';
            header("location:std_dashboard.php?dash&msg=$msg");
        }
        
    
}else if(isset($_GET['cut_off'])){
    
    $ses_id =$handle->validate($_POST['ses_id']);
    $cut_off = $handle->validate($_POST['cut_off']);
    
    $handle->query("insert into cut_off (ses_id,cut_of,section) values('$ses_id','$cut_off','$sec')");
    
    $msg = '<div class="alert alert-success ">cut-off point added</div>';
    
    header("location:admin-dashboard.php?cut_off&msg=$msg");
}else if(isset($_GET['cut_off_edit'])){
    $cut_of = $_POST['cut_of'];
    
    $handle->query("update cut_off set cut_of = '$cut_of' where id ='".$_GET['cut_off_edit']."'");
     header("location:admin-dashboard.php?cut_off");
}
      


