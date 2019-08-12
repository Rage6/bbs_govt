<?php

  session_start();
  require_once("../../pdo.php");
  require_once("lead_admin.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS | Admin Center</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans+Condensed:300|Playfair+Display&display=swap" rel="stylesheet"/>
    <!-- Width: 0px to 360px (Default CSS) -->
    <link rel="stylesheet" type="text/css" href="style/admin_360.css" />
    <!-- Width: 361px to 375px -->
    <link rel="stylesheet" media="screen and (min-width: 361px) and (max-width: 375px)" href="style/admin_375.css"/>
    <!-- Width: 376px to 414px -->
    <link rel="stylesheet" media="screen and (min-width: 376px) and (max-width: 414px)" href="style/admin_414.css"/>
    <!-- Width: 415px to 768px -->
    <link rel="stylesheet" media="screen and (min-width: 415px) and (max-width: 768px)" href="style/admin_768.css"/>
    <!-- Width: 769px to 1366px -->
    <link rel="stylesheet" media="screen and (min-width: 769px) and (max-width: 1366px)" href="style/admin_1366.css"/>
    <!-- Width: 1367px to 1440px -->
    <link rel="stylesheet" media="screen and (min-width: 1367px) and (max-width: 1440px)" href="style/admin_1440.css"/>
    <!-- Width: 1441px and above -->
    <link rel="stylesheet" media="screen and (min-width: 1441px)" href="style/admin_1920.css"/>
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
          while ($oneType = $listTypeStmt->fetch(PDO::FETCH_ASSOC)) {
            echo("
            <div data-head='".$oneType['type_id']."' class='postType'>".$oneType['type_name']."</div>
            <div id='typeId".$oneType['type_id']."' class='postMain'>
              <div class='postTypeRow'>
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
              echo("
                <div id='typeRow_".$oneType['type_id']."' class='pendingRow'>
                  <div id='pending".$oneType['type_id']."' class='pendingBttn' data-pendtype='".$oneType['type_id']."' data-approval=0>PENDING</div>
                  <div id='all".$oneType['type_id']."' class='allBttn' data-pendtype='".$oneType['type_id']."' data-approval=1>ALL</div>
                </div>
              ");
              $listPostStmt = $pdo->prepare("SELECT DISTINCT * FROM Post WHERE type_id=:tid ORDER BY post_order, Post.timestamp ASC");
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
                <div id='postBox_".$onePost['post_id']."' class='postBox' data-postid='".$onePost['post_id']."' data-typeid='".$onePost['type_id']."' data-approval='".$approval."'>
                  <form method='POST'>
                    <input type='hidden' name='postId' value='".$onePost['post_id']."'>
                    <div class='postSubtitle'>Title:</div>
                    <textarea class='postText titleText' name='postTitle'>");
                      echo htmlspecialchars($onePost['title'], ENT_QUOTES);
                    echo("</textarea>
                    <div class='postSubtitle'>Content:</div>
                    <textarea class='postText contentText' name='postContent'>");
                      echo htmlspecialchars($onePost['content'], ENT_QUOTES);
                    echo("</textarea>
                    <div class='postSubtitle'>Time Posted</div>
                    <div style='text-align:center'>
                      (<i>YYYY-MM-DD HH:MM:SS</i>)
                    </div>
                    <textarea class='postText timeText' name='postTime'>".$onePost['timestamp']."</textarea>
                    <div class='postSubtitle'>Order #:</div>
                    <input class='postOrder' type='number' name='orderNum' min='1' value='".$onePost['post_order']."'/>
                ");
                if ($approval == 1) {
                  $ifApproved = "checked";
                  $ifPending = "";
                  $status = "<b style='color:green'>APPROVED</b>";
                } else {
                  $ifApproved = "";
                  $ifPending = "checked";
                  $status = "<b style='color:yellow'>PENDING</b>";
                };
                echo("
                    <div class='postSubtitle postStatus'>Online Status: ".$status."</div>
                    <div class='changeBttns'>
                      <div class='blueBttn' id='chgBttn".$onePost['post_id']."' data-post='".$onePost['post_id']."' data-box='change'>CHANGE</div>
                      <div id='delBttn".$onePost['post_id']."' data-post='".$onePost['post_id']."' data-box='delete'>DELETE</div>
                    </div>
                    <div style='display:none' id='chgBox".$onePost['post_id']."' class='delBox'>");
                    if ($_SESSION['adminType'] == "delegate") {
                      echo("NOTE: Upon clicking 'CHANGE', this post will be hidden online until a counselor reapproves it. ");
                    };
                    echo("Are you sure you want to make the change(s)?
                      <div class='delBttnRow'>
                        <div class='delBttn noDel' id='cancelChg".$onePost['post_id']."' data-post='".$onePost['post_id']."'>NO, don't change it</div>
                        <input class='yesChg' type='submit' name='changePosts' value='Yes, change it' />
                      </div>
                    </div>
                    <div style='display:none' id='delBox".$onePost['post_id']."' class='delBox'>
                      ARE YOU SURE YOU WANT TO DELETE THIS POST?
                      <div class='delBttnRow'>
                        <div class='delBttn noDel' id='cancelDel".$onePost['post_id']."' data-post='".$onePost['post_id']."'>NO, keep it</div>
                        <input class='yesDel' type='submit' name='deletePost' value='YES, delete it' />
                      </div>
                    </div>");
                    if ($_SESSION['adminType'] == "counselor") {
                      echo("
                        <div class='counsOnly'>
                          <div><u>COUNSELOR ONLY</u></div>
                          <input type='radio' id='yes' name='approval' value='1' ".$ifApproved." />
                          <label for='yes'>APPROVED</label></br>
                          <input type='radio' id='no' name='approval' value='0' ".$ifPending." />
                          <label for='no'>PENDING</label></br>
                          <input type='submit' name='changeApproval' value='SUBMIT' />
                        </div>
                      ");
                    };
                  echo("
                  </form>
                </div>");
              };
        echo("</div>");
          };
        // echo("</form>");

        // ** Below are COUNSELOR ONLY

        // For assigning/changing job assignments
        if ($_SESSION['adminType'] == 'counselor') {
          $jobListStmt = $pdo->prepare("SELECT Delegate.delegate_id,job_id,job_name,senator,representative,first_name,last_name,section_name FROM Job JOIN Delegate JOIN City WHERE Job.section_id=:scd AND Job.delegate_id=Delegate.delegate_id AND Delegate.city_id=City.city_id");
          $jobListStmt->execute(array(
            ':scd'=>htmlentities($secInfo['section_id'])
          ));
          echo("
            <div class='counsTitle'>
              COUNSELORS ONLY
            </div>
            <div class='counsContent'>
              <div id='listTitle' class='postType listTitle'>
                Current Staff
              </div>
              <div id='listBox' class='listBox'>");
                while ($oneJob = $jobListStmt->fetch(PDO::FETCH_ASSOC)) {
                  echo("
                    <div class='staffTitle'>".$oneJob['job_name']."</div>
                    <div class='staffContent'>
                      <div>
                        <span style='color:green'>NAME:</span>
                        ".$oneJob['first_name']." ".$oneJob['last_name']."
                      </div>
                      <div>
                        <span style='color:green'>CITY:</span> ".$oneJob['section_name']."
                      </div>
                    </div>");
              };
        echo("
            </div>
            <div id='assignJobTitle' class='postType listTitle'>
              Assign A Job
            </div>
            <div id='assignJobBox' class='assignJobBox'>
              <form method='POST'>
                <div class='pickJob'>
                  <div>I am filling this job... </div>
                  <div>
                    <select name='jobId'>
                      <option value='-1'>-- Select Job --</option>");
                      $jobListStmt->execute(array(
                        ':scd'=>htmlentities($secInfo['section_id'])
                      ));
                      while ($singleJob = $jobListStmt->fetch(PDO::FETCH_ASSOC)) {
                        if ($singleJob['senator'] != NULL || $singleJob['representative'] != NULL) {
                          $cityName = $singleJob['section_name'];
                        } else {
                          $cityName = "";
                        };
                        echo("<option value='".$singleJob['job_id']."'>".$cityName." ".$singleJob['job_name']."</option>");
                      };
            echo("
                    </select>
                  </div>
                </div>
                <div style='text-align:center;margin-bottom:10px'>
                  ...with the following delegate:
                </div>
                <div>
                  <div class='delegateList'>
                    <div>
                      <input type='radio' name='jobDel' value='0' />
                      VACANT
                    </div>");
                for ($delNum = 0; $delNum < count($allDelegate); $delNum++) {
                  if ($allDelegate[$delNum]['delegate_id'] != 0) {
                    echo("
                    <div>
                      <input type='radio' name='jobDel' value='".$allDelegate[$delNum]['delegate_id']."' />".$allDelegate[$delNum]['last_name'].", ".$allDelegate[$delNum]['first_name']."
                    </div>");
                  };
                };
          echo("
                  </div>
                  <div>
                    <input class='assignJobBttn' type='submit' name='changeJobDel' value='CHANGE' />
                  </div>
                </div>
              </form>
            </div>
          ");

          // For adding, changing, deleting a delegate from the database
          echo("
            <div id='updateDirTitle' class='postType listTitle'>
              Delegate Directory
            </div>
            <div id='updateDirBox' class='updateDirBox'>
              <div id='addDirTitle' class='addDirTitle'>ADD DELEGATE</div>
              <div id='addDirBox' class='addDirBox'>
                <form method='POST'>
                  <div>
                    <input class='delInfoInput' type='text' name='newFirstN' placeholder='First name' />
                  </div>
                  <div>
                    <input class='delInfoInput' type='text' name='newLastN' placeholder='Last name' />
                  </div>
                  <div>
                    <input class='delInfoInput' type='text' name='newHome' placeholder='Hometown' />
                  </div>
                  <div>
                    <input class='delInfoInput' type='text' name='newEmail' placeholder='Email' />
                  </div>
                  <select class='selectBttn' name='delCity'>
                    <option value='-1'>Choose a city...</option>");
                    for ($cityNum = 0; $cityNum < count($allCity); $cityNum++) {
                      echo("<option value='".$allCity[$cityNum]['city_id']."'>".$allCity[$cityNum]['section_name']."</option>");
                    };
            echo("
                  </select>
                  <div>
                    <input class='addDelBttn' type='submit' name='addDelegate' value='ADD' />
                  </div>
                </form>
              </div>
              <div class='updateTable'>");
            for ($delNum = 0; $delNum < count($allDelegate); $delNum++) {
              if ($allDelegate[$delNum]['delegate_id'] != 0) {
                echo("
                  <form method='POST'>
                    <input type='hidden' name='delId' value='".$allDelegate[$delNum]['delegate_id']."'>
                    <div class='updateRow'>
                      <div class='tableName'>".
                      $allDelegate[$delNum]['last_name'].", ".$allDelegate[$delNum]['first_name']."
                      </div>
                      <div data-delId='".$allDelegate[$delNum]['delegate_id']."' data-act='chgBttn' class='tableChange'>
                        CHANGE
                      </div>
                      <div data-delId='".$allDelegate[$delNum]['delegate_id']."' data-act='delBttn' class='tableDelete'>
                        DELETE
                      </div>
                    </div>
                    <div id='chgBox".$allDelegate[$delNum]['delegate_id']."' class='changeBox' data-delId='".$allDelegate[$delNum]['delegate_id']."' data-act='chgBox'>
                      <div>
                        <div class='changeInfo'><i>Change any info below and click 'ENTER'</i></div>
                        <div class='changeInput'>
                          <div>First Name:</div>
                          <input type='text' name='updateFstNm' value='".$allDelegate[$delNum]['first_name']."' />
                        </div>
                        <div class='changeInput'>
                          <div>Last Name:</div>
                          <input type='text' name='updateLstNm' value='".$allDelegate[$delNum]['last_name']."' />
                        </div>
                        <div class='changeInput'>
                          <div>Hometown:</div>
                          <input type='text' name='updateHmtn' value='".$allDelegate[$delNum]['hometown']."' />
                        </div>
                        <div class='changeInput'>
                          <div>Email:</div>
                          <input type='text' name='updateEmail' value='".$allDelegate[$delNum]['email']."' />
                        </div>
                        <div class='changeInput'>
                          <div>BBS City:</div>
                          <select name='updateCityId'>");
                          for ($currentCityNum = 0; $currentCityNum < count($allCity); $currentCityNum++) {
                            if ($allCity[$currentCityNum]['city_id'] == $allDelegate[$delNum]['city_id']) {
                              $currentCity = $allCity[$currentCityNum];
                            };
                          };
                          echo("<option value='".$currentCity['city_id']."'>".$currentCity['section_name']."</option>");
                          for ($updateCityNum = 0; $updateCityNum < count($allCity); $updateCityNum++) {
                            if ($allDelegate[$delNum]['city_id'] != $allCity[$updateCityNum]['city_id']) {
                              echo("<option value='".$allCity[$updateCityNum]['city_id']."'>".$allCity[$updateCityNum]['section_name']."</option>");
                            };
                          };
                    echo("
                          </select>
                        </div>
                        <input class='changeEnter' type='submit' name='updateDelInfo' value='ENTER' />
                      </div>
                    </div>
                    <div id='delBox".$allDelegate[$delNum]['delegate_id']."' class='deleteBox udpateRow' data-delId='".$allDelegate[$delNum]['delegate_id']."' data-act='delBox'>
                      <div class='deleteInfo'>
                        <b><i>ARE YOU SURE YOU WANT TO DELETE THIS DELEGATE?</i></b>
                      </div>
                      <div class='deleteRow'>
                        <input type='hidden' name='removeDelId' value='".$allDelegate[$delNum]['delegate_id']."' />
                        <input type='hidden' name='removeDelName' value='".$allDelegate[$delNum]['last_name']."' />
                        <div>
                          <input type='submit' name='deleteDel' value='YES, delete it' />
                        </div>
                        <div data-delId='".$allDelegate[$delNum]['delegate_id']."' data-act='cancelBttn'>CANCEL</div>
                      </div>
                    </div>
                  </form>
                ");
              };
            };
          echo("
              </div>
            </div>
            <div id='dptTitle' class='postType listTitle'>
              Department Directory
            </div>
            <div id='dptDirBox' class='dptDirBox allBox'>
              <form method='POST'>
                <div id='addDptBttn' class='addDptBttn'>
                  CREATE DEPARTMENT
                </div>
                <div id='addDptBox' class='addDptBox'>
                  <input class='dptText' type='text' name='dptName' placeholder='Department Name' />
                  <input class='dptText' type='text' name='dptPurpose' placeholder='Purpose' /></br>
                  <input class='dptText' type='text' name='dptJob' placeholder='Job Title' />
                  <div class='dptActive'>
                    <span style='margin-right: 5%;font-size:1.1rem'>IN USE?</span>
                    <select name='dptActive'>
                      <option value='1'>YES</option>
                      <option value='0'>NO</option>
                    </select>
                  </div>
                  <div class='dptActive'>
                    <span>Director: </span>
                    <select name='dptHead'>
                      <option value='0'>Choose a delegate</option>");
                    for ($num = 0; $num < count($allDelegate); $num++) {
                      echo("
                      <option value='".$allDelegate[$num]['delegate_id']."'>".
                        $allDelegate[$num]['first_name']." ".$allDelegate[$num]['last_name']
                      ."</option>");
                    };
              echo("</select>
                  </div>
                  <input class='addDptSubmit' type='submit' name='makeDpt' value='CREATE' />
                </div>
              </form>
              <div class='updateTable'>");
              for ($dptNum = 0; $dptNum < count($dptList); $dptNum++) {
                if ($dptList[$dptNum]['active'] == 1) {
                  $forYes = " selected";
                  $forNo = "";
                } else {
                  $forYes = "";
                  $forNo = " selected";
                };
                echo("
                <form method='POST'>
                  <input type='hidden' name='dptId' value='".$dptList[$dptNum]['dpt_id']."'>
                  <input type='hidden' name='dptJobId' value='".$dptList[$dptNum]['job_id']."'>
                  <div class='updateRow'>
                    <div class='tableName'>".$dptList[$dptNum]['dpt_name']."
                    </div>
                    <div data-dptId='".$dptList[$dptNum]['dpt_id']."' data-act='chgDptBttn' class='tableChange'>
                      CHANGE
                    </div>
                    <div data-dptId='".$dptList[$dptNum]['dpt_id']."' data-act='delDptBttn' class='tableDelete'>
                      DELETE
                    </div>
                  </div>
                  <div id='chgDptBox".$dptList[$dptNum]['dpt_id']."' class='changeBox' data-dptId='".$dptList[$dptNum]['dpt_id']."' data-act='chgDptBox'>
                    <div>
                      <div class='changeInfo'><i>Change any info below and click 'ENTER'</i></div>
                      <div class='changeInput'>
                        <div>Department Name:</div>
                        <input type='text' name='dptName' value='".$dptList[$dptNum]['dpt_name']."' />
                      </div>
                      <div class='changeInput'>
                        <div>Purpose:</div>
                        <textarea name='dptPurpose'>".$dptList[$dptNum]['purpose']."</textarea>
                      </div>
                      <div class='changeInput'>
                        <div>Boss Title:</div>
                        <input type='text' name='dptJobName' value='".$dptList[$dptNum]['job_name']."' />
                      </div>
                      <div class='dptActive'>
                        <div class='dptActiveText'>In Use?</div>
                        <select name='dptActive'>
                          <option value='1'".$forYes.">YES</option>
                          <option value='0'".$forNo.">NO</option>
                        </select>
                      </div>
                      <input class='changeEnter' type='submit' name='submitDpt' value='ENTER' />
                    </div>
                  </div>
                  <div id='delDptBox".$dptList[$dptNum]['dpt_id']."' class='deleteBox udpateRow' data-dptId='".$dptList[$dptNum]['dpt_id']."' data-act='delDptBox'>
                    <div class='deleteInfo'>
                      <b><i>ARE YOU SURE YOU WANT TO DELETE THIS DEPARTMENT?</i></b>
                    </div>
                    <div class='deleteRow'>
                      <input type='hidden' name='removeDptId' value='".$dptList[$dptNum]['dpt_id']."' />
                      <input type='hidden' name='removeJobId' value='".$dptList[$dptNum]['job_id']."' />
                      <div>
                        <input type='submit' name='deleteDpt' value='YES, delete it' />
                      </div>
                      <div data-dptId='".$dptList[$dptNum]['dpt_id']."' data-act='cancelDptBttn'>CANCEL</div>
                    </div>
                  </div>
                </form>"
                );

              };
              echo("
              </div>
            </div>

            </div>

          ");
        };
        // <input type='text' name='dptPurpose' value='".$dptList[$dptNum]['purpose']."' />
      ?>
      <div style="padding-top:50px"></div>
      <div class="refAll">
        <div id="refInfoBar" class="refInfoBar">
          <div id="refText">Refresh in: <span id="timeMin">30</span> min</div>
          <div id="refInfoBttn" class="refInfoBttn">?</div>
        </div>
        <div id="refInfoBox" class="refInfoBox">
          <u style='text-align:center'>Why is there a timer on this?</u></br>
          There is a chance that a user will accidentally leave their account logged in on a public device, making it vulnerable to unqualified users.</br>
          To reduce this risk, your device will automatically relock this account if its page has not been refreshed or updated in the past 30 minutes.
        </div>
      </div>
    </div>
  </body>
</html>
