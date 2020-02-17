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

  // For selecting the House of Reps from the Senate box
  // THIS ID HASN'T BEEN MADE YET (15FEB2020)
  $("#repTab").click(()=>{
    $(".wholeBox").css("animation-duration","2s").css("animation-name","blueToRed");
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
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s").css("animation-name","toBlueBox")
      .css("animation-name","toBlueBox");
    $(".senateBox").delay(1500).fadeIn(500);
  });

  // For selecting the Senate from the House of Reps box
  // THIS ID HASN'T BEEN MADE YET (15FEB2020)
  $("#senTab").click(()=>{
    $(".wholeBox").css("animation-duration","2s").css("animation-name","redToBlue");
  });

})
