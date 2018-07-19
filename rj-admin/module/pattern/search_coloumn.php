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

  if($cname){
    $wh.=" and coloumn.name like '$cname%' ";
  }
?>
<tr class="active1 table_style" style="font-weight:600;">
      <td width="100">Sr. No.</td>
      <td width="200">Pattern Name</td>
      <td width="200">Class Name</td>
      <td width="200">Subject Name</td>
      <td width="200">Sequence Number</td>
      <!--<td width="80">View Full Profile</td>-->
      <td width="50" colspan="2">Action</td>
  </tr>
  <?php
    $sno=1;
    $qry="select coloumn.id,class.name as class,sequence, patteren.name as patteren,tname, coloumn.name as coloumn from patteren join class on  class_id=class.id join coloumn on patt_id=patteren.id $wh";
    if(fetchRow($qry)){
    $patt_detail=fetchAll($qry);
    //echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id";
    foreach ($patt_detail as  $patt_detail) {
   ?>
  <tr class="primary1 table_style2">
      <td><?php echo $sno++;?></td>
      <td><?php echo $patt_detail['patteren'];?></td>
      <td><?php echo $patt_detail['class'];?></td>
      <td style="text-transform:uppercase;"><?php echo $patt_detail['coloumn'];?></td>
      <td><?php echo $patt_detail['sequence'];?></td>
      <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
      <td><a href="index.php?mod=pattern&do=edit_coloumn&id=<?php echo $patt_detail['id'];?>" title="Edit Profile"><img src=<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a> | <a href="#" onclick="del('<?php echo $patt_detail['id'];?>','<?php echo $patt_detail['tname'];?>')">Delete</a></td>
  </tr>
<?php }}else{?>
<tr>
  <td colspan="5">No data found</td>
</tr>
  <?php
}?>
