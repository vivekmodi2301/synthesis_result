<?php
//include_once("connection.php");
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
	include_once($phpfile);
}
$name="";
if ($_POST['name']) {
	$name=$_POST['name'];
}
else {
	?>
	<script type="text/javascript">
	$('#name').focus();
	</script>
	<?php
	echo "Please enter class name";
}
//echo "select id,name from class where name='$name'";
if(fetchOne("select id,name from class where name='$name'")){?>
	<script type="text/javascript">
	$('#name').focus();
	$('#name').val("");
	</script><?php
	echo "This class is alerady exist";
}
?>
