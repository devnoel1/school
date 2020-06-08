<?php

$msg = "";

//setting up calender
$session = $_SESSION['ses_id'];
$term = $_SESSION['term_id'];

        if(isset($_POST['send'])){
            
                
  $ca1=@$_POST['ca1'];      
  $ca2=@$_POST['ca2'];
  $ca3=@$_POST['ca3'];
  $exams=@$_POST['exams'];	
  $abs =@_POST['abs'];
  $std_id = @$_POST['std_id'];
  $cls_id = $_POST['cls_id'];
  $sub_id = $_POST['sub_id'];

 
        $sub = $handle->query("select COUNT(std_id) AS total_std from sub_reg where cls_id = '$cls_id' and sub_id ='$sub_id' and section='$sec' " );
    
    $total_std = 0;
while($row=mysqli_fetch_assoc($sub)){
		$value=$row['total_std'];
		$total_std+=$value;
		}

    $avg[] = 0.0;
     
        
        $total=0;
       


      
    for($a=0; isset($ca1[$a]) && isset($ca2[$a]) && isset($ca3[$a]) && isset($exams[$a])  && isset($std_id[$a]); $a++){
	
    $total=$ca1[$a]+$ca2[$a]+$ca3[$a]+$exams[$a];
    
    
    $avg[$a] = $total/$total_std;
    
    
    
   $result = $handle->query("insert into result(std_id,sub_id,cls_id,ca1,ca2,ca3,exams,term_id,ses_id,total,cls_avg,section)
   values('$std_id[$a]','$sub_id','$cls_id','$ca1[$a]','$ca2[$a]','$ca3[$a]','$exams[$a]','$term',
                       '$session','$total','$avg[$a]','$sec') ");
     
    

        }
    
        
			
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
            
           $insert =$handle->query("insert into accesed (sub_id,cls_id,term_id,ses_id,section) values('$sub_id','$cls_id','$term','$session','$sec')");
                 
$msg = '<div class="alert alert-success">SCORED SUCCESSFULY</div>';
         
        }

       

?>
<div class="container-fluid">
    <div class="table-responsive-sm">
        <table class="table table-sm table-bordered">
            <?=$msg;?>
            <?php
            //getting active term
            $v_term = $handle->fetch("select * from term where term_id = '$term' ");
            
            //getting active session
             $ses = $handle->fetch("select * from acc_session where ses_id = '$session' ");
            
            //getting ssubject details
              $sub_id = $_GET['sub_id'];
                $d = $handle->fetch("select *,subject.sub_name,subject.sub_id,class.cls_name,class.cls_id
                        from sub_comb join subject on subject.sub_id = sub_comb.sub_id
                        join class on class.cls_id = sub_comb.cls_id  where sub_comb.sub_id = '$sub_id' and sub_comb.section='$sec' ");
            ?>
            <tr>
                <td>Subject: <span class="text-capitalize"><?=$d['sub_name'];?></span></td>
                <td>Class: <span class="text-capitalize"><?=$d['cls_name'];?></span></td>
                <td>Term: <span class="text-capitalize"><?=$v_term['term_name'];?></span></td>
                <td>Session: <span class="text-capitalize"><?=$ses['ses_name'];?></td>
            </tr>
        </table>
       
            <?php
            
            $accessed_check = $handle->numRows("select * from accesed
           where sub_id = '$sub_id' and cls_id='".$_GET['cls_id']."' and ses_id='$session' and term_id = '$term' and section='$sec' ");
            
            if($accessed_check > 0){
                ?>
         <table class="table table-sm table-bordered" width="100%">
            
            <tr>
                <td width="5%">SN</td>
                <td>NAMES</td>
                <td>CA1(10)</td>
                <td>CA2(10)</td>
                <td>CA3(10)</td>
                <td>EXAMS (70)</td>
                <td>TOTAL (100)</td>
                <td></td>
            </tr>
        <?php
                    $sub_id = $_GET['sub_id'];
            $view = $handle->fetchQuery("select *,student.std_id,student.surname,student.other_name,student.middle_name
                     from result
                join student on student.std_id = result.std_id    
                where result.sub_id = '$sub_id' and result.section = '$sec'
                    and result.term_id = '$term' and result.ses_id ='$session'
                    ");
            $sno = 1;
            foreach ($view as $v){
            ?>
            <tr>
                <td><?=$sno++;?></td>
                <td class="text-capitalize"><?=$v['surname']." ".$v['middle_name']." ".$v['other_name'];?></td>
                <td width="10%"><?=$v['ca1'];?></td>
                <td width="10%"><?=$v['ca2'];?></td>
                <td width="10%"><?=$v['ca3'];?></td>
                <td width="10%"><?=$v['exams'];?></td>
                <td width="10%"><?=$v['total'];?></td>
                <td width="5%"><a class="btn btn-primary" data-toggle="modal" data-target="#editAss<?=$st=$v['std_id'];?>" href="#">Edit</a></td>
            </tr>
        
        
            <?php
             include './edit_ass.php';
            }
            
           echo ' </table>';     
            }else{
                ?>
            <form method="post"> 
        <table class="table table-sm table-bordered" width="100%">
            
            <tr>
                <td width="5%">SN</td>
                <td>NAMES</td>
                <td>CA1(10)</td>
                <td>CA2(10)</td>
                <td>CA3(10)</td>
                <td>EXAMS (70)</td>
                <td>ABSENT</td>
            </tr>
            <?php
                $sub_id = $_GET['sub_id'];
            $view = $handle->fetchQuery("select *,student.std_id,student.surname,student.other_name,student.middle_name
                     from sub_reg 
                join student on student.std_id = sub_reg.std_id    
                where sub_reg.sub_id = '$sub_id' and sub_reg.section = '$sec'");
            $sno = 1;
            foreach ($view as $v){
            ?>
            <tr>
                <td><?=$sno++;?></td>
                <td hidden=""><input type="hidden" value="<?=$v['std_id'];?>" name="std_id[]"></td>
                <td hidden=""><input type="hidden" value="<?=$d['cls_id'];?>" name="cls_id"></td>
                <td hidden=""><input type="hidden" value="<?=$d['sub_id'];?>" name="sub_id"></td>
                <td class="text-capitalize"><?=$v['surname']." ".$v['middle_name']." ".$v['other_name'];?></td>
                <td width="10%"><input type="number" max="10" min="1" class="form-control" name="ca1[]"></td>
                <td width="10%"><input type="number" max="10" min="1" class="form-control" name="ca2[]"></td>
                <td width="10%"><input type="number" max="10" min="1" class="form-control" name="ca3[]"></td>
                <td width="10%"><input type="number" max="70" min="1" class="form-control" name="exams[]"></td>
                <td width="5%"><input type="checkbox" class="form-control" value="abs" name="abs[]"></td>
            </tr>
            <?php
                }
                echo '</table>
            <button type="submit" class="btn btn-danger" name="send">Submit</button>';
            }
            
            ?>
       
        </form>
    </div>
</div>