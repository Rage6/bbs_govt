$(document).ready(()=>{
  // console.log("bill.js is working...");
  $.getJSON('law_library/law_json.php',(lawLibrary)=>{

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
      // console.log(event.target.classList);
      for (let classNum = 0; classNum < event.target.classList.length; classNum++) {
        currentClass = event.target.classList[classNum];
        if (currentClass == senTitle || currentClass == senApproval) {
          initBkgd = "#8C130E";
          initColor = "#fec231";
          clickedTitle = ".oneSenLawTitle";
          clickedApproval = ".oneSenLawApproval";
          clickedLawContent = ".senLawContent";
        } else {
          // // This is will be filled out for the the HoR's law list
          initBkgd = "#8C130E";
          initColor = "#fec231";
          clickedTitle = ".oneSenLawTitle";
          clickedApproval = ".oneSenLawApproval";
          clickedLawContent = ".senLawContent";
        };
      };
      let lawId = event.target.dataset.postid;
      $(clickedApproval)
        .css('background-color',initBkgd)
        .css('color',initColor);
      $(clickedTitle)
        .css('background-color',initBkgd)
        .css('color',initColor);
      $("[data-postid='" + lawId + "']")
        .css('background-color',initColor)
        .css('color',initBkgd);
      // console.log(lawLibrary);
      for (let lawNum = 0; lawNum < lawLibrary.length; lawNum++) {
        if (lawLibrary[lawNum]['post_id'] == lawId) {
          $(clickedLawContent).empty();
          if (lawLibrary[lawNum]['content'] == '') {
            $(clickedLawContent).append(
              "<div>Details not yet published</div>"
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

});
