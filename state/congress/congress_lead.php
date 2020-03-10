<?php

  // Redirects to 'default.html' if lockdown in place
  if ($checkLock > 0) {
    header('Location: ../../default.html');
    return true;
  };

  // LIST OF VARIABLES THAT MUST HAVE A CERTAIN VALUE:
  // HoR's section_id
  $houseSecId = 2;
  // Senate's section_id
  $senSecId = 3;
  // HoR's 'bill' type_id
  $houseTypeId = 9;
  // Senate's 'bill' type_id
  $senTypeId = 11;


  // Gets Senate's introductory statement
  $senIntroStmt = $pdo->prepare("SELECT content FROM Post WHERE post_id=14");
  $senIntroStmt->execute();
  $senIntro = $senIntroStmt->fetch(PDO::FETCH_ASSOC);

  // Gets only the leaders WITHIN the Senate, NOT all of the Senators
  // IMPORTANT: The job_id determines the order of roles on the screen. These values don't have to have specific numbers, simply a specific order. The order is:
  // a) President of the Senate
  // b) President Pro Tempore
  // c) Assistant President Pro Tempore
  // d) Majority Whip
  // e) Minority Leader
  // f) Assistant Minority Leader
  // g) Minority Whip
  // e) Assistant Minority Whip
  $senateLdrListStmt = $pdo->prepare(
    "SELECT
      Job.job_id,
      job_name,
      Delegate.delegate_id,
      first_name,
      last_name,
      description,
      approved,
      section_path,
      filename,
      extension
    FROM
      Delegate INNER JOIN
      Job INNER JOIN
      Image
    WHERE
      Job.section_id=$senSecId AND
      Job.delegate_id=Delegate.delegate_id AND
      Job.job_id=Image.job_id AND
      Job.section_id=Image.section_id AND
      Job.senator=0
    ORDER BY
      Job.job_id ASC");
  $senateLdrListStmt->execute();
  $senateLdrList = [];
  while ($oneSenateLdr = $senateLdrListStmt->fetch(PDO::FETCH_ASSOC)) {
    $senateLdrList[] = $oneSenateLdr;
  };

  // Lists all of the laws
  $senLawListStmt = $pdo->prepare(
    "SELECT
      post_id,
      title,
      post_order,
      subtype_name
    FROM
      Post
        JOIN
      Subtype
    WHERE
      (Post.section_id=$senSecId
        OR
      Post.section_id=$houseSecId)
       AND
      (Post.type_id=$senTypeId
        OR
      Post.type_id=$houseTypeId)
       AND
      Post.subtype_id=Subtype.subtype_id
       AND
      (Subtype.subtype_name LIKE '%law%')
    ORDER BY post_order DESC");
  $senLawListStmt->execute();

  // Get all Senate committee information
  $senCommStmt = $pdo->prepare(
    "SELECT
      dpt_id,
      dpt_name,
      purpose,
      job_name,
      first_name,
      last_name
    FROM
      Department
        JOIN
      Job
        JOIN
      Delegate
    WHERE
      Department.section_id=$senSecId
        AND
      Department.job_id=Job.job_id
        AND
      Delegate.delegate_id=Job.delegate_id
    ORDER BY
      dpt_name ASC");
  $senCommStmt->execute();

  // FOR HOUSE OF REPRESENTATIVES
  $repSecId = 2;
  // Gets House of Rep's introductory statement
  $houseIntroStmt = $pdo->prepare("SELECT content FROM Post WHERE post_id=13");
  $houseIntroStmt->execute();
  $houseIntro = $houseIntroStmt->fetch(PDO::FETCH_ASSOC);

  // Gets only the leaders WITHIN the House, NOT all of the Representative
  $houseLdrListStmt = $pdo->prepare(
    "SELECT
      job_id,
      job_name,
      Delegate.delegate_id,
      first_name,
      last_name
    FROM
      Job INNER JOIN
      Delegate
    WHERE
      Job.section_id=$repSecId AND
      Job.delegate_id=Delegate.delegate_id AND
      Job.representative=0");
  $houseLdrListStmt->execute();
  $houseLdrList = [];
  while ($oneHouseLdr = $houseLdrListStmt->fetch(PDO::FETCH_ASSOC)) {
    $houseLdrList[] = $oneHouseLdr;
  };

  // echo("<pre>");
  // var_dump($senateLdrList);
  // echo("</pre>");

?>
