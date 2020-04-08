$(() => {
  console.log("index works");

  // Show or hide the GLOSSARY list
  $("#glossaryBttn").click(()=>{
    if ($("#glossaryBox").css('display') == 'none') {
      $("#glossaryBox").css('display','block');
    } else {
      $("#glossaryBox").css('display','none');
    };
  });

  // Makes the window slide down to the selected GLOSSARY option
  const slideDown = (contentId,msec) => {
    $(".glossaryBox").css('display','none');
    let contentTop = $(contentId).offset().top;
    $('html, body').animate({
      scrollTop: contentTop
    }, msec);
  };
  $("#numbersBttn").click(()=>{
    slideDown("#numbersTop",500);
  });
  $("#stateBttn").click(()=>{
    slideDown("#stateTop",500);
  });
  $("#countyBttn").click(()=>{
    slideDown("#countyTop",500);
  });
  $("#cityBttn").click(()=>{
    slideDown("#cityTop",500);
  });
  $("#electBttn").click(()=>{
    slideDown("#electTop",500);
  });
  $("#aboutBttn").click(()=>{
    slideDown("#aboutTop",500);
  });

});
