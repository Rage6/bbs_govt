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
        $("#caseBttnList").empty();
        for (let searchNum = 0; searchNum < subtypeLibrary.length; searchNum++) {
          if (event.target.dataset.selectid == subtypeLibrary[searchNum]['subtype_id']) {
            $("#selectBox").attr("data-subtypeid",event.target.dataset.selectid);
            let selectName = subtypeLibrary[searchNum]['subtype_name'];
            $("#selectBox").text(selectName);
            if (window.outerWidth < 769) {
              $(".subtypeBttnList").css('display','none');
            } else {
              $(".subtypeBttn").css('color','white');
              $("[data-selectid=" + event.target.dataset.selectid + "]").css('color','#fec231');
            };
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
          $(".caseBttn").css('color','white');
          console.log(event.target.dataset.caseid);
          let caseId = event.target.dataset.caseid;
          $("[data-caseid="+caseId+"]").css('color','#fec231')
          let hasText = false;
          $("#caseContent").empty();
          for (let contNum = 0; contNum < caseLibrary.length; contNum++) {
            if (event.target.dataset.caseid == caseLibrary[contNum]['post_id']) {
              $("#caseContent").empty();
              $("#caseContent").append("<div style='text-align:center'><i>" + caseLibrary[contNum]['title'] + "</i></div></br><div>" + caseLibrary[contNum]['content'] + "</div>");
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
