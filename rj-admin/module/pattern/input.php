<?php
  if(isset($_POST['col']) && $_POST['col']>0){
    $col=$_POST['col'];
    for($i=1;$i<=$col;$i++){
      ?>
        <input type="text" name="subject[]">
      <?php
    }
  }
?>
