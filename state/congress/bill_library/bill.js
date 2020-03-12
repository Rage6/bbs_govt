$(document).ready(()=>{
  // console.log("bill.js is working...");
  $.getJSON('bill_library/sen_bill_json.php',(senBillLibrary)=>{

    $.getJSON('bill_library/hor_bill_json.php',(horBillLibrary)=>{

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
      const horColors = {
        background: "#051E33",
        titleBkgd: "#4A4D08",
        // subtitleBkgd: "#C5CC0A",
        buttons: "#8C130E"
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
        } else if (chamber == "house") {
          chamberColors = horColors;
          subtypeIdData = "[data-horsubid='"+subtypeId+"']";
          billDirectory = "#horBillDirectory";
          divider = "horDivider";
          oneBill = "oneHorBill";
        };
        $(subtypeIdData)
          .css('background-color',amLgnColor['gold'])
          .css('color',chamberColors['buttons']);
        let billCount = 0;
        let noBill = true;
        for (let billNum = 0; billNum < billArray.length; billNum++) {
          if (subtypeId == "0" || billArray[billNum]['subtype_id'] == subtypeId) {
            if (billCount > 0) {
              $(billDirectory).append(
                "<div class='divider " + divider + "'></div>"
              );
            };
            $(billDirectory).append(
                "<div class='oneBill " + oneBill + "'>\
                  <div class='billNumber'>Bill # "+billArray[billNum]['post_order']+"</div>\
                  <div class='billTitle'>\
                    <div class='billSubtitle'>Title:</div>\
                    <div>"+billArray[billNum]['title']+"</div>\
                  </div>\
                  <div class='billTitle'>\
                    <div class='billSubtitle'>Status</div>\
                    <div>"+billArray[billNum]['subtype_name']+"</div>\
                  </div>\
                </div>"
            );
            billCount++;
            noBill = false;
          };
        };
        if (noBill == true) {
          $(billDirectory).append(
            "<div class='oneBill " + oneBill + "'>\
              <div class='billTitle noBill'>-- NO BILLS FOUND --</div>\
            </div>"
          );
        };
      };

      // Initial display of all of the bills
      billUpdate(senBillLibrary,"0","senate");
      billUpdate(horBillLibrary,"0","house");

      // Show all of the Senate bill options
      $("#currentSenSelect").click(()=>{
        if ($(".senSelectList").css('display') == 'none') {
          $(".senSelectList").css('display','block');
          setSenHeight();
        } else {
          $(".senSelectList").css('display','none');
          setSenHeight();
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
          $(".senSelectList").css('display','none');
          $("#currentSenSelect").text(newText);
          // ...the current list is emptied...
          $("#senBillDirectory").empty();
          // ...before the a new list is entered.
          billUpdate(senBillLibrary,newSubId,"senate");
          setSenHeight();
      });

    });

  });

});
