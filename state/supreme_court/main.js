$(()=>{

  console.log("supreme_court/main.js is working");

  // To open/close the options with the menuBttn on the top
  $("#mainMenu").click(()=>{
    if ($(".allOptions").css('display') == "none") {
      $(".allOptions").css('display','block');
    } else {
      $(".allOptions").css('display','none');
    };
  });

  // Closes the menu options when an option is selected
  $("div.optionBttn").click(()=>{
    if (window.innerWidth < 769) {
      $(".allOptions").css("display","none");
    };
  });

  // Selects the 'minutes' to see
  $("#minute1").css("color","#2020a0").css("background-color","#fec231");
  $("#minuteCnt1").css("display","block");
  $("[data-day]").click((event)=>{
    $("#" + event.target.id).css("color","#2020a0").css("background-color","#fec231");
    let minuteNum = parseInt($("#" + event.target.id).attr("data-day"));
    $("#minuteCnt" + minuteNum).css("display","block");
    for (let c = 1; c < 6; c++) {
      if (c != minuteNum) {
        $("#minute" + c).css("color","#fec231").css("background-color","#2020a0");
        $("#minuteCnt" + c).css("display","none");
      };
    };
  });

})
