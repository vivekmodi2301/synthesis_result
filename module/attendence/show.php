<?php
session_start();
ob_start();
$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
 include_once($phpfile);
}
$userroll=$_SESSION['udetail']['roll'];
  extract($_POST);
  $year=" and year=$year ";
?>
<table class="table table-bordered text-capitalize table-hover" id="showatt" style="text-align:left;">
  <tr>
    <td colspan="1">Month/Date</td>
    <?php
      for($i=1;$i<=31;$i++){
        ?>
        <td><?php echo $i;?></td>
        <?php
      }
     ?>
  </tr>
  <tr>
    <td>January</td>
    <?php
    //echo "select * from jan where roll=$userroll $year";
      $att_det=fetchOne("select * from jan where roll=$userroll $year");
      for($i=1;$i<=31;$i++){

        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }?>
          <?php }?>

  </tr>
  <tr>
    <td>February</td>
    <?php
      $att_det=fetchOne("select * from feb where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){

                            if($att_det['s'.$i]=='p'){
                              $color="green";
                            }
                            elseif($att_det['s'.$i]=='a'){
                              $color="red";
                            }
                            elseif($att_det['s'.$i]=='h'){
                              $color="yellow";
                            }else{
                              $color="black";
                            }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>March</td>
    <?php
      $att_det=fetchOne("select * from march where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>April</td>

    <?php
      $att_det=fetchOne("select * from ap where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
                        if(isset($att_det['s'.$i]) && $att_det['s'.$i]=='p'){
                          $color="green";
                        }
                        elseif(isset($att_det['s'.$i]) && $att_det['s'.$i]=='a'){
                          $color="red";
                        }
                        elseif(isset($att_det['s'.$i]) && $att_det['s'.$i]=='h'){
                          $color="yellow";
                        }else{
                          $color="black";
                        }
        $col="s".$i;
        if(isset($att_det[$col])){
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>May</td>
    <?php
      $att_det=fetchOne("select * from may where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>June</td>
    <?php
      $att_det=fetchOne("select * from june where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>July</td>
    <?php
      $att_det=fetchOne("select * from july where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>August</td>
    <?php
      $att_det=fetchOne("select * from aug where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>September</td>
    <?php
      $att_det=fetchOne("select * from sept where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>October</td>
    <?php
      $att_det=fetchOne("select * from oct where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>November</td>
    <?php
      $att_det=fetchOne("select * from nov where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  <tr>
    <td>December</td>
    <?php
      $att_det=fetchOne("select * from decm where roll=$userroll $year");
      for($i=1;$i<=31;$i++){
        $col="s".$i;
        if(isset($att_det[$col])){
                          if($att_det['s'.$i]=='p'){
                            $color="green";
                          }
                          elseif($att_det['s'.$i]=='a'){
                            $color="red";
                          }
                          elseif($att_det['s'.$i]=='h'){
                            $color="yellow";
                          }else{
                            $color="black";
                          }
        ?>
          <td style="color:<?php echo $color;?>"><?php echo $att_det['s'.$i];?></td>
          <?php }else{
            ?>
            <td>N/A</td>
            <?php
          }}?>
  </tr>
  </table>
