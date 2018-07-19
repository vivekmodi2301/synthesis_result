<?php
if ($_GET['year']){
  $id=$_GET['id'];
    $att_detail=fetchAll("select * from $_GET[month] where year=$_GET[year] and id=$id");
      if($_GET['month']=='jan' || $_GET['month']=='march' || $_GET['month']=='may' || $_GET['month']=='july' || $_GET['month']=='aug' || $_GET['month']=='oct' || $_GET['month']=='decm' ){
        $day=31;
      }elseif ($_GET['month']=='ap' || $_GET['month']=='june' || $_GET['month']=='sept' || $_GET['month']=='nov' ) {
        $day=30;
      }
      elseif ($_GET['month']=='feb') {
      //echo $_POST['year'];
        if($_GET['year']%2==0){
          $day=29;
        }
        else{
          $day=28;
        }
      }
    }
    if (isset($_POST['submit'])) {
      unset($_POST['submit']);
      addUpdate($_GET['month'],$_POST,$id);
      header("location:index.php?mod=attendence&do=see_att");
    }
      //echo $day;
 ?>
 <form  method="post">
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

             </tr>
             <?php
             $sno=1;
               foreach ($att_detail as $att_detail) {
                 //print_r($att_detail);
              ?>
             <tr>
               <td><?php echo $sno++;?></td>
               <td><?php echo  $att_detail['roll'];?></td>
               <td><?php echo  $att_detail['year'];?></td>
               <?php for($i=1;$i<=$day;$i++){
                 ?>
                 <td><input type="radio" <?php if($att_detail['s'.$i]=='p'){echo "checked";}?> name="<?php echo 's'.$i;?>" value="p">p
                   <input type="radio" <?php if($att_detail['s'.$i]=='a'){echo "checked";}?> name="<?php echo 's'.$i;?>" value="a">a
                   <input type="radio" <?php if($att_detail['s'.$i]=='h'){echo "checked";}?> name="<?php echo 's'.$i;?>" value="h">h
                 </td>
                 <?php
               }?>
             </tr>
             <?php }?>
             <tr>
               <td colspan="34"><input type="submit" name="submit"  value="Submit"></td>
             </tr>
         </table>
</form>
