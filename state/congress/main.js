$(()=>{

  // For selecting the House of Reps initially
  $("#repClick").click(()=>{
    $(".entranceBox").fadeOut(500);
    setTimeout(function() {
      $(".entranceBox").css('display','none');
    }, 1500);
    setTimeout(function() {
      $(".houseBox").css('display','block');
    }, 2000);
    $(".houseBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s")
      .css("animation-name","toRedBox");
  });

  // From the Senate box back to the entrance box
  $("#senateToCenter").click(()=>{
    $(".wholeBox").css("background-position-x","100%");
    $(".senateBox").fadeOut(500);
    setTimeout(function() {
      $(".senateBox").css('display','none');
    }, 1500);
    setTimeout(function() {
      $(".entranceBox").css('display','block');
    }, 2000);
    $(".entranceBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s")
      .css("animation-name","blueToCenter");
    setTimeout(function() {
      $(".wholeBox").css('background-position-x','50%');
    }, 2000);
  });

  // For selecting the Senate initially
  $("#senClick").click(()=>{
    $(".entranceBox").fadeOut(500);
    setTimeout(function() {
      $(".entranceBox").css('display','none');
    }, 1500);
    setTimeout(function() {
      $(".senateBox").css('display','block');
    }, 1500);
    $(".senateBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s").css("animation-name","toBlueBox")
      .css("animation-name","toBlueBox");
  });

  // For returning from the House of Reps to the entrance
  $("#repToCenter").click(()=>{
    $(".wholeBox").css("background-position-x","0%");
    $(".houseBox").fadeOut(500);
    setTimeout(function() {
      $(".houseBox").css('display','none');
    }, 1500);
    setTimeout(function() {
      $(".entranceBox").css('display','block');
    }, 2000);
    $(".entranceBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s")
      .css("animation-name","redToCenter");
    setTimeout(function() {
      $(".wholeBox").css('background-position-x','50%');
    }, 2000);
  });

})
