// $(()=>{
$(document).ready(()=>{
  console.log("testing admin/main.js");

  // Compares window height and body height and makes the body is higher than the window
  let windowHeight = $(window).height();
  let bodyHeight = $("body").height();
  if (windowHeight > bodyHeight) {
    let mainBoxHeight = $(".mainBox").height();
    let addedHeight = windowHeight - bodyHeight;
    let newHeight = mainBoxHeight + addedHeight;
    $(".mainBox").css('min-height',newHeight);
  };

  // Opens and closes the possible explanations to the upload error that just occurred
  $("#errorInstructBttn").click(()=>{
    let errBoxStatus = $("#errorInstructBox").css('display');
    if (errBoxStatus == "none") {
      $("#errorInstructBox").css('display','block');
    } else {
      $("#errorInstructBox").css('display','none');
    };
  });

  // Opens and closes all of a type's posts
  $("[data-head]").click(()=> {
    let typeNum = event.target.dataset.head;
    let typeId = "#typeId" + typeNum;
    let typeDisplay = $(typeId).css('display');
    if (typeDisplay == 'block') {
      $(typeId).css('display','none');
    } else {
      $(typeId).css('display','block');
    };
  });

  // Hides all approved posts
  let allPost = $("[data-postid]");
  let postNum = $("[data-postid]").length;
  for (let num = 0; num < postNum; num++) {
    if ($(allPost[num])[0].dataset.approval == 1) {
      let targetId = "#" + $(allPost[num])[0].id;
        $(targetId).css('display','none');
    };
  };

  // Adds filler content if a type has no pending posts
  let allTypes = $("[data-head]");
  let allPosts = $("[data-postid]");
  for (let typeIndex = 0; typeIndex < allTypes.length; typeIndex++) {
    let oneTypeId = allTypes[typeIndex].dataset.head;
    let pendingTotal = 0;
    for (let postIndex = 0; postIndex < allPosts.length; postIndex++) {
      if (allPosts[postIndex].dataset.typeid == oneTypeId) {
        if (allPosts[postIndex].dataset.approval == "0") {
          pendingTotal++;
        };
      };
    };
    if (pendingTotal == 0) {
      let noPendingType = "#boxList_" + oneTypeId;
      $(noPendingType).append("<div id='emptyBox_" + oneTypeId + "' class='postBox emptyBox'>There are no posts waiting for approval at this time.<div>");
    };
  };

  // Switches between 'pending' and 'all' posts
  $("[data-approval]").click(()=>{
    let postType = event.target.dataset.pendtype;
    let approvalStatus = event.target.dataset.approval;
    let pendingId = "#pending" + postType;
    let allId = "#all" + postType;
    if (approvalStatus == 0) {
      $(pendingId).css({'color':'black','background-color':'lightblue'});
      $(allId).css({'color':'white','background-color':'blue'});
    } else {
      $(pendingId).css({'color':'white','background-color':'blue'});
      $(allId).css({'color':'black','background-color':'lightblue'});
    };
    let postLength = ($("[data-postid]").length);
    let typeLength = 0;
    for (let postCount = 0; postCount < postLength; postCount++) {
      let onePost = $("[data-postid]")[postCount];
      if (postType == onePost.dataset.typeid) {
        let onePostId = "#" + onePost.id;
        if (approvalStatus == "0") {
          if (onePost.dataset.approval == "1") {
            $(onePost).css('display','none');
          };
        } else {
          $(onePost).css('display','block');
        };
      };
      if (onePost.dataset.typeid == postType && onePost.dataset.approval == approvalStatus) {
        typeLength++;
      };
    };
    let typeRowId = "#boxList_" + event.target.dataset.pendtype;
    if (typeLength == 0) {
      $(typeRowId).append("<div id='emptyBox_"+event.target.dataset.pendtype+"' class='postBox emptyBox'>There are no posts waiting for approval at this time.<div>");
    } else {
      let emptyBoxId = "#emptyBox_" + event.target.dataset.pendtype;
      $(emptyBoxId).remove();
    };
  });

  // Opens and closes the 'CHANGE' and 'DELETE' boxes
  $("[data-post]").click(() => {
    let clickBttnId = "#" + event.target.id;
    let clickBttnNum = $(clickBttnId).attr('data-post');
    if (event.target.dataset.box == "delete") {
      let delBoxId = "#delBox" + clickBttnNum;
      let displayStatus = $(delBoxId).css('display');
      if (displayStatus == "block") {
        $(delBoxId).css('display','none');
      } else {
        $(delBoxId).css('display','block');
      };
      let chgBoxId = "#chgBox" + clickBttnNum;
      $(chgBoxId).css('display','none')
    } else if (event.target.dataset.box == "change") {
      let chgBoxId = "#chgBox" + clickBttnNum;
      let displayStatus = $(chgBoxId).css('display');
      if (displayStatus == "block") {
        $(chgBoxId).css('display','none');
      } else {
        $(chgBoxId).css('display','block');
      };
      let delBoxId = "#delBox" + clickBttnNum;
      $(delBoxId).css('display','none')
    } else {
      console.log("Neither change nor delete");
    };
  });

  // Opens and closes the 'ADD POST' boxes
  $("[data-type]").click(() => {
    let addBttnId = "#" + event.target.id;
    let addBttnNum = $(addBttnId).attr('data-type');
    let addBoxId = "#addBox" + addBttnNum;
    let displayStatus = $(addBoxId).css('display');
    if (displayStatus == "block") {
      $(addBoxId).css('display','none');
    } else {
      $(addBoxId).css('display','block');
    };
  });

  let currentWidth = $(window).width();
  // Function that gets the current width of the window
  const checkWidth = () => {
    currentWidth = $(window).width();
  };

  // Opens/closes where the section's current staff can be seen
  $("#listTitle").click(() => {
    checkWidth();
    if (currentWidth <= 414) {
      if ($("#listBox").css('display') == 'block') {
        $("#listBox").css('display','none');
      } else {
        $("#listBox").css('display','block');
      };
      $("#dptDirBox").css('display','none');
      $("#assignJobBox").css('display','none');
      $("#updateDirBox").css('display','none');
    };
  });

  // Opens/closes where a job is assigned to a delegate (if they are already in the directory)
  $("#assignJobTitle").click(() => {
    checkWidth();
    if (currentWidth <= 414) {
      if ($("#assignJobBox").css('display') == 'block') {
        $("#assignJobBox").css('display','none');
      } else {
        $("#assignJobBox").css('display','block');
      };
      $("#dptDirBox").css('display','none');
      $("#listBox").css('display','none');
      $("#updateDirBox").css('display','none');
    };
  });

  // Opens/closes the delegate directory for changes/deletes
  $("#updateDirTitle").click(() => {
    checkWidth();
    if (currentWidth <= 414) {
      if ($("#updateDirBox").css('display') == 'block') {
        $("#updateDirBox").css('display','none');
      } else {
        $("#updateDirBox").css('display','block');
      };
      $("#dptDirBox").css('display','none');
      $("#listBox").css('display','none');
      $("#assignJobBox").css('display','none');
    };
  });

  // Opens/closes where delegates can be added to the directory
  $("#addDirTitle").click(() => {
    if ($("#addDirBox").css('display') == 'block') {
      $("#addDirBox").css('display','none');
      $("#addDirTitle").css('border-radius','10px');
    } else {
      $("#addDirBox").css('display','block');
      $("#addDirTitle").css('border-radius','10px 10px 0 0');
    };
  });

  // Opens/closes the Department list
  $("#dptTitle").click(()=>{
    checkWidth();
    console.log(currentWidth);
    if (currentWidth <= 414) {
      console.log("this worked");
      if ($("#dptDirBox").css('display') == 'block') {
        $("#dptDirBox").css('display','none');
      } else {
        $("#dptDirBox").css('display','block');
      };
      $("#updateDirBox").css('display','none');
      $("#listBox").css('display','none');
      $("#assignJobBox").css('display','none');
    };
  });

  // Opens/closes the 'CHANGE' and 'DELETE' buttons on 'Delegate Directory'
  $("[data-delId][data-act]").click(()=>{
    if (event.target.dataset.act == 'delBttn' || event.target.dataset.act == 'chgBttn') {
      let boxId = null;
      let nonBox = null;
      if (event.target.dataset.act == 'chgBttn') {
        boxId = "#chgBox" + event.target.dataset.delid;
        nonBox = "#delBox" + event.target.dataset.delid;
      } else if (event.target.dataset.act == "delBttn") {
        boxId = "#delBox" + event.target.dataset.delid;
        nonBox = "#chgBox" + event.target.dataset.delid;
      };
      if ($(boxId).css('display') == 'block') {
        $(boxId).css('display','none');
      } else {
        $(boxId).css('display','block');
      };
      $(nonBox).css('display','none');
    } else if (event.target.dataset.act == 'cancelBttn') {
      // Not sure why, but clicking on 'CANCEL' carries out the function twice
      let removeBox = "#delBox" + event.target.dataset.delid;
      $(removeBox).css('display','none');
    };
  });

  // Opens/closes the 'ADD DIRECTORY' box
  $("#addDptBttn").click(()=> {
    // console.log("worked");
    if ($("#addDptBox").css('display') == 'block') {
      $("#addDptBttn").css('border-radius','15px');
      $("#addDptBox").css('display','none');
    } else {
      $("#addDptBttn").css('border-radius','15px 15px 0 0');
      $("#addDptBox").css('display','block');
    };
  });

  // Opens/closes the 'CHANGE' and 'DELETE' options in Department Directory
  $("[data-dptId][data-act]").click(()=> {
    let eventId = event.target.dataset.dptid;
    if (event.target.dataset.act == "chgDptBttn") {
      let notClicked = "#delDptBox" + eventId;
      $(notClicked).css('display','none');
      let clicked = "#chgDptBox" + eventId;
      if ($(clicked).css('display') == 'block') {
        $(clicked).css('display','none');
      } else {
        $(clicked).css('display','block');
      };
    } else if (event.target.dataset.act == "delDptBttn") {
      let notClicked = "#chgDptBox" + eventId;
      $(notClicked).css('display','none');
      let clicked = "#delDptBox" + eventId;
      if ($(clicked).css('display') == 'block') {
        $(clicked).css('display','none');
      } else {
        $(clicked).css('display','block');
      };
    } else if (event.target.dataset.act == "cancelDptBttn") {
      let closeDelBox = "#delDptBox" + eventId;
      $(closeDelBox).css('display','none');
    } else {
      console.log("didn't work");
    };
  });

  // Opens and closes the 'Staff Photo' option
  $("#photoTab").click(()=>{
    if ($(".photoMain").css('display') == 'none') {
      $(".photoMain").css('display','block');
    } else {
      $(".photoMain").css('display','none');
    };
  });

  // Sets initial cropBox height
  let cropBoxHeight = $(window).height() - $("#refAll").height();
  $(".cropBox").css('height',cropBoxHeight);

  // Sets up the default square box when opening the cropBox
  const updateCropImg = (getAction,imgPath,getImgId,imgWidth,imgHeight) => {
    let portrait = null;
    let randomNum = Math.floor(Math.random() * Math.floor(100000000));
    $("#cropImg").attr('src',imgPath + "?t=" + randomNum);
    let fitWidth = document.getElementById('cropImg').offsetWidth;
    let fitHeight = parseInt(((imgHeight / imgWidth) * fitWidth).toFixed(0));
    let closeHeight = $(".closeRow").outerHeight();
    $(".topCrop").css('top',closeHeight);
    if (fitHeight > fitWidth) {
      maxSize = fitWidth;
      portrait = true;
      bottomPad = fitHeight - maxSize;
      $(".rightCrop").css('top',closeHeight).css('width',0).css('height',maxSize);
      $(".leftCrop").css('top',closeHeight).css('height',maxSize);
      $(".bottomCrop").css('top',maxSize + closeHeight).css('height',bottomPad);
    } else {
      maxSize = fitHeight;
      portrait = false;
      rightPad = fitWidth - maxSize;
      $(".rightCrop").css('top',closeHeight).css('width',rightPad).css('height',maxSize);
      $(".leftCrop").css('top',closeHeight).css('height',maxSize);
      $(".bottomCrop").css('top',closeHeight + maxSize).css('height',0);
    };

  };

  // Shows the cropBox after image is uploaded
  let rawWidth = 0;
  let rawHeight = 0;
  let requestData = window.location.search.substring(1);
  let requestList = requestData.split("&");
  console.log(requestList);
  let maxSize = 0;
  let top = 0;
  let right = 0;
  let bottom = 0;
  let left = 0;
  let topHeight = 0;
  let rightWidth = 0;
  let rightHeight = 0;
  let bottomHeight = 0;
  let leftWidth = 0;
  let leftHeight = 0;

  // This makes the 'cropBox' appear a) if the cropping/rotating occurs and b) after the image is uploaded.
  window.addEventListener('load',(event) => {
    if (requestList[0].split("=")[1] == "crop" || requestList[0].split("=")[1] == "rotate") {
      $(".cropBox").css('display','block');
      $("#exitJobId").val(requestList[2].split("=")[1]);
      let thisAction = requestList[0].split("=")[1];
      let srcDestination = requestList[1].split("=")[1];
      let thisImgId = requestList[2].split("=")[1];
      rawWidth = requestList[3].split("=")[1];
      rawHeight = requestList[4].split("=")[1];
      updateCropImg(thisAction,srcDestination,thisImgId,rawWidth,rawHeight);
    };
  });



  // To shrink the cropping border size of the image
  const shrinkImg = () => {
    topCropPx = parseInt($(".topCrop").css('height').replace("px","")) + $(".topCrop").offset().top;
    bottomCropPx = $(".bottomCrop").offset().top;
    if (bottomCropPx - topCropPx > 50) {
      // Lowers the top padding
      topHeight = $(".topCrop").height();
      let nextTopHeight = topHeight + 1;
      top = $(".topCrop").css('top');
      $(".topCrop").css('height',nextTopHeight + "px");
      // Increases the right padding to the left
      rightWidth = $(".rightCrop").width();
      rightHeight = $(".rightCrop").height();
      right = parseInt($(".rightCrop").css('margin-top').replace('px',''));
      let nextRightWidth = rightWidth + 1;
      let nextRightHeight = rightHeight - 2;
      let nextRightTop = right + 1;
      $(".rightCrop").css('width',nextRightWidth + "px");
      $(".rightCrop").css('height',nextRightHeight + "px");
      $(".rightCrop").css('margin-top',nextRightTop);
      // Raise the bottom padding
      bottomHeight = $(".bottomCrop").height();
      let nextBottomHeight = bottomHeight + 1;
      $(".bottomCrop").css('height',nextBottomHeight + "px");
      bottom = $(".bottomCrop").css('margin-top');
      let nextBottomTop = parseInt(bottom.replace("px","")) - 1;
      $(".bottomCrop").css('margin-top',nextBottomTop + "px");
      // Increases the left padding to the left
      leftWidth = $(".leftCrop").width();
      leftHeight = $(".leftCrop").height();
      left = parseInt($(".leftCrop").css('margin-top').replace('px',''));
      let nextLeftWidth = leftWidth + 1;
      let nextLeftHeight = leftHeight - 2;
      let nextLeftTop = left + 1;
      $(".leftCrop").css('width',nextLeftWidth + "px");
      $(".leftCrop").css('height',nextLeftHeight + "px");
      $(".leftCrop").css('margin-top',nextLeftTop);
    } else {;
      console.log("Minimum size");
      clearInterval(shrinkInterval);
    };
  };

  // To increase the cropping border size of the image
  const enlargeImg = () => {
    let topCheck = $(".topCrop").height();
    let rightCheck = $(".rightCrop").width();
    let bottomCheck = $(".bottomCrop").height();
    let leftCheck = $(".leftCrop").width();
    let rightMarginTop = parseInt($(".rightCrop").css('margin-top').replace("px",""));
    let rightCropHeight = $(".rightCrop").height();
    let bottomMarginTop = parseInt($(".bottomCrop").css('margin-top').replace("px",""));
    let bottomCropHeight = $(".bottomCrop").height();
    let leftMarginTop = parseInt($(".leftCrop").css('margin-top').replace("px",""));
    let leftCropHeight = $(".leftCrop").height();
    if (topCheck > 0 && rightCheck > 0 && bottomCheck > 0 && leftCheck > 0) {
      $(".topCrop")
        .css('height',topCheck - 1 + "px");
      $(".rightCrop")
        .css('width',rightCheck - 1 + "px")
        .css('margin-top',rightMarginTop - 1 + "px")
        .css('height',rightCropHeight + 2 + "px");
      $(".bottomCrop")
        .css('margin-top',bottomMarginTop + 1 + "px")
        .css('height',bottomCropHeight - 1 + "px");
      $(".leftCrop")
        .css('width',leftCheck - 1 + "px")
        .css('margin-top',leftMarginTop - 1 + "px")
        .css('height',leftCropHeight + 2 + "px");
    } else {;
      console.log("Maximum size");
      clearInterval(enlargeInterval);
    };
  };

  // Detects whether this devices is using a touch screen or a mouse
  if ('ontouchstart' in document.documentElement) {
    startType = "touchstart";
    stopType = "touchend";
  } else {
    startType = "mousedown";
    stopType = "mouseup";
  };

  // Activates shrinkImg() to make the img smaller
  let shrinkInterval = null;
  $("#smallerBttn").on(startType,()=>{
    if (shrinkInterval != null) {
      clearInterval(shrinkInterval);
    };
    event.preventDefault();
    shrinkInterval = setInterval(() => { shrinkImg() }, 50);
  });
  // Automatically deactivates shrinkImg()
  $("#smallerBttn").on(stopType,()=>{
    clearInterval(shrinkInterval);
  });

  // Activates enlargeImg() to make the img larger
  let enlargeInterval = null;
  $("#biggerBttn").on(startType,()=>{
    if (enlargeInterval != null) {
      clearInterval(enlargeInterval);
    };
    event.preventDefault();
    enlargeInterval = setInterval(() => { enlargeImg() }, 50);
  });
  // Automatically deactivates shrinkImg()
  $("#biggerBttn").on(stopType,()=>{
    clearInterval(enlargeInterval);
  });

  // Moving cropping box upwards
  const upCrop = () => {
    let currentTopHeight = $(".topCrop").height();
    let currentRightMargin = parseInt($(".rightCrop").css('margin-top').replace("px",""));
    let currentBottomHeight = $(".bottomCrop").height();
    let currentBottomMargin = parseInt($(".bottomCrop").css('margin-top').replace("px",""));
    let currentLeftMargin = parseInt($(".leftCrop").css('margin-top').replace("px",""));
    if (currentTopHeight > 0) {
      $(".topCrop")
        .css('height', currentTopHeight - 1 + "px");
      $(".rightCrop")
        .css('margin-top', currentRightMargin - 1 + "px");
      $(".bottomCrop")
        .css('height', currentBottomHeight + 1 + "px")
        .css('margin-top', currentBottomMargin - 1 + "px");
      $(".leftCrop")
        .css('margin-top', currentLeftMargin - 1 + "px");
    } else {
      console.log("Cannot go any higher");
      clearInterval(upInterval);
    };
  };

  // Activates the upward movement of the cropped image
  let upInterval = null;
  $("#upBttn").on(startType,()=>{
    if (upInterval != null) {
      clearInterval(upInterval);
    };
    event.preventDefault();
    upInterval = setInterval(() => { upCrop() }, 50);
  });
  // Automatically deactivates upInterval()
  $("#upBttn").on(stopType,()=>{
    clearInterval(upInterval);
  });

  // Moving cropping box to the right
  const rightCrop = () => {
    let currentRightWidth = $(".rightCrop").width();
    let currentLeftWidth = $(".leftCrop").width();
    if (currentRightWidth > 0) {
      $(".rightCrop")
        .css('width', currentRightWidth - 1 + "px");
      $(".leftCrop")
        .css('width', currentLeftWidth + 1 + "px");
    } else {
      console.log("Cannot go any further right");
      clearInterval(rightInterval);
    };
  };

  // Activates the right movement of the cropped image
  let rightInterval = null;
  $("#rightBttn").on(startType,()=>{
    if (rightInterval != null) {
      clearInterval(rightInterval);
    };
    event.preventDefault();
    rightInterval = setInterval(() => { rightCrop() }, 50);
  });
  // Automatically deactivates rightInterval()
  $("#rightBttn").on(stopType,()=>{
    clearInterval(rightInterval);
  });

  // Moving cropping box downward
  const downCrop = () =>{
    let currentTopHeight = $(".topCrop").height();
    let currentRightMargin = parseInt($(".rightCrop").css('margin-top').replace("px",""));
    let currentBottomHeight = $(".bottomCrop").height();
    let currentBottomMargin = parseInt($(".bottomCrop").css('margin-top').replace("px",""));
    let currentLeftMargin = parseInt($(".leftCrop").css('margin-top').replace("px",""));
    if (currentBottomHeight > 0) {
      $(".topCrop")
        .css('height', currentTopHeight + 1 + "px");
      $(".rightCrop")
        .css('margin-top', currentRightMargin + 1 + "px");
      $(".bottomCrop")
        .css('height', currentBottomHeight - 1 + "px")
        .css('margin-top', currentBottomMargin + 1 + "px");
      $(".leftCrop")
        .css('margin-top', currentLeftMargin + 1 + "px");
    } else {
      console.log("Cannot go any lower");
      clearInterval(downInterval);
    };
  };

  // Activates the down movement of the cropped image
  let downInterval = null;
  $("#downBttn").on(startType,()=>{
    if (downInterval != null) {
      clearInterval(downInterval);
    };
    event.preventDefault();
    downInterval = setInterval(() => { downCrop() }, 50);
  });
  // Automatically deactivates shrinkImg()
  $("#downBttn").on(stopType,()=>{
    clearInterval(downInterval);
  });

  // Moving cropping box to the left
  const leftCrop = () => {
    let currentRightWidth = $(".rightCrop").width();
    let currentLeftWidth = $(".leftCrop").width();
    if (currentLeftWidth > 0) {
      $(".rightCrop")
        .css('width', currentRightWidth + 1 + "px");
      $(".leftCrop")
        .css('width', currentLeftWidth - 1 + "px");
    } else {
      console.log("Cannot go any further left");
      clearInterval(leftInterval);
    };
  };

  // Activates the left movement of the cropped image
  let leftInterval = null;
  $("#leftBttn").on(startType,()=>{
    if (leftInterval != null) {
      clearInterval(leftInterval);
    };
    event.preventDefault();
    leftInterval = setInterval(() => { leftCrop() }, 50);
  });
  // Automatically deactivates leftCrop()
  $("#leftBttn").on(stopType,()=>{
    clearInterval(leftInterval);
  });

  $("#rotateBttn").click(()=>{
    let preRotateHeight = rawHeight;
    let preRotateWidth = rawWidth;
    rawHeight = preRotateWidth;
    rawWidth = preRotateHeight;
    let rotateData = window.location.search.substring(1);
    let rotateArray = rotateData.split("&");
    let rotateObject = {};
    for (let rotateNum = 0; rotateNum < rotateArray.length; rotateNum++) {
      let oneArray = rotateArray[rotateNum].split("=");
      rotateObject[oneArray[0]] = oneArray[1];
    };
    let rotateHref = window.location.origin + window.location.pathname + "?imgAction=rotate&destination=" + rotateObject['destination'] + "&imgId=" + rotateObject['imgId'] + "&actualWidth=" + rotateObject['actualHeight'] + "&actualHeight=" + rotateObject['actualWidth'];
    window.location.href = rotateHref;
    return true;
  });

  // Collects the cropped data, redirects back into admin.php w/ data in GET request
  $("#submitCrop").click(()=>{
    let submitArray = window.location.search.substring(1).split("&");
    let submitObject = {};
    for (let submitNum = 0; submitNum < submitArray.length; submitNum++) {
      let oneSubmit = submitArray[submitNum].split("=");
      submitObject[oneSubmit[0]] = oneSubmit[1];
    };
    console.log(submitObject['actualWidth']);
    console.log(submitObject['actualHeight']);
    let imgFullWidth = document.getElementById('cropImg').width;
    let imgFullHeight = parseInt(((parseInt(submitObject['actualHeight']) / parseInt(submitObject['actualWidth'])) * imgFullWidth).toFixed(0));
    let borderPx = [
      $(".topCrop").height(),
      $(".rightCrop").width(),
      $(".bottomCrop").height(),
      $(".leftCrop").width()
    ];
    console.log(borderPx);
    let cropWidthPx = imgFullWidth - (borderPx[3] + borderPx[1]);
    let cropHeightPx = imgFullHeight - (borderPx[0] + borderPx[2]);
    let cropWidthPercent = parseFloat(((cropWidthPx / imgFullWidth) * 100).toFixed(0));
    let cropHeightPercent = parseFloat(((cropHeightPx / imgFullHeight) * 100).toFixed(0));
    let topPercent = parseFloat(((borderPx[0] / imgFullHeight) * 100).toFixed(0));
    let leftPercent = parseFloat(((borderPx[3] / imgFullWidth) * 100).toFixed(0));
    let newHref = window.location.origin + window.location.pathname + "?editImg=true&xPercent=" + leftPercent + "&yPercent=" + topPercent + "&widthPercent=" + cropWidthPercent + "&heightPercent=" + cropHeightPercent + "&actualWidth=" + submitObject['actualWidth'] + "&actualHeight=" + submitObject['actualHeight'];
    window.location.href = newHref;
    return false;
  });

  // Counts down the time until the session expires
  let interval = null;
  $(document).ready(() => {
    interval = setInterval(tickDown,1000);
  });
  const lockTime = Date.now() + 1800000;
  const tickDown = () => {
    let currentTime = Date.now();
    let timeDiff = lockTime - currentTime;
    let currentSec = Math.floor(timeDiff / 1000);
    let currentMin = Math.floor(currentSec / 60);
    let currentRemainder = currentSec - (currentMin * 60);
    if (currentRemainder < 10) {
      currentRemainder = "0" + currentRemainder;
    };
    if (currentMin < 10) {
      currentMin = "0" + currentMin;
    };
    if (currentMin == 2 && currentRemainder == 0) {
      $("#refInfoBar").css('background-color','orange').css('color','black');
    };
    if (currentMin == 1 && currentRemainder == 0) {
      $("#refInfoBar").css('background-color','red').css('color','white');
    };
    $("#timeMin").text(currentMin + ":" + currentRemainder);
    if (timeDiff < 0) {
      $("#refText").text("Auto-locked. Refresh & login");
      clearInterval(interval);
    };
  };

  // Opens and closes the box about the 30 minute 'auto-lock'
  $("#refInfoBttn").click(()=>{
    if ($("#refInfoBox").css('display') == "block") {
      $("#refInfoBox").css('display','none');
    } else {
      $("#refInfoBox").css('display','block');
    };
  });

});
