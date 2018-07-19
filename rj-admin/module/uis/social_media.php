<?php
  if (isset($_POST['fb_link'])) {
    addUpdate('general_setting',$_POST,'1');
  }
  $data=fetchOne("select fb_link,tw_link,gmail_link,yt_link,lnkdn_link,gtalk_link,skype_link from general_setting where id=1");
 ?>
<div class="col-lg-12">
    <form role="form" class="form-horizontal" name="" enctype="multipart/form-data" method="post">
                <div class="form-group">
                	<label class="col-lg-4 control-label">Facebook</label>
                    <div class="col-lg-7">
                    <input type="text" class="form-control" id="fb_link" name="fb_link" value="<?php echo $data['fb_link'];?>" >
                    </div>
                    <img src=<?php echo ROOT."images/social/facebook.png";?> height="30" width="30" />
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Twitter</label>
                   <div class="col-lg-7">
                    <input type="text" class="form-control" id="tw_link" name="tw_link" value="<?php echo $data['tw_link'];?>">
                    </div>
                    <img src=<?php echo ROOT."images/social/twitter.png";?> height="30" width="30" />
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Gmail</label>
                    <div class="col-lg-7">
                    <input type="text" class="form-control" id="gmail_link" name="gmail_link" value="<?php echo $data['gmail_link'];?>" >
                    </div>
                    <img src=<?php echo ROOT."images/social/gmail.png";?> height="30" width="30" />
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">You Tube</label>
                    <div class="col-lg-7">
                    <input type="text" class="form-control" id="yt_link" name="yt_link" value="<?php echo $data['yt_link'];?>" >
                    </div>
                    <img src=<?php echo ROOT."images/social/youtube.png";?> height="30" width="30" />
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Linkedin</label>
                    <div class="col-lg-7">
                    <input type="text" class="form-control" id="lnkdn_link" name="lnkdn_link" value="<?php echo $data['lnkdn_link'];?>" >
                    </div>
                    <img src=<?php echo ROOT."images/social/linkedin.png";?> height="30" width="30" />
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Google Talk</label>
                    <div class="col-lg-7">
                    <input type="text" class="form-control" id="gtalk_link" name="gtalk_link" value="<?php echo $data['gtalk_link'];?>" >
                    </div>
                    <img src=<?php echo ROOT."images/social/googletalk.png";?> height="30" width="30" />
                </div>

                <div class="form-group">
                	<label class="col-lg-4 control-label">Skypee</label>
                    <div class="col-lg-7">
                    <input type="text" class="form-control" id="skype_link" name="skype_link" value="<?php echo $data['skype_link'];?>" >
                    </div>
                    <img src=<?php echo ROOT."images/social/skype.png";?> height="30" width="30" />
                </div>


                <div class="form-group">
                	<div class="col-lg-8 col-lg-offset-4">
                    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">SUBMIT</button>
                    </div>
                </div>
            </form>
</div>
