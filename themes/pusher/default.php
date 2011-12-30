<?php defined('C5_EXECUTE') or die("Access Denied.");

  if($callback) {
    header("Content-type: application/javascript");
    echo "$callback($innerContent);";
  }
  else {
    header("Content-type: application/json");
    echo $innerContent;
  }
?>
