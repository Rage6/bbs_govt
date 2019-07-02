<?php
  session_start();
  require_once("../pdo.php");
  require_once("security.php");

  echo("GET:");
  echo("<pre>");
  var_dump($_GET);
  echo("</pre>");
  echo("POST:");
  echo("<pre>");
  var_dump($_POST);
  echo("</pre>");
  echo("SESSION:");
  echo("<pre>");
  var_dump($_SESSION);
  echo("</pre>");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Center</title>
  </head>
  <body>
    <?php
      if (isset($_SESSION['message'])) {
        echo($_SESSION['message']);
        unset($_SESSION['message']);
      };
    ?>
  </body>
</html>
