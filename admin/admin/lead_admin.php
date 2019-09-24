<?php

// Confirms a token is present and matches with the token in the dB
if (isset($_SESSION['counsToken'])) {
  $dbTknStmt = $pdo->prepare("SELECT couns_token,couns_sess_start FROM Section WHERE section_id=:cid");
  $dbTknStmt->execute(array(
    ':cid'=>htmlentities($_SESSION['secId'])
  ));
  $dbObject = $dbTknStmt->fetch(PDO::FETCH_ASSOC);
  $dbTkn = $dbObject['couns_token'];
  if ($dbTkn != $_SESSION['counsToken']) {
    $_SESSION['message'] = "<b style='color:red'>Your token does not match your section's token. Please log back in.</br>NOTE: This may have happened because another counselor logged into this section's account recently.</b>";
    unset($_SESSION['counsToken']);
    unset($_SESSION['secId']);
    unset($_SESSION['adminType']);
    header('Location: ../login/login.php');
    return false;
  } else {
    if (((time() - $dbObject['couns_sess_start']) / 60) > 30) {
      $_SESSION['message'] = "<b style='color:red'>You were automatically logged out since no information updates or requests were made for the past 30 minutes. This is a security measure, not an error. You can log back in now.</b>";
      unset($_SESSION['counsToken']);
      unset($_SESSION['secId']);
      unset($_SESSION['adminType']);
      header('Location: ../login/login.php');
      return false;
    } else {
      $_SESSION['adminType'] = "counselor";
      $counsSessionStmt = $pdo->prepare('UPDATE Section SET couns_sess_start=:css WHERE section_id=:scid');
      $counsSessionStmt->execute(array(
        ':css'=>time(),
        ':scid'=>htmlentities($_SESSION['secId'])
      ));
    };
  }
} elseif (isset($_SESSION['delToken'])) {
  $dbTknStmt = $pdo->prepare("SELECT del_token, del_sess_start FROM Section WHERE section_id=:cid");
  $dbTknStmt->execute(array(
    ':cid'=>htmlentities($_SESSION['secId'])
  ));
  $dbObject = $dbTknStmt->fetch(PDO::FETCH_ASSOC);
  $dbTkn = $dbObject['del_token'];
  if ($dbTkn != $_SESSION['delToken']) {
    $_SESSION['message'] = "<b style='color:red'>Your token does not match your section's token. Please log back in.</br>NOTE: This probably happened because another delegate has logged into this section since you last logged in.</b>";
    unset($_SESSION['delToken']);
    unset($_SESSION['secId']);
    unset($_SESSION['adminType']);
    header('Location: ../login/login.php');
    return false;
  } else {
    if (((time() - $dbObject['del_sess_start']) / 60) > 30) {
      $_SESSION['message'] = "<b style='color:red'>You were automatically logged out since no updates or requests had been made for the past 30 minutes. This is a security measure, not an error. You can log back in now.</b>";
      unset($_SESSION['delToken']);
      unset($_SESSION['secId']);
      unset($_SESSION['adminType']);
      header('Location: ../login/login.php');
      return false;
    } else {
      $_SESSION['adminType'] = "delegate";
      $delSessionStmt = $pdo->prepare('UPDATE Section SET del_sess_start=:dss WHERE section_id=:scid');
      $delSessionStmt->execute(array(
        ':dss'=>time(),
        ':scid'=>htmlentities($_SESSION['secId'])
      ));
    };
  }
} else {
  $_SESSION['message'] = "<b style='color:red'>You must login to enter the Admin Center</b>";
  header('Location: ../login/login.php');
  return false;
};

// Gets section data
$secId = (int)$_SESSION['secId'];
$secInfoStmt = $pdo->prepare("SELECT DISTINCT section_id,section_name,description,full_time,is_city,is_county FROM Section WHERE section_id=:sid");
$secInfoStmt->execute(array(
  ':sid'=>$secId
));
$secInfo = $secInfoStmt->fetch(PDO::FETCH_ASSOC);

// All photo locations w/ staff info if they have a location
$allPhotoStmt = $pdo->prepare("SELECT Job.job_id, job_name, image_id, Image.image_path, Image.filename, extension, Image.approved, percent_x, percent_y, height, width, section_path, filename, actual_width, actual_height FROM Job JOIN Image WHERE Job.job_id=Image.job_id AND section_id=:se AND Image.filename IS NOT NULL");

$allPhotoStmt->execute(array(
  ':se'=>$secId
));
$allPhotos = [];
while ($onePhoto = $allPhotoStmt->fetch(PDO::FETCH_ASSOC)) {
  $allPhotos[] = $onePhoto;
};

// Gets all city info
$allCityStmt = $pdo->prepare("SELECT * FROM Section WHERE is_city=1");
$allCityStmt->execute();
$allCity = [];
while ($oneCity = $allCityStmt->fetch(PDO::FETCH_ASSOC)) {
  $allCity[] = $oneCity;
};

// Gets all delegate info
$allDelegateStmt = $pdo->prepare("SELECT * FROM Delegate ORDER BY last_name, first_name ASC");
$allDelegateStmt->execute();
$allDelegate = [];
while ($oneDelegate = $allDelegateStmt->fetch(PDO::FETCH_ASSOC)) {
  $allDelegate[] = $oneDelegate;
};

// Add a new post
if (isset($_POST['addPost'])) {
  if ($_POST['postTitle'] != "") {
    if ($_POST['postContent'] != "") {
      if ($_POST['orderNum'] != "") {
        $addPostStmt = $pdo->prepare("INSERT INTO Post(title,content,post_order,approved,type_id,section_id) VALUES (:ti,:cn,:po,:ap,:td,:sd)");
        $addPostStmt->execute(array(
          ':ti'=>htmlentities($_POST['postTitle']),
          ':cn'=>htmlentities($_POST['postContent']),
          ':po'=>htmlentities($_POST['orderNum']),
          ':ap'=>htmlentities($_POST['approval']),
          ':td'=>htmlentities($_POST['typeId']),
          ':sd'=>htmlentities($_POST['secId'])
        ));
        $_SESSION['message'] = "<b style='color:green'>Post Added</b>";
        header('Location: admin.php');
        return true;
      } else {
        $_SESSION['message'] = "<b style='color:red'>An order within the other posts is required</b>";
        header('Location: admin.php');
        return false;
      };
    } else {
      $_SESSION['message'] = "<b style='color:red'>A content is required</b>";
      header('Location: admin.php');
      return false;
    };
  } else {
    $_SESSION['message'] = "<b style='color:red'>A title is required</b>";
    header('Location: admin.php');
    return false;
  };
};

// Approving a pending post (or switching back to 'pending')
if (isset($_POST['changeApproval'])) {
  $approvalStmt = $pdo->prepare("UPDATE Post SET approved=:apv WHERE post_id=:pd");
  $approvalStmt->execute(array(
    ':apv'=>htmlentities($_POST['approval']),
    ':pd'=>htmlentities($_POST['postId'])
  ));
  $_SESSION['message'] = "<b style='color:green'>Approval changed</b>";
  header('Location: admin.php');
  return true;
};

// Changes an existing post
if (isset($_POST['changePosts'])) {
  if ($_POST['postTitle'] == "" || $_POST['postContent'] == "" || $_POST['orderNum'] == "") {
    $_SESSION['message'] = "<b style='color:red'>Title, main content, and order placement is required</b>";
    header('Location: admin.php');
    return false;
  } else {
    if (isset($_SESSION['delToken'])) {
      $changePostStmt = $pdo->prepare("UPDATE Post SET title = :tl, content = :ct, post_order = :od, approved = 0, Post.timestamp = :ts WHERE post_id = :poi");
      $changePostStmt->execute(array(
        ':tl'=>htmlentities($_POST['postTitle']),
        ':ct'=>htmlentities($_POST['postContent']),
        ':od'=>htmlentities($_POST['orderNum']),
        ':ts'=>htmlentities($_POST['postTime']),
        ':poi'=>htmlentities($_POST['postId'])
      ));
      $_SESSION['message'] = "<b style='color:green'>Post changed, awaiting counselor approval</b>";
      header('Location: admin.php');
      return true;
    } elseif (isset($_SESSION['counsToken'])) {
      $changePostStmt = $pdo->prepare("UPDATE Post SET title = :tl, content = :ct, post_order = :od, Post.timestamp=:ts WHERE post_id = :poi");
      $changePostStmt->execute(array(
        ':tl'=>htmlentities($_POST['postTitle']),
        ':ct'=>htmlentities($_POST['postContent']),
        ':od'=>htmlentities($_POST['orderNum']),
        ':ts'=>htmlentities($_POST['postTime']),
        ':poi'=>htmlentities($_POST['postId'])
      ));
      $_SESSION['message'] = "<b style='color:green'>Post changed and approved</b>";
      header('Location: admin.php');
      return true;
    } else {
      $_SESSION['message'] = "<b style='color:red'>Didn't work</b>";
      header('Location: admin.php');
      return false;
    };
  };
};

// Delete a post
if (isset($_POST['deletePost'])) {
  $delPostStmt = $pdo->prepare('DELETE FROM Post WHERE post_id=:pid');
  $delPostStmt->execute(array(
    ':pid'=>$_POST['postId']
  ));
  $_SESSION['message'] = "<b style='color:blue'>Post Deleted</b>";
  header('Location: admin.php');
  return true;
};

// Changes the job assignment from one existing delegate to another
if (isset($_POST['changeJobDel'])) {
  if ($_POST['jobId'] == -1) {
    $_SESSION['message'] = "<b style='color:red'>A job must be selected</b>";
    header('Location: admin.php');
    return false;
  } else {
    if (!isset($_POST['jobDel'])) {
      $_SESSION['message'] = "<b style='color:red'>A delegate must be selected</b>";
      header('Location: admin.php');
      return false;
    } else {
      // This makes sure a Rep or Senator can only be assigned to their city's seats
      $ifCongressJobStmt = $pdo->prepare("SELECT senator,representative FROM Job WHERE job_id=:jd");
      $ifCongressJobStmt->execute(array(
        ':jd'=>htmlentities($_POST['jobId'])
      ));
      $ifCongressJob = $ifCongressJobStmt->fetch(PDO::FETCH_ASSOC);
      if ($ifCongressJob['representative'] != 0 || $ifCongressJob['senator'] != 0) {
        $getDelCityStmt = $pdo->prepare("SELECT Section.section_id FROM Delegate JOIN Section WHERE Delegate.city_id=Section.section_id AND delegate_id=:di");
        $getDelCityStmt->execute(array(
          ':di'=>htmlentities($_POST['jobDel'])
        ));
        $delCitySect = $getDelCityStmt->fetch(PDO::FETCH_ASSOC)['section_id'];
        if ($delCitySect != $ifCongressJob['senator'] && $delCitySect != $ifCongressJob['representative']) {
          $_SESSION['message'] = "<b style='color:red'>A Representative or Senator must server their own city</b>";
          header('Location: admin.php');
          return false;
        };
      };
      //
      $changeJobStmt = $pdo->prepare("UPDATE Job SET delegate_id=:jd WHERE job_id=:ji");
      $changeJobStmt->execute(array(
        ':jd'=>htmlentities($_POST['jobDel']),
        ':ji'=>htmlentities($_POST['jobId'])
      ));
      $_SESSION['message'] = "<b style='color:green'>Job Updated</b>";
      header('Location: admin.php');
      return true;

    };
  };
};

// Uploade a job image, replacing the current one
if (isset($_POST['submitFile'])) {
  $jobImg = $_FILES['jobImg'];
  $onlyTypes = ['jpg','jpeg','JPG','JPEG'];
  $choppedImgName = explode('.', $jobImg['name']);
  if (count($_FILES) == 1) {
    if (count($choppedImgName) == 2) {
      $imgExt = strtolower(end($choppedImgName));
      if (in_array($imgExt, $onlyTypes)) {
        if ($jobImg['error'] == 0) {
          if ($jobImg['size'] <= 2000000) {
            $currentFilePath = htmlentities($_POST['jobPath']);
            $currentFileName = htmlentities($_POST['jobFile']);
            $currentFileExtension = htmlentities($_POST['jobExt']);
            $currentImgId = htmlentities($_POST['imageId']);
            $_FILES['jobImg']['name'] = $currentFileName;
            $imgDestination = "../../img".$currentFilePath.$currentFileName.".".$currentFileExtension;
            move_uploaded_file($_FILES['jobImg']['tmp_name'],$imgDestination);
            $imageInfo = getimagesize("../../img".$currentFilePath.$currentFileName.".".$currentFileExtension);
            $uploadSizesStmt = $pdo->prepare("UPDATE Image SET actual_width=:ax, actual_height=:ay WHERE image_id=:imi");
            $uploadSizesStmt->execute(array(
              ':ax'=>$imageInfo[0],
              ':ay'=>$imageInfo[1],
              ':imi'=>$currentImgId
            ));
            $_SESSION['message'] = "<b style='color:green'>Upload Successful</b>";
            $_SESSION['imgId'] = $currentImgId;
            header('Location: admin.php?crop&'.$imgDestination."&".$currentImgId."&".$imageInfo[0]."&".$imageInfo[1]);
            unset($_SESSION['imgid']);
            return true;
          } else {
            $_SESSION['message'] = "<b style='color:red'>Your file can be no larger than 2 megabytes</b>";
            unset($_SESSION['imgId']);
            unset($_FILES['jobImg']);
            header('Location: admin.php');
            return false;
          };
        } else {
          // $_SESSION['message'] = "
          //   <b style='color:red'>
          //     An error occured during your upload. Please contact your counselor or the BBS IT staff
          //   </b>
          //   </br>
          //   <b style='color:red'>
          //     Error:
          //   </b>";
          $_SESSION['message'] = print_r($jobImg['error']);
          unset($_FILES['jobImg']);
          header('Location: admin.php');
          return false;
        };
      } else {
        $_SESSION['message'] = "<b style='color:red'>Your file type must be .jpg, .jpeg, or .png</b>";
        unset($_FILES['jobImg']);
        header('Location: admin.php');
        return false;
      };
    } else {
      if (count($choppedImgName) < 2) {
        $_SESSION['message'] = "<b style='color:red'>An image must be selected</b>";
      } else {
        $_SESSION['message'] = "<b style='color:red'>Your file cannot contain multiple extensions</b>";
      };
      unset($_FILES['jobImg']);
      header('Location: admin.php');
      return false;
    };
  } else {
    $_SESSION['message'] = "<b style='color:red'>An image must be selected</b>";
    unset($_FILES['jobImg']);
    header('Location: admin.php');
    return false;
  };
};

// After editing, the dimensions are saved on its row in the Image table
if (isset($_GET['editImg'])) {
  $imgDimensionsStmt = $pdo->prepare("UPDATE Image SET percent_x=:px,percent_y=:py,height=:hgt,width=:wth,edited=1,approved=0 WHERE image_id=:img");
  $imgDimensionsStmt->execute(array(
    ':px'=>htmlentities($_GET['xPercent']),
    ':py'=>htmlentities($_GET['yPercent']),
    ':hgt'=>htmlentities($_GET['heightPercent']),
    ':wth'=>htmlentities($_GET['widthPercent']),
    ':img'=>htmlentities($_SESSION['imgId'])
  ));
  $updatePhotoStmt = $pdo->prepare("SELECT image_id, percent_x, percent_y, height, width, section_path, filename, extension, actual_width, actual_height FROM Job JOIN Image WHERE Job.job_id=Image.job_id AND section_id=:se AND filename IS NOT NULL");
  $updatePhotoStmt->execute(array(
    ':se'=>$secId
  ));
  $updatePhotos = [];
  while ($onePhoto = $updatePhotoStmt->fetch(PDO::FETCH_ASSOC)) {
    $updatePhotos[] = $onePhoto;
  };
  $arrayImgId = $_SESSION['imgId'];
  $imgNum = null;
  for ($indexNum = 0; $indexNum < count($updatePhotos); $indexNum++) {
    if ($updatePhotos[$indexNum]['image_id'] == $arrayImgId) {
      $imgNum = $indexNum;
    };
  };
  // Collects all the necessary data to crop the original images...
  $actualWidth = $updatePhotos[$imgNum]['actual_width'];
  $actualHeight = $updatePhotos[$imgNum]['actual_height'];
  $percentWidth = $updatePhotos[$imgNum]['width'];
  $percentHeight = $updatePhotos[$imgNum]['height'];
  $percentX = $updatePhotos[$imgNum]['percent_x'];
  $percentY = $updatePhotos[$imgNum]['percent_y'];
  $fromX = ($percentX / 100) * $actualWidth;
  $fromY = ($percentY / 100) * $actualHeight;
  $cropWidth = ($percentWidth / 100) * $actualWidth;
  $intCropWidth = (int)$cropWidth;
  $cropHeight = ($percentHeight / 100) * $actualHeight;
  $intCropHeight = (int)$cropHeight;
  // ... before actually carrying out the cropping and upload
  $editImgName = $updatePhotos[$imgNum]['section_path']."crop_".$updatePhotos[$imgNum]['filename'].".".$updatePhotos[$imgNum]['extension'];
  // The imagecreatetruecolor() function below is NOT working in Heroku
  $blankImg = imagecreatetruecolor($intCropWidth,$intCropHeight);
  //
  $fileType = $updatePhotos[$imgNum]['extension'];
  if ($fileType == "jpeg" || $fileType =="JPEG") {
    $originalImgFile = imagecreatefromjpeg($updatePhotos[$imgNum]['section_path'].$updatePhotos[$imgNum]['filename'].".".$updatePhotos[$imgNum]['extension']);
  } else if ($fileType == "jpg" || $fileType == "JPG") {
    $originalImgFile = imagecreatefromjpeg($updatePhotos[$imgNum]['section_path'].$updatePhotos[$imgNum]['filename'].".".$updatePhotos[$imgNum]['extension']);
  } else if ($fileType == "png" || $fileType == "PNG") {
    $originalImgFile = imagecreatefrompng($updatePhotos[$imgNum]['section_path'].$updatePhotos[$imgNum]['filename'].".".$updatePhotos[$imgNum]['extension']);
  };
  imagecopy($blankImg,$originalImgFile,0,0,$fromX,$fromY,$actualWidth,$actualHeight);
  if ($fileType == "jpeg") {
    $_SESSION['message'] = "<b style='color:green'>Test jpeg</b>";
    imagejpeg($blankImg,$editImgName);
    // imagedestroy($originalImgFile);
    // imagedestroy($blankImg);
  } else if ($fileType == "jpg") {
    $_SESSION['message'] = "<b style='color:green'>Test jpg</b>";
    imagejpeg($blankImg,$editImgName);
    // imagedestroy($originalImgFile);
    // imagedestroy($blankImg);
  } else if ($fileType == "png") {
    $_SESSION['message'] = "<b style='color:green'>Test png</b>";
    imagepng($blankImg,$editImgName);
    // imagedestroy($originalImgFile);
    // imagedestroy($blankImg);
  };
  $_SESSION['message'] = "<b style='color:green'>Upload And Edit Successful</b>";
  unset($_SESSION['imgId']);
  header('Location: admin.php');
  return true;
};

// Showing or hiding the current job image
if (isset($_POST['approveImg'])) {
  $chgImgApprovalStmt = $pdo->prepare("UPDATE Image SET approved=:ap WHERE job_id=:jim");
  $chgImgApproval = $chgImgApprovalStmt->execute(array(
    ':ap'=>htmlentities($_POST['imgStatus']),
    ':jim'=>htmlentities($_POST['appImgId'])
  ));
  $_SESSION['message'] = "<b style='color:green'>Image Approval Changed</b>";
  header('Location: admin.php');
  return true;
};

// Denies image approval if an image is uploaded but not edited
if (isset($_POST['exitBttn'])) {
  $notCroppedStmt = $pdo->prepare("UPDATE Image SET approved=0,edited=0 WHERE job_id=:jbd");
  $notCroppedStmt->execute(array(
    ':jbd'=>htmlentities($_POST['jobId'])
  ));
  $_SESSION['message'] = "<b style='color:red'>Image upload canceled</b>";
  unset($_SESSION['imgId']);
  header('Location: admin.php');
  return true;
};

// Updating a current delegate in the directory
if (isset($_POST['updateDelInfo'])) {
  if ($_POST['updateFstNm'] == "" || $_POST['updateLstNm'] == "") {
    $_SESSION['message'] = "<b style='color:red'>The first and last names must be filled out</b>";
    header('Location: admin.php');
    return false;
  } else {
    for ($oneCityNum = 0; $oneCityNum < count($allCity); $oneCityNum++) {
      if ($allCity[$oneCityNum]['section_id'] == htmlentities($_POST['updateCityId'])) {
        $countyId = $allCity[$oneCityNum]['is_county'];
      };
    };
    $updateDelStmt = $pdo->prepare('UPDATE Delegate SET first_name=:fsn, last_name=:lsn, hometown=:ht, email=:el, city_id=:ci, county_id=:co WHERE delegate_id=:di');
    $updateDelStmt->execute(array(
      ':fsn'=>htmlentities($_POST['updateFstNm']),
      ':lsn'=>htmlentities($_POST['updateLstNm']),
      ':ht'=>htmlentities($_POST['updateHmtn']),
      ':el'=>htmlentities($_POST['updateEmail']),
      ':ci'=>htmlentities($_POST['updateCityId']),
      ':co'=>(int)$countyId,
      ':di'=>htmlentities($_POST['delId'])
    ));
    $_SESSION['message'] = "<b style='color:green'>Update Successful</b>";
    header('Location: admin.php');
    return true;
  };
};

// Adding a new delegate to the job table
if (isset($_POST['addDelegate'])) {
  if ($_POST['newFirstN'] == "" || $_POST['newLastN'] == "") {
    $_SESSION['message'] = "<b style='color:red'>A first and last name must be entered</b>";
    header('Location: admin.php');
    return false;
  } else {
    if ($_POST['delCity'] == -1) {
      $_SESSION['message'] = "<b style='color:red'>A city must be selected</b>";
      header('Location: admin.php');
      return false;
    } else {
      for ($cityCount = 0; $cityCount < count($allCity); $cityCount++) {
        if ($allCity[$cityCount]['section_id'] == $_POST['delCity']) {
          $delCounty = $allCity[$cityCount]['is_county'];
        };
      };
      $addDelegateStmt = $pdo->prepare("INSERT INTO Delegate(first_name,last_name,email,hometown,city_id,county_id) VALUES (:fn,:lm,:em,:hm,:ci,:co)");
      $addDelegateStmt->execute(array(
        ':fn'=>htmlentities($_POST['newFirstN']),
        ':lm'=>htmlentities($_POST['newLastN']),
        ':em'=>htmlentities($_POST['newEmail']),
        ':hm'=>htmlentities($_POST['newHome']),
        ':ci'=>htmlentities($_POST['delCity']),
        ':co'=>(int)$delCounty
      ));
      $_SESSION['message'] = "<b style='color:green'>Delegate Added</b>";
      header('Location: admin.php');
      return true;
    };
  };
};

// Deleting an existing delegate
if (isset($_POST['deleteDel'])) {
  $removedName = htmlentities($_POST['removeDelName']);
  // This changes the delegate's jobs to the default 'NO DELEGATE' row
  $changeJobDelegateStmt = $pdo->prepare("UPDATE Job SET delegate_id=0 WHERE delegate_id=:jd");
  $changeJobDelegateStmt->execute(array(
    ':jd'=>htmlentities($_POST['removeDelId'])
  ));
  // This actually deletes the delegate's row
  $deleteDelStmt = $pdo->prepare("DELETE FROM Delegate WHERE delegate_id=:did");
  $deleteDelStmt->execute(array(
    ':did'=>htmlentities($_POST['removeDelId'])
  ));
  $_SESSION['message'] = "<b style='color:green'>Delegate ".$removedName." was deleted</b>";
  header('Location: admin.php');
  return true;
};

// Show all Departments
$dptListStmt = $pdo->prepare("SELECT DISTINCT * FROM Department JOIN Job WHERE Department.section_id=:secd AND Job.job_id=Department.job_id");
$dptListStmt->execute(array(
  ':secd'=>htmlentities($_SESSION['secId'])
));
$dptList = [];
while ($oneDpt = $dptListStmt->fetch(PDO::FETCH_ASSOC)) {
  $dptList[] = $oneDpt;
};

// Create new department and job
// Note: Departments always begin as 'Active'
if (isset($_POST['makeDpt'])) {
  if ($_POST['dptName'] == "" || $_POST['dptPurpose'] == "" || $_POST['dptJob'] == "") {
    $_SESSION['message'] = "<b style='color:red'>Department name, purpose, and job title required</b>";
    header('Location: admin.php');
    return false;
  } else {
    if ($_POST['dptHead'] == 0) {
      $_SESSION['message'] = "<b style='color:red'>Choose a delegate</b>";
      header('Location: admin.php');
      return false;
    } else {
      $createJobStmt = $pdo->prepare("INSERT INTO Job(job_name,job_active,delegate_id,section_id) VALUES (:jn,1,:dg,:st)");
      $createJobStmt->execute(array(
        ':jn'=>htmlentities($_POST['dptJob']),
        ':dg'=>htmlentities($_POST['dptHead']),
        ':st'=>htmlentities($_SESSION['secId'])
      ));
      $createDptStmt = $pdo->prepare("INSERT INTO Department(dpt_name,purpose,job_id,active,section_id) VALUES (:dn,:pu,:jo,:ac,:sc)");
      $lastIdStmt = $pdo->prepare("SELECT LAST_INSERT_ID()");
      $lastIdStmt->execute();
      $lastId = $lastIdStmt->fetch(PDO::FETCH_ASSOC)['LAST_INSERT_ID()'];
      // Note: The department wont show up until it has a delegate assigned to it
      $createDptStmt->execute(array(
        ':dn'=>htmlentities($_POST['dptName']),
        ':pu'=>htmlentities($_POST['dptPurpose']),
        ':jo'=>$lastId,
        ':ac'=>htmlentities($_POST['dptActive']),
        ':sc'=>htmlentities($_SESSION['secId'])
      ));
      $_SESSION['message'] = "<b style='color:green'>Department created</b>";
      header('Location: admin.php');
      return true;
    };
  };
};

// Changes a department and it's job
if (isset($_POST['submitDpt'])) {
  if ($_POST['dptName'] == "" || $_POST['dptPurpose'] == "" || $_POST['dptJobName'] == "") {
    $_SESSION['message'] = "<b style='color:red'>Department name, purpose, and job name are required</b>";
    header('Location: admin.php');
    return true;
  } else {
    $changeDptStmt = $pdo->prepare("UPDATE Department SET dpt_name=:dm, purpose=:pp, active=:av WHERE dpt_id=:dp");
    $changeDptStmt->execute(array(
      ':dm'=>htmlentities($_POST['dptName']),
      ':pp'=>htmlentities($_POST['dptPurpose']),
      ':av'=>htmlentities($_POST['dptActive']),
      ':dp'=>htmlentities($_POST['dptId'])
    ));
    $changeDptJobStmt = $pdo->prepare("UPDATE Job SET job_name=:jbn WHERE job_id=:jid");
    $changeDptJobStmt->execute(array(
      ':jbn'=>htmlentities($_POST['dptJobName']),
      ':jid'=>htmlentities($_POST['dptJobId'])
    ));
    $_SESSION['message'] = "<b style='color:green'>Department Changed</b>";
    header('Location: admin.php');
    return true;
  };
};

// Delete a department
if (isset($_POST['deleteDpt'])) {
  $deleteDptStmt = $pdo->prepare("DELETE FROM Department WHERE dpt_id=:dpt");
  $deleteDptStmt->execute(array(
    ':dpt'=>htmlentities($_POST['dptId'])
  ));
  $deleteJobStmt = $pdo->prepare("DELETE FROM Job WHERE job_id=:jb");
  $deleteJobStmt->execute(array(
    ':jb'=>htmlentities($_POST['removeJobId'])
  ));
  $_SESSION['message'] = "<b style='color:green'>Department and job deleted</b>";
  header('Location: admin.php');
  return true;
};

// Logs out data and sends to login page
if (isset($_POST['logout'])) {
  if (isset($_SESSION['counsToken'])) {
    unset($_SESSION['counsToken']);
  } else {
    unset($_SESSION['delToken']);
  };
  unset($_SESSION['adminType']);
  unset($_SESSION['secId']);
  $_SESSION['message'] = "<b style='color:green'>Logout Successful</b>";
  header('Location: ../login/login.php');
  return true;
};

// echo("GET:");
// echo("<pre>");
// var_dump($_GET);
// echo("</pre>");
// echo("POST:");
// echo("<pre>");
// var_dump($_POST);
// echo("</pre>");
// echo("SESSION:");
// echo("<pre>");
// var_dump($_SESSION);
// echo("</pre>");
// echo("FILES:");
// echo("<pre>");
// var_dump($_FILES);
// echo("</pre>");

?>
