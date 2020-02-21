<?php

  // Redirects to 'default.html' if lockdown in place
  if ($checkLock > 0) {
    header('Location: ../../default.html');
    return true;
  };

  // FOR SENATE

  // Gets Senate's introductory statement
  $senIntroStmt = $pdo->prepare("SELECT content FROM Post WHERE post_id=30");
  $senIntroStmt->execute();
  $senIntro = $senIntroStmt->fetch(PDO::FETCH_ASSOC);

  // FOR HOUSE OF REPRESENTATIVES

  // Gets House of Rep's introductory statement
  $houseIntroStmt = $pdo->prepare("SELECT content FROM Post WHERE post_id=22");
  $houseIntroStmt->execute();
  $houseIntro = $houseIntroStmt->fetch(PDO::FETCH_ASSOC);

?>
