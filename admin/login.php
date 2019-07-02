<?php

  session_start();
  require_once("../pdo.php");
  require_once("security.php");

  if (isset($_POST['sectionLogin'])) {
    $givenSect = htmlentities($_POST['sectionId']);
    $givenPw = htmlentities($_POST['sectionPw']);
    // Route to locksmith page...
    if ($givenSect == "999") {
      $masterStmt = $pdo->prepare("SELECT key_pw,attempts FROM Maintenance WHERE locksmith_id=999");
      $masterStmt->execute();
      while ($oneMaster = $masterStmt->fetch(PDO::FETCH_ASSOC)) {
        $masterInfo[] = $oneMaster;
      };
      if (count($masterInfo) != 1) {
        $_SESSION['message'] = "<b style='color:red'>ERROR 1 (login.php): More/less than 1 row in 'masterInfo'</b>";
        header('Location: login.php');
        return false;
      } else {
        if (password_verify($givenPw,$masterInfo[0]['key_pw'])) {
          $masterToken = bin2hex(random_bytes(64));
          $mstrTknStmt = $pdo->prepare("UPDATE Maintenance SET key_token=:tkn WHERE locksmith_id=999");
          $mstrTknStmt->execute(array(
            ':tkn'=>$masterToken
          ));
          $_SESSION['key_token'] = $masterToken;
          header('Location: locksmith.php');
          return true;
        } else {
          $_SESSION['message'] = "<b style='color:red'>Incorrect password</div>";
          header('Location: login.php');
          return false;
        };
      };
    // Route to admin page...
    } elseif ($givenSect != "") {
      $findSecStmt = $pdo->prepare('SELECT * FROM Section WHERE section_id=:sid');
      $findSecStmt->execute(array(
        ':sid'=>htmlentities($_POST['sectionId'])
      ));
      while ($oneSection = $findSecStmt->fetch(PDO::FETCH_ASSOC)) {
        $secInfo[] = $oneSection;
      };
      if (count($secInfo) != 1) {
        $_SESSION['message'] = "<b style='color:red'>ERROR 2 (login.php): More/less than 1 row in 'secInfo'</b>";
        header('Location: login.php');
      } else {
        if (password_verify($givenPw,$secInfo[0]['couns_pw'])) {
          $_SESSION['message'] = "<b style='color:green'>Counselor login successful</b>";
          header('Location: admin.php');
          return true;
        } elseif (password_verify($givenPw,$secInfo[0]['del_pw'])) {
          $_SESSION['message'] = "<b style='color:green'>Delegate login successful</b>";
          header('Location: admin.php');
          return true;
        } else {
          $_SESSION['message'] = "<b style='color:red'>Password incorrect</b>";
          header('Location: login.php');
          return fail;
        };
      };
      header('Location: admin.php');
      return true;
    // Route back to login when no section is selected
    } else {
      $_SESSION['message'] = "<b style='color:red'>You must select a section, county, or city</b>";
      header('Location: login.php');
      return false;
    };
    // if (password_verify($givenPw,$masterKey) == true) {
    //   $masterToken = bin2hex(random_bytes(64));
    //   $_SESSION['key_token'] = $masterToken;
    //   $newTknStmt = $pdo->prepare("UPDATE Maintenance SET key_token=:tkn WHERE locksmith_id=1");
    //   $newTknStmt->execute(array(
    //     ':tkn'=>$masterToken
    //   ));
    //   header('Location: locksmith.php');
    //   return true;
    // } else {
    //   $_SESSION['message'] = "Your Keybox login failed, fucker.";
    //   header('Location: login.php');
    //   return false;
    // };

    // // encrypt the entered password
    // $delPw = $secInfo['del_pw'];
    // $counsPw = $secInfo['couns_pw'];
    // if ($givenPw == $counsPw) {
    //   $_SESSION['section_id'] = $secInfo['section_id'];
    //   $_SESSION['admin_type'] = "counselor";
    //   $_SESSION['message'] = "Welcome to your counselor's admin";
    //   header('Location: admin.php');
    //   return true;
    // } elseif ($givenPw == $delPw) {
    //   $_SESSION['section_id'] = $sectionInfo["section_id"];
    //   $_SESSION['admin_type'] = "delegate";
    //   $_SESSION['message'] = "Welcome to your delegate's admin";
    //   header('Location: admin.php');
    //   return true;
    // } else {
    //   $_SESSION['message'] = "The entered password does not work with that section.";
    //   header('Location: login.php');
    //   return false;
    // };
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
    <?php
      if (isset($_SESSION['message'])) {
        echo($_SESSION['message']);
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
