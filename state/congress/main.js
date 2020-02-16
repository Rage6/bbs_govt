$(()=>{

  // For selecting the House of Reps initially
  $("#repClick").click(()=>{
    $(".wholeBox").css("animation-name","initRedBox");
  });

  // For selecting the House of Reps from the Senate box
  // THIS ID HASN'T BEEN MADE YET (15FEB2020)
  $("#repTab").click(()=>{
    $(".wholeBox").css("animation-name","redBox");
  });

  // For selecting the Senate initially
  $("#senClick").click(()=>{
    $(".wholeBox").css("animation-name","initBlueBox");
  });

  // For selecting the Senate from the House of Reps box
  // THIS ID HASN'T BEEN MADE YET (15FEB2020)
  $("#senTab").click(()=>{
    $(".wholeBox").css("animation-name","blueBox");
  });

})
