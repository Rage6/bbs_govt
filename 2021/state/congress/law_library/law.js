$(document).ready(()=>{
  // console.log("law.js is working...");
  const lawLibrary = [
    {"post_id":"681","title":"Postpone Bill and Fee Due Dates","content":"Any individuals who have not received payment for their employment will have their bill dues postponed until Saturday, June 19 at 4PM","subtype_name":"Law (Governor approval)"},
    {"post_id":"591","title":"The Fruit Fist Act","content":"","subtype_name":"Law (Governor approval)"}
  ];
  console.log(lawLibrary);
  let initColor = null;
  let initBkgd = null;
  let clickedTitle = null;
  let clickedApproval = null;
  let clickedLawContent = null;
  const senTitle = "oneSenLawTitle";
  const senApproval = "oneSenLawApproval";
  const repTitle = "oneRepLawTitle";
  const repApproval = "oneRepLawApproval";
  $("[data-postid]").click(()=>{
    for (let classNum = 0; classNum < event.target.classList.length; classNum++) {
      currentClass = event.target.classList[classNum];
      if (currentClass == senTitle || currentClass == senApproval) {
        chamber = "senate";
        initBkgd = "#8C130E";
        // initColor = "#fec231";
        clickedTitle = ".oneSenLawTitle";
        clickedApproval = ".oneSenLawApproval";
        clickedLawContent = ".senLawContent";
      } else {
        // // This is will be filled out for the the HoR's law list
        chamber = "house";
        initBkgd = "#004E8C";
        initColor = "#fec231";
        clickedTitle = ".oneRepLawTitle";
        clickedApproval = ".oneRepLawApproval";
        clickedLawContent = ".repLawContent";
      };
    };
    let lawId = event.target.dataset.postid;
    $(".oneRepLawApproval")
      .css('background-color',"#004E8C")
      .css('color',"#fec231");
    $(".oneRepLawTitle")
      .css('background-color',"#004E8C")
      .css('color',"#fec231");
    $(".oneSenLawApproval")
      .css('background-color',"#8C130E")
      .css('color',"#fec231");
    $(".oneSenLawTitle")
      .css('background-color',"#8C130E")
      .css('color',"#fec231");
    $("[data-postid='" + lawId + "'][data-chamber='" + chamber + "']")
      .css('background-color',initColor)
      .css('color',initBkgd);
    for (let lawNum = 0; lawNum < lawLibrary.length; lawNum++) {
      if (lawLibrary[lawNum]['post_id'] == lawId) {
        $(".repLawContent").empty();
        $(".senLawContent").empty();
        if (clickedLawContent == ".repLawContent") {
          $(".senLawContent").append(
            "<div class='startEmpty' style='text-align:center'>\
              <i>-- SELECT A LAW --</i>\
            </div>");
        } else {
          $(".repLawContent").append(
            "<div class='startEmpty' style='text-align:center'>\
              <i>-- SELECT A LAW --</i>\
            </div>");
        };
        if (lawLibrary[lawNum]['content'] == '' || lawLibrary[lawNum]['content'] == null) {
          $(clickedLawContent).append(
            "<div class='viewLawTitle'>"+lawLibrary[lawNum]['title']+"</div>\
            <div class='viewLawContent'><i>Details not yet published</i></div>"
          );
        } else {
          $(clickedLawContent).append(
            "<div class='viewLawTitle'>"+lawLibrary[lawNum]['title']+"</div>\
            <div class='viewLawContent'>"+lawLibrary[lawNum]['content']+"</div>"
          );
        };
      };
    };
  });

});
