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
      content,
      subtype_name
    FROM
      Post
        INNER JOIN
      Subtype
    WHERE
      Post.subtype_id=Subtype.subtype_id
        AND
      Subtype.subtype_name LIKE '%%Law%'
        AND
      approved=1");
  $lawContentStmt->execute();
  $lawContentList = [];
  while ($oneLaw = $lawContentStmt->fetch(PDO::FETCH_ASSOC)) {
    $lawContentList[] = $oneLaw;
  };
  echo(json_encode($lawContentList,JSON_PRETTY_PRINT));

?>
