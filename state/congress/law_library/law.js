$(document).ready(()=>{
  // console.log("bill.js is working...");
  $.getJSON('law_library/law_json.php',(lawLibrary)=>{

    $("[data-postid]").click(()=>{
      let lawId = event.target.dataset.postid;
      $(".oneLawApproval")
        .css('background-color','#051E33')
        .css('color','#fec231');
      $(".oneLawTitle")
        .css('background-color','#051E33')
        .css('color','#fec231');
      $("[data-postid='" + lawId + "']")
        .css('background-color','#fec231')
        .css('color','#051E33');
      // console.log(lawLibrary);
      for (let lawNum = 0; lawNum < lawLibrary.length; lawNum++) {
        if (lawLibrary[lawNum]['post_id'] == lawId) {
          $(".senLawContent").empty();
          if (lawLibrary[lawNum]['content'] == '') {
            $(".senLawContent").append(
              "<div>Details not yet published</div>"
            );
          } else {
            $(".senLawContent").append(
              "<div class='viewLawTitle'>"+lawLibrary[lawNum]['title']+"</div>\
              <div class='viewLawContent'>"+lawLibrary[lawNum]['content']+"</div>"
            );
          };
        };
      };
    });

  });

});
