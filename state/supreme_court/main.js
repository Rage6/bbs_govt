$(()=>{

  console.log("supreme_court/main.js is working");

  // To open/close the options with the menuBttn on the top
  $("#menuBttn").click(()=>{
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

  // The following will make the window slide down to the selected option, rather than it suddently changing
  const slideDown = (contentId,msec) => {
    // let screenTop = $(window).scrollTop();
    let contentTop = $(contentId).offset().top;
    $('html, body').animate({
      scrollTop: contentTop
    }, msec)
  };
  $("#justiceLink").click(()=>{
    slideDown("#justiceTop",500);
  });
  $("#caseLink").click(()=>{
    slideDown("#caseTop",550);
  });
  $("#minutesLink").click(()=>{
    slideDown("#minutesTop",600);
  });
  $("#resultsLink").click(()=>{
    slideDown("#resultsTop",650);
  });
  $(".goTop").click(()=>{
    slideDown(".mainTitle",300);
  });

  // Selects the 'minutes' to see
  $("#minute1").css("color","white").css("background-color","black");
  $("#minuteCnt1").css("display","block");
  $("[data-day]").click((event)=>{
    $("#" + event.target.id).css("color","white").css("background-color","black");
    let minuteNum = parseInt($("#" + event.target.id).attr("data-day"));
    $("#minuteCnt" + minuteNum).css("display","block");
    for (let c = 1; c < 6; c++) {
      if (c != minuteNum) {
        $("#minute" + c).css("color","black").css("background-color","transparent");
        $("#minuteCnt" + c).css("display","none");
      };
    };
  });

})
