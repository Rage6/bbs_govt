<?php

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

// echo("<pre>");
// var_dump($currentHost);
// echo("</pre>");

?>
