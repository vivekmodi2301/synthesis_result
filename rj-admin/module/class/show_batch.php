
<option value="">Select Batch</option>
<?php
$batchid="";
if (isset($_POST['batchid'])) {
  $batchid=$_POST['batchid'];
}
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}

  $cid=$_POST['cid'];
  $batch_data=fetchAll("select id,name from batch where class_id=$cid");
  foreach ($batch_data as $batch_data) {
?>
<option value="<?php echo $batch_data['id'];?>" <?php if ($batchid && $batch_data['id']==$batchid){echo "selected";}?>
><?php echo $batch_data['name'];?></option>
<?php }?>
