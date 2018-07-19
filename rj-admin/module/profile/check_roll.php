<?php
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}
$roll=$_POST['roll'];
if(fetchRow("select roll from student_biodata where roll=$roll")){
  echo "Roll number already used";
  ?>
  <script type="text/javascript">
    $('#roll').val('');
  </script>
  <?php
}
?>
