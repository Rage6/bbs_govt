<?php
  session_start();
  require_once("pdo.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS 2019</title>
    <link rel="stylesheet" type="text/css" href="style/required.css" />
    <link rel="stylesheet" type="text/css" href="style/index.css" />
  </head>
  <body>
    <div class="adminLink">
      <a href="admin/login/login.php">
        <img src="img/gear.png" />
      </a>
    </div>
    <div id="hubTitle">
      <div>Welcome To</div>
      <div>Buckeye Boys State</div>
    </div>
    <div id="hubContent">
      <a href="levels/state.php">
        <div id="stateButton" class="levelButton">
          <img class="levelImg" src="img/congress_3.jpg">
          <div class="levelTitle">
            STATE
          </div>
        </div>
      </a>
      <a href="">
        <div id="countyButton" class="levelButton">
          <img class="levelImg" src="img/county_1.jpg">
          <div class="levelTitle">
            COUNTY
          </div>
        </div>
      </a>
      <a href="">
        <div id="cityButton" class="levelButton">
          <img class="levelImg" src="img/city_1.png">
          <div class="levelTitle">
            CITY
          </div>
        </div>
      </a>
    </div>
    <div class="applyLink">
      Want to attend Buckeye Boys State next year?<br/>
      <a href="http://www.ohiobuckeyeboysstate.com/">
        <u>CLICK HERE!</u>
      </a>
    </div>
  </body>
</html>
