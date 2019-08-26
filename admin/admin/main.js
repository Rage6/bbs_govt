$(()=>{
  console.log("checking admin/main.js");

  // Compares window height and body height and makes the body is higher than the window
  let windowHeight = $(window).height();
  let bodyHeight = $("body").height();
  if (windowHeight > bodyHeight) {
    let mainBoxHeight = $(".mainBox").height();
    let addedHeight = windowHeight - bodyHeight;
    let newHeight = mainBoxHeight + addedHeight;
    $(".mainBox").css('min-height',newHeight);
  };

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
  const updateCropImg = (imgWidth,imgHeight) => {
    let portrait = null;
    let fitWidth = document.getElementById('cropImg').width;
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
  if (requestList[0] == "crop") {
    $(".cropBox").css('display','block');
    $("#cropImg").attr('src',requestList[1]);
    $("#exitJobId").val(requestList[2]);
    rawWidth = requestList[3];
    rawHeight = requestList[4];
    // console.log(requestList);
    updateCropImg(rawWidth,rawHeight);
  };

  // To shrink the image's cropping
  $("#smallerBttn").click(()=>{
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
    };
  });

  // Collects the cropped data, redirects back into admin.php w/ data in GET request



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
