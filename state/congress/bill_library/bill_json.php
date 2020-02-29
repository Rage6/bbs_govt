<?php
  session_start();
  require_once("../../../pdo.php");

  header('Content-Type: application/json; CHARSET=utf-8');

  // The Senate bills are type_id = 11
  $senTypeId = 11;

  // Draws out all of the Senate bills
  $senBillStmt = $pdo->prepare("SELECT post_order,title,Subtype.subtype_id,subtype_name FROM Post INNER JOIN Subtype WHERE Post.subtype_id=Subtype.subtype_id AND Post.type_id=$senTypeId AND approved=1 ORDER BY post_order DESC");
  $senBillStmt->execute();
  $senBillList = [];
  while ($oneSenBill = $senBillStmt->fetch(PDO::FETCH_ASSOC)) {
    $senBillList[] = $oneSenBill;
  };
  // print_r($senBillList);
  echo(json_encode($senBillList,JSON_PRETTY_PRINT));
?>
