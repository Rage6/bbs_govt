<?php
  session_start();
  require_once("../../../pdo.php");

  header('Content-Type: application/json; CHARSET=utf-8');

  $subtypeStmt = $pdo->prepare('SELECT subtype_id,subtype_name FROM Subtype WHERE type_id=6');
  $subtypeStmt->execute();
  $subtypeList = [];
  while ($oneSubtype = $subtypeStmt->fetch(PDO::FETCH_ASSOC)) {
    $subtypeList[] = $oneSubtype;
  };
  // print_r($teamList);
  echo(json_encode($subtypeList,JSON_PRETTY_PRINT));
?>
