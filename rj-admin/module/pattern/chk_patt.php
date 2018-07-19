<?php
//include_once("connection.php");
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile);
}
if (isset($_POST['name']) && isset($_POST['class'])) {
  extract($_POST);
  if(fetchOne("select name from patteren where name='$name' and class_id=$class")){
    echo "patteren name is alerady taken";?>
    <script>
      $('#patt').val();
      $('#patt').focous();
    </script>
    <?php
  }
}
?>
