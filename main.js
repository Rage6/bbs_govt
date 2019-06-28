$(()=>{

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

  // This finds the certain agency number of the 'event' (aka "the one you clicked on") and uses it to show or hide the certain agency content box
  $("[data-agency]").click(()=>{
    let agencyNum = event.target.dataset.agency;
    let agencyCntId = "#agencyCnt" + agencyNum;
    if ($(agencyCntId).css("display") == "none") {
      $(agencyCntId).css("display","block");
    } else {
      $(agencyCntId).css("display","none");
    };
  });

  // Open and close Department/Agency boxes
  const switchContent = ()=>{

  };

})
