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

});
