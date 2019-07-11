$(()=>{
  console.log("testing admin/main.js");

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
    $("#listBox").css('display','none');
    $("#updateDirBox").css('display','none');
  });

  // Opens/closes the current directory for changes/deletes
  $("#updateDirTitle").click(() => {
    if ($("#updateDirBox").css('display') == 'block') {
      $("#updateDirBox").css('display','none');
    } else {
      $("#updateDirBox").css('display','block');
    };
    $("#listBox").css('display','none');
    $("#assignJobBox").css('display','none');
  });

  // Opens/closes where delegates can be added to the directory
  $("#addDirTitle").click(() => {
    if ($("#addDirBox").css('display') == 'block') {
      $("#addDirBox").css('display','none');
    } else {
      $("#addDirBox").css('display','block');
    };
  });

  $("[data-delId][data-act]").click(()=>{
    let boxId = null;
    let nonBox = null;
    if (event.target.dataset.act == "chgBttn") {
      boxId = "#chgBox" + event.target.dataset.delid;
      nonBox = "#delBox" + event.target.dataset.delid;
      console.log("clicked on chgBttn");
    } else if (event.target.dataset.act == "delBttn") {
      boxId = "#delBox" + event.target.dataset.delid;
      nonBox = "#chgBox" + event.target.dataset.delid;
      console.log("clicked on delBttn");
    };
    if ($(boxId).css('display') == 'block') {
      $(boxId).css('display','none');
      console.log("switched "+boxId+" to none");
    } else {
      $(boxId).css('display','block');
      console.log("switched "+boxId+" to table-row");
    };
    $(nonBox).css('display','none');
  });

});
