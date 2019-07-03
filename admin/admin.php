<?php

  session_start();
  require_once("../pdo.php");
  require_once("leads/admin.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Center</title>
    <link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
  </head>
  <body>
    <div class="titleTop">BUCKEYE BOYS STATE</div>
    <div class="titleBottom">Administrative Center</div>
    <?php
      if (isset($_SESSION['message'])) {
        echo($_SESSION['message']);
        unset($_SESSION['message']);
      };
    ?>
    <form method="POST">
      <input style="border:1px solid black" type="submit" name="logout" value="LOGOUT" />
    </form>
  </body>
</html>
