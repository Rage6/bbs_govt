<?php

// Finds all section info for dropbox
$allSectStmt = $pdo->prepare("SELECT section_id,section_name,is_city,is_county FROM Section ORDER BY is_city,is_county,section_name ASC");
$allSectStmt->execute();
while ($oneSect = $allSectStmt->fetch(PDO::FETCH_ASSOC)) {
  $sectList[] = $oneSect;
};

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
        $mstrTknStmt = $pdo->prepare("UPDATE Maintenance SET key_token=:tkn,attempts=0 WHERE locksmith_id=999");
        $mstrTknStmt->execute(array(
          ':tkn'=>$masterToken
        ));
        $_SESSION['key_token'] = $masterToken;
        $_SESSION['message'] = "<b style='color:green'>Login Successful</b>";
        header('Location: ../locksmith/locksmith.php');
        return true;
      } else {
        $addAttemptStmt = $pdo->prepare("UPDATE Maintenance SET attempts=attempts+1");
        $addAttemptStmt->execute();
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
      if ($secInfo[0]['couns_num'] > 4 || $secInfo[0]['del_num'] > 4) {
        $_SESSION['message'] = "<b style='color:red'>Due to multiple failed password attempts, this section is currently locked. You must contact the BBS IT staff in order to unlock this section.</b>";
        header('Location: login.php');
        return false;
      };
      $newTkn = bin2hex(random_bytes(64));
      if (password_verify($givenPw,$secInfo[0]['couns_pw'])) {
        $counsTknStmt = $pdo->prepare("UPDATE Section SET couns_token=:nt, couns_num=0, del_num=0 WHERE section_id=:scd");
        $counsTknStmt->execute(array(
          ':nt'=>$newTkn,
          ':scd'=>htmlentities($_POST['sectionId'])
        ));
        $_SESSION['counsToken'] = $newTkn;
        $_SESSION['secId'] = htmlentities($_POST['sectionId']);
        $_SESSION['message'] = "<b style='color:green'>Counselor login successful</b>";
        $counsSessionStmt = $pdo->prepare('UPDATE Section SET couns_sess_start=:st, failed_IP=NULL WHERE section_id=:sd');
        $counsSessionStmt->execute(array(
          ':st'=>time(),
          ':sd'=>htmlentities($_SESSION['secId'])
        ));
        header('Location: ../admin/admin.php');
        return true;
      } elseif (password_verify($givenPw,$secInfo[0]['del_pw'])) {
        $delTknStmt = $pdo->prepare("UPDATE Section SET del_token=:nt, couns_num=0, del_num=0 WHERE section_id=:scd");
        $delTknStmt->execute(array(
          ':nt'=>$newTkn,
          ':scd'=>htmlentities($_POST['sectionId'])
        ));
        $_SESSION['delToken'] = $newTkn;
        $_SESSION['secId'] = htmlentities($_POST['sectionId']);
        $_SESSION['message'] = "<b style='color:green'>Delegate login successful</b>";
        $delSessionStmt = $pdo->prepare('UPDATE Section SET del_sess_start=:st, failed_IP=NULL WHERE section_id=:sd');
        $delSessionStmt->execute(array(
          ':st'=>time(),
          ':sd'=>htmlentities($_SESSION['secId'])
        ));
        header('Location: ../admin/admin.php');
        return true;
      } else {
        if ($secInfo[0]['del_num'] == 4) {
          if ($secInfo[0]['failed_IP'] == null) {
            $failedIPStmt = $pdo->prepare("UPDATE Section SET failed_IP=:fi WHERE section_id=:si");
            $failedIPStmt->execute(array(
              ':fi'=>htmlentities($_SERVER['REMOTE_ADDR']),
              ':si'=>htmlentities($_POST['sectionId'])
            ));
          };
        };
        $numDelFails = $secInfo[0]['del_num'] + 1;
        $numLeft = 5 - $numDelFails;
        if ($numLeft <= 0) {
          $totalMessage = "Your section is now locked. Contact the BBS IT staff in order to unlock this section.";
        } else {
          $totalMessage = "You have ".$numLeft." more attempts until this section locks.";
        };
        $addNumStmt = $pdo->prepare("UPDATE Section SET del_num = del_num + 1, couns_num = couns_num + 1 WHERE section_id=:scd");
        $addNumStmt->execute(array(
          ':scd'=>htmlentities($_POST['sectionId'])
        ));
        $_SESSION['message'] = "<b style='color:red'>Password Incorrect.</br> ".$totalMessage."</b>";
        header('Location: login.php');
        return fail;
      };
    };
    header('Location: ../admin/admin.php');
    return true;

  // Route back to login when no section is selected
  } else {
    $_SESSION['message'] = "<b style='color:red'>You must select a section, county, or city</b>";
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
