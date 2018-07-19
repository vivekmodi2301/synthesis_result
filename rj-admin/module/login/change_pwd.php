<div class="col-lg-12">
	<div class="col-lg-2">
    <img src="images/pna.jpg" height="150" width="140" />
    </div>
	<div class="col-lg-10" style="border-left:1px solid #CCC;">
    <form role="form" class="form-horizontal" name="change_pwd" enctype="multipart/form-data" action="">
            	<div class="form-group">
                	<label class="col-lg-4 control-label">User Name</label>
                    <div class="col-lg-8">
                    <input type="text" class="form-control" id="uname" name="uname" value="" pattern=".{5}" maxlength="5" onkeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="text-transform:capitalize;" disabled="disabled">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Old Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="old_pwd" name="old_pwd" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">New Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="new_pwd" name="new_pwd" style="text-transform:capitalize;">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-lg-4 control-label">Confirm New Password</label>
                    <div class="col-lg-8">
                    <input type="password" class="form-control" id="confirm_new_pwd" name="confirm_new_pwd" style="text-transform:capitalize;">
                    </div>
                </div>
                
                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit" name="send" id="send" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
      </div>
</div>