$(document).ready(()=>{
  // console.log("bill.js is working...");
  $.getJSON('law_library/law_json.php',(lawLibrary)=>{

    // for (let lawNum = 0; lawNum < lawLibrary.length; lawNum++) {
    //   console.log(lawLibrary[lawNum]);
    // };

  });

});
