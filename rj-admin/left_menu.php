<div class="col-lg-12">
  <?php
    $photo=fetchOne("select propic from student_biodata where id=$id");
    //print_r($photo);
    if($photo['propic']){
      $propic="images/student_images/".$photo['propic'];
    }
    else{
      $propic="images/view.gif";
    }
   ?>
<img src="<?php echo ROOT.$propic;?>" height="200px" width="200px" style="background-color:#096;" />
                    <!--<div class="" style="margin-top:1px; text-align:left;">
                        <ul class="auroramenu auroramenu-default">
                            <li>
                                <a href="#">User Interface Setting</a>
                                <ul>
                                    <li><a href="#">General Setting</a></li>
                                    <li><a href="#">Social Media And Links</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Menu 2</a>
                                <ul>
                                    <li><a href="#">Menu 2 Item 1</a></li>
                                    <li><a href="#">Menu 2 Item 2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Menu 3</a>
                                <ul>
                                    <li><a href="#">Menu 3 Item 1</a></li>
                                    <li><a href="#">Menu 3 Item 2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Menu 4</a>
                                <ul>
                                    <li><a href="#">Menu 4 Item 1</a></li>
                                    <li><a href="#">Menu 4 Item 2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>-->
    </div>
