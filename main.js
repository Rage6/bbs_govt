$(()=>{

  // Opens and closes the menu options
  $("#menuClick").click(()=>{
    if ($("#menuContent").css("display") == "block") {
      $("#menuContent").css("display","none");
      console.log($("#menuContent").css("display"));
    } else {
      $("#menuContent").css("display","block");
      console.log($("#menuContent").css("display"));
    };
  });

  // Closes the menu options when an option is selected
  $("div.menuButton").click(()=>{
    $("#menuContent").css("display","none")
  })

})
