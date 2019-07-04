<?php

  session_start();
  require_once("../pdo.php");
  require_once("leads/login.php");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | Admin Login</title>
    <link rel="stylesheet" type="text/css" href="../style/admin/login.css" />
  </head>
  <body>
    <div class="infoBox">
      Welcome to the Buckeye Boys State Administration page. Before adding, updating, or deleting information from the BBS website, you must first select your desired Section and enter the correct password.
    </div>
    <?php
      if (isset($_SESSION['message']) && $_SERVER['REQUEST_METHOD'] == "GET") {
        echo("<div class='message'>".$_SESSION['message']."</div>");
        unset($_SESSION['message']);
      };
    ?>
    <div class="formBox">
      <form method="POST">
        <div>Select your desired section, county, or city</div>
        <input type="text" name="sectionId" />
        <div>Enter your password</div>
        <input type="password" name="sectionPw" />
        <div class="formBttn">
          <input type="submit" name="sectionLogin" value="ENTER" />
        </div>
        </table>
      </form>
    </div>
  </body>
</html>
