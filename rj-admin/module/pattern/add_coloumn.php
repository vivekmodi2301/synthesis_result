<?php
  if(isset($_POST['class'])){
    if($_POST['pattern']){
      if($_POST['acoloumn']!='id'){
        //echo "hi";exit;
        $tname=fetchOne("select tname,sequence from patteren join coloumn on patteren.id=patt_id where patteren.id=$_POST[pattern] and coloumn.name='$_POST[acoloumn]'");
        $ncs=$tname['sequence']+1;
        //echo "select tname,sequence from patteren join coloumn on patteren.id=patt_id where patteren.id=$_POST[pattern] and and coloumn.name='$_POST[acoloumn]'";
        //echo "select tname,sequence from patteren join coloumn on patteren.id=patt_id where patteren.id=$_POST[pattern] $swh";
        //echo $tname;
        //print_r($tname);
        $coloumn=fetchAll("select id,sequence from coloumn where sequence>$tname[sequence]");
        //echo "select id,sequence from coloumn where sequence>$tname[sequence]";exit;
        //print_r($coloumn);
        foreach ($coloumn as  $coloumn) {
          //$coloumn['sequence']++;
          //echo $sequence;exit;
          $cdata = array('sequence' =>$coloumn['sequence']+1);
          //print_r($data);
          //print_r($cdata);exit;
          addUpdate('coloumn',$cdata,$coloumn['id']);
        }

      }

      else{
        $ncs=1;
        $tname=fetchOne("select tname from patteren  where patteren.id=$_POST[pattern] ");
        //echo "select tname,sequence from patteren join coloumn on patteren.id=patt_id where patteren.id=$_POST[pattern] $swh";
        //echo $tname;
        //print_r($tname);
        $coloumn=fetchAll("select id,sequence from coloumn");
        //echo "select id,sequence from coloumn where sequence>$tname[sequence]";
        //print_r($coloumn);
        foreach ($coloumn as  $coloumn) {
          $cdata = array('sequence' =>  $coloumn['sequence']+1);
          //print_r($data);
          addUpdate('coloumn',$cdata,$coloumn['id']);
        }
      }

      $cdata=array('patt_id'=>$_POST['pattern'],'name'=>$_POST['coloumn'],'sequence'=>$ncs);
      addUpdate('coloumn',$cdata);
      extract($tname);
    }

    $qry="ALTER TABLE `$tname` ADD `$_POST[coloumn]` VARCHAR(20)  AFTER `$_POST[acoloumn]`";
    addcoloumn($qry);
  }
 ?>
<form class="form-horizontal"  method="post" enctype="multipart/form-data">
  <div class="form-group">
      <label class="col-lg-4 control-label">Select Class</label>
        <div class="col-lg-8">
  <select name="class" class="form-control" required id="classs" onchange="showpatt(this.value)">
    <option value="">Select Class</option>
    <?php
                  $class_data=fetchAll("select id,name from class");
                  foreach($class_data as $class_data){
                  ?>
                                  <option value="<?php echo $class_data['id'];?>"><?php echo $class_data['name'];?></option>
                                <?php
                  }
                ?>
  </select>
          </div>
      </div>
      <div class="form-group">
          <label class="col-lg-4 control-label">Select Patteren</label>
            <div class="col-lg-8">

  <select name="pattern" id="patt" required class="form-control" onchange="showcoloumn(this.value)" >
    <option value="">Select Pattern</option>
  </select></div></div>

  <div class="form-group">
      <label class="col-lg-4 control-label">Add coloumn after</label>
        <div class="col-lg-8">

<select name="acoloumn" id="col" required class="form-control" >
<option value="">Select Coloumn Name</option>
</select></div></div>

<div class="form-group">
    <label class="col-lg-4 control-label">Coloumn name</label>
      <div class="col-lg-8">
<input type="text" name="coloumn" class="form-control" required placeholder="Enter new coloumn name">
</div></div>

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
function showcoloumn(patt){
    $.ajax({
      url:"module/pattern/coloumn.php",
      data:"patt="+patt,
      type:"post",
      success:function(e){
        $('#col').html(e);
      }
    });
}
</script>
