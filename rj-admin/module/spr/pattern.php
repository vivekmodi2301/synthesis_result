<option value="">Select Patteren</option>
<?php
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile);
}
  if(isset($_POST['cid'])){
    extract($_POST);
    $qry="select id,name,tname from patteren where class_id=$cid";
    $data=fetchAll($qry);
    foreach ($data as  $value) {
      ?>
        <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
      <?php
    }
  }
?>
