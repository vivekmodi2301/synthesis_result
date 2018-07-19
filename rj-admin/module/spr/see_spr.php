<?php
 if(isset($_SESSION['data'])){
   echo $_SESSION['data'];
   unset($_SESSION['data']);
 }
 ?>
 <?php
 if(isset($_SESSION['ddata'])){
   echo $_SESSION['ddata'];
   unset($_SESSION['ddata']);
 }
 if(isset($_SESSION['fdata'])){
 	echo "Please fill all feilds";
 	extract($_SESSION['fdata']);
 	unset($_SESSION['fdata']);
 }
 //print_r($_SESSION['fdata']);
 ?>
<form class="form-horizontal" action="index.php?mod=spr&do=show_spr"  method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label class="col-lg-4 control-label">Select Class</label>
        <div class="col-lg-8">
  <select name="class" class="form-control" onchange="showpatt(this.value)">
    <option value="">Select Class</option>
    <?php
                  $class_data=fetchAll("select id,name from class");
                  foreach($class_data as $class_data){
                  ?>
                                  <option <?php if(isset($class) && $class==$class_data['id']){echo "selected";}?> value="<?php echo $class_data['id'];?>"><?php echo $class_data['name'];?></option>
                                <?php
                  }
                ?>
  </select>
          </div>
      </div>
      <div class="form-group">
          <label class="col-lg-4 control-label">Select Patteren</label>
            <div class="col-lg-8">

  <select name="pattern" id="patt" class="form-control" >
    <option value="">Select Pattern</option>
  </select></div></div>

<div class="form-group">
  <div class="col-lg-8 col-lg-offset-4">
    <button type="submit"  id="submit" class="btn btn-danger btn-sm btn-block" style="font-family:'Century Gothic'; font-size:14px; font-weight:bold;">Value</button>
    </div>
</div>
</form>
<script type="text/javascript">
function showpatt(cid) {
  $.ajax({
    url:"module/spr/pattern.php",
    data:"cid="+cid,
    type:"post",
    success:function(e){
      $('#patt').html(e);
    }
  });
}
</script>
