<?php
  session_start();
  require_once("../pdo.php");

  // Finds the database's key_token
  $storedTknStmt = $pdo->prepare("SELECT key_token FROM Maintenance WHERE locksmith_id=999");
  $storedTknStmt->execute();
  $storedTkn = $storedTknStmt->fetch(PDO::FETCH_ASSOC)['key_token'];

  // Compares your browser's token to the database's
  if ($storedTkn != $_SESSION['key_token']) {
    $_SESSION['message'] = "<b style='color:red'>Invalid token</b>";
    header('Location: login.php');
    return false;
  };

  // Counts number of sections before using below 'for' loop
  $totalSecStmt = $pdo->prepare("SELECT COUNT(section_id) FROM Section");
  $totalSecStmt->execute();
  $totalSec = (int)$totalSecStmt->fetch(PDO::FETCH_ASSOC)['COUNT(section_id)'];

  // Gets necessary data from all of the sections
  $allSecStmt = $pdo->prepare('SELECT section_id,section_name,couns_num,del_num FROM Section ORDER BY section_name ASC');
  $allSecStmt->execute();
  for ($secNum = 0; $secNum < $totalSec; $secNum++) {
    $secList[] = $allSecStmt->fetch(PDO::FETCH_ASSOC);
  };

  // Carries out the password change
  if (isset($_POST['changePw'])) {
    if ($_POST['newPw'] == $_POST['confPw']) {
      $secName = htmlentities($_POST['secName']);
      $newPw = htmlentities($_POST['newPw']);
      $newHash = password_hash($newPw,PASSWORD_DEFAULT);
      if ($_POST['typeId'] == 'delegate') {
        $newPwStmt = $pdo->prepare("UPDATE Section SET del_pw=:nwh WHERE section_id=:sid");
      } else {
        $newPwStmt = $pdo->prepare("UPDATE Section SET couns_pw=:nwh WHERE section_id=:sid");
      };
      $newPwStmt->execute(array(
        ':nwh'=>$newHash,
        ':sid'=>htmlentities($_POST['secId'])
      ));
      $_SESSION['message'] = "<b style='color:green'>New password set for '".$secName."' section</b>";
      header('Location: locksmith.php');
      return false;
    } else {
      $_SESSION['message'] = "<b style='color:red'>Your new password must match it confirmation password</b>";
      header('Location: locksmith.php');
      return false;
    };
  };

  // Logs out user
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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Key Box</title>
    <link rel="stylesheet" type="text/css" href="../style/admin/locksmith.css" />
  </head>
  <body>
    <form method="POST">
      <button style="border:1px solid black">
        <input type="submit" name="logout" value="LOGOUT" />
      </button>
    </form>
    <div class="mainTitle">Key Box</div>
    <?php
      if (isset($_SESSION['message'])) {
        echo("<div class='message'>".$_SESSION['message']."</div>");
        unset($_SESSION['message']);
      };
      for ($indexNum = 0; $indexNum < $totalSec; $indexNum++) {
        echo("
          <div class='secBox'>

              <div class='secName'>".$secList[$indexNum]['section_name']."</div>
              <div class='rowPasswords'>
                <form method='POST'>
                  <div>
                    <div class='typeTitle'>DELEGATE</div>
                    <input type='hidden' name='typeId' value='delegate'>
                    <input type='hidden' name='secId' value='".$secList[$indexNum]['section_id']."'>
                    <input type='hidden' name='secName' value='".$secList[$indexNum]['section_name']."'>
                    <div><input class='inputPasswords' type='text' name='newPw' placeholder='new password' /></div>
                    <div><input class='inputPasswords' type='text' name='confPw' placeholder='confirm password' /></div>
                    <div class='changeBttn'><input type='submit' name='changePw' value='ENTER'></div>
                  </div>
                </form>
                <form method='POST'>
                  <div>
                    <div class='typeTitle'>COUNSELOR</div>
                    <input type='hidden' name='typeId' value='counselor'>
                    <input type='hidden' name='secId' value='".$secList[$indexNum]['section_id']."'>
                    <input type='hidden' name='secName' value='".$secList[$indexNum]['section_name']."'>
                    <div><input class='inputPasswords' type='text' name='newPw' placeholder='new password' /></div>
                    <div><input class='inputPasswords' type='text' name='confPw' placeholder='confirm password' /></div>
                    <div class='changeBttn'><input type='submit' name='changePw' value='ENTER'></div>
                  </div>
                </form>
              </div>

          </div>
        ");
      };
    ?>
  </body>
</html>
