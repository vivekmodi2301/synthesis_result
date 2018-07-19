<?php
  if (isset($_GET['id']) && isset($_GET['tname'])) {
  //echo $_GET[tname];exit;
//echo "delete from $_GET[tname] where `exam_date`='$_GET[id]'";exit;
    mysqli_query($con,"delete from $_GET[tname] where `exam_date`='$_GET[id]'");
    $_SESSION['ddata']="Data has been deleted successfully";
    header("location:index.php?mod=spr&do=delete_see_spr");
  }
  if (isset($_POST['class'])) {
    //print_r($_POST);
    extract($_POST);
    $col=array();
    $qry="select name,tname from patteren where id=$pattern";
    //echo $qry;
    $patteren=fetchOne($qry);//exit;
    extract($patteren);
    $tname=strtolower($tname);
    $qry="select name from coloumn where patt_id=$pattern order by sequence";
    $coloumn=fetchAll($qry);//exit;
    $tot=count($coloumn);
?>
<div class="col-lg-12 table-resposive" style="margin-left:10px; font-family:'Century Gothic';">
  <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
        <table class="table table-bordered table-hover">
            <tr class="active1 table_style" style="font-weight:600;">
                  <td>Search by exam date <input type="text" id="datee" onkeyup="search('<?php echo $tname;?>',this.value,'<?php echo $patteren['name'];?>')" class="form-control" /></td>
            </tr>
          </table>
 <div class="col-lg-12 table-resposive" id="spr_table" style="margin-left:10px; font-family:'Century Gothic';">
    <table class="table table-bordered table-hover" >
             <tr class="active1 table_style" style="font-weight:600;">
                   <td width="50">Sr. No.</td>
                   <td>Exam Date</td>
                   <!--<td width="80">View Full Profile</td>-->
                  <td>Action</td>
               </tr>
               <?php
                 $sno=1;
                 $patt_detail=fetchAll("select test,exam_date as datee from ".$tname." group by STR_TO_DATE(exam_date,'%d.%m.%Y') order by STR_TO_DATE(exam_date,'%d.%m.%Y')");
                 //echo "select test,`exam_date` from ".$tname." group by `exam_date` order by id asc";
                 //echo "select id,`Exam_Date` from ".$patteren['tname']." gorup by test";
                 //echo "select $ecol from ".$class."_".$class;
                 //echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id";
                 foreach ($patt_detail as  $patt_detail) {
                ?>
               <tr class="primary1 table_style2">
                   <td><?php echo $sno++;?></td>
                   <?php $col_count=count($col);?>
                   <td><?php echo $patt_detail['datee'];?></td>
                   <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
                   <td><a href="#" onclick="del('<?php echo $patt_detail['datee'];?>','<?php echo $tname;?>')" title="Edit Profile">Delete</a></td>
               </tr>
               <?php }?>
           </table>

<?php }?>
<script type="text/javascript">
  function search(tname,date,patt) {
    $.ajax({
        url:"module/spr/search_delete_spr.php",
        data:"datee="+date+"&tname="+tname+"&patt="+patt,
        type:"post",
        success:function(e){
          $('#spr_table').html(e);
        }
    });
  }
  function del(id,tname) {
    if(confirm("Do you want to delete")){
      location.href="index.php?mod=spr&do=delete_show_spr&id="+id+"&tname="+tname;
    }
  }
</script>
