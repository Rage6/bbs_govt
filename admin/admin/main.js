$(()=>{
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
      let noPendingType = "#typeRow_" + oneTypeId;
      $(noPendingType).after("<div id='emptyBox_" + oneTypeId + "' class='postBox' style='text-align:center'>There are no posts waiting for approval at this time.<div>");
    };
  };

  // Switches between 'pending' and 'all' posts
  $("[data-approval]").click(()=>{
    let postType = event.target.dataset.pendtype;
    let approvalStatus = event.target.dataset.approval;
    let pendingId = "#pending" + postType;
    let allId = "#all" + postType;
    if (approvalStatus == 0) {
      $(pendingId).css({'color':'gold','background-color':'black'});
      $(allId).css({'color':'black','background-color':'transparent'});
    } else {
      $(pendingId).css({'color':'black','background-color':'transparent'});
      $(allId).css({'color':'gold','background-color':'black'});
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
    let typeRowId = "#typeRow_" + event.target.dataset.pendtype;
    if (typeLength == 0) {
      $(typeRowId).after("<div id='emptyBox_"+event.target.dataset.pendtype+"' class='postBox' style='text-align:center'>There are no posts waiting for approval at this time.<div>");
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

  // Opens/closes where the section's current staff can be seen
  $("#listTitle").click(() => {
    if ($("#listBox").css('display') == 'block') {
      $("#listBox").css('display','none');
    } else {
      $("#listBox").css('display','block');
    };
    $("#dptDirBox").css('display','none');
    $("#assignJobBox").css('display','none');
    $("#updateDirBox").css('display','none');
  });

  // Opens/closes where a job is assigned to a delegate (if they are already in the directory)
  $("#assignJobTitle").click(() => {
    if ($("#assignJobBox").css('display') == 'block') {
      $("#assignJobBox").css('display','none');
    } else {
      $("#assignJobBox").css('display','block');
    };
    $("#dptDirBox").css('display','none');
    $("#listBox").css('display','none');
    $("#updateDirBox").css('display','none');
  });

  // Opens/closes the delegate directory for changes/deletes
  $("#updateDirTitle").click(() => {
    if ($("#updateDirBox").css('display') == 'block') {
      $("#updateDirBox").css('display','none');
    } else {
      $("#updateDirBox").css('display','block');
    };
    $("#dptDirBox").css('display','none');
    $("#listBox").css('display','none');
    $("#assignJobBox").css('display','none');
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

  // Opens/closes where Departments are listed
  $("#dptTitle").click(()=>{
    if ($("#dptBox").css('display') == 'block') {
      $("#dptBox").css('display','none');
    } else {
      $("#dptBox").css('display','block');
    };
    $("#updateDirBox").css('display','none');
    $("#listBox").css('display','none');
    $("#assignJobBox").css('display','none');
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

  // Opens/closes the Department directory's options
  $("#dptTitle").click(()=> {
    if ($("#dptDirBox").css('display') == 'block') {
      $("#dptDirBox").css('display','none');
    } else {
      $("#dptDirBox").css('display','block');
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

  // Counts down the time until the session expires
  // let currentMin = $("#timeMin").text();
  // let currentSec = currentMin * 60;
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
    console.log(currentMin + ":" + currentRemainder);
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
