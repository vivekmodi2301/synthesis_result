<?php
session_start();
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}
$pageData=10;
//print_r($_POST);
  extract($_POST);
  if(isset($wh) ){

    $wh="where 1 ";
    if($roll){
      $wh.=" and roll like'$roll%' ";
    }
    if($citystate){
      $wh.=" and state like'$citystate%' or district like'$citystate%' ";
    }
    if($sname){
      $wh.=" and s_name like '$sname%' ";
    }
    if($fname){
      $wh.=" and f_name like '$fname%' ";
    }
    if($classs){
      $wh.=" and class='$classs' ";
    }
    if($batch){
      $wh.=" and batch='$batch' ";
    }
    $_SESSION['wh']=$wh;
  }else{
    $wh=$_SESSION['wh'];
    //unset($_SESSION['wh']);
  }
  if(isset($nod) && $nod){
    $pageData=$nod;
  }
  //echo $wh;
//echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id $wh";?>

<?php

$url="module/profile/search.php?abc=abc";
$limit=1;
$frmdataget=$_REQUEST;
@PaginationWork($pageData);
$totRslt=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as tot from student_biodata left join batch on batch=batch.id left join class on class=class.id $wh"));
$qry="select student_biodata.id,roll,class.name as class,s_name,f_name,batch.name as name,propic from student_biodata left join batch on batch=batch.id left join class on class=class.id $wh limit  ".$frmdata['from'].", ".$frmdata['to'];
//echo "select student_biodata.id,roll,class.name as class,s_name,f_name,batch.name as name,propic from student_biodata left join batch on batch=batch.id left join class on class=class.id $wh limit  ".$frmdata['from'].", ".$frmdata['to'];
  $rs=mysqli_query($con,$qry);
  ?>
      <table class="table table-bordered table-hover" id="stu_table">

        <tr><td colspan="8"><span style="color:#900; font-weight:bold;">Total Students in this section : <?php echo $totRslt['tot'];?></span></td></tr>
    <tr class="active1 table_style" style="font-weight:600;">
          <td width="50">Sr. No.</td>
          <td width="80">Roll No.</td>
          <td width="200">Student Name</td>
          <td width="200">Father Name</td>
          <td width="120">Class</td>
          <td width="120">Batch</td>
          <td width="100">Photo</td>
          <!--<td width="80">View Full Profile</td>-->
          <td width="50" colspan="2">Action</td>
      </tr>
      <?php
        $sno=1;

        //echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id";
        while($stu_detail=mysqli_fetch_assoc($rs)){

        		if($stu_detail['propic']){
        			$propic="images/student_images/".$stu_detail['propic'];
        		}else{
        			$propic="images/view.gif";
        		}
       ?>
      <tr class="primary1 table_style2">
          <td><?php echo $sno++;?></td>
          <td><?php echo $stu_detail['roll'];?></td>
          <td><?php echo $stu_detail['s_name'];?></td>
          <td><?php echo $stu_detail['f_name'];?></td>
          <td><?php echo $stu_detail['class'];?></td>
          <td><?php echo $stu_detail['name'];?></td>
          <td><img src=<?php echo ROOT.$propic;?> height="30" width="30" /></td>
          <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
          <td><a href="index.php?mod=profile&do=edit_profile&id=<?php echo $stu_detail['id'];?>" title="Edit Profile"><img src=<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a> | <a href="#" title="Delete Profile" onclick="del('<?php echo $stu_detail['id'];?>')"><img src=<?php echo ROOT."images/trash.png"; ?> height="20" width="20" /></a></td>
      </tr>
      <?php }?>

      <tr>
          <td colspan="20">
            <?php searchPaginationDisplay($totRslt['tot'],$url.'&pageNumber=','',$pageData,$wh);?>
          </td>
</tr>
  </table>
