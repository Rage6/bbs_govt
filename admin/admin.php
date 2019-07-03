<?php
  session_start();
  require_once("../pdo.php");
  require_once("security.php");

  // Confirms a token is present and matches with the token in the dB
  if (isset($_SESSION['counsToken'])) {
    $dbTknStmt = $pdo->prepare("SELECT couns_token FROM Section WHERE section_id=:cid");
    $dbTknStmt->execute(array(
      ':cid'=>htmlentities($_SESSION['secId'])
    ));
    $dbTkn = $dbTknStmt->fetch(PDO::FETCH_ASSOC)['couns_token'];
    if ($dbTkn != $_SESSION['counsToken']) {
      $_SESSION['message'] = "<b style='color:red'>Your token does not match your section's token. Please log back in.</br>NOTE: This occurs if another counselor logs into this section's account while you are still logged in.</b>";
      unset($_SESSION['counsToken']);
      unset($_SESSION['secId']);
      header('Location: login.php');
      return false;
    } else {
      $_SESSION['adminType'] = "counselor";
    }
  } elseif (isset($_SESSION['delToken'])) {
    $dbTknStmt = $pdo->prepare("SELECT del_token FROM Section WHERE section_id=:cid");
    $dbTknStmt->execute(array(
      ':cid'=>htmlentities($_SESSION['secId'])
    ));
    $dbTkn = $dbTknStmt->fetch(PDO::FETCH_ASSOC)['del_token'];
    if ($dbTkn != $_SESSION['delToken']) {
      $_SESSION['message'] = "<b style='color:red'>Your token does not match your section's token. Please log back in.</br>NOTE: This occurs if another delegate logs into this section's account while you are still logged in.</b>";
      unset($_SESSION['delToken']);
      unset($_SESSION['secId']);
      header('Location: login.php');
      return false;
    } else {
      $_SESSION['adminType'] = "delegate";
    }
  } else {
    $_SESSION['message'] = "<b style='color:red'>You must login to enter the Admin Center</b>";
    header('Location: login.php');
    return false;
  };

  // Gets section data
  $secId = (int)$_SESSION['secId'];
  $secInfoStmt = $pdo->prepare("SELECT * FROM Section WHERE section_id=:sid");
  $secInfoStmt->execute(array(
    ':sid'=>$secId
  ));
  $secInfo = $secInfoStmt->fetch(PDO::FETCH_ASSOC);
  var_dump($secInfo);

  // Logs out data and sends to login page
  if (isset($_POST['logout'])) {
    if (isset($_SESSION['counsToken'])) {
      unset($_SESSION['counsToken']);
    } else {
      unset($_SESSION['delToken']);
    };
    unset($_SESSION['adminType']);
    unset($_SESSION['secId']);
    $_SESSION['message'] = "<b style='color:green'>Logout Successful</b>";
    header('Location: login.php');
    return true;
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
    <title>Admin Center</title>
  </head>
  <body>
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
