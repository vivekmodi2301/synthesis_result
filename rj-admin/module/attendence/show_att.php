<?php
$phpfiles=glob("../../include/php/*.php");
foreach ($phpfiles as  $phpfile) {
  include($phpfile);
}
if(($_POST['month']) && ($_POST['year'])){
      if($_POST['month']=='jan' || $_POST['month']=='march' || $_POST['month']=='may' || $_POST['month']=='july' || $_POST['month']=='aug' || $_POST['month']=='oct' || $_POST['month']=='decm' ){
        $day=31;
      }elseif ($_POST['month']=='ap' || $_POST['month']=='june' || $_POST['month']=='sept' || $_POST['month']=='nov' ) {
        $day=30;
      }
      elseif ($_POST['month']=='feb') {
      //echo $_POST['year'];
        if($_POST['year']%2==0){
          $day=29;
        }
        else{
          $day=28;
        }
      }
      //echo $day;
 ?>
<div class="col-lg-12 table-resposive" style=" font-family:'Century Gothic';">
   <table class="table table-bordered table-hover" style="margin:0" id="spr_table">
            <tr class="active1 table_style" style="font-weight:600;">
                  <td width="50">Sr. No.</td>
                  <td>Roll</td>
                  <td>Year</td>
                  <?php for($i=1;$i<=$day;$i++){
                    ?>
                    <td><?php echo $i;?></td>
                    <?php
                  }?>
                  <!--<td width="80">View Full Profile</td>-->
                 <td>Action</td>
              </tr>
              <?php
              $sno=1;
                $att_detail=fetchAll("select * from $_POST[month] where year=$_POST[year]");
                foreach ($att_detail as $att_detail) {
                  //print_r($att_detail);
               ?>
              <tr>
                <td><?php echo $sno++;?></td>
                <td><?php echo  $att_detail['roll'];?></td>
                <td><?php echo  $att_detail['year'];?></td>
                <?php for($i=1;$i<=$day;$i++){

                  if($att_detail['s'.$i]=='p'){
                    $color="green";
                  }
                  elseif($att_detail['s'.$i]=='a'){
                    $color="red";
                  }
                  elseif($att_detail['s'.$i]=='h'){
                    $color="yellow";
                  }else{
                    $color="black";
                  }
                  ?>
                  <td style="color:<?php echo $color;?>"><?php echo $att_detail['s'.$i];?></td>
                  <?php
                }?>
                <td><a href="index.php?mod=attendence&do=edit&id=<?php echo $att_detail['id'];?> &month=<?php echo $_POST['month'];?>&year=<?php echo $_POST['year'];?>">Edit</a> </td>
              </tr>
              <?php }?>
          </table>
<?php }?>
