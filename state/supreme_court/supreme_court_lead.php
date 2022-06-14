<?php

  // Redirects to 'default.html' if lockdown in place
  if ($checkLock > 0) {
    header('Location: ../../default.html');
    return true;
  };

  $secId = 4;

  // For Supreme Court's introduction
  $introStmt = $pdo->prepare("SELECT content,approved FROM Post WHERE type_id=5 AND section_id=$secId");
  $introStmt->execute();
  $intro = $introStmt->fetch(PDO::FETCH_ASSOC);
  // $introApproval = $intro['approval'];
  // $introContent = $intro['content'];

  // Collect all bio titles, names, photos, and basic info
  $justiceInfoStmt = $pdo->prepare(
    "SELECT
      Delegate.delegate_id AS delegate_id,
      first_name,
      last_name,
      hometown,
      approved,
      section_path,
      filename,
      extension,
      flickr_url,
      job_name,
      section_name
    FROM
      Job JOIN
      Delegate JOIN
      Image JOIN
      Section
    WHERE
      Job.section_id=$secId AND
      Delegate.delegate_id=Job.delegate_id AND
      Image.job_id=Job.job_id AND
      Section.section_id=Delegate.city_id
    ORDER BY
      Job.job_id ASC");
  $justiceInfoStmt->execute();

  // Collects the Minutes from the Bar Association
  $minuteStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=7 AND approved=1 ORDER BY post_order ASC");
  $minuteStmt->execute();
  $listOfMinutes = [];
  while ($oneMinute = $minuteStmt->fetch(PDO::FETCH_ASSOC)) {
    $listOfMinutes[] = $oneMinute;
  };

  // Collect all of the bar members
  $memberListStmt = $pdo->prepare(
    "SELECT delegate_id,first_name,last_name,hometown,section_name FROM Delegate JOIN Section WHERE Delegate.bar_member=1 AND Delegate.city_id=Section.section_id ORDER BY last_name,first_name");
  $memberListStmt->execute();

?>
