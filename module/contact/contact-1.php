<?php
	if(isset($_POST['contact_subject'])){
		$_POST['sid']=$usersessionid;
		$_POST['cdate']=date('d-m-Y h:i A');
		$name=fetchOne("select s_name,f_name,f_mobile from student_biodata where id=$_POST[sid]");
		//echo "select s_name,f_name,f_mobile from student_biodata where id=$_POST[sid]";
		//print_r($name);
		//print_r($_POST);exit;
		$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$msg="		
			<table class='table table-striped'>
				<tr>
					<td>Student Name</td>
					<td>$name[s_name]</td>
				</tr>
				<tr>
					<td>Father Name</td>
					<td>$name[f_name]</td>
				</tr>
				<tr>
					<td>Father Mobile No</td>
					<td>$name[f_mobile]</td>
				</tr>
				<tr>
					<td>Contact Subject</td>
					<td>$_POST[contact_subject]</td>
				</tr>
				<tr>
					<td>Contact Query</td>
					<td>$_POST[contact_query]</td>
				</tr>
				<tr>
					<td>Contact Date</td>
					<td>$_POST[cdate]</td>
				</tr>
				
			</table>
			";
			mail("synthesisbikaner@gmail.com","Enquiry from SPR Panel",$msg,$headers );
		addUpdate('contact',$_POST);
		?>
			<script>
				location.href="index.php?mod=contact&do=contact-1&submit=submit"
			</script>
		<?php
	}
 ?>
<div class="col-lg-12">
	<div class="col-lg-6">
    <span style="font-size:18px; text-shadow:6px 6px 6px #CCCCCC;">+91-8003094891/ 92/ 93</span> <br />
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3522.6398772321627!2d73.34376571506857!3d28.004912282669615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393fe767e79ff13b%3A0xab2dfb1a66afc146!2sSynthesis+Coaching+Head+office%2C+Old+Shiv+Bari+Rd%2C+Ambedkar+Colony%2C+Bikaner%2C+Rajasthan+334003!5e0!3m2!1sen!2sin!4v1469260084854" width="450" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
		<?php if(!isset($_GET['submit'])){?>
	<div class="col-lg-6" style="border-left:1px solid #CCC;">
            	<form role="form" class="form-vertical" name="contact_form1"  method="post" style="text-transform:uppercase" enctype="multipart/form-data">
        <div class="form-group" align="justify">
          <label for="sname">Subject</label>
          <input type="text" class="form-control" id="contact_subject" name="contact_subject" required style="text-transform:uppercase;" />
        </div>

        <div class="form-group" align="justify">
          <label for="opinion">Query</label>
          <textarea class="form-control" id="contact_query" name="contact_query" required></textarea>
        </div>

        <input type="submit"  id="submit" value="SEND" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;" />
      </form>
      </div>
			<?php }else{
				?>
<div class="col-lg-6" style="border-left:1px solid #CCC;">Thank you for contact us</div>
				<?php
			}?>
</div>
