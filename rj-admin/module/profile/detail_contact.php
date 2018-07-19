<?php
if (isset($_GET['id'])) {
  $id=$_GET['id'];
$stu_detail=fetchOne("select contact.id,class.name as class,s_name,f_name,batch.name as name,email,s_mobile,f_mobile,contact_subject,contact_query from student_biodata join batch on batch=batch.id join class on class=class.id join contact on sid=student_biodata.id where contact.id=$id order by student_biodata.id desc");
//echo "select student_biodata.id,class.name as class,s_name,f_name,batch.name as name,email,s_mobile,f_mobile,contact_subject,contact_query from student_biodata join batch on batch=batch.id join class on class=class.id join contact on sid=student_biodata.id where contact.id=$id order by student_biodata.id desc";
  ?>
<div class="col-lg-12">
            	<form role="form" class="form-vertical" name="contact_form1"  method="post" style="text-transform:uppercase" enctype="multipart/form-data">
                <div class="form-group" align="justify">
                  <label for="sname">Student Name</label>
                  <input type="text" class="form-control" id="contact_subject" value="<?php echo $stu_detail['s_name'];?>" style="text-transform:uppercase;" />
                </div>
                <div class="form-group" align="justify">
                  <label for="sname">Father Name</label>
                  <input type="text" class="form-control" id="contact_subject" value="<?php echo $stu_detail['f_name'];?>" name="contact_subject" required style="text-transform:uppercase;" />
                </div>
                <div class="form-group" align="justify">
                  <label for="sname">Class</label>
                  <input type="text" class="form-control" id="contact_subject" value="<?php echo $stu_detail['class'];?>" name="contact_subject" required style="text-transform:uppercase;" />
                </div>
                <div class="form-group" align="justify">
                  <label for="sname">Batch</label>
                  <input type="text" class="form-control" value="<?php echo $stu_detail['name'];?>" id="contact_subject" name="contact_subject" required style="text-transform:uppercase;" />
                </div>
                <div class="form-group" align="justify">
                  <label for="sname">Email</label>
                  <input type="text" class="form-control" value="<?php echo $stu_detail['email'];?>" id="contact_subject" name="contact_subject" required style="text-transform:uppercase;" />
                </div>
                <div class="form-group" align="justify">
                  <label for="sname">Father Mobile Number</label>
                  <input type="text" class="form-control" value="<?php echo $stu_detail['f_mobile'];?>" id="contact_subject" name="contact_subject" required style="text-transform:uppercase;" />
                </div>
        <div class="form-group" align="justify">
          <label for="sname">Subject</label>
          <input type="text" class="form-control" id="contact_subject" value="<?php echo $stu_detail['contact_subject'];?>" name="contact_subject" required style="text-transform:uppercase;" />
        </div>

        <div class="form-group" align="justify">
          <label for="opinion">Query</label>
          <textarea class="form-control"  id="contact_query" name="contact_query" required><?php echo $stu_detail['contact_query'];?></textarea>
        </div>

      </form>
      </div>
</div>
<?php }?>
