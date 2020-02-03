<?php
  session_start();
  require_once("../../../pdo.php");

  header('Content-Type: application/json; CHARSET=utf-8');

  $caseStmt = $pdo->prepare('SELECT * FROM Post WHERE type_id=6 AND approved=1 ORDER BY timestamp ASC');
  $caseStmt->execute();
  $caseList = [];
  while ($oneCase = $caseStmt->fetch(PDO::FETCH_ASSOC)) {
    $caseList[] = $oneCase;
  };
  // print_r($teamList);
  echo(json_encode($caseList,JSON_PRETTY_PRINT));
?>
