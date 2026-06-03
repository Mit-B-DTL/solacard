<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// echo "<pre>"; print_r($_FILES); 

//exit; ?>



<form method="post" action="https://solacards.com/action_test.php" enctype="multipart/form-data">
  <input type="file" name="video">
  <button>Upload</button>
</form>


