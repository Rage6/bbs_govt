<?php
  session_start();
  require_once("../../../pdo.php");
  require_once("../static_values.php");

  header('Content-Type: application/json; CHARSET=utf-8');

  // Draws out all of the Senate bills
  $horBillStmt = $pdo->prepare(
    "SELECT
      post_order,
      title,
      Subtype.subtype_id,
      subtype_name
    FROM
      Post INNER JOIN
      Subtype
    WHERE
      Post.subtype_id=Subtype.subtype_id AND
      Post.type_id=$horTypeId AND
      subtype_name NOT LIKE '%law%' AND
      approved=1
    ORDER BY
      post_order, post_id DESC");
  $horBillStmt->execute();
  $horBillList = [];
  while ($oneHorBill = $horBillStmt->fetch(PDO::FETCH_ASSOC)) {
    $horBillList[] = $oneHorBill;
  };
  // print_r($senBillList);
  echo(json_encode($horBillList,JSON_PRETTY_PRINT));

?>
