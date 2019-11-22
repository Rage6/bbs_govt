$(() => {
  console.log("index main.js works");

  $("#explainBttn").click(()=>{
    let maxHeight = $(".explainBox").css('max-height');
    console.log(maxHeight);
    if (maxHeight == "100px") {
      $(".explainBox").css('max-height','inherit');
      $("#explainBttn").text('-- SEE LESS --');
    } else {
      $(".explainBox").css('max-height','100px');
      $("#explainBttn").text('-- SEE MORE --');
    };
  });

});
