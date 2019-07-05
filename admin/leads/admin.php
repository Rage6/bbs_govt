<?php

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
$secInfoStmt = $pdo->prepare("SELECT section_id,section_name,description,full_time,is_city,is_county FROM Section WHERE section_id=:sid");
$secInfoStmt->execute(array(
  ':sid'=>$secId
));
$secInfo = $secInfoStmt->fetch(PDO::FETCH_ASSOC);
// echo("<pre>");
// var_dump($secInfo);
// echo("</pre>");

// Delete a post
if (isset($_POST['deletePost'])) {
  $delPostStmt = $pdo->prepare('DELETE FROM Post WHERE post_id=:pid');
  $delPostStmt->execute(array(
    ':pid'=>$_POST['postId']
  ));
  $_SESSION['message'] = "<b style='color:blue'>Post Deleted</b>";
  header('Location: admin.php');
  return true;
};

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
