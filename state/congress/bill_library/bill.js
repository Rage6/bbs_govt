$(document).ready(()=>{
  // console.log("bill.js is now working...");
  $.getJSON('bill_library/sen_bill_json.php',(senBillLibrary)=>{

    $.getJSON('bill_library/hor_bill_json.php',(repBillLibrary)=>{

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

  });

});
