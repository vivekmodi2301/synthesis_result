<?php
  if (isset($_GET['did'])) {
    $file=fetchOne("select filename from feesexcel where id=$_GET[did]");
    delete('profileexcel',$_GET['did']);
    if (file_exists("fee_exe/".$file['filename'])) {
      unlink("fee_exe/".$file['filename']);
    }
  }
 ?>
<div class="col-lg-12 table-resposive" style=" font-family:'Century Gothic';">
   <table class="table table-bordered table-hover" style="margin:0" id="spr_table">
            <tr class="active1 table_style" style="font-weight:600;">
                  <td width="50">Sr. No.</td>
                  <td>File Name</td>
                  <td>Date</td>
                  <!--<td width="80">View Full Profile</td>-->
                 <td>Action</td>
              </tr>
              <?php
              $sno=1;
                $att_detail=fetchAll("select id,filename,datee from feesexcel order by id desc");
                foreach ($att_detail as $att_detail) {
                  //print_r($att_detail);
               ?>
              <tr>
                <td><?php echo $sno++;?></td>
                <td><?php echo  $att_detail['filename'];?></td>
                <td><?php echo  $att_detail['datee'];?></td>
                <td>
                  <a href="fee_exe/<?php echo $att_detail['filename'];?>">Download</a> |
                  <a href="#" onclick="del('<?php echo $att_detail['id'];?>')">Delete</a>
                </td>
              </tr>
              <?php }?>
          </table>
<script type="text/javascript">
  function del(id) {
    if (confirm("Do you want to delete")) {
      location.href="index.php?mod=fee&do=list_excel&did="+id;
    }
  }
</script>
