<?php
  $msg="";

    
    
//getting teachers details
      $sql = $handle->query("select * from form_master where stf_id = '$user'");
                            $cl = mysqli_fetch_assoc($sql);
                            $class = $cl['cls_id'];
                            $sec = $cl['section'];
      
      
     

  //getting student id  
    $std_id =$handle->validate($_GET['std_id']);
     
      
       $std = $handle->query("select COUNT(*) AS total_std from student where cls_id = '$class' and section='$sec' " );
    
    $total_std = 0;
while($row=mysqli_fetch_assoc($std)){
    $value=$row['total_std'];
    $total_std+=$value;
    }
      
    //counting number of subject taking by student
    $sub = $handle->query("select COUNT(*) AS total_std_sub from sub_reg where cls_id = '$class' and std_id='".$_GET["std_id"]."' and section='$sec' " );
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
                        where result.cls_id = '$class' and std_id ='$std_id' and ses_id = '$session' and term_id = '$term' and result.section='$sec'  ");
for($i=0;isset($t_score[$i]); $i++){
     
        $stotal = $t_score[$i]['ca1']+$t_score[$i]['ca2']+$t_score[$i]['ca3']+$t_score[$i]['exams'];
        
        $total_score += $stotal;
       
    }
    
  
           
    //student average
    $std_avg = $total_score / $total_std_sub;

// checking if student exits in position table
    
   $posi_check = $handle->query("SELECT * FROM posi
           where std_id = '".$_GET['std_id']."' and cls_id = '$class' and ses_id='$session' and term_id='$term' and section='$sec' ");


    $num_posi = mysqli_num_rows($posi_check);

    
    if($num_posi > 0){

       $posiupdat = $handle->query("UPDATE posi set std_avg = '$std_avg'
                where std_id = '$std_id' and cls_id = '$class' and term_id = '$session' and ses_id='$term' and section='$sec' ");

       //updating position
        $update = $handle->query("UPDATE posi SET position = @curRank:=0 WHERE cls_id = '$class' and ses_id = '$session'
                and term_id = '$term' and section='$sec' order by std_avg DESC");
         
         $update = $handle->query("UPDATE posi join(SELECT std_id,
               std_avg,
              IF(std_avg=@_last_age,@curRank:=@curRank,@curRank:=@_sequence) AS position,
              @_sequence:=@_sequence+1,@_last_age:=std_avg
    FROM  posi r, (SELECT @curRank := 1, @_sequence:=1, @_last_age:=0) r
    WHERE cls_id = '$class' and ses_id = '$session'
                and term_id = '$term' and section='$sec' ORDER BY  std_avg DESC) as positions  USING(std_avg)
    SET  posi.position = positions.position ");         
    }else{
 
    $std_position = $handle->query("insert into posi(std_id,term_id,ses_id,cls_id,std_avg,section)
             values('$std_id','$term','$session','$class','$std_avg','$sec')");

     
    //updating position
       $update = $handle->query("UPDATE posi SET position = @curRank:=0 WHERE cls_id = '$class' and ses_id = '$session'
                and term_id = '$term' and section='$sec' order by std_avg DESC");
         
         $update = $handle->query("UPDATE posi join(SELECT std_id,
               std_avg,
              IF(std_avg=@_last_age,@curRank:=@curRank,@curRank:=@_sequence) AS position,
              @_sequence:=@_sequence+1,@_last_age:=std_avg
    FROM  posi r, (SELECT @curRank := 1, @_sequence:=1, @_last_age:=0) r
    WHERE cls_id = '$class'  and ses_id = '$session'
                and term_id = '$term' and section='$sec' ORDER BY  std_avg DESC) as positions  USING(std_avg)
    SET  posi.position = positions.position ");        


       }
       
    
        
         $postion = $handle->fetch("select * from posi where std_id = '".$_GET['std_id']."' and term_id='$term' and 
          ses_id='$session' and cls_id='$class'");
//setting promotion
		  $promoted="";
      $notPromoted = "";
		  
			if($postion['std_avg'] >= 39.00 ){
					$promoted = 'promoted';
			}else{
             $notPromoted = "repeat current class";
      }
         
    
    
if(isset($_POST['submit'])){
    
    
   $marks = $_POST['mark'];
   $ex_id = $_POST['ex_id'];
   

   
   for($a=0; isset($marks[$a])&& isset($ex_id[$a]) ; $a++){
       
       $insert = $handle->query("insert into extra_score(ex_id,cls_id,std_id,term_id,ses_id,mark,section)
               values('$ex_id[$a]','$class','".$_GET["std_id"]."','$term','$session','$marks[$a]','$sec')");

   }
  
        
    $compiled = $handle->query("insert into compiled (cls_id,term_id,ses_id,std_id,section) values('$class','$term','$session','".$_GET['std_id']."','$sec')");
       
       $msg = '<div class="alert alert-success" style="float : right;">RESULT COMPILED SUCCESSFULY</div>';
        echo "<meta http-equiv=\"refresh\"content=\"1;url=staff-dashboard.php?comp\">";
    
  
    
}
   

    $details = $handle->fetch("select *,class.cls_id,class.cls_name from student
            join class on class.cls_id = student.cls_id where std_id = '".$_GET['std_id']."' and student.section='$sec' ");
?>

<Div class="row">
    <?=$msg;?>
</Div>
<div class="row">
    
    <div class="col-md-6">
        <table class="table-sm" width="100%">
    <tr>
        <td rowspan="5" width="20%;"><img height="150"  width="150" style="margin: 5px 0px 0px 3px;" src="<?="../img/photo/".$details['photo']?>"> </td>
        <th class="text-capitalize"><b>Name: <?=$details['surname']." ".$details['middle_name']." ".$details['other_name'];?> </b></th>
    </tr>
    <tr>
        
        <th><b>Admission No: <?="JIS/".substr_replace($details['std_id'],"/", 4, 0);?></b></th>
    </tr>
    <tr>
        
        <th class="text-capitalize"><b>Class: <?=$details['cls_name'];?></b></th>
    </tr>
    <tr>
        <th>Term: </th>
    </tr>
    <tr>
        <th>Session: </th>
    </tr>
</table>
    </div>
    <div class="col-md-6">
                <h6 class="text-uppercase">Psychomotor Skills And Affective Areas</h6>
                <div class="table-responsive-sm">
                    <form method="post">
                        <table class="table-sm table-bordered table-striped table-responsive-sm" width="100%">
                    <tr>
                        <th>TRAIT</th>
                        <th>SCORES</th>
                        <th>MAX POINTS</th>
                    </tr>
                    <?php
                        $extra_core = $handle->fetchQuery("select * from extra_core");
                        for($c=0; isset($extra_core[$c]); $c++):
                    ?>
                    <tr>
                        <td class="text-capitalize"><?=$extra_core[$c]['name'];?></td>
                        <td><input type="number" min="1" max="5" name="mark[]" class="form-control"></td>
                        <td hidden=""><input type="hidden" name="ex_id[]" value="<?=$extra_core[$c]['ex_id'];?>" class="form-control"></td>
                        <td width="10%" align="center"><?=$extra_core[$c]['marks'];?></td>
                    </tr>
                    <?php
                endfor;
                    ?>
                </table>
                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                    </form>
                     
                </div>
               
            </div>
</div>