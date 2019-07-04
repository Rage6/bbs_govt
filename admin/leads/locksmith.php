<?php

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

// Resets the number of failed login attempts back to zero for the given section
if (isset($_POST['resetNum'])) {
  $resetNumStmt = $pdo->prepare("UPDATE Section SET couns_num=0, del_num=0 WHERE section_id=:scid");
  $resetNumStmt->execute(array(
    ':scid'=>htmlentities($_POST['secId'])
  ));
  $_SESSION['message'] = "<b style='color:green'>Section unlocked</b>";
  header('Location: locksmith.php');
  return true;
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
