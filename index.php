<?php
  session_start();
  require_once("pdo.php");
  require_once("index_lead.php");
  require_once("lockdown.php");

  if ($checkLock > 0) {
    header('Location: default.html');
    return true;
  };

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>BBS 2019</title>
    <link rel="stylesheet" type="text/css" href="style/required.css" />
    <link rel="stylesheet" type="text/css" href="style/index.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </head>
  <body>
    <div class="adminLink">
      <a href="admin/login/login.php">
        <img src="img/gear.png" />
      </a>
    </div>
    <div id="hubTitle">
      <div>Buckeye Boys State</div>
      <div>DIRECTORY</div>
    </div>
    <div id="glossaryBttn" class="glossaryBar">
      GLOSSARY
    </div>
    <div id="glossaryBox" class="glossaryBox">
      <div id="numbersBttn">BASIC STATISTICS</div>
      <div id="stateBttn">STATE</div>
      <div id="countyBttn">COUNTY</div>
      <div id="cityBttn">CITY</div>
      <!-- <div id="electBttn">ELECTION PROCESS</div> -->
      <div id="aboutBttn">ABOUT BBS</div>
    </div>
    <div class="introRow">
      <div class="introBox">
        <span class="introTitle">W</span>elcome to the Buckeye Boys State (BBS) government directory. Here you will find:
        <ul>
          <li>Basic statistics about BBS</li>
          <li>Links to every branch of the state-level government</li>
          <li>Populations & Flags awarded to every county and city</li>
          <li>A short summary of the BBS program</li>
          <!-- <li>Election process for each elected official</li> -->
        </ul>
        Use the above 'GLOSSARY' button to find your information quickly.
      </div>
      <div id="numbersTop" class="statsBox">
        This is where the basis BBS stats go
      </div>
    </div>
    <div id="hubContent">
      <div class="govtLinkRow">
        <div id="stateTop">
          <div class="levelTitle">
            STATE
          </div>
          <a href="state/governor/governor.php">
            <div class="levelButton">
              <div class="sectionName" style="border-bottom:none;padding-bottom:0px">
                <div>
                  Office of the Governor
                </div>
                <div>
                  <div><img src='img/right_arrow.png'></div>
                </div>
              </div>
            </div>
          </a>
          <a href="state/senate/senate.php">
            <div class="levelButton">
              <div class="sectionName" style="border-bottom:none;padding-bottom:0px">
                <div>
                  Senate
                </div>
                <div>
                  <div><img src='img/right_arrow.png'></div>
                </div>
              </div>
            </div>
          </a>
          <a href="state/house_of_reps/house_of_reps.php">
            <div class="levelButton">
              <div class="sectionName" style="border-bottom:none;padding-bottom:0px">
                <div>
                  House of Representatives
                </div>
                <div>
                  <div><img src='img/right_arrow.png'></div>
                </div>
              </div>
            </div>
          </a>
          <a href="state/supreme_court/supreme_court.php">
            <div class="levelButton">
              <div class="sectionName" style="border-bottom:none;padding-bottom:0px">
                <div>
                  Supreme Court
                </div>
                <div>
                  <div><img src='img/right_arrow.png'></div>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div id="countyTop">
          <div class="levelTitle">
            COUNTY
          </div>
          <?php
            for ($countyNum = 0; $countyNum < count($countyList); $countyNum++) {
              $cntyPopStmt = $pdo->prepare("SELECT SUM(population) FROM Section WHERE is_county=:si");
              $cntyPopStmt->execute(array(
                ':si'=>htmlentities($countyList[$countyNum]['section_id'])
              ));
              $cntyPop = $cntyPopStmt->fetch(PDO::FETCH_ASSOC)['SUM(population)'];
              echo("
                <!-- <a href='county/county.php?section_id=".$countyList[$countyNum]['section_id']."'> -->
                  <div class='levelButton'>
                    <div class='sectionName'>
                      <div>".$countyList[$countyNum]['section_name']." County</div>
                      <!-- <div><img src='img/right_arrow.png'></div> -->
                    </div>
                    <div class='statsRow'>
                      <div><img src='img/flag_2.png'> ".$countyList[$countyNum]['flags']."</div>
                      <div style='border-right:3px solid black'></div>
                      <div><img src='img/delegate_2.png'> ".$cntyPop."</div>
                    </div>
                  </div>
                <!-- </a> -->"
              );
            };
          ?>
        </div>
        <div id="cityTop">
          <div class="levelTitle">
            CITY
          </div>
          <?php
            for ($cityNum = 0; $cityNum < count($cityList); $cityNum++) {
              if ($cityList[$cityNum]['is_city'] == 0) {
                echo(
                  "<div class='subtitle'>
                    <div><u>".$cityList[$cityNum]['section_name']." County</u></div>
                  </div>
                  "
                );
              } else {
                echo("
                  <!-- <a href='city/city.php?section_id=".$cityList[$cityNum]['section_id']."'> -->
                    <div class='levelButton'>
                      <div class='sectionName'>
                        <div>".$cityList[$cityNum]['section_name']." City</div>
                        <!-- <div><img src='img/right_arrow.png'></div> -->
                      </div>
                      <div class='statsRow'>
                        <div><img src='img/flag_2.png'> ".$cityList[$cityNum]['flags']."</div>
                        <div style='border-right:3px solid black'></div>
                        <div><img src='img/delegate_2.png'> ".$cityList[$cityNum]['population']."</div>
                      </div>
                    </div>
                  <!-- </a> -->"
                );
              };
            };
          ?>
        </div>
      </div>
      <div id="aboutTop">
        <div class="levelTitle explainTitle">What Is Buckeye Boys State?</div>
        <div class="explainBox">
          <span class="introTitle">E</span>very summer, nearly 1000 young men take their first steps towards leading our nation by creating and running their own American state: Buckeye Boys State (BBS). This 8 day-long camp, which is taking places at Miami University in Oxford, OH, is a hands-on exercise in American democracy. During this time, the citizens of BBS are:
          <ul>
            <li>Running their own political parties</li>
            <li>Running for an elected position within their BBS city, county, or state</li>
            <li>Voting on their own BBS election day</li>
            <li>Taking responsibility of their new duties within their BBS community (be they elected, appointed, or hired)</li>
            <li>Fulfilling their responsibility as a BBS citizen, such as abiding by the laws passed by the BBS government and paying taxes (with BBS money)</li>
          </ul>
          For more information set the <a style="color:gold;border-bottom: 1px solid gold" href="http://www.ohiobuckeyeboysstate.com/">official American Legion website</a>.
        </div>
      </div>
      <div id="explainBttn" class="moreButton">-- SEE MORE --</div>
    </div>
    <div class="applyLink" style="background-color:black">
      Want to attend Buckeye Boys State next year?<br/>
      <a href="http://www.ohiobuckeyeboysstate.com/">
        <u>CLICK HERE!</u>
      </a>
    </div>
  </body>
</html>
