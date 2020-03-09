<?php
  session_start();
  require_once("../../../pdo.php");
  require_once("../static_values.php");

  header('Content-Type: application/json; CHARSET=utf-8');

  // Draws out the content of the laws
  $lawContentStmt = $pdo->prepare(
    "SELECT
      post_id,
      title,
      content
    FROM
      Post
    WHERE
      subtype_id=$senLawOne
        OR
      subtype_id=$senLawTwo");
  $lawContentStmt->execute();
  $lawContentList = [];
  while ($oneLaw = $lawContentStmt->fetch(PDO::FETCH_ASSOC)) {
    $lawContentList[] = $oneLaw;
  };
  echo(json_encode($lawContentList,JSON_PRETTY_PRINT));

?>
