$(()=>{

  // *** GOVERNOR PAGE --- START

  // Opens and closes the menu options
  $("#menuClick").click(()=>{
    if ($("#menuContent").css("display") == "block") {
      $("#menuContent").css("display","none");
    } else {
      $("#menuContent").css("display","block");
    };
  });

  // Closes the menu options when an option is selected
  $("div.menuButton").click(()=>{
    $("#menuContent").css("display","none")
  });

  // Starts all .agencyContent as hidden
  $(".agencyContent").css("display","none");

  // Gives each .attr() to each element
  const agencyCount = $(".agencyContent").length;
  for (let a = 0; a <= agencyCount; a++) {
    $("#agencyBtn"+a).attr("data-agency",a);
  };

  // This finds the clicked agency element (aka "event") and uses it to show or hide that agency's content box
  // NOTE: This MUST follow the creation of the "agencyCount" variable
  $("[data-agency]").click((event)=>{
    let agencyNum = event.target.dataset.agency;
    let agencyBtnId = "#" + event.target.id;
    let agencyCntId = "#agencyCnt" + agencyNum;
    if ($(agencyCntId).css("display") == "none") {
      $(agencyCntId).css("display","block");
    } else {
      $(agencyCntId).css("display","none");
    };
    for (let b = 0; b < agencyCount; b++) {
      if ("#agencyBtn" + b != agencyBtnId) {
        $("#agencyCnt" + b).css("display","none");
      };
    };
  });

  // Similar to 'agency' selection, this selects one of the  Daily Report
  $("#report1").css("color","#2020a0").css("background-color","gold");
  $("#reportCnt1").css("display","block");
  $("[data-day]").click((event)=>{
    $("#" + event.target.id).css("color","#2020a0").css("background-color","gold");
    let reportNum = parseInt($("#" + event.target.id).attr("data-day"));
    $("#reportCnt" + reportNum).css("display","block");
    for (let c = 1; c < 6; c++) {
      if (c != reportNum) {
        $("#report" + c).css("color","gold").css("background-color","#2020a0");
        $("#reportCnt" + c).css("display","none");
      };
    };
  });

  // GOVERNOR PAGE --- END

})
