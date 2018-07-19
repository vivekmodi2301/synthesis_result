<?php


if(isset($_POST['roll'])&& $_POST['pswd'])
	{
	$roll=trim($_POST['roll']);
	$pswd=trim($_POST['pswd']);
	$rs=mysql_query("select id,roll,pswd from student_biodata where roll='$roll' and pswd='$pswd'");
	//echo "select id,roll,pswd from student_biodata where roll='$roll' and pswd='$pswd'";
	$result= mysql_num_rows($rs);
	echo $rs;
	
	if($result>0)
	{
		$_SESSION['logindtl']=mysql_fetch_array($rs);
		
	?>
<script>location.href="index.php?mod=login&do=profile";</script>
<?php

	}
	else
	{
	?>
    <script> alert ('Incorrect Username or Password..');</script>
    <script>location.href="index.php";</script>
    <?php
		}
	}
	
?>