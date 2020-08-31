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

  // Object of all possible elected positions
  const positions = {
    governor: {
      name: "Governor",
      level: "state",
      fee: 700,
      paired: "The Governor must run with a Vice Governor.",
      eventList: [1,2],
    },
    viceGovernor: {
      name: "Vice Governor",
      level: "state",
      fee: 700,
      paired: "The Vice Governor must run alongside a Governor.",
      eventList: [1,2]
    }
  };

  // Object of all possible events during the election process
  const phase = {
    statePetition: {
      eventID: 1,
      eventName: "Turn in completed petition forms",
      description: "The completed list of petitions and all other necessary paperwork must be turned in by 5:30pm on Day 2 (Monday).",
      time: "Everything must be turned in by 5:30pm on Day 2 (Monday)."
    },
    statePrimaryRally: {
      eventID: 2,
      eventName: "State primary election rally",
      description: "Each of the candidates that turned in their completed paperwork & fees for a state-level position will have a brief time in which to give their name and speak to their entire party at this time. They will speak individually, not as a forum or a debate.",
      crowd: "Half of the BBS population will be present at each rally.",
      time: "The rally takes place on Day 2 (Monday) in the evening."
    }
  };

  console.log(positions);
  console.log(phase);

});
