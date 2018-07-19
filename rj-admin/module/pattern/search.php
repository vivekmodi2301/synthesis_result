<?php

$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}
  extract($_POST);
  $wh="where 1 ";
  if($classs){
    $wh.=" and class_id='$classs' ";
  }
  if($name){
    $wh.=" and patteren.name like '$name%' ";
  }
//echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id $wh";?>
<tr class="active1 table_style" style="font-weight:600;">
      <td width="100">Sr. No.</td>
      <td width="300">Pattern Name</td>
      <td width="200">Class Name</td>
      <!--<td width="80">View Full Profile</td>-->
      <td width="50" colspan="2">Action</td>
  </tr>
  <?php
    $sno=1;
    $qry="select patteren.name as pattern, class.name as class,patteren.id,tname from patteren join class on class_id=class.id $wh";
    if(fetchRow($qry)){
      $stu_detail=fetchAll($qry);
      foreach ($stu_detail as  $stu_detail) {
   ?>
  <tr class="primary1 table_style2">
      <td><?php echo $sno++;?></td>
      <td><?php echo $stu_detail['pattern'];?></td>
      <td><?php echo $stu_detail['class'];?></td>
      <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
      <td><a href="index.php?mod=pattern&do=edit_pattern&id=<?php echo $stu_detail['id'];?>" title="Edit Profile"><img src=<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a>| <a href="#" onclick="del('<?php echo $stu_detail['id'];?>','<?php echo $stu_detail['tname'];?>')" title="Delete Class"><img src=<?php echo ROOT."images/trash.png";?> height="20" width="20" /></a>
  </tr>
  <?php }}else{?>
<tr>
  <td colspan="4">No data found</td>
</tr>
<?php
  }?>
