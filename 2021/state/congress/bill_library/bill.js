$(document).ready(()=>{
  // console.log("bill.js is now working...");
  const senBillLibrary = [
    {"post_order":"35","chamber_prefix":"S.B.","title":"Incentivize Creation and Growth of Small Businesses","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"34","chamber_prefix":"S.B.","title":"Electric Car Usage","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"33","chamber_prefix":"S.B.","title":"Create Public Parks from Excess Parking Lots","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"32","chamber_prefix":"S.B.","title":"State Employees Relations Board","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"31","chamber_prefix":"S.B.","title":"Casinos in Boys State","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"30","chamber_prefix":"S.B.","title":"Provide State Taxes Directly to Individuals","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"29","chamber_prefix":"S.B.","title":"Reduced Penny Usage","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"28","chamber_prefix":"S.B.","title":"Increase Voting Polls and Voter Accessibilities","subtype_id":"22","subtype_name":"3rd Consideration"},
    {"post_order":"27","chamber_prefix":"S.B.","title":"Improve Accessibility to Buildings for Disabled Citizens","subtype_id":"23","subtype_name":"Tabled"},
    {"post_order":"26","chamber_prefix":"S.B.","title":"Mandated Moment of Silence Across all Schools for the Dead of the 9\/11 Terrorist","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"25","chamber_prefix":"S.B.","title":"Abortion","subtype_id":"20","subtype_name":"1st Consideration"},
    {"post_order":"23","chamber_prefix":"S.B.","title":"Extend Utility Bill Deadlines","subtype_id":"23","subtype_name":"Tabled"},
    {"post_order":"22","chamber_prefix":"S.B.","title":"Adopt a Forest","subtype_id":"28","subtype_name":"Passed both Chambers"},
    {"post_order":"21","chamber_prefix":"S.B.","title":"Require Governor Saxton to Carry a Bag of Oranges","subtype_id":"23","subtype_name":"Tabled"},
    {"post_order":"20","chamber_prefix":"S.B.","title":"Restructure Ohio Unemployment Benefits","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"19","chamber_prefix":"S.B.","title":"Joint House and Senate Subcommittee","subtype_id":"23","subtype_name":"Tabled"},
    {"post_order":"18","chamber_prefix":"S.B.","title":"Rank Choice Voting","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"17","chamber_prefix":"S.B.","title":"Reform Ohio Supplement Nutrition Assistance Program (SNAP)","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"16","chamber_prefix":"S.B.","title":"Showering","subtype_id":"23","subtype_name":"Tabled"},
    {"post_order":"15","chamber_prefix":"S.B.","title":"Protect citizens and politicans on social media","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"14","chamber_prefix":"S.B.","title":"Provide Compensation for Mental Health Conditions by the Bureau of Workers' Comp","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"13","chamber_prefix":"S.B.","title":"Provide Express Licenses","subtype_id":"23","subtype_name":"Tabled"},
    {"post_order":"12","chamber_prefix":"S.B.","title":"Tax Breaks to Owners of Electric Chargers for Cars","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"11","chamber_prefix":"S.B.","title":"Bar Enforcement of Certain Driving Maneuvers","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"10","chamber_prefix":"S.B.","title":"Ban Biological Males from High School Female Sports","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"9","chamber_prefix":"S.B.","title":"Veterans Day Assembly","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"8","chamber_prefix":"S.B.","title":"Drag Racing Provisions","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"7","chamber_prefix":"S.B.","title":"Ban teaching of critical race theory","subtype_id":"21","subtype_name":"2nd Consideration"},
    {"post_order":"6","chamber_prefix":"S.B.","title":"Replace Incandescent Street Light Bulbs with LED Bulbs","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"5","chamber_prefix":"S.B.","title":"Permit the Use of tinted glass at Miami University","subtype_id":"23","subtype_name":"Tabled"},
    {"post_order":"4","chamber_prefix":"S.B.","title":"Buggy\/Carriage License","subtype_id":"22","subtype_name":"3rd Consideration"},
    {"post_order":"3","chamber_prefix":"S.B.","title":"Legalize Use and Sale of Recreational Marijuana","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"2","chamber_prefix":"S.B.","title":"Landfills","subtype_id":"25","subtype_name":"Passed in Senate"},
    {"post_order":"1","chamber_prefix":"S.B.","title":"Sunglasses Worn at Anytime","subtype_id":"25","subtype_name":"Passed in Senate"}
  ];

  const repBillLibrary = [
    {"post_order":"44","chamber_prefix":"H.B.","title":"To Reform Accents within the Legislature","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"43","chamber_prefix":"H.B.","title":"Employment for disabled Ohioans","subtype_id":"15","subtype_name":"Tabled"},
    {"post_order":"42","chamber_prefix":"H.B.","title":"To enact weather procedures","subtype_id":"15","subtype_name":"Tabled"},
    {"post_order":"41","chamber_prefix":"H.B.","title":"Convict Capital Act","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"40","chamber_prefix":"H.B.","title":"To include more Ohioans in the workforce","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"39","chamber_prefix":"H.B.","title":"To create a name\/role\/location sign in every city","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"38","chamber_prefix":"H.B.","title":"Justice for Cicadas","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"37","chamber_prefix":"H.B.","title":"To Create a BBS FFA Chapter","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"35","chamber_prefix":"S.B.","title":"To incentive the creation and growth of small businesses","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"35","chamber_prefix":"H.B.","title":"To Discourage the Usage of E-Cigarettes and Vapes by Minors","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"34","chamber_prefix":"H.B.","title":"Welfare","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"31","chamber_prefix":"H.B.","title":"To ban teaching of critical race theory in schools","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"30","chamber_prefix":"H.B.","title":"To Protect Women&amp;rsquo;s Sports Act","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"29","chamber_prefix":"S.B.","title":"To remove the usage of the penny","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"29","chamber_prefix":"H.B.","title":"Farmland Licensing","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"28","chamber_prefix":"H.B.","title":"To Establish Water Productivity","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"27","chamber_prefix":"H.B.","title":"To establish a curfew time","subtype_id":"15","subtype_name":"Tabled"},
    {"post_order":"26","chamber_prefix":"H.B.","title":"To protect Boys State water","subtype_id":"15","subtype_name":"Tabled"},
    {"post_order":"25","chamber_prefix":"H.B.","title":"Thunderstorm Participation","subtype_id":"15","subtype_name":"Tabled"},
    {"post_order":"24","chamber_prefix":"H.B.","title":"A Bill to postpone bill and fee due dates","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"24","chamber_prefix":"S.B.","title":"A Bill to postpone bill and fee due dates","subtype_id":"17","subtype_name":"Passed both Chambers"},
    {"post_order":"24","chamber_prefix":"H.B.","title":"To increase effectiveness of Earth Day","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"23","chamber_prefix":"H.B.","title":"To amend 3313.6011 Ohio Revised Code  to prevent teen pregnancies","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"22","chamber_prefix":"S.B.","title":"To Adopt a Forest","subtype_id":"17","subtype_name":"Passed both Chambers"},
    {"post_order":"22","chamber_prefix":"H.B.","title":"To create the Mental Health Dispatch Act","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"21","chamber_prefix":"H.B.","title":"Tobacco Tax","subtype_id":"15","subtype_name":"Tabled"},
    {"post_order":"20","chamber_prefix":"H.B.","title":"To ensure voting rights and election security","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"19","chamber_prefix":"H.B.","title":"Dolly Parton Day","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"18","chamber_prefix":"H.B.","title":"House Bill for Country Roads (Take Me Home)","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"17","chamber_prefix":"H.B.","title":"Buffering Internet","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"16","chamber_prefix":"H.B.","title":"To implement pay for NCAA Athletes","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"15","chamber_prefix":"H.B.","title":"To create chief legal council and set aside $10,000","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"14","chamber_prefix":"H.B.","title":"To allow the Inspector General to investigate election fraud","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"13","chamber_prefix":"H.B.","title":"Empowering Individual Retirement","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"12","chamber_prefix":"H.B.","title":"4-lane highways","subtype_id":"15","subtype_name":"Tabled"},
    {"post_order":"10","chamber_prefix":"H.B.","title":"To lower the minimum age to maintain a learner&amp;rsquo;s permit to 15","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"9","chamber_prefix":"H.B.","title":"To create chief legal council and set aside $42,000 ","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"9","chamber_prefix":"S.B.","title":"Establish Veteran's Assembly","subtype_id":"17","subtype_name":"Passed both Chambers"},
    {"post_order":"8","chamber_prefix":"S.B.","title":"To end &ldquo;Drag Racing&rdquo; provisions","subtype_id":"15","subtype_name":"Tabled"},
    {"post_order":"8","chamber_prefix":"H.B.","title":"Protecting small dairy farmers","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"7","chamber_prefix":"H.B.","title":"No taxation without representation","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"6","chamber_prefix":"S.B.","title":"To replace incandescent bulbs with LED bulbs","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"6","chamber_prefix":"H.B.","title":"Legalize Sports Betting","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"5","chamber_prefix":"H.B.","title":"Resolution for Clerk Appreciation","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"5","chamber_prefix":"H.B.","title":"To Establish Financial Literacy Classes in Ohio Highschools","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"4","chamber_prefix":"S.B.","title":"Horse-drawn carriage license","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"4","chamber_prefix":"H.B.","title":"To Protect Womens Sports Act","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"3","chamber_prefix":"S.B.","title":"To Legalize the sale of Recreational Marijuana","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"3","chamber_prefix":"H.B.","title":"Education Grant","subtype_id":"15","subtype_name":"Tabled"},
    {"post_order":"2","chamber_prefix":"H.B.","title":"Operation Pothole","subtype_id":"16","subtype_name":"Passed in House"},
    {"post_order":"1","chamber_prefix":"C.B.","title":"Weed Bill","subtype_id":"17","subtype_name":"Passed both Chambers"},
    {"post_order":"1","chamber_prefix":"S.B.","title":"Legalize Sunglasses","subtype_id":"13","subtype_name":"2nd Consideration"},
    {"post_order":"1","chamber_prefix":"H.B.","title":"The Legalization of Marijuana","subtype_id":"13","subtype_name":"2nd Consideration"}
  ];

  // console.log(senBillLibrary);
  // console.log(repBillLibrary);

  // Objects for filling billUpdate()'s parameters
  const amLgnColor = {
    blue: "#00467f",
    gold: "#fec231"
  }
  const senColors = {
    background: "#051E33",
    titleBkgd: "#4A4D08",
    // subtitleBkgd: "#C5CC0A",
    buttons: "#8C130E"
  };
  const repColors = {
    background: "#400200",
    titleBkgd: "#4A4D08",
    // subtitleBkgd: "#C5CC0A",
    buttons: "#004E8C"
  };

  // Resets the new height after shifting to the senateBox
  const setSenHeight = () => {
    let currentSenHeight = $(".senateBox").outerHeight();
    if ($(window).outerHeight() < currentSenHeight) {
      $("body").css('height',currentSenHeight);
    } else {
      $("body").css('height','100%');
    };
  };

  // Resets the new height after shifting to the houseBox
  const setRepHeight = () => {
    let currentRepHeight = $(".houseBox").outerHeight();
    if ($(window).outerHeight() < currentRepHeight) {
      $("body").css('height',currentRepHeight);
    } else {
      $("body").css('height','100%');
    };
  };

  // Function to choose selected bills based on their status
  const billUpdate = (billArray,subtypeId,chamber) => {
    let chamberColors = null;
    if (chamber == "senate") {
      chamberColors = senColors;
      subtypeIdData = "[data-sensubid='"+subtypeId+"']";
      billDirectory = "#senBillDirectory";
      divider = "senDivider";
      oneBill = "oneSenBill";
      billTitle = "senBillNumber";
      billData = "senBillData";
    } else if (chamber == "house") {
      chamberColors = repColors;
      subtypeIdData = "[data-repsubid='"+subtypeId+"']";
      billDirectory = "#repBillDirectory";
      divider = "repDivider";
      oneBill = "oneRepBill";
      billTitle = "repBillNumber";
      billData = "repBillData";
    };
    $(subtypeIdData)
      .css('background-color',amLgnColor['gold'])
      .css('color',chamberColors['buttons']);
    let billTotal = billArray.length;
    if (billTotal > 0) {
      for (let billNum = 0; billNum < billArray.length; billNum++) {
        if (subtypeId == "0" || billArray[billNum]['subtype_id'] == subtypeId) {
          let prefix = "";
          if (billArray[billNum]['chamber_prefix'] != null) {
            prefix = billArray[billNum]['chamber_prefix'];
          };
          $(billDirectory).append(
              "<div class='oneBill " + oneBill + "'>\
                <div class='billNumber " + billTitle + "'>\
                  "+prefix+" "+billArray[billNum]['post_order']+"\
                </div>\
                <div class='billData " + billData + "'>\
                  <div class='billTitle'>\
                    <div class='billSubtitle'>Title:</div>\
                    <div>"+billArray[billNum]['title']+"</div>\
                  </div>\
                  <div class='billTitle'>\
                    <div class='billSubtitle'>Status</div>\
                    <div>"+billArray[billNum]['subtype_name']+"</div>\
                  </div>\
                </div>\
              </div>"
          );
        };
      };
    } else {
      $(billDirectory).append(
        "<div class='oneBill " + oneBill + "'>\
          <div class='billTitle noBill'>-- NO BILLS FOUND --</div>\
        </div>"
      );
    };
  };

  // Initial display of all of the bills
  billUpdate(senBillLibrary,"0","senate");
  billUpdate(repBillLibrary,"0","house");

  // Show all of the Senate bill options
  $("#currentSenSelect").click(()=>{
    if ($(window).outerWidth() < 1366) {
      if ($(".senSelectList").css('display') == 'none') {
        $(".senSelectList").css('display','block');
        setSenHeight();
      } else {
        $(".senSelectList").css('display','none');
        setSenHeight();
      };
    };
  });

  // After clicking on any Senate option
  $("[data-sensubid]").click(()=>{
      // The menu is first changed and hidden...
      $(".senSelectOption")
        .css('color',amLgnColor['gold'])
        .css('background-color',senColors['buttons']);
      let newSubId = event.target.dataset.sensubid;
      let newText = event.target.innerText;
      $("[data-sensubid="+newSubId+"]").css('color','#051E33').css('background-color','#fec231');
      if ($(window).outerWidth() < 769) {
        $(".senSelectList")
          .css('display','none');
        $("#currentSenSelect")
          .text(newText);
      };
      // ...the current list is emptied...
      $("#senBillDirectory").empty();
      // ...before the a new list is entered.
      billUpdate(senBillLibrary,newSubId,"senate");
      setSenHeight();
  });

  // Show all of the House bill options
  $("#currentRepSelect").click(()=>{
    if ($(window).outerWidth() < 1366) {
      if ($(".repSelectList").css('display') == 'none') {
        $(".repSelectList").css('display','block');
        setRepHeight();
      } else {
        $(".repSelectList").css('display','none');
        setRepHeight();
      };
    };
  });

  // After clicking on any House option
  $("[data-repsubid]").click(()=>{
      // The menu is first changed and hidden...
      $(".repSelectOption")
        .css('color',amLgnColor['gold'])
        .css('background-color',repColors['buttons']);
      let newSubId = event.target.dataset.repsubid;
      let newText = event.target.innerText;
      $("[data-repsubid="+newSubId+"]")
        .css('color',repColors['buttons'])
        .css('background-color','#fec231');
      if ($(window).outerWidth() < 769) {
        $(".repSelectList")
          .css('display','none');
        $("#currentRepSelect")
          .text(newText);
      };
      // ...the current list is emptied...
      $("#repBillDirectory")
        .empty();
      // ...before the a new list is entered.
      billUpdate(repBillLibrary,newSubId,"house");
      setRepHeight();
  });

});
