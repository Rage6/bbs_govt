$(()=>{
  // console.log("testing");
  // Opens and closes the menu options
  $("#menuClick").click(()=>{
    if (window.innerWidth < 769) {
      if ($("#menuContent").css("display") == "block") {
        $("#menuContent").css("display","none");
      } else {
        $("#menuContent").css("display","block");
      };
    };
  });

  // Closes the menu options when an option is selected
  $("div.menuButton").click(()=>{
    if (window.innerWidth < 769) {
      $("#menuContent").css("display","none");
    };
  });

  // The following will make the window slide down to the selected option, rather than it suddently changing
  const slideDown = (contentId,msec) => {
    // let screenTop = $(window).scrollTop();
    let contentTop = $(contentId).offset().top;
    $('html, body').animate({
      scrollTop: contentTop
    }, msec)
  };
  $("#govLink").click(()=>{
    slideDown("#govTop",500);
  });
  $("#electedLink").click(()=>{
    slideDown("#electedTop",600);
  });
  $("#goalLink").click(()=>{
    slideDown("#goalTop",700);
  });
  $("#agencyLink").click(()=>{
    slideDown("#agencyTop",800);
  });
  $("#reportLink").click(()=>{
    slideDown("#reportTop",900);
  });

  // Gives each .attr() to each element
  const agencyCount = $(".agencyContent").length;
  for (let a = 0; a <= agencyCount; a++) {
    $("#agencyBtn"+a).attr("data-agency",a);
  };

  // This finds the clicked agency element (aka "event") and uses it to show or hide that agency's content box
  // NOTE: This MUST follow the creation of the "agencyCount" variable above
  // NOTE: This only functions for tablets, phones because bigger screens have enough space for the content all the time
  $("[data-agency]").click((event)=>{
    if (window.innerWidth < 769) {
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
    } else {
      $(".agencyContent").css('display','block');
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

})
