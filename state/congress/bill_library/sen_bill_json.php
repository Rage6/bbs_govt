<?php
  session_start();
  require_once("../../../pdo.php");
  require_once("../static_values.php");

  header('Content-Type: application/json; CHARSET=utf-8');

  // Draws out all of the Senate bills
  $senBillStmt = $pdo->prepare(
    "SELECT
      post_order,
      chamber_prefix,
      title,
      Subtype.subtype_id,
      subtype_name
    FROM
      Post INNER JOIN
      Subtype
    WHERE
      Post.subtype_id=Subtype.subtype_id AND
      Post.type_id=$senTypeId AND
      subtype_name NOT LIKE '%law%' AND
      approved=1
    ORDER BY
      post_order DESC, post_id DESC");
  $senBillStmt->execute();
  $senBillList = [];
  while ($oneSenBill = $senBillStmt->fetch(PDO::FETCH_ASSOC)) {
    $senBillList[] = $oneSenBill;
  };
  // print_r($senBillList);
  echo(json_encode($senBillList,JSON_PRETTY_PRINT));

?>
