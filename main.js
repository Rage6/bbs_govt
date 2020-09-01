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

  // Shows or hides the clicked election topic
  let lastClicked = null;
  $("[data-title]").click(()=>{
    let title = event.target.dataset.title;
    let dataTitle = "[data-content='"+title+"']";
    let currentDisplay = $(dataTitle).css('display');
    $("[data-content]").css('display','none');
    if (currentDisplay == "none") {
      $(dataTitle).css('display','block');
    } else {
      $(dataTitle).css('display','none');
    };
  });

  // Selecting level of jobs
  $("[data-level]").click(()=>{
    $("#chooseLevel").remove();
    $("#noPosit").remove();
    $(".onePosition").remove();
    $("#chooseJob").remove();
    $(".oneEvent").remove();
    $("#positionEvents").append("<i id='chooseJob'>Choose an elected position...</i>");
    let level = event.target.dataset.level;
    let noPosit = true;
    for (let positNum = 0; positNum < position.length; positNum++) {
      if (level == position[positNum].level) {
        $("#positionList").append("\
          <div\
            data-positid='"+position[positNum].positionID+"'\
            data-eventlist='"+position[positNum].eventList+"'\
            class='onePosition'>\
              "+position[positNum].name+"\
          </div>\
        ");
        $("#positionList").on("click","[data-positid='"+position[positNum].positionID+"']",function(){
          $("#chooseJob").remove();
          $("#noEvent").remove();
          $(".oneEvent").remove();
          let eventStringList = event.target.dataset.eventlist;
          let eventList = eventStringList.split(',');
          let noEvent = true;
          let orderNum = 0;
          for (let eventNum = 0; eventNum < eventList.length; eventNum++) {
            for (let stepNum = 0; stepNum < steps.length; stepNum++) {
              if (eventList[eventNum] == steps[stepNum].eventID) {
                orderNum++;
                $("#positionEvents").append("<div data-eventid='"+steps[stepNum].eventID+"' class='oneEvent'>"+orderNum+") "+steps[stepNum].eventName+"</div>");
                noEvent = false;
              };
            };
          };
          if (noEvent == true) {
            $("#positionEvents").append("\
              <div id='noEvent'>NO EVENTS FOUND</div>\
            ");
          };
        });
        noPosit = false;
      };
    };
    if (noPosit == true) {
      $("#positionList").append("\
        <div id='noPosit'>NO POSITIONS FOUND</div>\
      ");
    };
  });

  // Selecting a job
  // $("[data-eventlist]").click(()=>{
  // const jobClick = () => {
  //   $("#chooseJob").remove();
  //   $("#noStep").remove();
  //   $(".oneEvent").remove();
  //   let eventStringList = event.target.dataset.eventlist;
  //   let eventList = eventStringList.split(',');
  //   // console.log("eventList");
  //   let noEvent = true;
  //   for (let stepNum = 0; stepNum < steps.length; stepNum++) {
  //     if (eventList == position[positNum].level) {
  //       $("#positionList").append("\
  //         <div data-eventlist='"+position[positNum].eventList+"' class='onePosition'>"+position[positNum].name+"</div>\
  //       ");
  //       noStep = false;
  //     };
  //   };
  //   if (noStep == true) {
  //     $("#positionList").append("\
  //       <div id='noStep'>NO POSITIONS FOUND</div>\
  //     ");
  //   };
  // };

  // Object of all possible elected positions
  const position = [
    {
      positionID: 1,
      name: "Governor",
      level: "state",
      fee: 700,
      paired: "The Governor must run with a Vice Governor.",
      eventList: [1,2],
    },
    {
      positionID: 2,
      name: "Vice Governor",
      level: "state",
      fee: 700,
      paired: "The Vice Governor must run alongside a Governor.",
      eventList: [1,2]
    }
  ];

  // Object of all possible events during the election process
  const steps = [
    {
      eventID: 1,
      eventName: "Turn in completed petition forms",
      description: "The completed list of petitions and all other necessary paperwork must be turned in by 5:30pm on Day 2 (Monday).",
      time: "Everything must be turned in by 5:30pm on Day 2 (Monday)."
    },
    {
      eventID: 2,
      eventName: "State primary election rally",
      description: "Each of the candidates that turned in their completed paperwork & fees for a state-level position will have a brief time in which to give their name and speak to their entire party at this time. They will speak individually, not as a forum or a debate.",
      crowd: "Half of the BBS population will be present at each rally.",
      time: "The rally takes place on Day 2 (Monday) in the evening."
    }
  ];

  console.log(position);
  console.log(steps);

});
