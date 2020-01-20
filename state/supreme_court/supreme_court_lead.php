<?php

  $secIdStmt = $pdo->prepare("SELECT section_id FROM Section WHERE section_name='Supreme Court'");
  $secIdStmt->execute();
  $secId = (int)$secIdStmt->fetch(PDO::FETCH_ASSOC)['section_id'];

  // For Supreme Court's introduction
  $introStmt = $pdo->prepare("SELECT content FROM Post WHERE section_id=:sec AND title='Opening Statement'");
  $introStmt->execute(array(
    ':sec'=>$secId
  ));
  $intro = $introStmt->fetch(PDO::FETCH_ASSOC)['content'];

?>
