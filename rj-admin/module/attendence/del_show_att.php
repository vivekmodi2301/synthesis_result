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

                  <td>Year</td>
                  <!--<td width="80">View Full Profile</td>-->
                 <td>Action</td>
              </tr>
              <?php
              $sno=1;
                $att_detail=fetchAll("select * from $_POST[month] where year=$_POST[year] group by year");
                foreach ($att_detail as $att_detail) {
                  //print_r($att_detail);
               ?>
              <tr>
                <td><?php echo $sno++;?></td>
                <td><?php echo  $att_detail['year'];?></td>

                <td><a href="#" onclick="del('<?php echo $att_detail['year'];?>')">Delete</a></td>
              </tr>
              <?php }?>
          </table>
<?php }?>
