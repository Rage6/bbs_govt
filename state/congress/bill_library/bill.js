$(document).ready(()=>{
  // console.log("bill.js is working...");
  $.getJSON('bill_library/bill_json.php',(billLibrary)=>{

    const setSenHeight = () => {
      let currentSenHeight = $(".senateBox").outerHeight();
      if ($(window).outerHeight() < currentSenHeight) {
        $("body").css('height',currentSenHeight);
      } else {
        $("body").css('height','100%');
      };
    };

    // Function to chose selected bills based on their status
    const billUpdate = (billArray,subtypeId) => {
      $("[data-sensubid='"+subtypeId+"']")
        .css('background-color','#fec231')
        .css('color','#051E33');
      let billCount = 0;
      let noBill = true;
      for (let billNum = 0; billNum < billArray.length; billNum++) {
        if (subtypeId == "0" || billArray[billNum]['subtype_id'] == subtypeId) {
          if (billCount > 0) {
            $("#senBillDirectory").append(
              "<div class='divider senDivider'></div>"
            );
          };
          $("#senBillDirectory").append(
              "<div class='oneBill oneSenBill'>\
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
        $("#senBillDirectory").append(
          "<div class='oneBill oneSenBill'>\
            <div class='billTitle noBill'>-- NO BILLS FOUND --</div>\
          </div>"
        );
      };
    };

    // Initial display of all of the bills
    billUpdate(billLibrary,"0");

    // Show all options
    $("#currentSenSelect").click(()=>{
      if ($(".senSelectList").css('display') == 'none') {
        $(".senSelectList").css('display','block');
        setSenHeight();
      } else {
        $(".senSelectList").css('display','none');
        setSenHeight();
      };
    });

    // Upon clicking any following option
    $("[data-sensubid]").click(()=>{
        // The menu is first changed and hidden...
        $(".senSelectOption").css('color','#fec231').css('background-color','#051E33');
        let newSubId = event.target.dataset.sensubid;
        let newText = event.target.innerText;
        $("[data-sensubid="+newSubId+"]").css('color','#051E33').css('background-color','#fec231');
        $(".senSelectList").css('display','none');
        $("#currentSenSelect").text(newText);
        // ...the current list is emptied...
        $("#senBillDirectory").empty();
        // ...before the a new list is entered.
        billUpdate(billLibrary,newSubId);
        setSenHeight();
    });
    
  });

});
