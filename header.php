<?php
	$title=fetchOne("select site_title from general_setting");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title['site_title'];?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href=<?php echo ROOT."css/bootstrap.min.css";?>>
  <link rel="stylesheet" href=<?php echo ROOT."css/bootstrap-theme.min.css";?>/>
  <link rel="stylesheet" href=<?php echo ROOT."css/style2.css";?>/>

  <script src=<?php echo ROOT."js/jquery.min.js";?>></script>
  <script src=<?php echo ROOT."js/bootstrap.min.js";?>></script>
  <script src=<?php echo ROOT."js/jquery.js.js";?>></script>



</head>
<body>

<div class="container">
  <div class="row">
  	<div class="row" style="background:#F60; height:4px;">&nbsp;</div>
    <div class="col-lg-12" style="margin-top:6px;">
        <nav class="navbar navbar-default" style="background:none; border:none; box-shadow:none; font-family:'Century Gothic';">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php
        $logo=fetchOne("select logo from general_setting");
       ?>
      <a href="#"><img src=<?php echo SITE_IMAGES."images/logo/".$logo['logo'];?> width="298px" height="100px"/></a>
    </div>
    <?php
      $menu_name=fetchOne("select * from menu_name");
     ?>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="http://synthesis.ac.in/"><?php echo $menu_name['home'];?></a></li>
        <li><a href="index.php?mod=spr&do=spr"><?php echo $menu_name['spr'];?></a></li>
        <li><a href="index.php?mod=attendence&do=attendence"><?php echo $menu_name['at_report'];?></a></li>
        <?php /*?><li><a href="index.php?mod=fee&do=fee"><?php echo $menu_name['fee_detail'];?></a></li><?php */?>
        <li>
          <a class="dropdown-toggle"  href="index.php?mod=contact&do=contact-1"><?php echo $menu_name['cntct'];?></span></a>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $menu_name['profile'];?><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?mod=login&do=profile"><?php echo $menu_name['view_profile'];?></a><span><hr /></span></li>
            <li><a href="index.php?mod=login&do=change_pwd"><?php echo $menu_name['chng_pass'];?></a><span><hr /></span></li>
            <li><a href="index.php?mod=login&do=logout"><?php echo $menu_name['logout'];?></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php /*?><?php
  $banner=fetchOne("select banner from general_setting where id=1");
  if($banner){
?>
<img src=<?php echo  SITE_IMAGES."banner_image/$banner[banner]";?> class="img-responsive" alt="Synthesis" style="height:300px;" width="100%" />
<?php }else{?>
      <img src=<?php echo ROOT."images/banner.jpg";?> class="img-responsive" alt="Synthesis" height="300" width="100%" />
      <?php }?><?php */?>
</div>
      <div class="col-lg-12 text-center">
        <h6>&nbsp;</h6>
        <div class="col-md-12">
        <table class="table table-bordered">
            	<tr class="content_page_heading" align="justify">
                    <td style="background:#DA251D; color:#fff;">Welcome Dear <?php
                    $s_name=fetchOne("select s_name from student_biodata where id=$usersessionid");
                      echo ucwords(strtolower($s_name['s_name']));
              ?>,</td>
                </tr>
         </table>
