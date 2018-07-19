<?php

$phpfiles=glob("../../include/php/*.php");
foreach($phpfiles as $phpfile){
  include_once($phpfile);
}
print_r($_POST);exit;
