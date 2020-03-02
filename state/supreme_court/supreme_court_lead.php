<?php

  // Redirects to 'default.html' if lockdown in place
  if ($checkLock > 0) {
    header('Location: ../../default.html');
    return true;
  };

  $secId = 4;

  // For Supreme Court's introduction
  $introStmt = $pdo->prepare("SELECT content FROM Post WHERE type_id=5");
  $introStmt->execute();
  $intro = $introStmt->fetch(PDO::FETCH_ASSOC)['content'];

  // Collect all bio titles, names, photos, and basic info
  $justiceInfoStmt = $pdo->prepare(
    "SELECT first_name,last_name,hometown,approved,section_path,filename,extension,job_name,section_name
    FROM Job JOIN Delegate JOIN Image JOIN Section
    WHERE Job.section_id=$secId AND Delegate.delegate_id=Job.delegate_id AND Image.job_id=Job.job_id AND Section.section_id=Delegate.city_id");
  $justiceInfoStmt->execute();

  // Collects the Minutes from the Bar Association
  $minuteStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=7 ORDER BY post_order ASC");
  $minuteStmt->execute();

  // Confirm that there is at least one bar member
  $countMemberStmt = $pdo->prepare("SELECT COUNT(bar_member) FROM Delegate WHERE bar_member=1");
  $countMemberStmt->execute();
  $countMember = $countMemberStmt->fetch(PDO::FETCH_ASSOC)['COUNT(bar_member)'];

  // Collect all of the bar members
  $memberListStmt = $pdo->prepare(
    "SELECT delegate_id,first_name,last_name,hometown,section_name FROM Delegate JOIN Section WHERE Delegate.bar_member=1 AND Delegate.city_id=Section.section_id ORDER BY last_name,first_name");
  $memberListStmt->execute();

?>
