<?php

// Redirects to 'default.html' if lockdown in place
if ($checkLock > 0) {
  header('Location: ../../default.html');
  return true;
};

// Current Governor section_id
$secId = 1;

// List of Governor staff
$govStaffList = [];
$govStaffStmt = $pdo->prepare(
  "SELECT * FROM Delegate INNER JOIN Job INNER JOIN Image WHERE Delegate.delegate_id=Job.delegate_id AND Image.job_id=Job.job_id AND Job.job_active=1 AND Job.section_id=$secId");
$govStaffStmt->execute();
while($oneGov = $govStaffStmt->fetch(PDO::FETCH_ASSOC)) {
  $govStaffList[] = $oneGov;
};

// Recalls all daily reports
$reportStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=3 AND approved=1 AND post_order<=5 ORDER BY post_order ASC");
$reportStmt->execute();
$listOfReports = [];
while ($oneReport = $reportStmt->fetch(PDO::FETCH_ASSOC)) {
  $listOfReports[] = $oneReport;
}

// Basic info for approving and showing first banner image
$bannerOneStmt = $pdo->prepare("SELECT image_path,filename,extension,approved,flickr_url FROM Image WHERE image_id=7");
$bannerOneStmt->execute();
$bannerOne = $bannerOneStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing second banner image
$bannerTwoStmt = $pdo->prepare("SELECT image_path,filename,extension,approved,flickr_url FROM Image WHERE image_id=8");
$bannerTwoStmt->execute();
$bannerTwo = $bannerTwoStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing third banner image
$bannerThreeStmt = $pdo->prepare("SELECT image_path,filename,extension,approved,flickr_url FROM Image WHERE image_id=9");
$bannerThreeStmt->execute();
$bannerThree = $bannerThreeStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing fourth banner image
$bannerFourStmt = $pdo->prepare("SELECT image_path,filename,extension,approved,flickr_url FROM Image WHERE image_id=10");
$bannerFourStmt->execute();
$bannerFour = $bannerFourStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing fifth banner image
$bannerFiveStmt = $pdo->prepare("SELECT image_path,filename,extension,approved,flickr_url FROM Image WHERE image_id=11");
$bannerFiveStmt->execute();
$bannerFive = $bannerFiveStmt->fetch(PDO::FETCH_ASSOC);

// Basic info for approving and showing six banner image
$bannerSixStmt = $pdo->prepare("SELECT image_path,filename,extension,approved,flickr_url FROM Image WHERE image_id=12");
$bannerSixStmt->execute();
$bannerSix = $bannerSixStmt->fetch(PDO::FETCH_ASSOC);

// Content of the governor's opening statement or motto
$introContentStmt = $pdo->prepare("SELECT content,approved FROM Post WHERE type_id=4");
$introContentStmt->execute();
$introContent = $introContentStmt->fetch(PDO::FETCH_ASSOC);

// echo("<pre>");
// var_dump($govStaffList[0]);
// echo("</pre>");

?>
