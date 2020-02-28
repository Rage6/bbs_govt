$(document).ready(()=>{
  // console.log("bill.js is working...");
  $.getJSON('bill_library/bill_json.php',(billLibrary)=>{

    // Function to chose selected bills based on their status
    const billUpdate = (billArray,subtypeId) => {
      if (billArray.length > 0) {
        for (let billNum = 0; billNum < billArray.length; billNum++) {
          if (subtypeId == "ALL" || billArray[billNum]['subtype_id'] == subtypeId) {
            $("#senBillDirectory").append(
                "<div class='oneBill oneSenBill'>\
                  <div class='billNumber'>Bill # "+billArray[billNum]['post_order']+"</div>\
                  <div class='billTitle'>"+billArray[billNum]['title']+"</div>\
                  <div class='billStatus'>\
                    <div><u>Status</u></div>\
                    <div><i>"+billArray[billNum]['subtype_name']+"</i></div>\
                  </div>\
                </div>"
            );
          };
        };
      } else {
        $("#senBillDirectory").append(
          "<div class='oneBill oneSenBill'>\
            <div class='billTitle'>-- NO BILLS FOUND --</div>\
          </div>"
        );
      };
    };

    // Initial display of all of the bills
    billUpdate(billLibrary,"ALL");



  });
});
