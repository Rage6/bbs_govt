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

  // Gets only the leaders WITHIN the House, NOT all of the Representative as a whole
  $houseLdrListStmt = $pdo->prepare("SELECT job_id, job_name, first_name, last_name FROM Job INNER JOIN Delegate WHERE Job.section_id=10 AND Job.delegate_id=Delegate.delegate_id AND Job.representative=0");
  $houseLdrListStmt->execute();

?>
