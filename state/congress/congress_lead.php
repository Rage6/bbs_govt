<?php

  // Redirects to 'default.html' if lockdown in place
  if ($checkLock > 0) {
    header('Location: ../../default.html');
    return true;
  };

  // FOR SENATE
  $senSecId = 11;
  // Gets Senate's introductory statement
  $senIntroStmt = $pdo->prepare("SELECT content FROM Post WHERE post_id=14");
  $senIntroStmt->execute();
  $senIntro = $senIntroStmt->fetch(PDO::FETCH_ASSOC);

  // Gets only the leaders WITHIN the Senate, NOT all of the Senators
  // IMPORTANT: The order of roles MUST be in this order in your database for them to be inserted into the correct boxes:
  // 1. President of the Senate
  // 2. President Pro Tempore
  // 3. Assistant President Pro Tempore
  // 4. Majority Whip
  // 5. Minority Leader
  // 6. Assistant Minority Leader
  // 7. Minority Whip
  // 8. Assistant Minority Whip
  $senateLdrListStmt = $pdo->prepare("SELECT Job.job_id, job_name, Delegate.delegate_id, first_name, last_name, description, approved, section_path, filename, extension FROM
    Delegate INNER JOIN Job INNER JOIN Image WHERE Job.section_id=$senSecId AND Job.delegate_id=Delegate.delegate_id AND Job.job_id=Image.job_id AND Job.section_id=Image.section_id AND Job.senator=0");
  $senateLdrListStmt->execute();
  $senateLdrList = [];
  while ($oneSenateLdr = $senateLdrListStmt->fetch(PDO::FETCH_ASSOC)) {
    $senateLdrList[] = $oneSenateLdr;
  };

  // FOR HOUSE OF REPRESENTATIVES
  $repSecId = 10;
  // Gets House of Rep's introductory statement
  $houseIntroStmt = $pdo->prepare("SELECT content FROM Post WHERE post_id=13");
  $houseIntroStmt->execute();
  $houseIntro = $houseIntroStmt->fetch(PDO::FETCH_ASSOC);

  // Gets only the leaders WITHIN the House, NOT all of the Representative
  $houseLdrListStmt = $pdo->prepare("SELECT job_id, job_name, Delegate.delegate_id, first_name, last_name FROM Job INNER JOIN Delegate WHERE Job.section_id=$repSecId AND Job.delegate_id=Delegate.delegate_id AND Job.representative=0");
  $houseLdrListStmt->execute();
  $houseLdrList = [];
  while ($oneHouseLdr = $houseLdrListStmt->fetch(PDO::FETCH_ASSOC)) {
    $houseLdrList[] = $oneHouseLdr;
  };

  // echo("<pre>");
  // var_dump($senateLdrList);
  // echo("</pre>");

?>
