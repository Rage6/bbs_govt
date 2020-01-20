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

  // The function that
  // Closes the menu options when an option is selected
  $("div.optionBttn").click(()=>{
    if (window.innerWidth < 769) {
      $(".allOptions").css("display","none");
    };
  });
})
