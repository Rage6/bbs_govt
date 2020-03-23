<?php

  // Redirects to 'default.html' if lockdown in place
  if ($checkLock > 0) {
    header('Location: ../../default.html');
    return true;
  };

  // LIST OF VARIABLES THAT MUST HAVE A CERTAIN VALUE:
  // HoR's section_id
  $repSecId = 2;
  // Senate's section_id
  $senSecId = 3;
  // HoR's 'bill' type_id
  $repTypeId = 9;
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

  // The different statuses of Senate bills before becoming a law
  $senStatusStmt = $pdo->prepare(
    "SELECT
      *
    FROM
      Subtype
    WHERE
      type_id=$senTypeId
        AND
      subtype_name NOT LIKE '%Law%'");
  $senStatusStmt->execute();

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
      Post.section_id=$repSecId)
       AND
      (Post.type_id=$senTypeId
        OR
      Post.type_id=$repTypeId)
       AND
      Post.subtype_id=Subtype.subtype_id
       AND
      (Subtype.subtype_name LIKE '%law%')
    ORDER BY post_order DESC");

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
        AND
      Department.active=1
    ORDER BY
      dpt_name ASC");
  $senCommStmt->execute();

  // Get all of the senators listed
  $senMemList = [];
  $senMemListStmt = $pdo->prepare(
    "SELECT
      first_name,
      last_name,
      hometown,
      section_name
    FROM
      Delegate
        JOIN
      Job
        JOIN
      Section
    WHERE
      Job.section_id=$senSecId
        AND
      Job.senator=Section.section_id
        AND
      Job.job_name='Senator'
        AND
      Job.delegate_id=Delegate.delegate_id
    ORDER BY
      section_name,hometown ASC");
  $senMemListStmt->execute();
  while ($oneSenMember = $senMemListStmt->fetch(PDO::FETCH_ASSOC)) {
    $senMemList[] = $oneSenMember;
  };

  // FOR HOUSE OF REPRESENTATIVES

  // Gets House of Rep's introductory statement
  $repIntroStmt = $pdo->prepare("SELECT content FROM Post WHERE post_id=13");
  $repIntroStmt->execute();
  $repIntro = $repIntroStmt->fetch(PDO::FETCH_ASSOC);

  // Gets only the LEADERS within the House, NOT all of the Representative
  $repLdrListStmt = $pdo->prepare(
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
      Job.section_id=$repSecId AND
      Job.delegate_id=Delegate.delegate_id AND
      Job.job_id=Image.job_id AND
      Job.section_id=Image.section_id AND
      Job.representative=0
    ORDER BY
      Job.job_id ASC");
  $repLdrListStmt->execute();
  $repLdrList = [];
  while ($oneHouseLdr = $repLdrListStmt->fetch(PDO::FETCH_ASSOC)) {
    $repLdrList[] = $oneHouseLdr;
  };

  // The different statuses of House's bills before becoming a law
  $repStatusStmt = $pdo->prepare(
    "SELECT
      *
    FROM
      Subtype
    WHERE
      type_id=$repTypeId
        AND
      subtype_name NOT LIKE '%Law%'");
  $repStatusStmt->execute();

  // Get all Senate committee information
  $repCommStmt = $pdo->prepare(
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
      Department.section_id=$repSecId
        AND
      Department.job_id=Job.job_id
        AND
      Delegate.delegate_id=Job.delegate_id
        AND
      Department.active=1
    ORDER BY
      dpt_name ASC");
  $repCommStmt->execute();

  // Get all of the representatives listed
  $repMemList = [];
  $repMemListStmt = $pdo->prepare(
    "SELECT
      first_name,
      last_name,
      hometown,
      section_name
    FROM
      Delegate
        JOIN
      Job
        JOIN
      Section
    WHERE
      Job.section_id=$repSecId
        AND
      Job.representative=Section.section_id
        AND
      Job.job_name='Representative'
        AND
      Job.delegate_id=Delegate.delegate_id
    ORDER BY
      section_name,hometown ASC");
  $repMemListStmt->execute();
  while ($oneRepMember = $repMemListStmt->fetch(PDO::FETCH_ASSOC)) {
    $repMemList[] = $oneRepMember;
  };

  // echo("<pre>");
  // var_dump($repLdrList);
  // echo("</pre>");

?>
