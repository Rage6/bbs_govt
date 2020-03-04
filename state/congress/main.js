$(()=>{

  console.log("main.js is working...");

  // To adjust the 'body' height when swapping boxes
  const setBodyHeight = (boxCSS) => {
    let currentBoxHeight = $(boxCSS).outerHeight();
    if ($(window).outerHeight() < currentBoxHeight) {
      $("body").css('height',currentBoxHeight);
    } else {
      $("body").css('height','100%');
    };
  };

  // For selecting the House of Reps initially
  $("#repClick").click(()=>{
    $(".entranceBox").fadeOut(500);
    setTimeout(function() {
      $(".entranceBox").css('display','none');
    }, 1500);
    setTimeout(function() {
      $(".houseBox").css('display','block');
    }, 2000);
    setBodyHeight(".houseBox");
    $(".houseBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s")
      .css("animation-name","toRedBox");
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
    setBodyHeight(".entranceBox");
    $(".entranceBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s")
      .css("animation-name","redToCenter");
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
      let senInitHeight = $(".senMenu").outerHeight() * (-1);
      $(".senMenu").css("top",senInitHeight).css("display","block");
      setBodyHeight(".senateBox");
    }, 2000);
    // setBodyHeight(".senateBox");
    $(".senateBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s")
      .css("animation-name","toBlueBox");
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
      setBodyHeight(".entranceBox");
    }, 2000);
    // setBodyHeight(".entranceBox");
    $(".entranceBox").delay(1500).fadeIn(500);
    $(".wholeBox")
      .css("animation-delay","0.5s")
      .css("animation-duration","1s")
      .css("animation-name","blueToCenter");
    setTimeout(function() {
      $(".wholeBox").css('background-position-x','50%');
    }, 2000);
  });

  // Slides the Senate menu up and down
  let slidDown = false;
  const useSenMenu = () => {
    let menuHeight = $(".senMenu").outerHeight();
    let bttnRowHeight = $(".bothTopBttns").outerHeight();
    let totalDistance = bttnRowHeight + menuHeight;
    if (slidDown == false) {
      let translateY = "translateY(" + totalDistance + "px)";
      $(".senMenu").css("transform", translateY);
      slidDown = true;
    } else {
      let translateY = "translateY(0px)";
      $(".senMenu").css("transform", translateY);
      slidDown = false;
    };
  };

  $("#senMenuClick").click(()=>{
    useSenMenu();
  });

  // Slides window down to selected module
  const scrollToOption = (moduleBox,msec) => {
    let moduleTop = $(moduleBox).offset().top;
    $('html, body').animate({
      scrollTop: moduleTop
    }, msec);
  };
  // Slide to Majority Leaders
  $("#senMajClick").click(() => {
    scrollToOption("#senMajBox",500);
    useSenMenu();
  });
  // Slide to Minority Leaders
  $("#senMinClick").click(() => {
    scrollToOption("#senMinBox",700);
    useSenMenu();
  });
  // Slide to Minority Leaders
  $("#senBillClick").click(() => {
    scrollToOption("#senBillBox",700);
    useSenMenu();
  });
  // Send window back to the top of the page
  $(".senTopBttn").click(() => {
    scrollToOption(".senateBox",500);
  });

  //

})
