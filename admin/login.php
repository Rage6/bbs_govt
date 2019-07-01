<?php

  session_start();
  require_once("../pdo.php");
  require_once("security.php");

  if (isset($_POST['sectionLogin'])) {
    // search for desired section
    echo("check 1");
    $findSecStmt = $pdo->prepare('SELECT * FROM Section WHERE section_id=:sid');
    $findSecStmt->execute(array(
      ':sid'=>htmlentities($_POST['sectionId'])
    ));
    $secInfo = $findSecStmt->fetch(PDO::FETCH_ASSOC);
    echo("<pre>");
    var_dump($secInfo);
    echo("</pre>");
    if (count($secInfo['section_id']) == 1) {
      $givenPw = htmlentities($_POST['sectionPw']);
      // encrypt the entered password
      $delPw = $secInfo['del_pw'];
      $counsPw = $secInfo['couns_pw'];
      if ($givenPw == $counsPw) {
        $_SESSION['section_id'] = $secInfo['section_id'];
        $_SESSION['admin_type'] = "counselor";
        $_SESSION['message'] = "Welcome to your counselor's admin";
        header('Location: admin.php');
        return true;
      } elseif ($givenPw == $delPw) {
        $_SESSION['section_id'] = $sectionInfo["section_id"];
        $_SESSION['admin_type'] = "delegate";
        $_SESSION['message'] = "Welcome to your delegate's admin";
        header('Location: admin.php');
        return true;
      } else {
        $_SESSION['message'] = "The entered password does not work with that section.";
        header('Location: login.php');
        return false;
      };
    } else {
      $_SESSION['message'] = "The section that you are searching for was not found. Please contact the IT department for any assistance.";
      header('Location: login.php');
      return false;
    };
  };

  // echo("GET:");
  // echo("<pre>");
  // var_dump($_GET);
  // echo("</pre>");
  // echo("POST:");
  // echo("<pre>");
  // var_dump($_POST);
  // echo("</pre>");
  // echo("SESSION:");
  // echo("<pre>");
  // var_dump($_SESSION);
  // echo("</pre>");

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
      <?php
        if (isset($_SESSION['message'])) {
          echo($_SESSION['message']);
          unset($_SESSION['message']);
        };
      ?>
    </div>
  </body>
</html>
