$(document).ready(()=>{
  // console.log("bills.js is working...");
  $.getJSON('bill_library/bills_json.php',(billLibrary)=>{
    // console.log(billLibrary);
    $("#senBillDirectory").append(
        "<div class='oneSenBill'>\
          <div>"+billLibrary[0]['post_order']+"</div>\
          <div>"+billLibrary[0]['title']+"</div>\
          <div>"+billLibrary[0]['subtype_name']+"</div>\
        </div>"
    );
  });
});
