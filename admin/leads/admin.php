<?php

// Confirms a token is present and matches with the token in the dB
if (isset($_SESSION['counsToken'])) {
  $dbTknStmt = $pdo->prepare("SELECT couns_token FROM Section WHERE section_id=:cid");
  $dbTknStmt->execute(array(
    ':cid'=>htmlentities($_SESSION['secId'])
  ));
  $dbTkn = $dbTknStmt->fetch(PDO::FETCH_ASSOC)['couns_token'];
  if ($dbTkn != $_SESSION['counsToken']) {
    $_SESSION['message'] = "<b style='color:red'>Your token does not match your section's token. Please log back in.</br>NOTE: This may have happened because another counselor logged into this section's account recently.</b>";
    unset($_SESSION['counsToken']);
    unset($_SESSION['secId']);
    unset($_SESSION['adminType']);
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
    $_SESSION['message'] = "<b style='color:red'>Your token does not match your section's token. Please log back in.</br>NOTE: This may have happened because another delegate logged into this section's account recently.</b>";
    unset($_SESSION['delToken']);
    unset($_SESSION['secId']);
    unset($_SESSION['adminType']);
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

// Gets all city info
$allCityStmt = $pdo->prepare("SELECT city_id,section_name FROM City");
$allCityStmt->execute();
$allCity = [];
while ($oneCity = $allCityStmt->fetch(PDO::FETCH_ASSOC)) {
  $allCity[] = $oneCity;
};

// Add a new post
if (isset($_POST['addPost'])) {
  if ($_POST['postTitle'] != "") {
    if ($_POST['postContent'] != "") {
      if ($_POST['orderNum'] != "") {
        $addPostStmt = $pdo->prepare("INSERT INTO Post(title,content,post_order,approved,type_id,section_id) VALUES (:ti,:cn,:po,:ap,:td,:sd)");
        $addPostStmt->execute(array(
          ':ti'=>htmlentities($_POST['postTitle']),
          ':cn'=>htmlentities($_POST['postContent']),
          ':po'=>htmlentities($_POST['orderNum']),
          ':ap'=>htmlentities($_POST['approval']),
          ':td'=>htmlentities($_POST['typeId']),
          ':sd'=>htmlentities($_POST['secId'])
        ));
        $_SESSION['message'] = "<b style='color:green'>Post Added</b>";
        header('Location: admin.php');
        return true;
      } else {
        $_SESSION['message'] = "<b style='color:red'>An order within the other posts is required</b>";
        header('Location: admin.php');
        return false;
      };
    } else {
      $_SESSION['message'] = "<b style='color:red'>A content is required</b>";
      header('Location: admin.php');
      return false;
    };
  } else {
    $_SESSION['message'] = "<b style='color:red'>A title is required</b>";
    header('Location: admin.php');
    return false;
  };
};

// Approving a pending post (or switching back to 'pending')
if (isset($_POST['changeApproval'])) {
  $approvalStmt = $pdo->prepare("UPDATE Post SET approved=:apv WHERE post_id=:pd");
  $approvalStmt->execute(array(
    ':apv'=>htmlentities($_POST['approval']),
    ':pd'=>htmlentities($_POST['postId'])
  ));
  $_SESSION['message'] = "<b style='color:green'>Approval changed</b>";
  header('Location: admin.php');
  return true;
};

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
