<?php
//include_once("connection.php");
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile);
}
$name="";
$class="";
if ($_POST['name']) {
	$name=$_POST['name'];
}
else {
	?>
	<script type="text/javascript">
	$('#name').focus();
	</script>
	<?php
	echo "Please enter batch name";
}
if ($_POST['class']) {
	$class=$_POST['class'];
}
else {
	?>
	<script type="text/javascript">
	$('#classs').focus();
	$('#eclass').html("Please enter class name");
	</script>
	<?php
}
//echo "select id,name from class where name='$name'";
if(fetchOne("select id,name from batch where name='$name' and class_id=$class")){?>
	<script type="text/javascript">
	$('#cname').focus();
	$('#cname').val("");
	</script><?php
	echo "This batch is alerady exist";
}
?>
