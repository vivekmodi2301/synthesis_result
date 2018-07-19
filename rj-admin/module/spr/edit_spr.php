<?php
$id="";
  $col_name=array();
  if(isset($_GET['id']) && isset($_GET['table']) && $_GET['id'] && $_GET['table']){
    extract($_GET);
    $_GET['table']=strtolower($_GET['table']);
    $table=explode('_',$table);
    if(count($table)==2){
    //print_r($table);
    $patt_id=fetchOne("select id from patteren where name='$table[0]' and class_id=$table[1]");
    }else if(count($table)==3){
    $patt_id=fetchOne("select id from patteren where tname='$_GET[table]' and class_id=$table[2]");
    //echo "select id from patteren where name='$stable' and class_id=$table[2]";
    //print_r($patt_id);
    //echo $patt_id;exit;
    }
    //echo "select id from patteren where name='$table[0]' and class_id=$table[1]";
    //print_r($patt_id);
    $coloumn=fetchAll("select name from coloumn where patt_id=$patt_id[id] order by sequence");
    //echo "select id,name,sequence from coloumn where patt_id=$patt_id[id]";
    //print_r($coloumn);
    foreach ($coloumn as $value) {
      $col_name[]=$value['name'];
      $select=implode('`,`',$col_name);
    }
    $count=count($col_name);
    //echo "select `$select`,`test`";exit;
    $result_dtl=fetchOne("select `roll`,`exam_date`, `$select`,`test` from $_GET[table] where id=$id");
  }
if (isset($_POST['submit'])) {
  //print_r($_POST);
  foreach($_POST as $key =>$value){
  if(strpos($key,'_')){
  	//echo $key;
  	$k=str_replace('_','.',$key);
  	//echo $k."<br>";
  	$_POST[$k]=$_POST[$key];
  	unset($_POST[$key]);
  	}
  }
  	print_r($_POST);
  unset($_POST['roll']);
  unset($_POST['submit']);
  unset($_POST['ROLL']);
  //print_r($_POST);
  addUpdate($_GET['table'],$_POST,$id);
  header("Location:index.php?mod=spr&do=see_spr");
}
 if($id){?>

    <form class="form-horizontal"   method="post" enctype="multipart/form-data">
      
      <div class="form-group">
          <label class="col-lg-4 control-label">Roll No.</label>
            <div class="col-lg-8">
                <input type="text"  disabled value="<?php echo $result_dtl['roll'] ;?>" class="form-control">
            </div>
      </div>
      <div class="form-group">
          <label class="col-lg-4 control-label">Exam Date</label>
            <div class="col-lg-8">
                <input type="text"  disabled  value="<?php echo $result_dtl['exam_date'] ;?>" class="form-control">
            </div>
      </div>
      <?php
        for ($i=0; $i <$count ; $i++) {
          //print_r($col_name[$i]);
      ?>
      
      <div class="form-group">
          <label class="col-lg-4 control-label"><?php echo $col_name[$i];?></label>
            <div class="col-lg-8">
                <input type="text" name="<?php echo $col_name[$i];?>" value="<?php echo $result_dtl[$col_name[$i]];?>" class="form-control">
            </div>
      </div>
    <?php
  }
  ?>
  <div class="form-group">
    <div class="col-lg-8 col-lg-offset-4">
      <button type="submit" name="submit" id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">Submit</button>
      </div>
  </div>
  <?php }else{
    echo "Page not found";
  }?>
