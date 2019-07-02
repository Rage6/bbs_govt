<?php
  session_start();
  require_once("../pdo.php");

  $storedTknStmt = $pdo->prepare("SELECT key_token FROM Maintenance WHERE locksmith_id=999");
  $storedTknStmt->execute();
  $storedTkn = $storedTknStmt->fetch(PDO::FETCH_ASSOC)['key_token'];

  if ($storedTkn != $_SESSION['key_token']) {
    $_SESSION['message'] = "<b style='color:red'>Invalid token</b>";
    header('Location: login.php');
    return false;
  };

  if (isset($_POST['logout'])) {
    $_SESSION['message'] = "<b style='color:green'>Logout successful</b>";
    unset($_SESSION['key_token']);
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
  // var_dump(strlen($_SESSION['key_token']));
  // echo("</pre>");

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Key Box</title>
  </head>
  <body>
    <h1>Key Box</h1>
    <form method="POST">
      <button style="border:1px solid black">
        <input type="submit" name="logout" value="LOGOUT" />
      </button>
    </form>
  </body>
</html>
