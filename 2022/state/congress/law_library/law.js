$(document).ready(()=>{
  // console.log("law.js is working...");
  // $.getJSON('law_library/law_json.php',(lawLibrary)=>{
    const lawLibrary = [
      {"post_id":"1248","title":"American Legionnaire Appreciation Day","content":"A Proclamation \r\nThat Saturday, June 18th shall be Buckeye Boys State Legionnaire Appreciation day.\r\n\r\n BE IT ENACTED BY THE GENERAL ASSEMBLY OF BUCKEYE BOYS STATE: \r\n\r\nThat Saturday, June 18th will be declared Buckeye Boy&rsquo;s State&rsquo;s Legionnaire Appreciation Day.  Examples of thanking Legionnaires could include, but not be limited to, thanking a Legionnaire or sitting with and engaging in conversation with a Legionnaire to convey our appreciation for their sacrifices and taking interest in us and other future generations of leaders. \r\nThis is to be an informal holiday so there will be no paid time off of work. \r\nThere shall be an announcement of the day of commemoration on the day of Friday, June 17th.\r\n","subtype_name":"Law (Governor approval)"}
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

  // });

});
