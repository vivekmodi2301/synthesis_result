<?php
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile);
}
  if(isset($_POST['cid'])){
    extract($_POST);
    $qry="select name,tname from pattern where class_id=$cid";
    $data=fetchAll($qry);
    foreach ($data as  $value) {
      ?>
        <option value="<?php echo $data['tname'];?>"><?php echo $data['name'];?></option>
      <?php
    }
  }
?>
