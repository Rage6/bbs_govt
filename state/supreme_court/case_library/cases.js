$(document).ready(()=>{
  // console.log("cases.js is working...");
  $.getJSON('case_library/cases_json.php',(caseLibrary)=>{
    $.getJSON('case_library/subtype_json.php',(subtypeLibrary)=>{
      // console.log(caseLibrary);
      // Lists all of the subtypes as buttons
      for (let subtypeNum = 0; subtypeNum < subtypeLibrary.length; subtypeNum++) {
        $("#subtypeBttnList").append("<div class='subtypeBttn' data-selectid='"+subtypeLibrary[subtypeNum]['subtype_id']+"'>"+subtypeLibrary[subtypeNum]['subtype_name']+"</div>");
      };

      // Shows/hides the subtype list
      $("#selectBox").click(()=>{
        if ($(".subtypeBttnList").css('display') == "block") {
          $(".subtypeBttnList").css('display','none');
        } else {
          $(".subtypeBttnList").css('display','block');
        };
      });

      // Selects a subtype, changes the data-subtypeid, shows its name, and hides the list
      $("[data-selectid]").click((event)=>{
        // console.log("subtype selected");
        $("#caseBttnList").empty();
        for (let searchNum = 0; searchNum < subtypeLibrary.length; searchNum++) {
          if (event.target.dataset.selectid == subtypeLibrary[searchNum]['subtype_id']) {
            $("#selectBox").attr("data-subtypeid",event.target.dataset.selectid);
            let selectName = subtypeLibrary[searchNum]['subtype_name'];
            $("#selectBox").text(selectName);
            $(".subtypeBttnList").css('display','none');
            addSelectedCases(subtypeLibrary[searchNum]['subtype_id']);
            break;
          };
        };
      });

      // Draws up the names and IDs of the selected subtype's cases
      const addSelectedCases = (thisSubtype) => {
        let hasCase = false;
        $("#caseContent").empty();
        $("#caseContent").append("<i>-- No case selected --</i>");
        for (let caseNum = 0; caseNum < caseLibrary.length; caseNum++) {
          if (caseLibrary[caseNum]['subtype_id'] == thisSubtype) {
            if ($(".caseBttnList").css('display') == 'none') {
              $(".caseBttnList").css('display','block');
            };
            $("#caseBttnList").append("<div class='caseBttn' data-caseid='" + caseLibrary[caseNum]['post_id'] + "'>" + caseLibrary[caseNum]['title'] + "</div>");
            hasCase = true;
          };
        };
        if (hasCase == false) {
          $("#caseBttnList").append("<i>-- No case found --</i>");
        };
        // Colors the selected button and inserts the content on
        $("[data-caseid]").click((event)=>{
          let hasText = false;
          $("#caseContent").empty();
          for (let contNum = 0; contNum < caseLibrary.length; contNum++) {
            if (event.target.dataset.caseid == caseLibrary[contNum]['post_id']) {
              $("#caseContent").empty();
              $("#caseContent").text(caseLibrary[contNum]['content']);
              hasText = true;
              break;
            };
          };
          if (hasText == false) {
            $("#caseContent").append("<i>Select a case above</i>");
          };
        });
      };

    });
  });
});
