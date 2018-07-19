<?php
  if(isset($_POST['submit'])){

    if($_FILES['csv']['name']){
      //echo "hi";exit;
      //print_r($_FILES);exit;
      if($_FILES['csv']['type']=='image/jpeg'){
        //echo "hi";exit;
        $_POST['banner']=time()."_".$_FILES['csv']['name'];
        move_uploaded_file($_FILES['csv']['tmp_name'],'include/banner_image/'.$_POST['banner']);
      }
      unset($_POST['submit']);
      addUpdate('general_setting',$_POST,1);
      $image=glob("include/banner_image/*.jpg");
      $count=count($image);
      $count-=1;
      for($i=0;$i<$count;$i++){
        unlink($image[$i]);
      }
      header("location:index.php?mod=uis&do=banner");
    }
  }
?>
<form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
<?php
  $banner=fetchOne("select banner from general_setting where id=1");
  if($banner){
?>
  <div class="col-lg-12">
                <div class="form-group">
                	<label class="col-lg-4 control-label">Banner Image</label>
                    <div class="col-lg-8">
                      <img src="include/banner_image/<?php echo $banner['banner'];?>" height="100px" width"100pxx">
                    </div>
                </div>
<?php }?>

	<div class="col-lg-12">
                <div class="form-group">
                	<label class="col-lg-4 control-label">Upload CSV file for<br />New Student Profile</label>
                    <div class="col-lg-8">
                    <input type="file" class="form-control" id="" name="csv" value="">
                    </div>
                </div>


      <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit" name="submit" id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
     </div>
</form>
