<?php
session_start();

        include '../config/config.php';
    
    $handle = new config();
     if(isset($_GET['std_id']) and isset($_GET['cls']) and isset($_GET['term']) and isset($_GET['ses']) and isset($_GET['sec'])){
        $std_id = $_GET['std_id'];
        $cls_id = $_GET['cls'];
        $term = $_GET['term'];
        $ses = $_GET['ses'];
        $sec = $_GET['sec'];
    }

    
    
    $sub = $handle->query("select COUNT(*) AS total_std_sub from sub_reg where cls_id = '$cls_id' and std_id='$std_id' and section='$sec' " );
        $total_std_sub = 0;
while($row=mysqli_fetch_assoc($sub)){
    $stdvalue=$row['total_std_sub'];
    $total_std_sub+=$stdvalue;
    }
    
    $stotal = 0;
    $total_score = 0;
    $std_avg = 0.0;
    
    
        //getting student result
   $t_score = $handle->fetchQuery("select * from result join subject on subject.sub_id = result.sub_id 
                        where result.cls_id = '$cls_id' and std_id ='$std_id' and ses_id = '$ses' and term_id = '$term' and result.section='$sec'  ");
for($i=0;isset($t_score[$i]); $i++){
     
        $stotal = $t_score[$i]['ca1']+$t_score[$i]['ca2']+$t_score[$i]['ca3']+$t_score[$i]['exams'];
        
        $total_score += $stotal;
       
    }
      
      //student average
    $std_avg = $total_score / $total_std_sub;
    
   
    
$details = $handle->fetch("select *,class.cls_id,class.cls_name from student join class on class.cls_id = student.cls_id where std_id = '$std_id'");

$calender = $handle->fetch("select *,acc_session.ses_id,acc_session.ses_name,term.term_id,term.term_name
         from act_cal join acc_session on acc_session.ses_id = act_cal.ses_id join term on term.term_id = act_cal.term_id
         where act_cal.term_id = '$term' and act_cal.ses_id='$ses'");


//total student in class

$std = $handle->query("select COUNT(*) AS total_std from student where cls_id = '$cls_id'" );
    
    $total_std = 0;
while($row=mysqli_fetch_assoc($std)){
    $value=$row['total_std'];
    $total_std+=$value;
    }

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
     result
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
      .details td{
          border: 0;
      }
  </style>
 
</head>
<body onload="print_result()">
            

<div class="container">
    <div class="table-responsive-sm">
        <table class="table table-sm table-borderless"  width="100%">
            <tr>
                <th align="center">
                     <img height="100"  width="100" style="margin: 5px 0px 0px 3px;" src="<?="../img/photo/".$details['photo']?>"> 
                </th>
                <td align="center">
                    <h4><b>JOSEPHINE INTERNATIONAL SCHOOLS</b></h4>
                    <span><b>TERMLY REPORT</b></span>
                    <h6>Motto:</h6>
                    <h6>km 3 Uni-agric Road North-Bank, Makurdi Benue State</h6>
                </td>
                <th align="center">
                     <img height="100"  width="100" style="margin: 5px 0px 0px 3px;" src="<?="../img/photo/".$details['photo']?>">   
                </th>
            </tr>
        </table>
        <table class="table table-borderless table-sm details" width="100%">
            <tr>
                <th class="text-capitalize"><b>Name: <?=$details['surname']." ".$details['middle_name']." ".$details['other_name'];?></b> </th>
                <th class="text-capitalize"><b>Class:</b><strong> <?=$details['cls_name'];?></strong></th>
                <th class="text-capitalize"><b>Term: <?=$calender['term_name'];?></b></th>
            </tr>
            <tr>
                <td class="text-capitalize"><b>Gender: <?=$details['gender'];?></b></td>
                <td><b>Admisson No: <?="JIS/".substr_replace($details['std_id'],"/", 4, 0);?></b></td>
                <td><b>Session: <?=$calender['ses_name'];?></b></td>
            </tr>
        </table>
        <br/>
        <table class="table-sm table-bordered" width="100%">
            <tr>
                <th rowspan="2">Subject</th>
                <th align="center">CA1</th>
                <th align="center">CA2</th>
                <th align="center">CA3</th>
                <th align="center">Exams</th>
                <th align="center">Total</th>
                <th rowspan="2">Highest</th>
                <th rowspan="2">Lowest</th>
                <th rowspan="2">Average</th>
                <th rowspan="2">Position</th>
                <th rowspan="2">Grade</th>
                <th rowspan="2">Remark</th>
            </tr>
            <tr>
                <th align="center">10</th>
                <th align="center">10</th>
                <th align="center">10</th>
                <th align="center">70</th>
                <th align="center">100</th>
            </tr>
            <?php
                $result = $handle->fetchQuery("select * from result join subject on subject.sub_id = result.sub_id 
                        where result.cls_id = '$cls_id' and std_id ='$std_id' and ses_id = '$ses' and term_id = '$term'  ");
                
                
                                                 
                
                for($i=0; isset($result[$i]); $i++ ):
                    
                                  $total = $result[$i]['total'];
                                   $sub_position = $result[$i]['sub_position'];
                                    
                                   //grading
                                   if($total==""){
                                            $grade = "ABS";
                                        }
                                    elseif (70 <= $total ==100){
                                      $grade = "A";

                                    }elseif (60 <= $total ==69) {

                                      $grade = "B";
                                      # code...
                                    }elseif (50 <= $total ==59) {
                                      # code...
                                      $grade = "C";
                                    }elseif (40 <= $total ==49){
                                       $grade = "D";
                                    }else{
                                      $grade= "F";
                                    }
                                    

                                  //setting sub position
 
                                      $done = "";
         if($total == ""){
             $done = "";
         }else{
             $sup =@ substr($sub_position, -1);
             $sup1 =@ substr($sub_position, 0, -1);
             
         if($sup == 0 || $sup == 4 || $sup == 5 || $sup ==  6 || $sup == 7 || $sup == 8
                 || $sup ==  9 || ($sup==1 && $sup1==1)|| ($sup==2 && $sup1==1) ||($sup==3 && $sup1==1)
                 || ($sup==3 && $sup1==1) || ($sup==4 && $sup1==1) || ($sup==5 && $sup1==1) 
                         || ($sup==6 && $sup1==1) || ($sup==7 && $sup1==1) || ($sup==8 && $sup1==1)
                 || ($sup==9 && $sup1==1)){
                                        $done = "<sup>th</sup>";
                     }elseif($sup==1 && $sup1 !=1 ){
                         $done = "<sup>st</sup>";
                     }elseif($sup==2 && $sup1!=1){
                         $done = "<sup>nd</sup>";
                     }elseif($sup==3 && $sup1!=1){
                         $done = "<sup>rd</sup>";
                     }else{
                         $done = "";
                     }
         }
        
         
                $reduce = $result[$i]['cls_avg'];
         $cls_avg = number_format((float)$reduce,2,'.','');
            ?>
            <tr>
                <td class="text-capitalize"><?=$result[$i]['sub_name'];?></td>
                <td><?=$result[$i]['ca1'];?></td>
                <td><?=$result[$i]['ca2'];?></td>
                <td><?=$result[$i]['ca3'];?></td>
                <td><?=$result[$i]['exams'];?></td>
                <td><?=$result[$i]['total'];?></td>
                <td></td>
                <td></td>
                <td><?=$cls_avg;?></td>
                <td><?=$sub_position.$done;?></td>
                <td><?=$grade;?></td>
                <td></td>
            </tr>
            <?php
                endfor;
            ?>
        </table>
        <br/>
        <div class="row">
            <div class="col-md-6">
                <h6 class="text-uppercase">Psychomotor Skills And Affective Areas</h6>
                <table class="table-sm table-bordered table-striped" width="100%">
                    <tr>
                        <th>TRAIT</th>
                        <th>SCORES</th>
                        <th>MAX POINTS</th>
                    </tr>
                    <?php
     $extra_core = $handle->fetchQuery("select *,extra_core.ex_id,extra_core.name,extra_core.marks from extra_score
         join extra_core on extra_core.ex_id = extra_score.ex_id
             where std_id = '$std_id' and ses_id='$ses' and term_id = '$term' and cls_id='$cls_id' ");
                for($e=0; isset($extra_core[$e]); $e++):
                    ?>
                    <tr>
                        <td class="text-capitalize"><?=$extra_core[$e]['name'];?></td>
                        <td><?=$extra_core[$e]['mark'];?></td>
                        <td><?=$extra_core[$e]['marks'];?></td>
                    </tr>
                    <?php
                endfor;
                    ?>
                </table>
            </div>
            <div class="col-md-6">
                <h6>KEY TO RATINGS</h6> 
                <table class="table-sm table-bordered table-striped" width="100%">
                    <tr >
                        <th rowspan="2">AFFECTIVE AREAS</th>
                        <th>Point</th>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        
                    </tr>
                    <tr>
                        <th>Comment</th>
                        <td>Poor</td>
                        <td>Fair</td>
                        <td>Good</td>
                        <td>Very Good</td>
                        <td>Excellent</td>
                        
                    </tr>
                    <tr>
                        <th rowspan="4">ACADEMICS</th>
                        <th>Average Mark</th>
                        <td>70-100</td>
                        <td>60-69</td>
                        <td>50-59</td>
                        <td>40-49</td>
                        <td>0-39</td>
                       
                    </tr>
                    <tr>
                        <th>Grade</th>
                        <td>A</td>
                        <td>B</td>
                        <td>C</td>
                        <td>D</td>
                        <td>F</td>
                    </tr>
                    <tr>
                        <th>Point</th>
                        <td>5</td>
                        <td>4</td>
                        <td>3</td>
                        <td>2</td>
                        <td>1</td>
                    </tr>
                </table>
            </div>
        </div>
        <br/>
        <?php
        //total subject offered by student
            $sub = $handle->query("select COUNT(sub_id) AS total_std from sub_reg where cls_id = '$cls_id' and std_id ='$std_id' and section='$sec' " );
    
                $total_sub = 0;
                while($row=mysqli_fetch_assoc($sub)){
		$value=$row['total_std'];
		$total_sub+=$value;
		}
                
                //total score of student
$total_score = 0;
   $t_score = $handle->fetchQuery("select * from result join subject on subject.sub_id = result.sub_id 
                        where result.cls_id = '$cls_id' and std_id ='$std_id' and ses_id = '$ses' and term_id = '$term' and result.section='$sec'  ");
for($i=0;isset($t_score[$i]); $i++){
     
        $stotal = $t_score[$i]['ca1']+$t_score[$i]['ca2']+$t_score[$i]['ca3']+$t_score[$i]['exams'];
        
        $total_score += $stotal;
       
    }
    //getting student position
      
   $posi_check = $handle->fetch("SELECT * FROM posi
           where std_id = '$std_id' and cls_id = '$cls_id' and ses_id='$ses' and term_id='$term' and section='$sec' ");
  
$final_position = $posi_check['position'];


 $done = "";
        
         
         if($final_position == ""){
             $done = "";
         }else{
             $sup =@ substr($final_position, -1);
             $sup1 =@ substr($final_position, 0, -1);
             
         if($sup == 0 || $sup == 4 || $sup == 5 || $sup ==  6 || $sup == 7 || $sup == 8
                 || $sup ==  9 || ($sup==1 && $sup1==1)|| ($sup==2 && $sup1==1) ||($sup==3 && $sup1==1)
                 || ($sup==3 && $sup1==1) || ($sup==4 && $sup1==1) || ($sup==5 && $sup1==1) 
                         || ($sup==6 && $sup1==1) || ($sup==7 && $sup1==1) || ($sup==8 && $sup1==1)
                 || ($sup==9 && $sup1==1)){
                                        $done = "<sup>th</sup>";
                     }elseif($sup==1 && $sup1 !=1 ){
                         $done = "<sup>st</sup>";
                     }elseif($sup==2 && $sup1!=1){
                         $done = "<sup>nd</sup>";
                     }elseif($sup==3 && $sup1!=1){
                         $done = "<sup>rd</sup>";
                     }else{
                         $done = "";
                     }
         }
          $reduce = $std_avg;
         $std_avg = number_format((float)$reduce,2,'.','');
        ?>
        <table class="table-sm" width="100%">
                    <tr>
                        <th>Number of Subjects: <?=$total_sub;?></th>
                        <th>Total Score: <?=$total_score;?></th>
                        <th>Average: <?=$std_avg;?></th>
                        <th>Position: <?=$final_position.$done;?></th>
                        <th>Out OF: <?=$total_std;?></th>
                    </tr>
                    <tr>
                        <th>Term Began: <?=$calender['term_start'];?></th>
                        <th>Term Ended: <?=$calender['term_end'];?></th>
                        <th>Next Term Begins:</th>
                        <th></th>
                    </tr>
        </table>
        <br/>
        <table class="table-sm table-bordered " border="1" width="100%">
            <tr class="details">
                <td height="80px">Form Master's Comment : </td>
                <td >Princpal's comment : </td>
            </tr> 
            <tr>
                <td>Form Masters's Name : </td>
                <td>Principal's Name :</td>
            </tr>
            <tr>
                <td>Sign: <span style="margin-left: 50%;">Date:</span></td>
                <td>Sign: <span style="margin-left: 50%;">Date:</span></td>
            </tr>
           
        </table>
        
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
  
  <script>
      function print_result(){
          window.print();
      }
      </script>

    </body>
</html>
