$(()=>{
  console.log("login/main.js is functioning");

  // Opens/closes the info about why it locks out after 5 failed attempts
  $("#lockedBttn").click(()=>{
    console.log("lockedBttn works");
    if ($("#lockedInfo").css('display') == 'none') {
      $("#lockedInfo").css('display','block');
    } else {
      $("#lockedInfo").css('display','none');
    };
  });

  // To make sure that the 'Locked Out' bar is below the login form
  let bodyHeight = $("body").outerHeight(true);
  let windowHeight = $(window).outerHeight(true);
  if (windowHeight > bodyHeight) {
    let newHeight = windowHeight;
    $("body").css('height',newHeight).css('padding','0');
  };

});
