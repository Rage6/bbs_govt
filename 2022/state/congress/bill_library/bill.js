$(document).ready(()=>{
  // console.log("bill.js is now working...");
  // $.getJSON('bill_library/sen_bill_json.php',(senBillLibrary)=>{

    // $.getJSON('bill_library/hor_bill_json.php',(repBillLibrary)=>{

      // console.log(senBillLibrary);
      // console.log(repBillLibrary);
      const repBillLibrary = [
        {"post_order":"34","chamber_prefix":"H.B.","title":"Reduce Income Tax For Veterans","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"33","chamber_prefix":"H.B.","title":"Sustainable Farming Incentives ","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"31","chamber_prefix":"H.B.","title":"Right To Repair","subtype_id":"14","subtype_name":"3rd Consideration"},
        {"post_order":"30","chamber_prefix":"H.B.","title":"Teach Elders Technology Literacy ","subtype_id":"14","subtype_name":"3rd Consideration"},
        {"post_order":"29","chamber_prefix":"H.B.","title":"Public School Financial Booster Act","subtype_id":"14","subtype_name":"3rd Consideration"},
        {"post_order":"28","chamber_prefix":"H.B.","title":"Lower Gas Taxes","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"27","chamber_prefix":"H.B.","title":"Tax Deduction For School Employees","subtype_id":"14","subtype_name":"3rd Consideration"},
        {"post_order":"26","chamber_prefix":"H.B.","title":"School Funding For Life Skills Classes","subtype_id":"14","subtype_name":"3rd Consideration"},
        {"post_order":"24","chamber_prefix":"H.B.","title":"Decriminalize And Legalize Marijuana","subtype_id":"13","subtype_name":"2nd Consideration"},
        {"post_order":"23","chamber_prefix":"H.B.","title":"Ban On Space Travel","subtype_id":"13","subtype_name":"2nd Consideration"},
        {"post_order":"21","chamber_prefix":"H.B.","title":"Historical Site Funding","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"20","chamber_prefix":"H.B.","title":"Band Member Compensation","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"19","chamber_prefix":"H.B.","title":"Regulation Of Airspace Decibel Levels","subtype_id":"12","subtype_name":"1st Consideration"},
        {"post_order":"18","chamber_prefix":"S.B.","title":"Cowbell Solo Act","subtype_id":"17","subtype_name":"Passed both Chambers"},
        {"post_order":"18","chamber_prefix":"H.B.","title":"Increase School Security","subtype_id":"13","subtype_name":"2nd Consideration"},
        {"post_order":"17","chamber_prefix":"H.B.","title":"Require New Buildings To Follow ADA","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"14","chamber_prefix":"H.B.","title":"Legalize Drag Racing","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"12","chamber_prefix":"S.B","title":"Fruit In Hand Act","subtype_id":"17","subtype_name":"Passed both Chambers"},
        {"post_order":"12","chamber_prefix":"H.B.","title":"Guns, Ammo, and Tactical Gear Tax","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"11","chamber_prefix":"H.B.","title":"Littering Penalties","subtype_id":"17","subtype_name":"Passed both Chambers"},
        {"post_order":"10","chamber_prefix":"S.B","title":"Create Ohio Program For Agrivoltaics ","subtype_id":"17","subtype_name":"Passed both Chambers"},
        {"post_order":"10","chamber_prefix":"H.B","title":"Price Cap On Lifesaving Medicine","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"9","chamber_prefix":"S.B","title":"Monty Python Act","subtype_id":"17","subtype_name":"Passed both Chambers"},
        {"post_order":"9","chamber_prefix":"H.B.","title":"Increases Sin Tax","subtype_id":"14","subtype_name":"3rd Consideration"},
        {"post_order":"8","chamber_prefix":"H.B.","title":"Removes Gas Tax","subtype_id":"13","subtype_name":"2nd Consideration"},
        {"post_order":"7","chamber_prefix":"H.B.","title":"Local Governments Can Create Flags\/Coat Of Arms","subtype_id":"16","subtype_name":"Passed in House"},
        {"post_order":"6","chamber_prefix":"H.B","title":"Petition for Gun Confiscation","subtype_id":"12","subtype_name":"1st Consideration"},
        {"post_order":"5","chamber_prefix":"H.B.","title":"State Highway Siren - Sponsor: Carter Davis","subtype_id":"17","subtype_name":"Passed both Chambers"},
        {"post_order":"3","chamber_prefix":"S.B.","title":"Tv Freedom Act","subtype_id":"17","subtype_name":"Passed both Chambers"}
      ];

      const senBillLibrary = [
        {"post_order":"34","chamber_prefix":"H.B.","title":"Tax Reduction for Veterans Act","subtype_id":"32","subtype_name":"Failed (Senate)"},
        {"post_order":"31","chamber_prefix":"H.B.","title":"Right to Repare Act","subtype_id":"21","subtype_name":"2nd Consideration"},
        {"post_order":"30","chamber_prefix":"H.B.","title":"Anti Bullying Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"28","chamber_prefix":"H.B.","title":"Gas Tax Reduction Act","subtype_id":"23","subtype_name":"Tabled"},
        {"post_order":"27","chamber_prefix":"S.B.","title":"Charter Scrutiny Act","subtype_id":"22","subtype_name":"3rd Consideration"},
        {"post_order":"26","chamber_prefix":"S.B.","title":"Workplace Saftey Act","subtype_id":"21","subtype_name":"2nd Consideration"},
        {"post_order":"25","chamber_prefix":"S.B.","title":"Foster Care Financial Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"24","chamber_prefix":"S.B","title":"Gun Safe Act","subtype_id":"32","subtype_name":"Failed (Senate)"},
        {"post_order":"23","chamber_prefix":"S.B.","title":"School Board Funding Act","subtype_id":"21","subtype_name":"2nd Consideration"},
        {"post_order":"23","chamber_prefix":"A","title":"School Board Funding Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"22","chamber_prefix":"S.B.","title":"Revitalized Homeless Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"21","chamber_prefix":"S.B.","title":"Ohio Nuclear Regulation Aministration (ONRA) Act\r\n","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"20","chamber_prefix":"S.B.","title":"Parking Lot Solar Panels Act","subtype_id":"20","subtype_name":"1st Consideration"},
        {"post_order":"19","chamber_prefix":"S.B.","title":"Accommodations for Disabled Acts ","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"18","chamber_prefix":"S.B.","title":"Cowbell Solo Act","subtype_id":"28","subtype_name":"Passed both Chambers"},
        {"post_order":"17","chamber_prefix":"H.B.","title":"Disability Service Act","subtype_id":"23","subtype_name":"Tabled"},
        {"post_order":"17","chamber_prefix":"S.B.","title":"Car Insurance Enforcement Act","subtype_id":"32","subtype_name":"Failed (Senate)"},
        {"post_order":"16","chamber_prefix":"S.R.","title":"Increase Budget of State Auditors Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"15","chamber_prefix":"S.B.","title":"Increase THC Levels Act","subtype_id":"21","subtype_name":"2nd Consideration"},
        {"post_order":"14","chamber_prefix":"S.B.","title":"Stable Foster Homes Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"13","chamber_prefix":"S.B.","title":"End Executions Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"12","chamber_prefix":"S.B.","title":"Fruit in Hand Act","subtype_id":"28","subtype_name":"Passed both Chambers"},
        {"post_order":"11","chamber_prefix":"H.B.","title":"End Littering Act","subtype_id":"28","subtype_name":"Passed both Chambers"},
        {"post_order":"11","chamber_prefix":"S.B.","title":"Gun License Act","subtype_id":"21","subtype_name":"2nd Consideration"},
        {"post_order":"10","chamber_prefix":"H.B.","title":"Cap the Cost of Life Saving Devices Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"10","chamber_prefix":"S.B.","title":"Clean Energy Act","subtype_id":"21","subtype_name":"2nd Consideration"},
        {"post_order":"9","chamber_prefix":"S.B","title":"Monty Python Act","subtype_id":"23","subtype_name":"Tabled"},
        {"post_order":"8","chamber_prefix":"S.B.","title":"Prostitution Act","subtype_id":"32","subtype_name":"Failed (Senate)"},
        {"post_order":"7","chamber_prefix":"S.R.","title":"Resolution; Remembrance Road ","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"7","chamber_prefix":"H.B.","title":"Flag Act","subtype_id":"21","subtype_name":"2nd Consideration"},
        {"post_order":"7","chamber_prefix":"S.B.","title":"WeeWoo WeeWoo Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"6","chamber_prefix":"S.R.","title":"Resolution; Appointment of Chief Legal Counsel","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"6","chamber_prefix":"S.B.","title":"Gambling Act","subtype_id":"32","subtype_name":"Failed (Senate)"},
        {"post_order":"5","chamber_prefix":"S.R.","title":"Resolution: No to Space","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"5","chamber_prefix":"H.B.","title":"The Sound of the Police Act","subtype_id":"28","subtype_name":"Passed both Chambers"},
        {"post_order":"5","chamber_prefix":"S.B","title":"BBS for Industry Act","subtype_id":"32","subtype_name":"Failed (Senate)"},
        {"post_order":"4","chamber_prefix":"S.R.","title":"Resolution: Confirmation of Elected Minority Positions","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"4","chamber_prefix":"S.B.","title":"Fertilizer Act","subtype_id":"21","subtype_name":"2nd Consideration"},
        {"post_order":"3","chamber_prefix":"J.R.","title":"Joint Resoultion; Thank you to LSCs and Clerks","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"3","chamber_prefix":"S.R.","title":"Resolution: Confirmation of Elected Majority Positions","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"3","chamber_prefix":"S.B.","title":"T.V. Freedom Act","subtype_id":"28","subtype_name":"Passed both Chambers"},
        {"post_order":"2","chamber_prefix":"J.B.","title":"Joint Bill; New Redistrciting Commission Act","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"2","chamber_prefix":"S.R.","title":"Resolution: Adoption of Temporary Rules","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"2","chamber_prefix":"S.B.","title":"Naked Education Spending Bill","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"1","chamber_prefix":"H.B.","title":"Funding for Historical Sites Act","subtype_id":"28","subtype_name":"Passed both Chambers"},
        {"post_order":"1","chamber_prefix":"S.R.","title":"Resolution; Clerk positions","subtype_id":"25","subtype_name":"Passed in Senate"},
        {"post_order":"1","chamber_prefix":"S.B.","title":"Hot for Teachers","subtype_id":"25","subtype_name":"Passed in Senate"}
      ];

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

    // });

  // });

});
