$(document).ready(()=>{
  // console.log("cases.js is working...");
  $.getJSON('case_library/cases_json.php',(caseLibrary)=>{
    for (let caseNum = 0; caseNum < caseLibrary.length; caseNum++) {
      $("#caseBttnList").append("<div>"+caseLibrary[caseNum]['title']+"</div>");
    };
  });
});
