<?php
$phpfiles=glob("include/php/*.php");
foreach($phpfiles as $phpfile){
 include_once($phpfile);
 }
 if(isset($_POST['roll'])){
   $qry="select id from student_biodata where roll=$_POST[roll] and f_name='$_POST[fname]'";
   $data=fetchRow($qry);
   if($data){
     $detail=fetchOne($qry);
     $array=array('pswd'=>md5($_POST['npswd']));
     addUpdate('student_biodata',$array,$detail['id']);
   }else{
     echo "data dose not match";
   }
}
?>
<form method="post">
  <input type="text" name="roll" placeholder="Enter your roll no">
  <input type="text" name="fname" placeholder="Enter your father name">
  <input type="password" name="npswd">
  <input type="submit" value="submit">
</form>
