<?php
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
 include_once($phpfile);
}
if($_POST['roll'] && $_POST['pass']){
  extract($_POST);
  $pass=md5($pass);
  $count=fetchRow("select roll,pswd from student_biodata where roll=$roll and pswd='$pass'");
  //echo "select roll,pswd from student_biodata where roll=$roll and pswd='$pass'";
  if($count){
 ?>
<div class="form-group">
  <label class="col-lg-4 control-label">New Password</label>
    <div class="col-lg-8">
    <input type="password" class="form-control" id="pswd" name="pswd" style="text-transform:capitalize;">
    </div>
</div>
<div class="form-group">
  <label class="col-lg-4 control-label">Confirm New Password</label>
    <div class="col-lg-8">
    <input type="password" class="form-control" id="pswd" name="cpswd" style="text-transform:capitalize;">
    </div>
</div>

<?php
}else{
  echo "<span style='color:red'>Enter correct password</span>";
}
}
 ?>
