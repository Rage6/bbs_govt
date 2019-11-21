<?php

// Finds the database's key_token
$storedTknStmt = $pdo->prepare("SELECT key_token FROM Maintenance WHERE locksmith_id=999");
$storedTknStmt->execute();
$storedTkn = $storedTknStmt->fetch(PDO::FETCH_ASSOC)['key_token'];

// Compares your browser's token to the database's
if ($storedTkn != $_SESSION['key_token']) {
  $_SESSION['message'] = "<b style='color:red'>Invalid token</b>";
  header('Location: ../login/login.php');
  return false;
};

// Counts number of sections before using below 'for' loop
$totalSecStmt = $pdo->prepare("SELECT COUNT(section_id) FROM Section");
$totalSecStmt->execute();
$totalSec = (int)$totalSecStmt->fetch(PDO::FETCH_ASSOC)['COUNT(section_id)'];

// Gets necessary data from all of the sections
$allSecStmt = $pdo->prepare('SELECT section_id,section_name,population,flags,couns_num,del_num,is_city,is_county,failed_IP FROM Section ORDER BY is_city,is_county,section_name ASC');
$allSecStmt->execute();
for ($secNum = 0; $secNum < $totalSec; $secNum++) {
  $secList[] = $allSecStmt->fetch(PDO::FETCH_ASSOC);
};

// Carries out the password change
if (isset($_POST['changePw'])) {
  if ($_POST['newPw'] == $_POST['confPw']) {
    $secName = htmlentities($_POST['secName']);
    $pwType = htmlentities($_POST['typeId']);
    $newPw = htmlentities($_POST['newPw']);
    $newHash = password_hash($newPw,PASSWORD_DEFAULT);
    // Makes sure that the counselor and delegate passwords aren't the same
    $getBothPwStmt = $pdo->prepare("SELECT couns_pw, del_pw FROM Section WHERE section_id=:sd");
    $getBothPwStmt->execute(array(
      ':sd'=>htmlentities($_POST['secId'])
    ));
    $getBothPw = $getBothPwStmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($getBothPw['couns_pw'],$newHash) != true || password_verify($getBothPw['del_pw'],$newHash) != true) {
      $_SESSION['message'] = "<b style='color:red'>The password entered is already used. Please try a differnent password</b>";
      header('Location: locksmith.php');
      return false;
    } else {
      // Now it puts the new password in the dB
      if ($pwType == 'delegate') {
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
      return true;
    };
  } else {
    $_SESSION['message'] = "<b style='color:red'>Your new password must match it confirmation password</b>";
    header('Location: locksmith.php');
    return false;
  };
};

// Changes a city's population
if (isset($_POST['popUpdate'])) {
  if ($_POST['popNum'] >= 0) {
    $updatePop = $pdo->prepare("UPDATE Section SET population=:pp WHERE section_id=:scd AND section_id != 0");
    $updatePop->execute(array(
      ':pp'=>htmlentities($_POST['popNum']),
      ':scd'=>htmlentities($_POST['popId'])
    ));
    $_SESSION['message'] = "<b style='color:green'>Population Updated</b>";
    header('Location: locksmith.php');
    return true;
  } else {
    $_SESSION['message'] = "<b style='color:red'>The population must be greater than zero</b>";
    header('Location: locksmith.php');
    return false;
  };
};

// Changes a county or city's flag number
if (isset($_POST['flagUpdate'])) {
  $updateFlag = $pdo->prepare("UPDATE Section SET flags=:fl WHERE section_id=:si");
  $updateFlag->execute(array(
    ':fl'=>htmlentities($_POST['flagNum']),
    ':si'=>htmlentities($_POST['flagSecNum'])
  ));
  $_SESSION['message'] = "<b style='color:green'>Flag # updated</b>";
  header('Location: locksmith.php');
  return true;
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

// Locks down the website
if (isset($_POST['lockSite'])) {
  $lockSiteStmt = $pdo->prepare("UPDATE Maintenance SET lockdown=1 WHERE key_token=:kt");
  $lockSiteStmt->execute(array(
    ':kt'=>htmlentities($_SESSION['key_token'])
  ));
  $_SESSION['message'] = "<b style='color:red'>BBS website is locked</b>";
  header('Location: locksmith.php');
  return true;
};

// Unlock the website
if (isset($_POST['unlockSite'])) {
  $lockSiteStmt = $pdo->prepare("UPDATE Maintenance SET lockdown=0");
  $lockSiteStmt->execute(array(
    ':kt'=>htmlentities($_SESSION['key_token'])
  ));
  $_SESSION['message'] = "<b style='color:green'>BBS website is unlocked</b>";
  header('Location: locksmith.php');
  return true;
};

// Logs out user
if (isset($_POST['logout'])) {
  $_SESSION['message'] = "<b style='color:green'>Logout successful</b>";
  unset($_SESSION['key_token']);
  header('Location: ../login/login.php');
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
