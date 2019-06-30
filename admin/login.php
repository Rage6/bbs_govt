<?php

  session_start();
  require_once("../pdo.php");
  require_once("security.php");

  if (isset($_POST['sectionLogin'])) {
    // search for desired section
    $findSecStmt = $pdo->prepare('SELECT * FROM Section WHERE section_id=:sid');
    $findSecStmt->execute(array(
      ':sid'=>htmlentities($_POST['sectionId'])
    ));
    $secInfo = $findSecStmt->fetch(PDO::FETCH_ASSOC);
    // makes sure one (and ONLY one) section was selected

    // compares the selected password to the entered one

    // if all correct, it redirects to the admin page
    // $_SESSION['section_id'] = "put correct id number here";
    // $_SESSION['message'] = "Put message here";
    // header('Location: admin.php');

    // if incorrect, it redirects back to login
    $_SESSION['message'] = $secInfo;
    header('Location: login.php');
  };

  echo("POST:");
  var_dump($_POST);
  echo("SESSION:");
  var_dump($_SESSION);

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
    </div>
  </body>
</html>
