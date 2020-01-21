<?php

  $secIdStmt = $pdo->prepare("SELECT section_id FROM Section WHERE section_name='Supreme Court'");
  $secIdStmt->execute();
  $secId = (int)$secIdStmt->fetch(PDO::FETCH_ASSOC)['section_id'];

  // For Supreme Court's introduction
  $introStmt = $pdo->prepare("SELECT content FROM Post WHERE section_id=:sec AND title='Intro Statement'");
  $introStmt->execute(array(
    ':sec'=>$secId
  ));
  $intro = $introStmt->fetch(PDO::FETCH_ASSOC)['content'];

  // Collects the Minutes from the Bar Association
  $minuteStmt = $pdo->prepare("SELECT * FROM Post WHERE type_id=7 ORDER BY post_order ASC");
  $minuteStmt->execute();

?>
