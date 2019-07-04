<?php

  session_start();
  require_once("../pdo.php");
  require_once("leads/admin.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | Admin Center</title>
    <link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </head>
  <body>
    <div class="menuTop">
      <?php
        if ($_SESSION['adminType'] == "counselor") {
          echo("<div style='background-color:blue'>STATUS: COUNSELOR</div>");
        } else {
          echo("<div style='background-color:green'>STATUS: DELEGATE</div>");
        };
      ?>
      <form method="POST">
        <input style="border:1px solid black" type="submit" name="logout" value="LOGOUT" />
      </form>
    </div>
    <div class="titleTop">BUCKEYE BOYS STATE</div>
    <div class="titleBottom">Administrative Center</div>
    <?php
      if (isset($_SESSION['message']) && $_SERVER['REQUEST_METHOD'] == "GET") {
        echo("<div class='message'>".$_SESSION['message']."</div>");
        unset($_SESSION['message']);
      };
    ?>
    <div class="sectionName">
      <?php
        // Adds these to the city or county titles for the page
        if ($secInfo['is_city'] == "1") {
          $titleSuffix = " City";
        } elseif ($secInfo['is_county'] == "1") {
          $titleSuffix = " County";
        } else {
          $titleSuffix = "";
        };
        // Displays which section you are working on
        echo($secInfo['section_name'].$titleSuffix);
      ?>
    </div>
    <div style="display:flex">
      <div class="belowTab"></div>
      <div class="belowTab"></div>
    </div>
    <div class="mainBox">
      <?php
        $listTypeStmt = $pdo->prepare("SELECT * FROM Type WHERE section_id=:sid");
        $listTypeStmt->execute(array(
          ':sid'=>$secInfo['section_id']
        ));
        echo("<form method='POST'>");
          while ($oneType = $listTypeStmt->fetch(PDO::FETCH_ASSOC)) {
            echo("<div class='postType'>".$oneType['type_name']."</div>");
            $listPostStmt = $pdo->prepare("SELECT DISTINCT * FROM Post WHERE type_id=:tid ORDER BY post_order ASC");
            $listPostStmt->execute(array(
              ':tid'=>$oneType['type_id']
            ));
            while ($onePost = $listPostStmt->fetch(PDO::FETCH_ASSOC)) {
              if ($onePost['approved'] == 1) {
                $approval = 'true';
              } else {
                $approval = 'false';
              };
              echo("
              <div class='postBox' data-approved=".$approval.">
                <div>Title:</div>
                <textarea>".$onePost['title']."</textarea>
                <div>Content:</div>
                <textarea>".$onePost['content']."</textarea>
                <div>Order #:</div>
                <textarea>".$onePost['post_order']."</textarea>
                <div>Approved:</div>
                <textarea>".$onePost['approved']."</textarea>
              </div>");
            };
          };
          echo("
            <div class='changeBttn'>
              <input type='submit' name='changePosts' value='MAKE CHANGES' />
            </div>
          ");
        echo("</form>");
      ?>
    </div>
  </body>
</html>
<!-- section_id,section_name,description,full_time,is_city,is_county -->
