<option value="">Select coloumn name</option>
<option value="id">id</<option>
<?php

$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}
  extract($_POST);
  $coloumn=fetchAll("select id,name from coloumn where patt_id=$patt order by sequence");
  foreach ($coloumn as $value) {
    ?>
    <option value="<?php echo $value['name'];?>"><?php echo $value['name'];?></option>
    <?php
  }
  ?>
