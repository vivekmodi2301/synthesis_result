<?php
  $menu_detail="";
  $menu_detail=fetchOne("select * from menu_name where id='1'");
  //echo "select home,spr,at_report,fee_detail,cntct,cntct_1,cntct_2,profile,view_profile,chng_pass,logout from menu_name where id='1'";
  if (isset($_POST['home'])) {
    $_POST['home']=ucwords($_POST['home']);
    $_POST['spr']=ucwords($_POST['spr']);
    $_POST['at_report']=ucwords($_POST['at_report']);
    $_POST['fee_detail']=ucwords($_POST['fee_detail']);
    $_POST['cntct']=ucwords($_POST['cntct']);
    $_POST['profile']=ucwords($_POST['profile']);
    $_POST['view_profile']=ucwords($_POST['view_profile']);
    $_POST['chng_pass']=ucwords($_POST['chng_pass']);
    $_POST['logout']=ucwords($_POST['logout']);
    addUpdate('menu_name',$_POST,'1');
    header("location:index.php?mod=uis&do=menu_name");
  }
 ?>
<div class="col-lg-12">
    <form role="form" class="form-horizontal" name="" enctype="multipart/form-data" method="post">
                <div class="form-group">
                	<label class="col-lg-4 control-label">Home</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="home" name="home" value="<?php if($menu_detail['home']){
                      echo $menu_detail['home'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">SPR</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="spr" name="spr" value="<?php if($menu_detail['spr']){
                      echo $menu_detail['spr'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Attentence Report </label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="at_report" name="at_report" value="<?php if($menu_detail['at_report']){
                      echo $menu_detail['at_report'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Fee Detail </label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="fee_detail" name="fee_detail" value="<?php if($menu_detail['fee_detail']){
                      echo $menu_detail['fee_detail'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Contact Us</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="cntct" name="cntct" value="<?php if($menu_detail['cntct']){
                      echo $menu_detail['cntct'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Team Synthesis</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="cntct_1" name="cntct_1" value="<?php if($menu_detail['cntct_1']){
                      echo $menu_detail['cntct_1'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Team Synjee</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="cntct_2" name="cntct_2" value="<?php if($menu_detail['cntct_2']){
                      echo $menu_detail['cntct_2'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Profile</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="profile" name="profile" value="<?php if($menu_detail['profile']){
                      echo $menu_detail['profile'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">View Profile</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="view_profile" name="view_profile" value="<?php if($menu_detail['view_profile']){
                      echo $menu_detail['view_profile'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Change Password</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="chng_pass" name="chng_pass" value="<?php if($menu_detail['chng_pass']){
                      echo $menu_detail['chng_pass'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Logout</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="logout" name="logout" value="<?php if($menu_detail['logout']){
                      echo $menu_detail['logout'];
                    }?>" style="text-transform:capitalize;">
                    </div>
                </div>


                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
</div>
