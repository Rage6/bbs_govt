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
    <!-- For EasyAutocomplete -->
    <script src="../node_modules/easy-autocomplete/dist/jquery.easy-autocomplete.min.js"></script>
    <link rel="stylesheet" href="../node_modules/easy-autocomplete/dist/easy-autocomplete.min.css">
    <link rel="stylesheet" href="../node_modules/easy-autocomplete/dist/easy-autocomplete.themes.min.css">
    <!--  -->
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
          while ($oneType = $listTypeStmt->fetch(PDO::FETCH_ASSOC)) {
            echo("
            <div class='postTypeRow'>
              <div class='postType'>".$oneType['type_name']."</div>
              <div id='addBttn".$oneType['type_id']."' class='addingPost' data-type='".$oneType['type_id']."'> + ADD POST</div>
            </div>
            <div style='display:none' id='addBox".$oneType['type_id']."' class='addBox postBox'>
              <form method='POST'>
                <div class='postTitle'>Title:</div>
                <input type='text' name='postTitle' placeholder='Enter your title here' />
                <div>Content:</div>
                <input type='text' name='postContent' placeholder='Enter your content here' />
                <div>Order #:</div>
                <input class='postOrder' type='number' name='orderNum' min='1' value='1' />
                <input type='hidden' name='approval' value='0' />
                <input type='hidden' name='typeId' value='".$oneType['type_id']."' />
                <input type='hidden' name='secId' value='".$_SESSION['secId']."' />
                <input class='addSubmit' type='submit' name='addPost' value='SUBMIT' />
              </form>
            </div>
            ");
            $listPostStmt = $pdo->prepare("SELECT DISTINCT * FROM Post WHERE type_id=:tid ORDER BY post_order ASC");
            $listPostStmt->execute(array(
              ':tid'=>$oneType['type_id']
            ));
            while ($onePost = $listPostStmt->fetch(PDO::FETCH_ASSOC)) {
              if ($onePost['approved'] == 1) {
                $approval = 1;
              } else {
                $approval = 0;
              };
              echo("
              <div class='postBox'>
                <form method='POST'>
                  <input type='hidden' name='postId' value='".$onePost['post_id']."'>
                  <div class='postTitle'>Title:</div>
                  <input type='text' name='postTitle' value='");
                    echo htmlspecialchars($onePost['title'], ENT_QUOTES);
                    echo("' />
                  <div>Content:</div>
                  <input type='text' name='postContent' value='");
                    echo htmlspecialchars($onePost['content'], ENT_QUOTES);
                    echo("' />
                  <div>Order #:</div>
                  <input class='postOrder' type='number' name='orderNum' min='1' value='".$onePost['post_order']."'/>
              ");
              if ($approval == 1) {
                $ifApproved = "checked";
                $ifPending = "";
                $status = "PUBLIC";
              } else {
                $ifApproved = "";
                $ifPending = "checked";
                $status = "PENDING";
              };
              echo("<div>Online Status: ".$status."</div>");
              if ($_SESSION['adminType'] == "counselor") {
                echo("
                  <div class='counsOnly'>
                    <div><u>COUNSELOR ONLY</u></div>
                    <input type='radio' id='yes' name='approval' value='1' ".$ifApproved." />
                    <label for='yes'>COMPLETE</label></br>
                    <input type='radio' id='no' name='approval' value='0' ".$ifPending." />
                    <label for='no'>PENDING</label></br>
                    <input type='submit' name='changeApproval' value='SUBMIT' />
                  </div>
                ");
              };
              echo("
                  <div class='changeBttns'>
                    <input type='submit' name='changePosts' value='CHANGE' />
                    <div id='delBttn".$onePost['post_id']."' data-post='".$onePost['post_id']."'>DELETE</div>
                  </div>
                  <div style='display:none' id='delBox".$onePost['post_id']."' class='delBox'>
                    ARE YOU SURE YOU WANT TO DELETE THIS POST?
                    <div class='delBttnRow'>
                      <div class='delBttn noDel' id='cancelDel".$onePost['post_id']."' data-post='".$onePost['post_id']."'>NO, keep it</div>
                      <input class='yesDel' type='submit' name='deletePost' value='YES, delete it' />
                    </div>
                  </div>
                </form>
              </div>");
            };
          };
        echo("</form>");

        // ** Below are options ONLY available for counselors

        // For adding a new delegate to the database
        echo("
          <div>
            <div>Add New Delegate</div>
            <div>
              <form method='POST'>
                <input type='text' name='newFirstN' placeholder='First name' />
                <input type='text' name='newLastN' placeholder='Last name' />
                <select name='delCity'>
                  <option>Choose a city...</option>");
                  for ($cityNum = 0; $cityNum < count($allCity); $cityNum++) {
                    echo("<option value='".$allCity[$cityNum]['city_id']."'>".$allCity[$cityNum]['section_name']."</option>");
                  };
        echo("
                </select>
                <input type='submit' name='addDelegate' value='ADD' />
              </form>
            </div>
          </div>
        ");

        // For assigning/changing job assignments
        if ($_SESSION['adminType'] == 'counselor') {
          $jobListStmt = $pdo->prepare("SELECT Delegate.delegate_id,job_id,job_name,first_name,last_name,section_name FROM Job JOIN Delegate JOIN City WHERE Job.section_id=:scd AND Job.delegate_id=Delegate.delegate_id AND Delegate.city_id=City.city_id");
          $jobListStmt->execute(array(
            ':scd'=>htmlentities($secInfo['section_id'])
          ));
          echo("
            <div>
              <div>
                <table>
                  <thead>
                    <tr>
                      Job Assignments
                    </tr>
                  </thead>
                  <tbody>");
                    while ($oneJob = $jobListStmt->fetch(PDO::FETCH_ASSOC)) {
                      echo("
                        <tr>
                          <td>".$oneJob['job_name']."</td>
                        </tr>
                        <tr>
                          <td>".$oneJob['first_name']." ".$oneJob['last_name']."</td>
                          <td>".$oneJob['section_name']."</td>
                          <input type='hidden' name='jobId' value='".$oneJob['job_id']."' />
                          <td>CHANGE</td>
                        </tr>");
                    };
          echo("
                  </tbody>
                </table>
              </div>
            </div>
          ");
        };
      ?>
    </div>
  </body>
</html>
<!-- section_id,section_name,description,full_time,is_city,is_county -->
