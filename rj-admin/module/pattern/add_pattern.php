<?php
	if(isset($_POST['class_id'])){
	$_POST['tname']=$_POST['name'];
	$tname=explode(' ',$_POST['tname']);
	if(is_array($tname)){
		$_POST['tname']=implode('_',$tname);
	}
	//echo $_POST['tname'];exit;
	$_POST['tname']=strtolower($_POST['tname']);
	//echo $_POST['tname'];exit;
    $patt=array('name'=>$_POST['name'],'class_id'=>$_POST['class_id'],'tname'=>$_POST['tname']."_".$_POST['class_id']);
    $patt_id=laddUpdate('patteren',$patt);
		//echo $last_id;exit;
    $create_table="create table $patt[tname]( id int primary key auto_increment, exam_date varchar(20), roll int(10), ";
    if(is_array($_POST['subject'])){
      $count=count($_POST['subject']);
      for($i=0;$i<$count;$i++){
				$_POST['subject'][$i]=strtolower(str_replace(" ","_",$_POST['subject'][$i]));
        $heading=$_POST['subject'][$i];
        $create_table.="`$heading` varchar(20),";
				$data=array('patt_id'=>$patt_id,'name'=>$heading,'sequence'=>$i+1);
				addUpdate('coloumn',$data);
      }
    }
    $create_table.="test int(9))";
    create_table($create_table);
    ?>
      <script>
        location.href="index.php?mod=pattern&do=see_pattern";
      </script>
    <?php
	}
?>
	<div class="col-lg-12">
    <form role="form" method="post" class="form-horizontal" name="change_pwd" enctype="multipart/form-data" action="">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">Select Class</label>
                    <div class="col-lg-8">
                    <select class="form-control" id="classs" name="class_id">
                    <option value="">Please Select Class</option>
						<?php
							$class_data=fetchAll("select id,name from class");
							foreach($class_data as $class_data){
							?>
                            	<option value="<?php echo $class_data['id'];?>"><?php echo $class_data['name'];?></option>
                            <?php
							}
						?>
                    </select>
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Name of New Pattern</label>
                    <div class="col-lg-8">
                    <input type="text" onchange="chkpatt(this.value,classs.value)" class="form-control" id="patt" name="name" value="" style="text-transform:capitalize;">
										<div id="cpatt">

										</div>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Number  of Coloums</label>
                    <div class="col-lg-8">
                      <input type="number" class="form-control" onchange="showinput(this.value)">
                    </div>
                </div>
                <div class="form-group" id="input">

                </div>
                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
</div>
<script type="text/javascript">
function showinput(totalcol) {
  $.ajax({
    url:"module/pattern/input.php",
    data:"col="+totalcol,
    type:'POST',
    success:function(e){
      $('#input').html(e);
    }
  });
}
</script>

<script type="text/javascript">
function chkpatt(name,classs) {
  $.ajax({
    url:"module/pattern/chk_patt.php",
    data:"name="+name+"&class="+classs,
    type:'POST',
    success:function(e){
      $('#cpatt').html(e);
    }
  });
}
</script>
