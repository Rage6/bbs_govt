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
    let windowWidth = $(window).width();
    if (windowWidth < 768) {
      let title = event.target.dataset.title;
      let dataTitle = "[data-content='"+title+"']";
      let currentDisplay = $(dataTitle).css('display');
      $("[data-content]").css('display','none');
      if (currentDisplay == "none") {
        $(dataTitle).css('display','block');
      } else {
        $(dataTitle).css('display','none');
      };
    };
  });

  // Selecting level of jobs
  $("[data-level]").click(()=>{
    // Empties the old positions
    $("#chooseLevel").remove();
    $("#noPosit").remove();
    $(".onePosition").remove();
    // Empties any old events, replaces with default words
    $("#chooseJob").remove();
    $(".oneEvent").remove();
    $("#positionEvents").append("<i id='chooseJob'>Choose an elected position...</i>");
    // Empties the last description, replaces with default words
    $("#positionDescrip").empty();
    $("#positionDescrip").append("<i id='chooseStep'>Choose a step in that process...</i>");
    // The selected 'level' shows which was clicked on...
    let level = event.target.dataset.level;
    $("[data-level]").css('background-color','black');
    event.target.style.backgroundColor = "darkred";
    let noPosit = true;
    // ...then adds/shows the appropriate positions...
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
        // ...while binding them to a function that...
        $("#positionList").on("click","[data-positid='"+position[positNum].positionID+"']",function(){
          $("[data-positid]").css('color','gold').css('background-color','darkred');
          $("[data-positid='"+position[positNum].positionID+"']").css("color","darkred").css("background-color","gold");
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
                // ...will show that position's steps for elected. Each new step is then...
                $("#positionEvents").append("\
                  <div \
                    data-eventid='"+steps[stepNum].eventID+"' \
                    class='oneEvent'>\
                      "+orderNum+") "+steps[stepNum].eventName+"\
                  </div>");
                $("#positionEvents").on("click","[data-eventid='"+steps[stepNum].eventID+"']",function(){
                  // console.log(steps[stepNum].description);
                  $("[data-eventid]").css("color","gold").css("background-color","darkred");
                  $("[data-eventid='"+steps[stepNum].eventID+"']").css("color","darkred").css("background-color","gold");
                  $("#positionDescrip").empty();
                  $("#positionDescrip").append(steps[stepNum].description);
                });
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
        <div id='noPosit' class='noPosit'>NO POSITIONS FOUND</div>\
      ");
    };
  });

  // Object of all possible elected positions
  const position = [
    {
      positionID: 1,
      name: "Governor",
      level: "state",
      fee: 700,
      paired: "The Governor must run with a Lt. Governor.",
      eventList: [3,4,5,6,18,19,21,22,23,24,25]
    },
    {
      positionID: 2,
      name: "Lieutenant Governor",
      level: "state",
      fee: 700,
      paired: "The Lt. Governor must run with a Governor. His campaign fee is combined with that of the Governor, for a total of $700.",
      eventList: [3,4,5,6,18,19,21,22,23,24,25]
    },
    {
      positionID: 3,
      name: "Attorney General",
      level: "state",
      fee: 300,
      eventList: [3,4,5,8,18,19,21,22,23,24,25]
    },
    {
      positionID: 4,
      name: "Treasurer",
      level: "state",
      fee: 300,
      eventList: [3,4,5,8,18,19,21,22,23,24,25]
    },
    {
      positionID: 5,
      name: "Auditor",
      level: "state",
      fee: 300,
      eventList: [3,4,5,8,18,19,21,22,23,24,25]
    },
    {
      positionID: 6,
      name: "Secretary of State",
      level: "state",
      fee: 300,
      eventList: [3,4,5,8,18,19,21,22,23,24,25]
    },
    {
      positionID: 7,
      name: "Chief Justice",
      level: "state",
      fee: 400,
      eventList: [3,26,4,5,7,18,19,21,27,22,28,23,24,25]
    },
    {
      positionID: 8,
      name: "Associate Justice",
      level: "state",
      fee: 300,
      eventList: [3,26,4,5,8,18,19,21,27,22,28,23,24,25]
    },
    {
      positionID: 9,
      name: "Judge of the Court of Appeals",
      level: "state",
      fee: 200,
      eventList: [3,26,4,5,9,18,19,21,27,22,28,23,24,25]
    },
    {
      positionID: 10,
      name: "State Senator",
      level: "state",
      fee: 75,
      eventList: [5,11,15,16,18,20,24,25]
    },
    {
      positionID: 11,
      name: "State Representative",
      level: "state",
      fee: 75,
      eventList: [5,11,15,16,18,20,24,25]
    },
    {
      positionID: 12,
      name: "Commissioner",
      level: "county",
      fee: 150,
      eventList: [14,17,5,10,18,20,24,25]
    },
    {
      positionID: 13,
      name: "Treasurer",
      level: "county",
      fee: 150,
      eventList: [14,17,5,10,18,20,24,25]
    },
    {
      positionID: 14,
      name: "Engineer",
      level: "county",
      fee: 150,
      eventList: [14,17,5,10,18,20,24,25]
    },
    {
      positionID: 15,
      name: "Recorder",
      level: "county",
      fee: 150,
      eventList: [14,17,5,10,18,20,24,25]
    },
    {
      positionID: 16,
      name: "Auditor",
      level: "county",
      fee: 150,
      eventList: [14,17,5,10,18,20,24,25]
    },
    {
      positionID: 17,
      name: "Prosecuting Attorney",
      level: "county",
      fee: 150,
      eventList: [14,17,5,10,18,20,24,25]
    },
    {
      positionID: 18,
      name: "Clerk of Courts",
      level: "county",
      fee: 150,
      eventList: [14,17,5,10,18,20,24,25]
    },
    {
      positionID: 19,
      name: "Judge of Municipal Court",
      level: "county",
      fee: 150,
      eventList: [14,17,5,10,18,20,26,27,28,24,25]
    },
    {
      positionID: 20,
      name: "Judge of the Court of Common Pleas",
      level: "county",
      fee: 150,
      eventList: [14,17,5,10,18,20,26,27,28,24,25]
    },
    {
      positionID: 21,
      name: "State School Board Member",
      level: "county",
      fee: 1,
      eventList: [14,17,5,13,18,20,24,25]
    },
    {
      positionID: 22,
      name: "Mayor",
      level: "city",
      fee: 50,
      eventList: [15,16,5,12,18,20,24,25]
    },
    {
      positionID: 23,
      name: "Treasurer",
      level: "city",
      fee: 50,
      eventList: [15,16,5,12,18,20,24,25]
    },
    {
      positionID: 24,
      name: "Auditor",
      level: "city",
      fee: 50,
      eventList: [15,16,5,12,18,20,24,25]
    },
    {
      positionID: 25,
      name: "Director of Law",
      level: "city",
      fee: 50,
      eventList: [26,15,16,5,12,18,20,27,24,28,25]
    },
    {
      positionID: 26,
      name: "Councilman",
      level: "city",
      fee: 50,
      eventList: [15,16,5,12,18,20,24,25]
    },
    {
      positionID: 27,
      name: "City School Board Member",
      level: "city",
      fee: 1,
      eventList: [15,16,5,13,18,20,24,25]
    },
  ];

  // Object of all possible events during the election process
  const steps = [
    {
      eventID: 3,
      eventName: "Pick up a petition",
      description: "The completed list of petitions and all other necessary paperwork must be turned in by 5:30pm on Day 2 (Monday).",
      time: "Everything must be turned in by 5:30pm on Day 2 (Monday)."
    },
    {
      eventID: 4,
      eventName: "Recieve 54 nomination signatures",
      description: "Each of the candidates that turned in their completed paperwork & fees for a state-level position will have a brief time in which to give their name and speak to their entire party at this time. They will speak individually, not as a forum or a debate.",
      crowd: "Half of the BBS population will be present at each rally.",
      time: "The rally takes place on Day 2 (Monday) in the evening."
    },
    {
      eventID: 5,
      eventName: "Track all of your campaign's expenses/contributions",
      description: "The completed list of petitions and all other necessary paperwork must be turned in by 5:30pm on Day 2 (Monday).",
      time: "Everything must be turned in by 5:30pm on Day 2 (Monday)."
    },
    {
      eventID: 6,
      eventName: "Pay $700 for the Governor & Lt. Governor fee (in total)",
      description: "Testing",
      time: ""
    },
    {
      eventID: 7,
      eventName: "Pay $400 fee",
      description: "Testing",
      time: ""
    },
    {
      eventID: 8,
      eventName: "Pay $300 fee",
      description: "Testing",
      time: ""
    },
    {
      eventID: 9,
      eventName: "Pay $200 fee",
      description: "Testing",
      time: ""
    },
    {
      eventID: 10,
      eventName: "Pay $150 fee",
      description: "Testing",
      time: ""
    },
    {
      eventID: 11,
      eventName: "Pay $75 fee",
      description: "Testing",
      time: ""
    },
    {
      eventID: 12,
      eventName: "Pay $50 fee",
      description: "Testing",
      time: ""
    },
    {
      eventID: 13,
      eventName: "Pay $1 fee",
      description: "Testing",
      time: ""
    },
    {
      eventID: 14,
      eventName: "Recieve a nomination during county party caucus",
      description: "Testing",
      time: ""
    },
    {
      eventID: 15,
      eventName: "Recieve a nomination during city party caucus",
      description: "Testing",
      time: ""
    },
    {
      eventID: 16,
      eventName: "Win the majority of the votes during the city caucus",
      description: "Testing",
      time: ""
    },
    {
      eventID: 17,
      eventName: "Win the majority of the votes during the county caucus",
      description: "Testing",
      time: ""
    },
    {
      eventID: 18,
      eventName: "Fill out the Declaration of Candidacy (DoC) form",
      description: "Testing",
      time: ""
    },
    {
      eventID: 19,
      eventName: "Submit the completed DoC, fee, and petition",
      description: "Testing",
      time: ""
    },
    {
      eventID: 20,
      eventName: "Submit the completed DoC and fee",
      description: "Testing",
      time: ""
    },
    {
      eventID: 21,
      eventName: "Speak at the state party caucus",
      description: "Testing",
      time: ""
    },
    {
      eventID: 22,
      eventName: "Win the Primary Elections",
      description: "Testing",
      time: ""
    },
    {
      eventID: 23,
      eventName: "Participate in the state debate",
      description: "Testing",
      time: ""
    },
    {
      eventID: 24,
      eventName: "Win the General Elections",
      description: "Testing",
      time: ""
    },
    {
      eventID: 25,
      eventName: "Submit the complete 'Campaign Contribution & Expenditure' form",
      description: "Testing",
      time: ""
    },
    {
      eventID: 26,
      eventName: "Take BAR exam (1st attempt)",
      description: "Testing",
      time: ""
    },
    {
      eventID: 27,
      eventName: "Take BAR exam (2nd attempt)",
      description: "Testing",
      time: ""
    },
    {
      eventID: 28,
      eventName: "Take BAR exam (final attempt)",
      description: "Testing",
      time: ""
    }
  ];

});
