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
    setTimeout(function() {
      $(".wholeBox").css("background-image","linear-gradient(to right, #dc2121, #dc2121 48%, white 48%, white 52%, #00467f 52%)");
    }, 2000);
  });

  // For selecting the House of Reps from the Senate box
  $("#repTab").click(()=>{
    $(".wholeBox").css("background-position-x","100%");
    $(".senateBox").fadeOut(500);
    setTimeout(function() {
      $(".senateBox").css('display','none');
    }, 1500);
    setTimeout(function() {
      $(".houseBox").css('display','block');
    }, 2000);
    $(".houseBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s")
      .css("animation-name","blueToRed");
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
    setTimeout(function() {
      $(".wholeBox").css("background-image","linear-gradient(to right, #dc2121, #dc2121 48%, white 48%, white 52%, #00467f 52%)");
    }, 2000);
  });

  // For selecting the Senate from the House of Reps box
  // THIS ID HASN'T BEEN MADE YET (15FEB2020)
  $("#senTab").click(()=>{
    $(".wholeBox").css("background-position-x","0%");
    $(".houseBox").fadeOut(500);
    setTimeout(function() {
      $(".houseBox").css('display','none');
    }, 1500);
    setTimeout(function() {
      $(".senateBox").css('display','block');
    }, 2000);
    $(".senateBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s")
      .css("animation-name","redToBlue");
  });

})
