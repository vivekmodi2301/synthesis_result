<style>

/*===============================Footer CSS Put it at bottum always================== */
#pg{CLEAR: both;MARGIN: 2em 0px 2em 12px;COLOR: #3666d4;HEIGHT: 2em}
#pg A{BORDER-RIGHT: #ccdbe4 1px solid;PADDING-RIGHT: 8px;BORDER-TOP: #ccdbe4 1px solid;DISPLAY: block;PADDING-LEFT: 8px;FLOAT: left;PADDING-BOTTOM: 2px;MARGIN: 0px 5px 0px 0px;BORDER-LEFT: #ccdbe4 1px solid;COLOR: #3666d4;PADDING-TOP: 2px;BORDER-BOTTOM: #ccdbe4 1px solid;TEXT-ALIGN: center;TEXT-DECORATION: none}
#pg STRONG{BORDER-RIGHT: #ccdbe4 1px solid;PADDING-RIGHT: 8px;BORDER-TOP: #ccdbe4 1px solid;DISPLAY: block;PADDING-LEFT: 8px;FLOAT: left;PADDING-BOTTOM: 2px;MARGIN: 0px 5px 0px 0px;BORDER-LEFT: #ccdbe4 1px solid;COLOR: #3666d4;PADDING-TOP: 2px;BORDER-BOTTOM: #ccdbe4 1px solid;TEXT-ALIGN: center;TEXT-DECORATION: none}
#pg A:hover{BORDER-LEFT-COLOR: #2b55af;BACKGROUND: #3666d4;BORDER-BOTTOM-COLOR: #2b55af;COLOR: #fff;BORDER-TOP-COLOR: #2b55af;BORDER-RIGHT-COLOR: #2b55af}
#pg STRONG{BORDER-RIGHT: 0px;PADDING-RIGHT: 6px;BORDER-TOP: 0px;PADDING-LEFT: 6px;FONT-WEIGHT: bold;FONT-SIZE: 108%;PADDING-BOTTOM: 2px;BORDER-LEFT: 0px;COLOR: #000;PADDING-TOP: 2px;BORDER-BOTTOM: 0px}
#pg-next{BORDER-TOP-WIDTH: 2px;MARGIN-TOP: -2px;BORDER-LEFT-WIDTH: 2px;BORDER-BOTTOM-WIDTH: 2px;PADDING-BOTTOM: 1px;PADDING-TOP: 1px;BORDER-RIGHT-WIDTH: 2px}
#pg-prev{BORDER-TOP-WIDTH: 2px;MARGIN-TOP: -2px;BORDER-LEFT-WIDTH: 2px;BORDER-BOTTOM-WIDTH: 2px;PADDING-BOTTOM: 1px;PADDING-TOP: 1px;BORDER-RIGHT-WIDTH: 2px; background-color:#CC0066}
#pg-next{MARGIN-LEFT: 9px}
#pg-prev{MARGIN-RIGHT: 14px}
#pg-selected { background-color:#CC99FF }
</style>

<?php
if( isset($_GET['table']) || isset($_GET['id'])){
	extract($_GET);
	$table=explode('_',$_GET['table']);
	//print_r($table);exit;
	delete($_GET['table'],$id);
	//echo "index.php?mod=spr&do=show_spr&class=$table[1]&pattern=$table[0]";exit;
	$_SESSION['ddata']="Data has been deleted successfully";
	header("location:index.php?mod=spr&do=show_spr&class=$table[1]&pattern=$table[0]");
	
}
  if (isset($_POST['class']) || isset($_GET['class']) ) {
//    print_r($_POST);exit;
    $success=1;
    if(isset($_POST['class'])){
    	if(!$_POST['class']){
    		$_SESSION['eclass']="Select class";
    		$success=0;
    	}
    	if(!$_POST['pattern']){
    		$_SESSION['eclass']="Select Pattern";
    		$success=0;
    	}else{
    		$class=fetchOne("select tname from patteren where id=$_POST[pattern]");
    		//print_r($class);
    		extract($class);
    	}
    }
    if($success){
	    extract($_POST);
	    extract($_GET);
	    $spattern=$pattern;
	    $col=array();
	    $qry="select name,tname from patteren where id=$pattern";
	    //echo $qry;
	    $patteren=fetchOne($qry);//exit;
	    extract($patteren);
	    $qry="select name from coloumn where patt_id=$pattern order by sequence";
	    $coloumn=fetchAll($qry);//exit;
	    $tot=count($coloumn);
   }else{
   	$_SESSION['fdata']=$_POST;
   	print_r($_SESSION['fdata']);
   	header("location:index.php?mod=spr&do=show_spr");
   }
   $qry="SELECT exam_date as datee FROM $tname group by STR_TO_DATE(exam_date,'%d.%m.%Y') order by STR_TO_DATE(exam_date,'%d.%m.%Y')";
   $edate=fetchAll($qry);
   //echo "select exam_date as datee from $table  GROUP BY exam_date order by exam_date";
 }
 else{
  header("location:index.php?mod=spr&do=see_spr");
}
?>
<div class="col-lg-12 table-resposive" style="margin-left:10px; font-family:'Century Gothic';">
  <form role="form" class="form-horizontal" enctype="multipart/form-data" method="post">
        <table class="table table-bordered table-hover">
            <tr class="active1 table_style" style="font-weight:600;">
                  <td>Search by student roll no <input type="text" id="roll" onkeyup="search('<?php echo $_POST['class'];?>','<?php echo  $_POST['pattern'];?>')" class="form-control" /></td>
                  <td>Search by student name <input type="text" id="name" onkeyup="search('<?php echo $_POST['class'];?>','<?php echo  $_POST['pattern'];?>')" class="form-control" /></td>
                  
                 <td>Search by exam date
                 <select class="form-control" id="datee"  onChange="search('<?php echo $_POST['class'];?>','<?php echo  $_POST['pattern'];?>')">
             		<option value=''>Select Exam Date </option>
                  <?php 
                  foreach($edate as $edate){
                  ?>
                  	<option value="<?php echo $edate['datee'];?>"> 
                  	<?php 
                  	echo $edate['datee'];
                  	?>
                  	</option><?php 
                  }
                  ?>
                  </select>
                   <!-- <input type="text" id="datee" onkeyup="search('<?php echo $_POST['class'];?>','<?php echo $_POST['pattern'];?>')" class="form-control" /> --></td>
                    <td>No of data
    									<select class="form-control" id="nod"  onchange="search('<?php echo $_POST['class'];?>','<?php echo  $_POST['pattern'];?>')" name="class">
    										<option value="">Select no of data</option>
    										<?php
    											for($i=10;$i<=100;$i+=10){
    																	?>
    																 <option value="<?php echo $i;?>"><?php echo $i?> </option>
    																 <?php
    																	}
    																?>

    									</select>
    								</td>
                  </td>
            </tr>
          </table>
 <div class="col-lg-12 table-resposive" style="margin-left:10px; font-family:'Century Gothic';">
    <table class="table table-bordered table-hover" id="spr_table">
             <tr class="active1 table_style" style="font-weight:600;">
                   <td width="50">Sr. No.</td>
                   <td>Roll No.</td>
                   <td>Student Name</td>
                   <td>Batch</td>
                   <td>Exam Date</td>
                   <?php foreach ($coloumn as $value) {
                     $col[]=$value['name'];?>
                     <td width="80"><?php echo $value['name'];?></td>
                   <?php }
                   $ecol=implode('`,`',$col)?>
                   <!--<td width="80">View Full Profile</td>-->
                  <td width="180">Action</td>
               </tr>
               <?php
               //print_r($patteren);
               $url="index.php?mod=spr&do=show_spr&class=".$class."&pattern=".$pattern;
               $limit=1;
               $frmdataget=$_REQUEST;
               @PaginationWork();
               $name=fetchOne("select tname as name from patteren where id=$pattern");
               extract($name);
               $totRslt=mysqli_fetch_assoc(mysqli_query($con,"select count(*) as tot from ".$name));
               //echo "select count(*) as tot from ".$name."_".$class;exit;

              $rs=mysqli_query($con,"select `exam_date`,`roll`, id,`$ecol` from ".$name." limit ".$frmdata['from'].", ".$frmdata['to']);
              //echo "select id,`$ecol` from ".$name."_".$class." limit ".$frmdata['from'].", ".$frmdata['to'];
              $tablename=strtolower($name)."_".$class;
                       $total_row=$totRslt['tot'];
                       //echo $total_row;
                       $maxPageData=100;
                       if($total_row<100){
                         $maxPageData=$total_row;
                       }

                 $sno=1;
                 //echo "select $ecol from ".$class."_".$class;
                 //echo "select student_biodata.id,roll,s_name,f_name,name,propic from student_biodata join batch on batch=batch.id";
                 while ($patt_detail=mysqli_fetch_assoc($rs)) {
                ?>
               <tr class="primary1 table_style2">
                   <td><?php echo $sno++;?></td>
                   <td><?php echo $patt_detail['roll'];?></td>
                   <?php
                   $s_name=fetchOne("select s_name,batch.name as batch from student_biodata join batch on batch=batch.id where roll=$patt_detail[roll]");?>
                   <td><?php  echo $s_name['s_name'];?></td>
                   <td><?php  echo $s_name['batch'];?></td>
                   <td><?php echo $patt_detail['exam_date'];?></td>
                   <?php $col_count=count($col);
                   for($d=0;$d<$col_count;$d++){?>
                     <td><?php echo $patt_detail[$col[$d]];?></td>
                   <?php }?>
                   <!--<td><a href="#" title="View Full Profile">View Full</a></td>-->
                   <td><a href="index.php?mod=spr&do=edit_spr&id=<?php echo $patt_detail['id'];?>&table=<?php echo $tname;?>" title="Edit Profile"><img src=<?php echo ROOT."images/profile_edit.png";?> height="20" width="20" /></a> &nbsp;|&nbsp; <a href="#" onclick="del('<?php echo $patt_detail['id'];?>','<?php echo $tablename;?>')">Delete</a> &nbsp;|&nbsp; <a href="index.php?mod=spr&do=summary&id=<?php echo $patt_detail['roll'];?>">Detail</a>
                   </td>
               </tr>
               <?php }?>
               <tr>
                 <td colspan="20">
                   <?php  PaginationDisplay($total_row,$url.'&pageNumber=','','');?>
                 </td>
               </tr>

           </table>


<script type="text/javascript">
  function search(classs,pattern) {
    roll=$('#roll').val();
    name=$('#name').val();
    datee=$('#datee').val();
    nod=$('#nod').val();
    //alert(roll);
    $.ajax({
        url:"module/spr/show_stu_result.php",
        data:"roll="+roll+"&datee="+datee+"&class="+classs+"&pattern="+pattern+"&nod="+nod+"&s_name="+name,
        type:"post",
        success:function(e){
          $('#spr_table').html(e);
        }
    })
  }

  function showpage(where,page,classs,pattern){
    //alert(where);
    $.ajax({
      url:'module/spr/show_stu_result.php',
      data:"where="+where+"&pageNumber="+page+"&class="+classs+"&pattern="+pattern,
      type:'post',
      success:function(e){
        $('#spr_table').html(e);},
      error:function(){
        alert("gadbad hai");
      }
    });

  }
</script>

<script>
	function del(id,table){
		if(confirm("Do you want to delter this record")){
			location.href="index.php?mod=spr&do=show_spr&id="+id+"&table="+table;
		}
	}
</script>