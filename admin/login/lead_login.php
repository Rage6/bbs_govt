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

  if (!isset($_COOKIE['error'])) {
    setcookie('error','start');
  };

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
      return false;
    } else {
      // Blocks too many attempts from by the same user
      $errorInfo = null;
      if ($_COOKIE['error'] != 'start') {
        $blockListStmt = $pdo->prepare("SELECT * FROM Blocked");
        $blockListStmt->execute();
        while ($oneBlocked = $blockListStmt->fetch(PDO::FETCH_ASSOC)) {
          if ($oneBlocked['error_cookie'] == $_COOKIE['error']) {
            $errorInfo = $oneBlocked;
            if ($errorInfo['blocked'] == 1) {
              $_SESSION['message'] = "<b style='color:red'>You failed to log in at least 5 times.</br> Talk to the BBS IT Staff to unlock your password.</b>";
              header('Location: login.php');
              return false;
            };
          };
        };
      };
      //
      $newTkn = bin2hex(random_bytes(64));
      if (password_verify($givenPw,$secInfo[0]['couns_pw'])) {
        // $counsTknStmt = $pdo->prepare("UPDATE Section SET couns_token=:nt, couns_num=0, del_num=0 WHERE section_id=:scd");
        $counsTknStmt = $pdo->prepare("UPDATE Section SET couns_token=:nt WHERE section_id=:scd");
        $counsTknStmt->execute(array(
          ':nt'=>$newTkn,
          ':scd'=>htmlentities($_POST['sectionId'])
        ));
        $_SESSION['counsToken'] = $newTkn;
        $_SESSION['secId'] = htmlentities($_POST['sectionId']);
        $_SESSION['message'] = "<b style='color:green'>Counselor login successful</b>";
        // $counsSessionStmt = $pdo->prepare('UPDATE Section SET couns_sess_start=:st, failed_IP=NULL WHERE section_id=:sd');
        $counsSessionStmt = $pdo->prepare('UPDATE Section SET couns_sess_start=:st WHERE section_id=:sd');
        $counsSessionStmt->execute(array(
          ':st'=>time(),
          ':sd'=>htmlentities($_SESSION['secId'])
        ));
        // Removes the 'error' cookie (if present);
        if (isset($_COOKIE['error'])) {
          $deleteCounsErrorStmt = $pdo->prepare("DELETE FROM Blocked WHERE error_cookie = :ce");
          $deleteCounsErrorStmt->execute(array(
            ':ce'=>htmlentities($_COOKIE['error'])
          ));
        };
        unset($_COOKIE['error']);
        $removeCounsError = setcookie('error','',time() - 3600);
        //
        header('Location: ../admin/admin.php');
        return true;
      } elseif (password_verify($givenPw,$secInfo[0]['del_pw'])) {
        // $delTknStmt = $pdo->prepare("UPDATE Section SET del_token=:nt, couns_num=0, del_num=0 WHERE section_id=:scd");
        $delTknStmt = $pdo->prepare("UPDATE Section SET del_token=:nt WHERE section_id=:scd");
        $delTknStmt->execute(array(
          ':nt'=>$newTkn,
          ':scd'=>htmlentities($_POST['sectionId'])
        ));
        $_SESSION['delToken'] = $newTkn;
        $_SESSION['secId'] = htmlentities($_POST['sectionId']);
        $_SESSION['message'] = "<b style='color:green'>Delegate login successful</b>";
        // $delSessionStmt = $pdo->prepare('UPDATE Section SET del_sess_start=:st, failed_IP=NULL WHERE section_id=:sd');
        $delSessionStmt = $pdo->prepare('UPDATE Section SET del_sess_start=:st WHERE section_id=:sd');
        $delSessionStmt->execute(array(
          ':st'=>time(),
          ':sd'=>htmlentities($_SESSION['secId'])
        ));
        // Removes the 'error' cookie (if present);
        if (isset($_COOKIE['error'])) {
          $deleteDelErrorStmt = $pdo->prepare("DELETE FROM Blocked WHERE error_cookie = :de");
          $deleteDelErrorStmt->execute(array(
            ':de'=>htmlentities($_COOKIE['error'])
          ));
        };
        unset($_COOKIE['error']);
        $removeDelError = setcookie('error','',time() - 3600);
        //
        header('Location: ../admin/admin.php');
        return true;
      } else {
        if ($errorInfo == null) {
          $errorTag = bin2hex(random_bytes(64));
          $addToBlockStmt = $pdo->prepare("INSERT INTO Blocked(error_cookie,time_stamp) VALUES (:et,:ti)");
          $addToBlockStmt->execute(array(
            ':et'=>htmlentities($errorTag),
            ':ti'=>time()
          ));
          setcookie('error', $errorTag);
          $totalMessage = "You have 4 login attempts remaining.";
        } else {
          if ($errorInfo['error_count'] + 1 >= 5) {
            $newBlockStmt = $pdo->prepare("UPDATE Blocked SET error_count = error_count + 1, blocked = 1 WHERE error_cookie = :ei");
            $newBlockStmt->execute(array(
              ':ei'=>htmlentities($errorInfo['error_cookie'])
            ));
            $totalMessage = "You have run out of login attempts.</br> Contact the BBS IT Staff for assistance.";
          } else {
            $updateBlockStmt = $pdo->prepare("UPDATE Blocked SET error_count = error_count + 1 WHERE error_cookie = :eu");
            $updateBlockStmt->execute(array(
              ':eu'=>htmlentities($errorInfo['error_cookie'])
            ));
            $countsLeft = 5 - ($errorInfo['error_count'] + 1);
            $totalMessage = "You have ".$countsLeft." attempts remaining.";
          };
        };
        $_SESSION['message'] = "<b style='color:red'>Password Incorrect.</br> ".$totalMessage."</b>";
        header('Location: login.php');
        return false;
      };
    };

  // Route back to login when no section is selected
  } else {
    $_SESSION['message'] = "<b style='color:red'>You must select a section, county, or city</b>";
    header('Location: login.php');
    return false;
  };
};

// echo("</br>");
// echo("</br>");
// echo("</br>");
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
// echo("COOKIE:");
// echo("<pre>");
// var_dump($_COOKIE);
// echo("</pre>");
?>
