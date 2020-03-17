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
      let horInitHeight = $(".repMenu").outerHeight() * (-1);
      $(".repMenu").css("top",horInitHeight).css("display","block");
      setBodyHeight(".houseBox");
    }, 2000);
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
      setBodyHeight(".entranceBox");
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
  let senSlidDown = false;
  const useSenMenu = () => {
    let menuHeight = $(".senMenu").outerHeight();
    let bttnRowHeight = $(".senBothTopBttns").outerHeight();
    let totalDistance = bttnRowHeight + menuHeight;
    if (senSlidDown == false) {
      let translateY = "translateY(" + totalDistance + "px)";
      $(".senMenu").css("transform", translateY);
      senSlidDown = true;
    } else {
      let translateY = "translateY(0px)";
      $(".senMenu").css("transform", translateY);
      senSlidDown = false;
    };
  };

  $("#senMenuClick").click(()=>{
    useSenMenu();
  });

  // Slides the HoR menu up and down
  let repSlidDown = false;
  const useRepMenu = () => {
    let menuHeight = $(".repMenu").outerHeight();
    let bttnRowHeight = $(".repBothTopBttns").outerHeight();
    let totalDistance = bttnRowHeight + menuHeight;
    if (repSlidDown == false) {
      let translateY = "translateY(" + totalDistance + "px)";
      $(".repMenu").css("transform", translateY);
      repSlidDown = true;
    } else {
      let translateY = "translateY(0px)";
      $(".repMenu").css("transform", translateY);
      repSlidDown = false;
    };
  };

  $("#repMenuClick").click(()=>{
    useRepMenu();
  });

  // Slides window down to selected module
  const scrollToOption = (moduleBox,msec) => {
    let moduleTop = $(moduleBox).offset().top;
    $('html, body').animate({
      scrollTop: moduleTop
    }, msec);
  };
  // Slide to Senate Majority Leaders
  $("#senMajClick").click(() => {
    scrollToOption("#senMajBox",500);
    useSenMenu();
  });
  // Slide to Senate Minority Leaders
  $("#senMinClick").click(() => {
    scrollToOption("#senMinBox",700);
    useSenMenu();
  });
  // Slide to Senate Bills
  $("#senBillClick").click(() => {
    scrollToOption("#senBillBox",900);
    useSenMenu();
  });
  // Slide to Laws on Senate page
  $("#senLawClick").click(()=> {
    scrollToOption("#senLawBox",1100);
    useSenMenu();
  });
  // Slide to Senate Committees
  $("#senCommitteeClick").click(()=> {
    scrollToOption("#senCommitteeBox",1300);
    useSenMenu();
  });
  // Slide to the list of Senators
  $("#senMemberClick").click(()=> {
    scrollToOption("#senMemberBox",1500);
    useSenMenu();
  });
  // Send window back to the top of the Senate page
  $(".senTopBttn").click(() => {
    scrollToOption(".senateBox",500);
  });
  // Slide to House Majority Leaders
  $("#repMajClick").click(() => {
    scrollToOption("#repMajBox",500);
    useRepMenu();
  });
  // Slide to House Minority Leaders
  $("#repMinClick").click(() => {
    scrollToOption("#repMinBox",700);
    useRepMenu();
  });
  // Slide to House Bills
  $("#repBillClick").click(() => {
    scrollToOption("#repBillBox",900);
    useRepMenu();
  });
  // Slide to Laws on House page
  $("#repLawClick").click(()=> {
    scrollToOption("#repLawBox",1100);
    useRepMenu();
  });
  // Slide to House Committees
  $("#repCommitteeClick").click(()=> {
    scrollToOption("#repCommitteeBox",1300);
    useRepMenu();
  });
  // Slide to the list of Representatives
  $("#repMemberClick").click(()=> {
    scrollToOption("#repMemberBox",1500);
    useRepMenu();
  });
  // Send window back to the top of the House page
  $(".repTopBttn").click(() => {
    scrollToOption(".houseBox",500);
  });

  // Function that shows an answer to the 'Laws' questions
  const showAnswer = (answerBox) => {
    if ($(answerBox).css('display') == 'none') {
      $(".answer").css('display','none');
      $(answerBox).css('display','block');
    } else {
      $(".answer").css('display','none');
    };
  };
  // Show how a Senate bill becomes a law
  $("#viewSenBillClick").click(()=>{
    showAnswer("#viewSenBillBox");
    setBodyHeight(".senateBox");
  });
  // Shows how to view a law's details in the Senate page
  $("#viewSenReadClick").click(()=>{
    showAnswer("#viewSenReadBox");
    setBodyHeight(".senateBox");
  });
  // Shows how to view a Senate committee's purpose and senator in charge
  $("#viewSenCommClick").click(()=>{
    showAnswer("#viewSenCommBox");
    setBodyHeight(".senateBox");
  });
  // Show how a House bill becomes a law
  $("#viewRepBillClick").click(()=>{
    showAnswer("#viewRepBillBox");
    setBodyHeight(".houseBox");
  });
  // Shows how to view a law's details in the House page
  $("#viewRepReadClick").click(()=>{
    showAnswer("#viewRepReadBox");
    setBodyHeight(".houseBox");
  });
  // Shows how to view a House committee's purpose and rep in charge
  $("#viewRepCommClick").click(()=>{
    showAnswer("#viewRepCommBox");
    setBodyHeight(".houseBox");
  });

  // Function that shows the content of a clicked committee title
  $("[data-dptid]").click(()=>{
    let thisDptId = event.target.dataset.dptid;
    let thisType = event.target.dataset.chambertype;
    let isOpen;
    if ($(".commContent[data-dptid='"+thisDptId+"']").css('display') == 'block') {
      isOpen = true;
    } else {
      isOpen = false;
    };
    const commSenColors = {
      titleColor: '#fec231',
      titleBkgd: '#8C130E'
    };
    const commRepColors = {
      titleColor: '#fec231',
      titleBkgd: '#004E8C'
    };
    let selectColors = null;
    if (thisType == 'senate') {
      selectColors = commSenColors;
    } else {
      selectColors = commRepColors;
    };
    $(".commTitle[data-chambertype='senate']")
      .css('color',commSenColors['titleColor'])
      .css('background-color',commSenColors['titleBkgd'])
      .css('border-bottom','none');
    $(".commTitle[data-chambertype='house']")
      .css('color',commRepColors['titleColor'])
      .css('background-color',commRepColors['titleBkgd'])
      .css('border-bottom','none');
    $(".commContent")
      .css('display','none');
    if (isOpen == false) {
      $(".commTitle[data-dptid='"+thisDptId+"']")
        .css('color',selectColors['titleBkgd'])
        .css('background-color',selectColors['titleColor'])
        .css('border-bottom','1px solid #fec231');
      $(".commContent[data-dptid='"+thisDptId+"']")
        .css('display','block');
      // console.log($(".commContent[data-dptid='"+thisDptId+"']").css('display'));
    } else {
      $(".commTitle[data-dptid='"+thisDptId+"']")
        .css('color',selectColors['titleColor'])
        .css('background-color',selectColors['titleBkgd'])
        .css('border-bottom','none');
      $(".commContent[data-dptid='"+thisDptId+"']")
        .css('display','none');
    };
    if (thisType == 'senate') {
      setBodyHeight(".senateBox");
    } else {
      setBodyHeight(".houseBox");
    };
  });

})
