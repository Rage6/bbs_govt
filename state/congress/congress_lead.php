<?php

  // Redirects to 'default.html' if lockdown in place
  if ($checkLock > 0) {
    header('Location: ../../default.html');
    return true;
  };

  // Gets Senate's introductory statement
  $senIntroStmt = $pdo->prepare("SELECT content FROM Post WHERE post_id=30");
  $senIntroStmt->execute();
  $senIntro = $senIntroStmt->fetch(PDO::FETCH_ASSOC);

?>
