<?php
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}
  extract($_POST);
  $fdetail=fetchOne("select id,fee_submit,paid_by,pay_number from fees_submit where id=$fid");
?>
<form  method="post">
  Fees Submit<input type="text" name="fee_submit" value="<?php echo $fdetail['fee_submit'];?>">
  Paid By <input type="radio" name="paid_by" value="cash" <?php if($fdetail['paid_by']=='cash'){echo "checked";}?>>Cash
  <input type="radio" name="paid_by" value="cheque" <?php if($fdetail['paid_by']=='cheque'){echo "checked";}?>>Cheque
  <input type="radio" name="paid_by" value="dd" <?php if($fdetail['paid_by']=='dd'){echo "checked";}?>>Demand Draft
  <input type="text" name="pay_number" value="<?php echo $fdetail['pay_number'];?>">
  <input type="hidden" name="id" value="<?php echo $fdetail['id'];?>">
  <input type="submit"  value="Save">
</form>
