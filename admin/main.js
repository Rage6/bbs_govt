$(()=>{
  console.log("testing admin/main.js");

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

  // Opens and closes 'DELETE' boxes
  $("[data-post]").click(() => {
    let delBttnId = "#" + event.target.id;
    let delBttnNum = $(delBttnId).attr('data-post');
    let delBoxId = "#delBox" + delBttnNum;
    let displayStatus = $(delBoxId).css('display');
    if (displayStatus == "block") {
      $(delBoxId).css('display','none');
    } else {
      $(delBoxId).css('display','block');
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
  let currentMin = $("#timeMin").text();
  let currentSec = currentMin * 60;
  let interval = null;
  $(document).ready(() => {
    interval = setInterval(tickDown,1000);
  });
  const tickDown = () => {
    currentSec--;
    currentMin = Math.floor(currentSec / 60);
    currentRemainder = currentSec - (currentMin * 60);
    if (currentRemainder < 10) {
      currentRemainder = "0" + currentRemainder;
    };
    if (currentMin < 10) {
      currentMin = "0" + currentMin;
    };
    if (currentMin == 2 && currentRemainder == 0) {
      $("#refInfoBar").css('background-color','orange').css('black','orange');
    };
    if (currentMin == 1 && currentRemainder == 0) {
      $("#refInfoBar").css('background-color','red').css('color','white');
    };
    $("#timeMin").text(currentMin + ":" + currentRemainder);
    if (currentSec < 0) {
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
