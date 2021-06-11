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
    $("[data-level]")
      .css('border','1px solid rgba(254,194,49,1)')
      .css('color','rgba(254,194,49,1)')
      .css('background-color','darkred');
    event.target.style.backgroundColor = "rgba(254,194,49,1)";
    event.target.style.color = "darkred";
    event.target.style.border = "1px solid darkred";
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
          $("[data-positid]").css('color','rgba(254,194,49,1)').css('background-color','darkred');
          $("[data-positid='"+position[positNum].positionID+"']").css("color","darkred").css("background-color","rgba(254,194,49,1)");
          $("#chooseJob").remove();
          $("#noEvent").remove();
          $("#positionDescrip").empty();
          $("#positionDescrip").append("\
            <i>Choose a step in that process...</i>\
          ");
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
                  $("[data-eventid]").css("color","rgba(254,194,49,1)").css("background-color","darkred");
                  $("[data-eventid='"+steps[stepNum].eventID+"']").css("color","darkred").css("background-color","rgba(254,194,49,1)");
                  $("#positionDescrip").empty();
                  $("#positionDescrip").append(steps[stepNum].description+" "+steps[stepNum].time);
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
      eventList: [3,4,6,18,19,5,21,22,23,24,25]
    },
    {
      positionID: 2,
      name: "Lieutenant Governor",
      level: "state",
      fee: 700,
      paired: "The Lt. Governor must run with a Governor. His campaign fee is combined with that of the Governor, for a total of $700.",
      eventList: [3,4,6,18,19,5,21,22,23,24,25]
    },
    {
      positionID: 3,
      name: "Attorney General",
      level: "state",
      fee: 300,
      eventList: [3,26,4,7,18,19,5,21,27,22,23,24,25]
      // eventList: [3,26,4,7,18,19,5,21,27,22,28,23,24,25]
    },
    {
      positionID: 4,
      name: "Treasurer",
      level: "state",
      fee: 300,
      eventList: [3,4,8,18,19,5,21,22,23,24,25]
    },
    {
      positionID: 5,
      name: "Auditor",
      level: "state",
      fee: 300,
      eventList: [3,4,8,18,19,5,21,22,23,24,25]
    },
    {
      positionID: 6,
      name: "Secretary of State",
      level: "state",
      fee: 300,
      eventList: [3,4,8,18,19,5,21,22,23,24,25]
    },
    {
      positionID: 7,
      name: "Chief Justice",
      level: "state",
      fee: 400,
      eventList: [3,26,4,7,18,19,5,21,27,22,23,24,25]
      // eventList: [3,26,4,7,18,19,5,21,27,22,28,23,24,25]
    },
    {
      positionID: 8,
      name: "Associate Justice",
      level: "state",
      fee: 300,
      eventList: [3,26,4,8,18,19,5,21,27,22,23,24,25]
      // eventList: [3,26,4,8,18,19,5,21,27,22,28,23,24,25]
    },
    {
      positionID: 9,
      name: "Judge of the Court of Appeals",
      level: "state",
      fee: 200,
      eventList: [3,26,4,9,18,19,5,21,27,22,23,24,25]
      // eventList: [3,26,4,9,18,19,5,21,27,22,28,23,24,25]
    },
    {
      positionID: 10,
      name: "State Senator",
      level: "state",
      fee: 75,
      eventList: [15,16,12,18,20,5,30,25]
    },
    {
      positionID: 11,
      name: "State Representative",
      level: "state",
      fee: 75,
      eventList: [15,16,12,18,20,5,30,25]
    },
    {
      positionID: 12,
      name: "Commissioner",
      level: "county",
      fee: 150,
      eventList: [17,10,18,20,5,29,30,25]
    },
    {
      positionID: 13,
      name: "Treasurer",
      level: "county",
      fee: 150,
      eventList: [17,10,18,20,5,29,30,25]
    },
    {
      positionID: 14,
      name: "Engineer",
      level: "county",
      fee: 150,
      eventList: [17,10,18,20,5,29,30,25]
    },
    {
      positionID: 15,
      name: "Recorder",
      level: "county",
      fee: 150,
      eventList: [17,10,18,20,5,29,30,25]
    },
    {
      positionID: 16,
      name: "Auditor",
      level: "county",
      fee: 150,
      eventList: [17,10,18,20,5,29,30,25]
    },
    {
      positionID: 17,
      name: "Prosecuting Attorney",
      level: "county",
      fee: 150,
      eventList: [17,10,18,20,5,26,29,27,30,25]
      // eventList: [17,10,18,20,5,26,29,27,30,28,25]
    },
    {
      positionID: 18,
      name: "Clerk of Courts",
      level: "county",
      fee: 150,
      eventList: [17,10,18,20,5,29,30,25]
    },
    {
      positionID: 19,
      name: "Judge of Municipal Court",
      level: "county",
      fee: 150,
      eventList: [17,10,18,20,5,26,29,27,30,25]
      // eventList: [17,10,18,20,5,26,29,27,30,28,25]
    },
    {
      positionID: 20,
      name: "Judge of the Court of Common Pleas",
      level: "county",
      fee: 150,
      eventList: [17,10,18,20,5,26,29,27,30,25]
      // eventList: [17,10,18,20,5,26,29,27,30,28,25]
    },
    {
      positionID: 21,
      name: "State School Board Member",
      level: "county",
      fee: 1,
      eventList: [17,29,5,13,18,20,24,25]
    },
    {
      positionID: 22,
      name: "Mayor",
      level: "city",
      fee: 50,
      eventList: [15,16,12,18,20,5,30,25]
    },
    {
      positionID: 23,
      name: "Treasurer",
      level: "city",
      fee: 50,
      eventList: [15,16,12,18,20,5,30,25]
    },
    {
      positionID: 24,
      name: "Auditor",
      level: "city",
      fee: 50,
      eventList: [15,16,12,18,20,5,30,25]
    },
    {
      positionID: 25,
      name: "Director of Law",
      level: "city",
      fee: 50,
      eventList: [15,26,16,12,18,20,5,27,30,25]
      // eventList: [15,26,16,12,18,20,5,27,30,28,25]
    },
    {
      positionID: 26,
      name: "Councilman",
      level: "city",
      fee: 50,
      eventList: [15,16,12,18,20,5,30,25]
    },
    {
      positionID: 27,
      name: "City School Board Member",
      level: "city",
      fee: 1,
      eventList: [15,16,12,18,20,5,30,25]
    },
  ];

  // Object of all possible events during the election process
  const steps = [
    {
      eventID: 3,
      eventName: "Pick up a petition form and submit the 'Certificate of Intent' forms",
      description: "Both of the forms can be found at the location of the Acting Secretary of State. A petition form is used to collect the signatures of other delegates in support of your candidacy. If a candidate withdraws from the running, they must still submit their uncomplete petition form and 'Campaign Contribution & Expenses' form (see 'Track all of your campaign expenses/contributions').",
      time: ""
    },
    {
      eventID: 4,
      eventName: "Collect 44 signatures on the petition form",
      description: "All of the delegates signing the petition must be from the same political party as the candidate's party. The parties within BBS are 'Federalist' or 'Nationalist'. To show state-wide support, the state petition forms must contain 11 signatures from each of the 4 counties.",
      time: "",
    },
    {
      eventID: 5,
      eventName: "Track all of your campaign expenses/contributions",
      description: "Many delegates use donated funds in order to pay for the approved BBS materials (both physical and digital) that can advertise their candidacies. State-level candidates can accept no more than $20 from a single delegate, and a county- or city-level one can accept no more than $10. To ensure fair use of these funds, all candidates <b><u>MUST</u></b> track their donations and payments with a 'Campaign Contribution & Expenditure' form. This completed form <b><u>MUST</u></b> be submitted after their general election, whether they win or lose.",
      time: ""
    },
    {
      eventID: 6,
      eventName: "Pay $700 for the Governor & Lt. Governor fee (in total)",
      description: "Every delegate begins with an account of 600 BBS dollars. All candidates must track their campaign funds with the 'Campaign Contribution & Expenditure' form. Since the Governor and Lt. Governor must pair together at the beginning of their campaign, their fee is combined into one $700 total.",
      time: ""
    },
    {
      eventID: 7,
      eventName: "Pay $400 fee",
      description: "Every delegate begins with an account of 600 BBS dollars. All candidates must track their campaign funds with the 'Campaign Contribution & Expenditure' form.",
      time: ""
    },
    {
      eventID: 8,
      eventName: "Pay $300 fee",
      description: "Every delegate begins with an account of 600 BBS dollars. All candidates must track their campaign funds with the 'Campaign Contribution & Expenditure' form.",
      time: ""
    },
    {
      eventID: 9,
      eventName: "Pay $200 fee",
      description: "Every delegate begins with an account of 600 BBS dollars. All candidates must track their campaign funds with the 'Campaign Contribution & Expenditure' form.",
      time: ""
    },
    {
      eventID: 10,
      eventName: "Pay $150 fee",
      description: "Every delegate begins with an account of 600 BBS dollars. All candidates must track their campaign funds with the 'Campaign Contribution & Expenditure' form.",
      time: ""
    },
    {
      eventID: 11,
      eventName: "Pay $75 fee",
      description: "Every delegate begins with an account of 600 BBS dollars. All candidates must track their campaign funds with the 'Campaign Contribution & Expenditure' form.",
      time: ""
    },
    {
      eventID: 12,
      eventName: "Pay $50 fee",
      description: "Every delegate begins with an account of 600 BBS dollars. All candidates must track their campaign funds with the 'Campaign Contribution & Expenditure' form.",
      time: ""
    },
    {
      eventID: 13,
      eventName: "Pay $1 fee",
      description: "Every delegate begins with an account of 600 BBS dollars. All candidates must track their campaign funds with the 'Campaign Contribution & Expenditure' form.",
      time: ""
    },
    {
      eventID: 15,
      eventName: "Declare your city nomination during the informal city party caucus",
      description: "Anyone pursuing a city-level position must first become a nominee within their political party. They can nominate themself, or be nominated by another delegate in the caucus. All of these nominees will compete to be their city party's candidate at the <u>formal</u> city party caucus tomorrow.",
      time: "The informal caucus takes place in the evening of Day 1 (Sunday)."
    },
    {
      eventID: 16,
      eventName: "Win candidacy by majority vote during the formal city caucus",
      description: "All nominees from the informal city party caucus will now have a chance to briefly speak to their city party's members. Once all nominees have spoken, voting will take place. Each party candidate will be determined by whichever nominee gets the majority of the votes.",
      time: "The formal city caucus takes place in the afternoon of Day 2 (Monday)."
    },
    {
      eventID: 17,
      eventName: "Declare your county nomination and win candidacy during the county party caucus",
      description: "During the county caucus, nominees can nominate themselves or recieve the nomination from another party member. All of the nomines will then have an opportunity to speak to the entire county party. The speeches will immediately be followed by voting. The nominee with the majority vote will be the county party's candidate.",
      time: "The county caucus takes place in the morning of Day 2 (Monday)."
    },
    {
      eventID: 18,
      eventName: "Fill out the Declaration of Candidacy (DoC) form",
      description: "If you are a state-level candidates, then submit your DoC directly to the Acting Secretary of State. If you are a county- and city-level candidate, then fill out the form immediately after winning your candidacy and give it to your party chairman.",
      time: ""
    },
    {
      eventID: 19,
      eventName: "Submit the completed DoC, fee, and petition",
      description: "With both of the forms completed and the fee prepared, submit these required  materials to the Acting Secretary of State.",
      time: "The deadline for this is NO LATER THAN 5:30pm on Day 2 (Monday)."
    },
    {
      eventID: 20,
      eventName: "Submit the completed DoC and fee",
      description: "Your DoC and the necessary fee must be turned over to your party chairman, who will then hand it over to the Acting Secretary of State.",
      time: "This must take place immediately following the party caucus in which you became a candidate."
    },
    {
      eventID: 21,
      eventName: "Speak at the state party caucus",
      description: "Each of the candidates that turned in their completed paperwork & fees for a state-level position will have a brief time in which to give their name and speak to their entire party during the rally. They will speak individually, not as a forum or a debate.",
      time: "The rally takes place in the evening of Day 2 (Monday) in the evening."
    },
    {
      eventID: 22,
      eventName: "Win the state Primary Elections",
      description: "Each city will have a designated time to arrive at the polling stations and will be guided by their city counselor.",
      time: "The primary election polls open in the morning of Day 3 (Tuesday). The results will be posted in the afternoon."
    },
    {
      eventID: 23,
      eventName: "Participate in 'Meet The Candidate' rally and debates",
      description: "The newly-elected state candidates of each party will have an opportunity to speak to the entire BBS body, during which they can introduce themselves and express their goals or policies. This will be immediately followed by a series of debate between all of the opposing candidates.",
      time: "This event begins shortly after lunch on Day 3 (Tuesday)."
    },
    {
      eventID: 24,
      eventName: "Win in the state General Election",
      description: "",
      time: "The polling stations open in the afternoon of Day 3 (Tuesday), shortly after the state rally and debates."
    },
    {
      eventID: 25,
      eventName: "Submit the complete 'Campaign Contribution & Expenditure' form",
      description: "At the conclusion of the state General Elections, all state, county, and city candidates must turn in their completed 'Campaign Contribution & Expenditure' form to the Acting Secretary of State. This includes both winners and losers in their general elections, as well as all of the state candidates that lost in the primary election.",
      time: ""
    },
    {
      eventID: 26,
      eventName: "Take BAR exam (1st attempt)",
      description: "The BAR exam is a test required of any attorny in Buckeye Boys State. This includes judges, the attorney general, prosecutors, directors of law, and even private attorneys. Anyone elected to one of these positions but failed to pass the BAR exam (after two attempts) will lose that elected position.",
      time: "This exam takes place in the morning of Day 2 (Monday)."
    },
    {
      eventID: 27,
      eventName: "Take BAR exam (2nd attempt)",
      description: "The BAR exam is a test required of any attorny in Buckeye Boys State. This includes judges, the attorney general, prosecutors, directors of law, and even private attorneys. Anyone elected to one of these positions but fails to pass the BAR exam (after two attempts) will lose that elected position.",
      time: "This exam takes place in the afternoon of Day 2 (Monday)."
    },
    // {
    //   eventID: 28,
    //   eventName: "Take BAR exam (final attempt)",
    //   description: "The BAR exam is a test required of any attorny in Buckeye Boys State. This includes judges, the attorney general, prosecutors, directors of law, and even private attorneys. Anyone elected to one of these positions but fails to pass the BAR exam (after three attempts) will lose that elected position.",
    //   time: "This exam takes place on Day 3 (Tuesday)."
    // },
    {
      eventID: 29,
      eventName: "Speak at the general county meeting",
      description: "The county candidates will have a chance to speak to ALL of their county members at this meeting, and not only their party.",
      time: "The county meeting takes place in the afternoon of Day 2 (Monday)."
    },
    {
      eventID: 30,
      eventName: "Win in the city/county General Elections",
      description: "",
      time: "The election polls open in the morning of Day 3 (Tuesday). The results will be posted in the afternoon."
    }
  ];

});
