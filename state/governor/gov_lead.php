<?php

// Redirects to 'default.html' if lockdown in place
if ($checkLock > 0) {
  header('Location: ../../default.html');
  return true;
};

$secId = 9;

// For Governor basic info
$govStmt = $pdo->prepare(
  "SELECT * FROM Delegate INNER JOIN Job INNER JOIN Image WHERE Delegate.delegate_id=Job.delegate_id AND Image.job_id=Job.job_id AND Job.job_id=1");
$govStmt->execute();
$govInfo = $govStmt->fetch(PDO::FETCH_ASSOC);

// For Lieutenant Governor basic info
$ltgovStmt = $pdo->prepare(
  "SELECT * FROM Delegate INNER JOIN Job INNER JOIN Image WHERE Delegate.delegate_id=Job.delegate_id AND Image.job_id=Job.job_id AND Job.job_id=2");
$ltgovStmt->execute();
$ltgovInfo = $ltgovStmt->fetch(PDO::FETCH_ASSOC);

// For Attorney General basic info
$attGenStmt = $pdo->prepare(
  "SELECT * FROM Delegate INNER JOIN Job INNER JOIN Image WHERE Delegate.delegate_id=Job.delegate_id AND Image.job_id=Job.job_id AND Job.job_id=3");
$attGenStmt->execute();
$attGenInfo = $attGenStmt->fetch(PDO::FETCH_ASSOC);

// For State Treasurer basic info
$treasStmt = $pdo->prepare(
  "SELECT * FROM Delegate INNER JOIN Job INNER JOIN Image WHERE Delegate.delegate_id=Job.delegate_id AND Image.job_id=Job.job_id AND Job.job_id=4");
$treasStmt->execute();
$treasInfo = $treasStmt->fetch(PDO::FETCH_ASSOC);

// For State Auditor basic info
$auditStmt = $pdo->prepare(
  "SELECT * FROM Delegate INNER JOIN Job INNER JOIN Image WHERE Delegate.delegate_id=Job.delegate_id AND Image.job_id=Job.job_id AND Job.job_id=5");
$auditStmt->execute();
$auditInfo = $auditStmt->fetch(PDO::FETCH_ASSOC);

// For Secretary of State basic info
$secStmt = $pdo->prepare(
  "SELECT * FROM Delegate INNER JOIN Job INNER JOIN Image WHERE Delegate.delegate_id=Job.delegate_id AND Image.job_id=Job.job_id AND Job.job_id=6");
$secStmt->execute();
$secInfo = $secStmt->fetch(PDO::FETCH_ASSOC);

// Recalls all daily reports
$reportStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=3 AND approved=1 AND post_order<=5 ORDER BY post_order ASC");
$reportStmt->execute();

// Basic info for approving and showing first banner image
$bannerOneStmt = $pdo->prepare("SELECT image_path,filename,extension,approved FROM Image WHERE image_id=7");
$bannerOneStmt->execute();
$bannerOne = $bannerOneStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing second banner image
$bannerTwoStmt = $pdo->prepare("SELECT image_path,filename,extension,approved FROM Image WHERE image_id=8");
$bannerTwoStmt->execute();
$bannerTwo = $bannerTwoStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing third banner image
$bannerThreeStmt = $pdo->prepare("SELECT image_path,filename,extension,approved FROM Image WHERE image_id=9");
$bannerThreeStmt->execute();
$bannerThree = $bannerThreeStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing fourth banner image
$bannerFourStmt = $pdo->prepare("SELECT image_path,filename,extension,approved FROM Image WHERE image_id=10");
$bannerFourStmt->execute();
$bannerFour = $bannerFourStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing fifth banner image
$bannerFiveStmt = $pdo->prepare("SELECT image_path,filename,extension,approved FROM Image WHERE image_id=11");
$bannerFiveStmt->execute();
$bannerFive = $bannerFiveStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing six banner image
$bannerSixStmt = $pdo->prepare("SELECT image_path,filename,extension,approved FROM Image WHERE image_id=12");
$bannerSixStmt->execute();
$bannerSix = $bannerSixStmt->fetch(PDO::FETCH_ASSOC);

// Content of the governor's opening statement or motto
$introContentStmt = $pdo->prepare("SELECT content,approved FROM Post WHERE subtype_id=4 AND section_id=9");
$introContentStmt->execute();
$introContent = $introContentStmt->fetch(PDO::FETCH_ASSOC);

?>
