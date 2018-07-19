<?php
	$title=fetchOne("select site_title from general_setting");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $title['site_title'];?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="<?php echo ROOT."css/bootstrap.min.css";?>">
  <link rel="stylesheet" href="<?php echo ROOT."css/bootstrap-theme.min.css";?>"/>
  <link rel="stylesheet" href="<?php echo ROOT."css/style2.css";?>"/>

  <script src="<?php echo ROOT."js/jquery.min.js";?>"></script>
  <script src="<?php echo ROOT."js/bootstrap.min.js";?>"></script>
  <script src="<?php echo ROOT."js/jquery.js.js";?>"></script>

  	<!--for left side responsive menu start-->
	<!--<link rel="stylesheet" href="css/css_menu/auroramenu.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="js/js_menu/jquery.auroramenu.js"></script>-->
    <!--for left side responsive menu end-->

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
        $logo=fetchOne("select logo from general_setting where id=1");
        if ($logo['logo']) {
          $logo=$logo['logo'];
        }
        else {
          $logo="ylh.jpg";
        }
      ?>
      <a href="#"><img src="<?php echo ROOT."images/logo/$logo";?>" width="298" height="100"/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">SPR <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?mod=spr&do=index">Add New SPR <img src="<?php echo ROOT."images/plus.gif";?>" /></a><span><hr /></span></li>
            <li><a href="index.php?mod=spr&do=see_spr">See SPR</a><span><hr /></span></li>
            <li><a href="index.php?mod=spr&do=delete_see_spr">Delete SPR</a></li>
            <!--<li><a href="#">Upload SPR Via CSV File</a></li>-->
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Attentence Report <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?mod=attendence&do=index">Add New Attendance <img src="<?php echo ROOT."images/plus.gif";?>" /></a><span><hr /></span></li>
            <li><a href="index.php?mod=attendence&do=see_att">See Attendance</a><span><hr /></span></li>
            <li><a href="index.php?mod=attendence&do=del_att">Delete Attendance</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Fee Detail <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?mod=fee&do=add_new_fee">Add New Fee <img src="<?php echo ROOT."images/plus.gif";?> "/></a><span><hr /></span></li>
            <li><a href="index.php?mod=fee&do=csv_fee">Upload Fee by CSV<img src="<?php echo ROOT."images/plus.gif";?> "/></a><span><hr /></span></li>
            <li><a href="index.php?mod=fee&do=see_all_fee">See All Fee</a><span><hr /></span></li>
            <li><a href="index.php?mod=fee&do=create_excel">Create Fees excel file</a><span><hr /></span></li>
            <li><a href="index.php?mod=fee&do=list_excel">Fees Excel File</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Class Setting <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?mod=class&do=add_class">Add New Class <img src="<?php echo ROOT."images/plus.gif";?>" /></a><span><hr /></span></li>
            <li><a href="index.php?mod=class&do=see_class">See All Classes</a><span><hr /></span></li>
            <li><a href="index.php?mod=class&do=add_batch">Add New Batch <img src="<?php echo ROOT."images/plus.gif";?>" /></a><span><hr /></span></li>
            <li><a href="index.php?mod=class&do=see_batch">See All Batches</a><span><hr /></span></li>
            <li><a href="index.php?mod=pattern&do=add_pattern">Add New Pattern <img src="<?php echo ROOT."images/plus.gif";?>" /></a><span><hr /></span></li>
            <li><a href="index.php?mod=pattern&do=see_pattern">See All Pattern</a> <span><hr /></span></li>
            <li><a href="index.php?mod=pattern&do=add_coloumn">Add New Subject</a> <span><hr /></span></li>
            <li><a href="index.php?mod=pattern&do=see_coloumn">See All Subject</a></li>
          </ul>
        </li>
        <!--<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Contact Us <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Team Synthesis</a><span><hr /></span></li>
            <li><a href="#">Team Synjee</a></li>
          </ul>
        </li>-->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">U.I.S. <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?mod=uis&do=general_settings">General Setting</a></li><span><hr /></span>
            <li><a href="index.php?mod=uis&do=social_media">Social Media & Links</a></li><span><hr /></span>
            <li><a href="index.php?mod=uis&do=menu_name">Menu Name</a><span><hr /></span></li>
            <li><a href="index.php?mod=uis&do=banner">Change Banner Photo</a><span><hr /></span></li>
            <li><a href="index.php?mod=uis&do=change_pswd">Change Admin Password</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Profile <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="index.php?mod=profile&do=see_all_profile">See All Profile</a><span><hr /></span></li>
            <li><a href="index.php?mod=profile&do=add_new_profile">Add New Profile <img src="<?php echo ROOT."images/plus.gif";?>" /></a><span><hr /></span></li>
            <li><a href="index.php?mod=profile&do=csv_profile">Upload data by csv</a><span><hr /></span></li>
            <li><a href="index.php?mod=profile&do=contact">Contact</a><span><hr /></span></li>
            <li><a href="index.php?mod=profile&do=create_profile_excel">Export profiles in excel sheet</a><span><hr /></span></li>
            <li><a href="index.php?mod=profile&do=exe_list">List of profile excel sheet</a><span><hr /></span></li>
            <li><a href="index.php?mod=login&do=logout">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

      <!--<img src="images/banner.jpg" class="img-responsive" alt="Responsiveimage" height="300" width="100%" />-->
</div>
      <div class="col-lg-12 text-center">
        <h6>&nbsp;</h6>
        <div class="col-md-12">
        <table class="table table-bordered">
            	<tr class="content_page_heading" align="justify">
                    <td>Welcome Dear User,</td>
                </tr>
         </table>


         <!-- content area cutting start here -->

         <!-- left menu start here -->
         <?php// include_once('left_menu.php'); ?>
    <!-- left menu end here -->
         <div class="col-lg-12">
<!-- content area cutting end here -->
