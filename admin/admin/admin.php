<?php

  session_start();
  require_once("../../pdo.php");
  require_once("../../lockdown.php");
  require_once("lead_admin.php");

  // Redirects back go 'default.html' if lockdown in place
  if ($checkLock > 0) {
    unset($_SESSION['counsToken']);
    unset($_SESSION['delToken']);
    unset($_SESSION['secId']);
    unset($_SESSION['adminType']);
    header('Location: ../../default.html');
    return true;
  };

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
    <link rel="icon" type="image/x-icon" href="../../img/favicon.ico"/>
    <!-- <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script> -->
    <script src=<?php
    if ($isLocal == true) {
      echo("../../".$jquery);
    } else {
      echo($jquery);
    };?>></script>
    <script src="main.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PEVZ2L2FBZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-PEVZ2L2FBZ');
    </script>
    <!-- End of gtag -->
  </head>
  <body>
  <div class="wholePage">
    <!-- START: This is the box that only appears when cropping a newly uploaded image -->
    <div class="cropBox" id="cropBox">
      <div class="cropBacking">
      </div>
      <div class="cropToolBox">
        <div id="closeCrop" class="closeRow">
          <form method="POST">
            <input id="exitJobId" type="hidden" name="jobId" value="">
            <input class="closeCrop" type="submit" name="exitBttn" value="X" />
          </form>
        </div>
        <div class="cropImgBox">
          <img id="cropImg" class="cropImg" src="../../img/default_photo.png" />
          <div class="topCrop cropBorder"></div>
          <div class="cropMidRow">
            <div class="leftCrop cropColumns cropBorder">|</div>
            <div class="rightCrop cropColumns cropBorder">|</div>
          </div>
          <div class="bottomCrop cropBorder"></div>
        </div>
        <div class="cropMove">
          <div class="cropMoveRow">
            <button id="upBttn" class="moveBttn"></button>
          </div>
          <div class="cropMoveRow">
            <button id="leftBttn" class="moveBttn"></button>
            <button id="downBttn" class="moveBttn"></button>
            <button id="rightBttn" class="moveBttn"></button>
          </div>
        </div>
        <div class="cropSize">
          <button id="smallerBttn" class="sizeBttn"></button>
          <button id="biggerBttn" class="sizeBttn"></button>
          <button id="rotateBttn" class="sizeBttn"></button>
        </div>
        <button id="submitCrop" type="button">
          ENTER
        </button>
      </div>
    </div>
    <!-- END -->
    <div class="menuTop">
      <?php
        if ($_SESSION['adminType'] == "counselor") {
          echo("<div style='background-color:green'>STATUS: COUNSELOR</div>");
        } else {
          echo("<div style='background-color:blue'>STATUS: DELEGATE</div>");
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
        echo html_entity_decode("<div class='message'>".$_SESSION['message']."</div>");
        // var_dump($_SESSION['message']);
        unset($_SESSION['message']);
      };
    ?>
    <div class="sectionName">
      <?php
        // Adds these to the city or county titles for the page
        if ($secInfo['is_city'] > 0) {
          $titleSuffix = " City";
        } elseif ($secInfo['is_county'] > 0) {
          $titleSuffix = " County";
        } else {
          $titleSuffix = "";
        };
        // Displays which section you are working on
        echo html_entity_decode($secInfo['section_name'].$titleSuffix);
      ?>
    </div>
    <div style="display:flex;border-left:2px solid black;border-right:2px solid black">
      <div class="belowTab"></div>
      <div class="belowTab"></div>
    </div>
    <div class="mainBox">
      <div class="delegateContent">
      <?php
        $listTypeStmt = $pdo->prepare("SELECT * FROM Type WHERE section_id=:sid");
        $listTypeStmt->execute(array(
          ':sid'=>$secInfo['section_id']
        ));
          while ($oneType = $listTypeStmt->fetch(PDO::FETCH_ASSOC)) {
            $subtypeListStmt = $pdo->prepare("SELECT * FROM Subtype WHERE type_id=:tyd");
            $subtypeListStmt->execute(array(
              ':tyd'=>$oneType['type_id']
            ));
            $subtypeList = [];
            while ($oneSubtype = $subtypeListStmt->fetch(PDO::FETCH_ASSOC)) {
              $subtypeList[] = $oneSubtype;
            };
            echo html_entity_decode("
            <div class='delegateBox'>
              <a href='admin.php?type=".$oneType['type_id']."'>
                <div data-head='".$oneType['type_id']."' class='postType'>"
                  .$oneType['type_name'].
                "</div>
              </a>");
              if (isset($_GET['type']) && $_GET['type'] == $oneType['type_id']) {
                echo html_entity_decode("<div id='typeId".$oneType['type_id']."' class='postMain'>");
                if ($oneType['can_add'] == 1) {
                  echo html_entity_decode("<div class='postTypeRow'>
                    <div id='addBttn".$oneType['type_id']."' class='addingPost' data-type='".$oneType['type_id']."'> + ADD POST</div>
                  </div>
                  <div style='display:none' id='addBox".$oneType['type_id']."' class='addBox postBox'>
                    <form method='POST'>
                      <div class='postSubtitle'>Title/Name(s):</div>
                      <textarea name='postTitle' class='postText titleText' placeholder='Enter your title here'></textarea>
                      <div class='postSubtitle'>Content:</div>
                      <textarea name='postContent' class='postText contentText' placeholder='Enter your content here'></textarea>");
                      if ($oneType['type_id'] == 9 || $oneType['type_id'] == 11) {
                        echo("<div class='postSubtitle'>Bill #:</div>");
                      } else {
                        echo("<div class='postSubtitle'>Order #:</div>");
                      };
                      echo("<input class='postOrder' type='number' name='orderNum' min='1' value='1' />");
                      if ($oneType['type_id'] == 9 || $oneType['type_id'] == 11) {
                        echo("
                        <div class='postSubtitle'>Bill Prefix (H.B. or S.B.):</div>
                        <input type='text' name='chamberPrefix' />");
                      };
                      echo("<div class='postSubtitle'>
                        Category
                      </div>
                      <div>
                        <select class='subtypeSelect' name='newSubtype'>");
                          for ($newSub = 0; $newSub < count($subtypeList); $newSub++) {
                            echo html_entity_decode("<option value='".$subtypeList[$newSub]['subtype_id']."'>".$subtypeList[$newSub]['subtype_name']."</option>");
                          };
                        echo html_entity_decode("</select>
                      </div>
                      <input type='hidden' name='approval' value='0' />
                      <input type='hidden' name='typeId' value='".$oneType['type_id']."' />
                      <input type='hidden' name='secId' value='".$_SESSION['secId']."' />
                      <input class='addSubmit allPostBttns' type='submit' name='addPost' value='SUBMIT' />
                    </form>
                  </div>
                  ");
                };
                echo html_entity_decode("
                  <div id='typeRow_".$oneType['type_id']."' class='pendingRow'>
                    <div id='pending".$oneType['type_id']."' class='pendingBttn' data-pendtype='".$oneType['type_id']."' data-approval=0>PENDING</div>
                    <div id='all".$oneType['type_id']."' class='allBttn' data-pendtype='".$oneType['type_id']."' data-approval=1>ALL</div>
                  </div>
                  <div id='boxList_".$oneType['type_id']."' class='boxList'>
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
                  echo html_entity_decode("
                  <div id='postBox_".$onePost['post_id']."' class='postBox' data-postid='".$onePost['post_id']."' data-typeid='".$onePost['type_id']."' data-approval='".$approval."'>
                    <form method='POST'>
                      <input type='hidden' name='postId' value='".$onePost['post_id']."'>");
                      if ($oneType['can_add'] == 1) {
                        echo("
                          <div class='postSubtitle'>Title/Name(s):</div>
                          <textarea class='postText titleText' name='postTitle'>");
                          echo html_entity_decode($onePost['title'], ENT_QUOTES);
                        echo("</textarea>");
                      } else {
                        echo html_entity_decode("
                          <input type='hidden' name='postTitle' value='".$onePost['title']."'/>
                          <div class='postSubtitle'>Title: ".$onePost['title']."</div>");
                      };
                      echo("<div class='postSubtitle'>Content:</div>
                      <textarea class='postText contentText' name='postContent'>");
                        echo html_entity_decode($onePost['content'], ENT_QUOTES);
                      echo html_entity_decode("</textarea>
                      <div class='postSubtitle'>Time Posted</div>
                      <div style='text-align:center'>
                        (<i>YYYY-MM-DD HH:MM:SS</i>)
                      </div>
                      <textarea class='postText timeText' name='postTime'>".$onePost['timestamp']."</textarea>");

                      if (count($subtypeList) > 1) {
                        $currentSubId = 0;
                        $currentSubName = "none";
                        for ($subNum = 0; $subNum < count($subtypeList); $subNum++) {
                          if ($subtypeList[$subNum]['subtype_id'] == $onePost['subtype_id']) {
                            $currentSubId = $subtypeList[$subNum]['subtype_id'];
                            $currentSubName = $subtypeList[$subNum]['subtype_name'];
                          };
                        };
                        echo html_entity_decode("
                          <div class='postSubtitle'>
                            Category
                          </div>
                          <div>
                            <form method='POST'>
                              <input type='hidden' name='categoryPostId' value='".$onePost['post_id']."'>
                              <select class='subtypeSelect' name='subtype'>
                                <option value='".$currentSubId."'>".$currentSubName."</option>");
                                for ($sub = 0; $sub < count($subtypeList); $sub++) {
                                  if ($subtypeList[$sub]['subtype_id'] != $onePost['subtype_id']) {
                                    echo html_entity_decode("<option value='".$subtypeList[$sub]['subtype_id']."'>".$subtypeList[$sub]['subtype_name']."</option>");
                                  };
                                };
                              echo("</select>
                              <button type='submit' name='changeCategories'>
                                Change Category Only
                              </button>

                          </div>
                        ");
                      } else {
                        echo html_entity_decode("
                        <div class='postSubtitle'>
                          Category
                        </div>
                        <div>
                          <input type='hidden' name='subtype' value='".$subtypeList[0]['subtype_id']."' />
                          <div style='text-align:center'>".$subtypeList[0]['subtype_name']."</div>
                        </div>
                        ");
                      };

                      if ($onePost['type_id'] == 9 || $onePost['type_id'] == 11) {
                        echo("<div class='postSubtitle'>Bill #:</div>");
                      } else {
                        echo("<div class='postSubtitle'>Order #:</div>");
                      };
                      echo html_entity_decode("<input class='postOrder' type='number' name='orderNum' min='1' value='".$onePost['post_order']."'/>");
                      if ($oneType['type_id'] == 9 || $oneType['type_id'] == 11) {
                        echo html_entity_decode("
                        <div class='postSubtitle'>Bill Prefix (H.B. or S.B.):</div>
                        <input type='text' name='currentPrefix' value='".$onePost['chamber_prefix']."' />");
                      };
                  if ($approval == 1) {
                    $ifApproved = "checked";
                    $ifPending = "";
                    $status = "<b style='color:green'>APPROVED</b>";
                  } else {
                    $ifApproved = "";
                    $ifPending = "checked";
                    $status = "<b style='color:yellow'>PENDING</b>";
                  };
                  echo html_entity_decode("
                      <div class='postSubtitle postStatus'>Online Status: ".$status."</div>
                      <div class='changeBttns'>
                        <div class='blueBttn' id='chgBttn".$onePost['post_id']."' data-post='".$onePost['post_id']."' data-box='change'>CHANGE</div>");
                        $findCanAddStmt = $pdo->prepare("SELECT can_add FROM Type WHERE type_id=:ti");
                        $findCanAddStmt->execute(array(
                          ':ti'=>$onePost['type_id']
                        ));
                        $findCanAdd = $findCanAddStmt->fetch(PDO::FETCH_ASSOC)['can_add'];
                        if ($findCanAdd == 1) {
                          echo html_entity_decode("<div id='delBttn".$onePost['post_id']."' data-post='".$onePost['post_id']."' data-box='delete'>DELETE</div>");
                        };
                      echo html_entity_decode("</div>
                      <div style='display:none' id='chgBox".$onePost['post_id']."' class='delBox'>");
                      if ($_SESSION['adminType'] == "delegate") {
                        echo("NOTE: Upon clicking 'CHANGE', this post will be hidden online until a counselor reapproves it. ");
                      };
                      echo html_entity_decode("Are you sure you want to make the change(s)?
                        <div class='delBttnRow'>
                          <div class='delBttn noDel' id='cancelChg".$onePost['post_id']."' data-post='".$onePost['post_id']."'>NO, don't change it</div>
                          <input class='yesChg allPostBttns' type='submit' name='changePosts' value='Yes, change it' />
                        </div>
                      </div>");
                      if ($findCanAdd == 1) {
                        echo html_entity_decode("<div style='display:none' id='delBox".$onePost['post_id']."' class='delBox'>
                          ARE YOU SURE YOU WANT TO DELETE THIS POST?
                          <div class='delBttnRow'>
                            <div class='delBttn noDel' id='cancelDel".$onePost['post_id']."' data-post='".$onePost['post_id']."'>NO, keep it</div>
                            <input class='yesDel allPostBttns' type='submit' name='deletePost' value='YES, delete it' />
                          </div>
                        </div>");
                      };
                      if ($_SESSION['adminType'] == "counselor") {
                        echo html_entity_decode("
                          <div class='counsOnly'>
                            <div><u>COUNSELOR ONLY</u></div>
                            <input type='radio' id='yes".$onePost['post_id']."' name='approval' value='1' ".$ifApproved." />
                            <label for='yes'>APPROVED</label></br>
                            <input type='radio' id='no".$onePost['post_id']."' name='approval' value='0' ".$ifPending." />
                            <label for='no'>PENDING</label></br>
                            <input class='allPostBttns' type='submit' name='changeApproval' value='SUBMIT' />
                          </div>
                        ");
                      };
                    echo("
                    </form>
                  </div>");
                };
              echo("</div>
              </div>");
            };
            echo("</div>");
          };
          echo("
          <div class='delegateBox'>
          <a href='admin.php?type=photos'>
            <div id='photoTab' class='postType'>
              Staff Photos
            </div>
          </a>");
          if (isset($_GET['type']) && $_GET['type'] == "photos") {
            echo("<div class='postMain photoMain'>
              <div class='postTypeRow'>
                <div class='addingPost hideAdding'>
                  Testing
                </div>
              </div>
              <div class='pendingRow photoFolderTab'>
                <div class='pendingBttn'>
                  View / Change
                </div>
              </div>
              <div class='boxList'>");
                for ($imgNum = 0; $imgNum < count($allPhotos); $imgNum++) {
                  echo html_entity_decode("
                  <div class='photoBox'>
                    <div class='photoTitle'>".$allPhotos[$imgNum]['img_title']."<br> (Job ID: ".$allPhotos[$imgNum]['job_id'].")</div>");
                    if ($allPhotos[$imgNum]['job_id'] < 0) {
                      echo html_entity_decode("<div class='photoDelegate'>(".$allPhotos[$imgNum]['delegate_name'].")</div>");
                    };
                  echo html_entity_decode("
                    <div class='actualPhoto'>");
                      // echo html_entity_decode("<img class='photoImg' src='".$imgPrefix.$allPhotos[$imgNum]['image_path']."crop_".$allPhotos[$imgNum]['filename'].".".$allPhotos[$imgNum]['extension']."?t=".time()."'/>");
                      if ($allPhotos[$imgNum]['flickr_url'] != null) {
                        echo html_entity_decode("<img src='".$allPhotos[$imgNum]['flickr_url']."'>");
                      } else {
                        echo("<img src='".$imgPrefix."/default_other.jpg'>");
                      };
                    echo html_entity_decode("
                    </div>
                    <form method='POST'>
                      <div class='flickrBox'>
                        <input name='imageId' type='hidden' value='".$allPhotos[$imgNum]['image_id']."' />
                        <input name='approvalNum' type='hidden' value='".$allPhotos[$imgNum]['approved']."' />
                        <input class='flickrLink' name='flickrUrl' type='text' value='".$allPhotos[$imgNum]['flickr_url']."' placeholder='Enter Flickr URL here'/>
                      <div class='flickrBttns'>
                        <input type='submit' name='sendFlickr' value='ENTER'>
                        <input type='submit' name='resetFlickr' value='RESET'>
                      </div>
                      </div>
                    </form>");
                    // echo html_entity_decode("
                    // <form method='POST' enctype='multipart/form-data'>
                    //   <input name='jobId' type='hidden' value='".$allPhotos[$imgNum]['job_id']."' />
                    //   <input name='imageId' type='hidden' value='".$allPhotos[$imgNum]['image_id']."' />
                    //   <input name='jobFile' type='hidden' value='".$allPhotos[$imgNum]['filename']."' />
                    //   <input name='jobExt' type='hidden' value='".$allPhotos[$imgNum]['extension']."' />
                    //   <input name='jobPath' type='hidden' value='".$allPhotos[$imgNum]['image_path']."' />
                    //   <input name='actualX' type='hidden' value='".$allPhotos[$imgNum]['actual_width']."' />
                    //   <input name='actualY' type='hidden' value='".$allPhotos[$imgNum]['actual_height']."' />
                    //   <input class='photoFile' name='jobImg' type='file' />
                    //   <div class='imgRow'>
                    //     <input style='background-color:blue' class='photoUpload allPostBttns' name='submitFile' type='submit' value='UPLOAD'/>
                    //     <input style='background-color:red' class='photoUpload allPostBttns' name='resetFile' type='submit' value='RESET'/>
                    //   </div>
                    // </form>");
                    if ($_SESSION['adminType'] == 'counselor') {
                      echo("<div class='photoApprovBox'>
                        <div class='counsApprTitle'>COUNSELOR ONLY</div>
                          <form method='POST'>
                            <input name='appImgId' type='hidden' value='".$allPhotos[$imgNum]['job_id']."' />
                            <div class='apprSelection'>
                              <div>Image Approved?</div>
                              <select name='imgStatus'>");
                              if ($allPhotos[$imgNum]['approved'] == 1) {
                                echo("
                                  <option value='1'>YES</option>
                                  <option value='0'>NO</option>");
                              } else {
                                echo("
                                  <option value='0'>NO</option>
                                  <option value='1'>YES</option>");
                              };
                              echo("
                              </select>
                            </div>
                            <input class='counsApprBttn allPostBttns' name='approveImg' type='submit' value='ENTER' />
                          </form>
                        </div>");
                    } else {
                      if ($allPhotos[$imgNum]['approved'] == 1) {
                        $approvalStatus = "APPROVED";
                      } else {
                        $approvalStatus = "PENDING";
                      };
                      echo("
                      <div class='approvalStatus'>
                        Approval Status: ".$approvalStatus."
                      </div>
                      ");
                    };
                  echo("
                  </div>");
                };
              echo("</div>
            </div>
            </div>");
          };
  echo("</div>
      </div>");

        // ** Below are COUNSELOR ONLY

        // For assigning/changing job assignments
        if ($_SESSION['adminType'] == 'counselor') {
          $jobListStmt = $pdo->prepare("SELECT Delegate.delegate_id,job_id,job_name,job_active,Job.section_id,senator,representative,in_department,first_name,last_name,section_name FROM Job JOIN Delegate JOIN Section WHERE Job.section_id=:scd AND Job.delegate_id=Delegate.delegate_id AND Delegate.city_id=Section.section_id ORDER BY Job.senator,Job.representative,Job.job_id ASC");
          $jobListStmt->execute(array(
            ':scd'=>htmlentities($secInfo['section_id'])
          ));
          $jobList = [];
          while ($oneJob = $jobListStmt->fetch(PDO::FETCH_ASSOC)) {
            $jobList[] = $oneJob;
          };
          $findDptNameStmt = $pdo->prepare("SELECT dpt_name,active FROM Department WHERE Department.job_id=:ji");
          echo("
            <div class='counsTitle'>
              COUNSELORS ONLY
            </div>
            <div class='counsContent'>");

          // Box that shows all of the section's current staff
          echo("
              <div class='counsBox'>
                <a href='admin.php?type=staff'>
                  <div id='listTitle' class='postType listTitle'>
                    Current Staff
                  </div>
                </a>");
                if (isset($_GET['type']) && $_GET['type'] == "staff") {
                echo("<div id='listBox' class='listBox'>");
              for ($jobNum = 0; $jobNum < count($jobList); $jobNum++) {
                $oneJob = $jobList[$jobNum];
                if ($oneJob['senator'] != 0) {
                  $jobCity = "None";
                  foreach($allSection as $oneSection) {
                    if ($oneSection['section_id'] == $oneJob['senator']) {
                      $jobCity = $oneSection['section_name'];
                    };
                  };
                  $cityAndId = ", ".$jobCity." (Job ID: ".$oneJob['job_id'].")";
                  $onlyId = $oneJob['job_id'];
                } elseif ($oneJob['representative'] != 0) {
                  $jobCity = "None";
                  foreach($allSection as $oneSection) {
                    if ($oneSection['section_id'] == $oneJob['representative']) {
                      $jobCity = $oneSection['section_name'];
                    };
                  };
                  $cityAndId = ", ".$jobCity." (Job ID: ".$oneJob['job_id'].")";
                  $onlyId = $oneJob['job_id'];
                } else {
                  $cityAndId = " (Job ID: ".$oneJob['job_id'].")";
                };
                if ($oneJob['in_department'] == 1) {
                  $findDptNameStmt->execute(array(
                    ':ji'=>$oneJob['job_id']
                  ));
                  $findDptName = $findDptNameStmt->fetch(PDO::FETCH_ASSOC);
                  $dptName = " (".$findDptName['dpt_name'].")";
                  $dptStatus = $findDptName['active'];
                } else {
                  $dptName = "";
                  $dptStatus = 0;
                };
                if ($oneJob['in_department'] == 0 || $dptStatus == 1) {
                  echo html_entity_decode("
                  <div class='staffTitle'>
                    ".$oneJob['job_name'].$cityAndId.$dptName."
                    <form method='POST'>
                      <input type='hidden' name='jobId' value='".$onlyId."'/>
                      <select name='statusChange'>");
                      if ($oneJob['job_active'] == 1) {
                        echo("
                          <option value='1' selected>ACTIVE</option>
                          <option value='0'>INACTIVE</option>");
                      } else {
                        echo("
                          <option value='1'>ACTIVE</option>
                          <option value='0' selected>INACTIVE</option>");
                      };
                      echo html_entity_decode("
                      </select>
                      <input type='submit' name='changeJobStatus'>
                    </form>
                  </div>
                  <div class='staffContent'>
                    <div>
                      <span style='color:green'>NAME:</span>
                      ".$oneJob['first_name']." ".$oneJob['last_name']."
                    </div>
                    <div>
                      <span style='color:green'>BBS CITY:</span> ".$oneJob['section_name']."
                    </div>
                  </div>");
                };
              };
        echo("
                </div>");
              };
              echo("</div>");

        // Box for assigning delegates to the section's jobs
        echo("
          <div class='counsBox'>
            <a href='admin.php?type=assignments'>
              <div id='assignJobTitle' class='postType listTitle'>
                Assign A Job
              </div>
            </a>");
            if (isset($_GET['type']) && $_GET['type'] == "assignments") {
            echo html_entity_decode("<div id='assignJobBox' class='assignJobBox'>
              <form method='POST'>
                <div class='pickJob'>
                  <div>I am filling this job... </div>
                  <div>
                    <select name='jobId'>
                      <option value='-1'>-- Select Job --</option>");
                      for ($jobNum = 0; $jobNum < count($jobList); $jobNum++) {
                        $singleJob = $jobList[$jobNum];
                        if ($singleJob['senator'] != 0) {
                          $cityName = "No city";
                          foreach ($allSection as $oneSection) {
                            if ($oneSection['section_id'] == $singleJob['senator']) {
                              $cityName = ", ".$oneSection['section_name']." (Job ID: ".$singleJob['job_id'].")";
                            };
                          };
                        } elseif ($singleJob['representative'] != 0) {
                          $cityName = "No city";
                          foreach ($allSection as $oneSection) {
                            if ($oneSection['section_id'] == $singleJob['representative']) {
                              $cityName = ", ".$oneSection['section_name']." (Job ID: ".$singleJob['job_id'].")";
                            };
                          };
                        } else {
                          $cityName = " (Job ID: ".$singleJob['job_id'].")";
                        };
                        if ($singleJob['in_department'] == 1) {
                          $findDptNameStmt->execute(array(
                            ':ji'=>$singleJob['job_id']
                          ));
                          $findDpt = $findDptNameStmt->fetch(PDO::FETCH_ASSOC);
                          $findDptName = $findDpt['dpt_name'];
                          $findDptStatus = $findDpt['active'];
                          $selectDptName = " (".$findDptName.")";
                        } else {
                          $selectDptName = "";
                          $findDptStatus = 1;
                        };
                        if ($singleJob['in_department'] == 0 || $findDptStatus == 1) {
                          echo html_entity_decode("<option value='".$singleJob['job_id']."'>".$singleJob['job_name'].$cityName.$selectDptName."</option>");
                        };
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
                    <div class='delRadio'>
                      <input type='radio' name='jobDel' value='0' />
                      NO DELEGATE
                    </div>");
                for ($delNum = 0; $delNum < count($allDelegate); $delNum++) {
                  if ($allDelegate[$delNum]['delegate_id'] != 0) {
                    echo html_entity_decode("
                    <div class='delRadio'>
                      <input
                        type='radio'
                        name='jobDel'
                        value='".$allDelegate[$delNum]['delegate_id']."'
                      />"
                      .$allDelegate[$delNum]['last_name'].", "
                      .$allDelegate[$delNum]['first_name'].
                    "</div>");
                  };
                };
          echo("
                  </div>
                  <div>
                    <input class='assignJobBttn allPostBttns' type='submit' name='changeJobDel' value='CHANGE' />
                  </div>
                </div>
              </form>
            </div>");
            };
          echo("</div>");

          // Box for adding, changing, deleting a delegate from the database
          echo("
          <div class='counsBox'>
            <a href='admin.php?type=delegates'>
              <div id='updateDirTitle' class='postType listTitle'>
                Delegate Directory
              </div>
            </a>");
            if (isset($_GET['type']) && $_GET['type'] == "delegates") {
            echo("
            <div id='updateDirBox' class='updateDirBox'>
              <div id='addDirTitle' class='addDirTitle'>+ ADD DELEGATE</div>
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
                  <select class='selectBttn' name='delCity'>
                    <option value='-1'>Choose a city...</option>");
                    for ($cityNum = 0; $cityNum < count($allCity); $cityNum++) {
                      echo html_entity_decode("<option value='".$allCity[$cityNum]['section_id']."'>".$allCity[$cityNum]['section_name']."</option>");
                    };
            echo("
                  </select>
                  <div class='barSlot'>
                    <div>Bar member?</div>
                    <select class='selectBttn' name='delBarStat'>
                      <option value='1'>YES</option>
                      <option value='0' selected>NO</option>
                    </select>
                  </div>
                  <div>
                    <input class='addDelBttn allPostBttns' type='submit' name='addDelegate' value='ADD' />
                  </div>
                </form>
              </div>
              <div class='updateTable'>");
            for ($delNum = 0; $delNum < count($allDelegate); $delNum++) {
              if ($allDelegate[$delNum]['delegate_id'] != 0) {
                echo html_entity_decode("
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
                          <div>BBS City:</div>
                          <select name='updateCityId'>");
                          for ($currentCityNum = 0; $currentCityNum < count($allCity); $currentCityNum++) {
                            if ($allCity[$currentCityNum]['section_id'] == $allDelegate[$delNum]['city_id']) {
                              $currentCity = $allCity[$currentCityNum];
                            };
                          };
                          echo html_entity_decode("<option value='".$currentCity['section_id']."'>".$currentCity['section_name']."</option>");
                          for ($updateCityNum = 0; $updateCityNum < count($allCity); $updateCityNum++) {
                            if ($allDelegate[$delNum]['city_id'] != $allCity[$updateCityNum]['section_id']) {
                              echo html_entity_decode("<option value='".$allCity[$updateCityNum]['section_id']."'>".$allCity[$updateCityNum]['section_name']."</option>");
                            };
                          };
                    echo("
                          </select>
                        </div>
                        <div class='changeInput'>
                          <div>Bar member?</div>
                          <select name='updateBarStat'>");
                            if ($allDelegate[$delNum]['bar_member'] == 1) {
                              echo("
                              <option selected value='1'>YES</option>
                              <option value='0'>NO</option>");
                            } else {
                              echo("
                              <option value='1'>YES</option>
                              <option selected value='0'>NO</option>");
                            };
                          echo html_entity_decode("</select>
                        </div>
                        <input class='changeEnter allPostBttns' type='submit' name='updateDelInfo' value='ENTER' />
                      </div>
                    </div>
                    <div id='delBox".$allDelegate[$delNum]['delegate_id']."' class='deleteBox udpateRow' data-delId='".$allDelegate[$delNum]['delegate_id']."' data-act='delBox'>
                      <div class='deleteInfo'>
                        <b><i>ARE YOU SURE YOU WANT TO DELETE '".$allDelegate[$delNum]['first_name']." ".$allDelegate[$delNum]['last_name']."' FROM THE DIRECTORY?</i></b>
                      </div>
                      <div class='deleteRow'>
                        <input type='hidden' name='removeDelId' value='".$allDelegate[$delNum]['delegate_id']."' />
                        <input type='hidden' name='removeDelName' value='".$allDelegate[$delNum]['last_name']."' />
                        <input class='deleteBttn allPostBttns' type='submit' name='deleteDel' value='YES, delete it' />
                        <div data-delId='".$allDelegate[$delNum]['delegate_id']."' data-act='cancelBttn'>CANCEL</div>
                      </div>
                    </div>
                  </form>
                ");
              };
            };
          echo("
              </div>
            </div>");
            };
            echo("
          </div>");
          //
          echo("
          <div class='counsBox'>
            <a href='admin.php?type=departments'>
              <div id='dptTitle' class='postType listTitle'>
                Departments & Committees
              </div>
            </a>");
            if (isset($_GET['type']) && $_GET['type'] == "departments") {
            echo("
            <div id='dptDirBox' class='dptDirBox allBox'>
              <form method='POST'>
                <div id='addDptBttn' class='addDptBttn'>
                  ADD +
                </div>
                <div id='addDptBox' class='addDptBox'>
                  <input class='dptText' type='text' name='dptName' placeholder='Department Name' />
                  <textarea class='dptText' name='dptPurpose' rows='4' placeholder='Purpose'></textarea></br>
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
                      <option value='-1'>Choose a delegate</option>");
                    for ($num = 0; $num < count($allDelegate); $num++) {
                      echo html_entity_decode("
                      <option value='".$allDelegate[$num]['delegate_id']."'>".
                        $allDelegate[$num]['last_name'].", ".$allDelegate[$num]['first_name']
                      ."</option>");
                    };
              echo("</select>
                  </div>
                  <input class='addDptSubmit allPostBttns' type='submit' name='makeDpt' value='CREATE' />
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
                echo html_entity_decode("
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
                      <input class='changeEnter allPostBttns' type='submit' name='submitDpt' value='ENTER' />
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
                        <input class='allPostBttns' type='submit' name='deleteDpt' value='YES, delete it' />
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
            </div>");
            };
            echo("
          </div>
          ");
        };
        // <input type='text' name='dptPurpose' value='".$dptList[$dptNum]['purpose']."' />
      ?>
      <!-- <div style="padding-top:50px"></div> -->
      <div class="refAll" id="refAll">
        <div id="refInfoBar" class="refInfoBar">
          <div id="refText">Refresh in: <span id="timeMin">30</span> min</div>
          <div id="refInfoBttn" class="refInfoBttn">?</div>
        </div>
        <div id="refInfoBox" class="refInfoBox">
          <u style='text-align:center'>Why is there a timer on this?</u></br>
          If your account is left logged in at a public computer, it would be vulnerable to unqualified users.</br>
          To reduce this risk, your device will automatically relock this account if its page has not been refreshed or updated in the past 30 minutes.
        </div>
      </div>
    </div>
  </div>
  </body>
</html>
