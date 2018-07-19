<?php
	if(isset($_POST['admin_footer']) && $_POST['admin_footer']!='raj verma'){
    	$_POST['admin_footer']='raj verma';
    }
?>
<?php
$gs_detail="";
$gs_detail=fetchOne("select * from general_setting where id='1'");
$gs_detail=array_map('trim',$gs_detail);
  if (isset($_POST['site_title'])) {
    if (isset($_FILES['logo']['name']) && $_FILES['logo']['name']) {
      $ext=array('jpg','jpeg','png');
      $image_ext=substr($_FILES['logo']['name'],strrpos($_FILES['logo']['name'],'.')+1);
      //echo $image_ext;exit;
    
      if(in_array($image_ext,$ext)){
				 $size=$_FILES['logo']['size'];//exit;
				if($size<=595284){
					//echo "hi";exit;
		if($gs_detail['logo']){
			if(file_exists("include/images/logo/".$gs_detail['logo'])){
			unlink("include/images/logo/".$gs_detail['logo']);
		}
		}
        $_POST['logo']=time()."_".$_FILES['logo']['name'];
        $_POST=array_map('trim',$_POST);
        move_uploaded_file($_FILES['logo']['tmp_name'],'include/images/logo/'.$_POST['logo']);
				
			}else {

					$_SESSION['elogo']="Upload file less then 97kbps";
					//echo $_SESSION['elogo'];exit;
			}
      }
			else {
					$_SESSION['elogo']="Upload only jpg,jpeg,png file";
			}
    }
    if(!isset($_SESSION['elogo'])){
    addUpdate('general_setting',$_POST,'1');
				header("location:index.php?mod=uis&do=general_settings");
}
  }
	//print_r($_SESSION);exit;
 ?>
<div class="col-lg-12">
    <form role="form" class="form-horizontal" name="" enctype="multipart/form-data" method="post">

				<?php if(isset($_SESSION['elogo'])){
					echo $_SESSION['elogo'];
				}?>
								<div class="form-group">
                	<label class="col-lg-4 control-label">Site Title</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="site_title" name="site_title"
                    value="<?php if(isset($gs_detail['site_title'])){echo trim($gs_detail['site_title']);}?>"
                    style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Site Url</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="site_url" name="site_url"
                    value="<?php if(isset($gs_detail['site_url'])){echo trim($gs_detail['site_url']);}?>"
                     >
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Site E-mail</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="site_email" name="site_email"
                    value="<?php if(isset($gs_detail['site_email'])){echo trim($gs_detail['site_email']);}?>"
                     >
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Page Meta Tag Keyword</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="meta_keywrd" name="meta_keywrd"value="<?php if(isset($gs_detail['meta_keywrd'])){               echo trim($gs_detail['meta_keywrd']);}?>"
                     style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Page Meta Tag Description</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="meta_desc" name="meta_desc"
                    value="<?php if(isset($gs_detail['meta_desc'])){echo trim($gs_detail['meta_desc']);}?>"
                     style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Admin Footer</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="admin_footer" name="admin_footer" value="Raj Verma" style="text-transform:capitalize;">
                    </div>
                </div>

                <?php
                  if(isset($gs_detail['logo']) && $gs_detail['logo']){
                      echo "<img src=".ROOT."images/logo/".$gs_detail['logo']." height='100px' width='298px'>";
                  }
                 ?>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Upload Logo</label>
                    <div class="col-lg-8">
                    <input type="file" class="form-control" id="logo" name="logo" value="Raj Verma" style="text-transform:capitalize;">
										<?php if(isset($_SESSION['elogo'])){
											echo $_SESSION['elogo'];
											unset($_SESSION['elogo']);
										}?>
										</div>
                </div>


                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
</div>