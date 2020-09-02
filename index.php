<?php
  session_start();
  require_once("pdo.php");
  require_once("index_lead.php");
  require_once("lockdown.php");

  if ($checkLock > 0) {
    header('Location: default.html');
    return true;
  };

  $getYearStmt = $pdo->prepare("SELECT starting_date FROM Maintenance");
  $getYearStmt->execute();
  $getYear = $getYearStmt->fetch(PDO::FETCH_ASSOC)['starting_date'];
  $thisYear = explode("-",$getYear)[2];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Buckeye Boys State | <?php echo($thisYear) ?></title>
    <!-- Set-up for posts, texts, etc. -->
    <meta property="og:title" content="Buckeye Boys State" />
    <meta property="og:image" content="img/ohio_flag_bbs.jpg" />
    <meta property="og:description" content="Welcome to Buckeye Boys State! It is here where many young men take their first steps towards becoming our democratic leaders of tomorrow." />
    <!-- Font styles for the index page -->
    <link href="https://fonts.googleapis.com/css?family=Abel|Cinzel|Josefin+Slab|Playfair+Display|Special+Elite&display=swap" rel="stylesheet">
    <!-- CSS across all pages -->
    <link rel="stylesheet" type="text/css" href="style/required.css" />
    <!-- Width: 0px to 360px (Default CSS) -->
    <link rel="stylesheet" type="text/css" href="style/index_360.css"/>
    <!-- Width: 361px to 375px -->
    <link rel="stylesheet" media="screen and (min-width: 361px) and (max-width: 375px)" href="style/index_375.css"/>
    <!-- Width: 376px to 414px -->
    <link rel="stylesheet" media="screen and (min-width: 376px) and (max-width: 414px)" href="style/index_414.css"/>
    <!-- Width: 415px to 768px -->
    <link rel="stylesheet" media="screen and (min-width: 415px) and (max-width: 768px)" href="style/index_768.css"/>
    <!-- Width: 769px to 1366px -->
    <link rel="stylesheet" media="screen and (min-width: 769px) and (max-width: 1366px)" href="style/index_1366.css"/>
    <!-- Width: 1367px to 1440px -->
    <link rel="stylesheet" media="screen and (min-width: 1367px) and (max-width: 1440px)" href="style/index_1440.css"/>
    <!-- Width: 1441px and above -->
    <link rel="stylesheet" media="screen and (min-width: 1441px)" href="style/index_1920.css"/>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico"/>
    <script src=<?php echo($jquery) ?>></script>
    <script src="main.js"></script>
  </head>
  <body>
    <div class="indexMain">
      <div class="adminLink">
        <a href="admin/login/login.php">
          <img src="img/gear.png" />
        </a>
      </div>
      <a name="pageTop">
        <div class="topBar">
          <div id="hubTitle">
            <div>Buckeye Boys State</div>
            <div>DIRECTORY</div>
          </div>
          <div class="ohioLogo">
            <img src="img/Ohio_Flag_Map_Accurate.png" />
          </div>
        </div>
      </a>
      <div id="glossaryBttn" class="glossaryBar">
        MENU
      </div>
      <div id="glossaryBox" class="glossaryBox">
        <div id="numbersBttn">BASIC STATISTICS</div>
        <div id="electBttn">ELECTIONS</div>
        <div id="stateBttn">STATE</div>
        <div id="countyBttn">COUNTY</div>
        <div id="cityBttn">CITY</div>
        <div id="aboutBttn">ABOUT BBS</div>
      </div>
      <div class="introRow">
        <div class="introBox">
          <span class="introTitle">W</span>elcome to the Buckeye Boys State (BBS) government directory. Here you will find:
          <ul>
            <li>Basic statistics about BBS</li>
            <li>Descriptions of the election process for each position</li>
            <li>Links to every branch of the state-level government</li>
            <li>Populations of every city & county</li>
            <li>Total of flags awarded to each county & city</li>
            <li>A short summary of the BBS program</li>
          </ul>
        </div>
        <div id="numbersTop" class="statsBox">
          <div class="statsTitle"><span class="introTitle">B</span>y the numbers...</div>
          <div class="statsList">
            <div>Population: <?php echo($totalPopulation) ?></div>
            <div>Start Date: <?php echo($startDate) ?></div>
            <div>End Date: <?php echo($endDate) ?></div>
            <div>Location: Oxford, OH</div>
            <div>BBS Counties: <?php echo($totalCounties) ?></div>
            <div>BBS Cities: <?php echo($totalCities) ?></div>
          </div>
        </div>
      </div>
    <div class="electionContent">
      <div id="electTop">
        <div class="levelTitle">ELECTIONS</div>
        <div class="electionBox">
          <div class="browserBox">
            <div class="positTitle">GOVERNMENT LEVELS</div>
            <div class="levelList">
              <div data-level="state">STATE</div>
              <div data-level="county">COUNTY</div>
              <div data-level="city">CITY</div>
            </div>
            <div class="clickingRow">
              <div>
                <div class="noteTitle">ELECTED POSITIONS</div>
                <div id="positionList" class="positionBox positionList">
                  <i id="chooseLevel">Choose a level of government...</i>
                </div>
              </div>
              <div>
                <div class="positTitle">STEPS OF ELECTION</div>
                <div id="positionEvents" class="positionBox positionEvents">
                  <i id="chooseJob">Choose an elected position...</i>
                </div>
              </div>
              <div>
                <div class="positTitle">STEP DESCRIPTION</div>
                <div id="positionDescrip" class="positionBox positionDescrip">
                  <i id="chooseStep">Choose a step in that process...</i>
                </div>
              </div>
            </div>
          </div>
          <div class="positTitle"><u>THINGS TO KNOW...</u></div>
          <div class="allTopic">
            <div class="topicBox">
              <div class="topicTitle" data-title="integrity">
                + Election Integrity Matters
              </div>
              <div class="topicContent" data-content="integrity">
                One of Buckeye Boy State's highest priorities is to uphold the fairness and integrity of our democratic elections. For this reason, the requirements, deadlines, and financial transparency expected of every nominee/candidate is <b>strictly enforced</b>. It has happend before in which a delegate was elected, but was unable to fill that position because they failed to meet the electoral standards.
              </div>
            </div>
            <div class="topicBox">
              <div class="topicTitle" data-title="sprint">
                + Elections Are A Sprint
              </div>
              <div class="topicContent" data-content="sprint">
                All of the campaigns and elections at BBS take place within the first three days. This often makes running for an election a fast-paced and exciting 72 hours! If you have already decided to run for an elected position, we encourage you to develop a general campaign plan before arriving on the first day.
              </div>
            </div>
            <div class="topicBox">
              <div class="topicTitle" data-title="serve">
                + Many Ways To Serve
              </div>
              <div class="topicContent" data-content="serve">
                There are MANY different elected positions that are open at the beginning of Buckeye Boys State. They occur at the state, county, and city levels, and each of these levels has its own form of the executive, legislative, and judicial branches. Finally, there are numerous jobs within BBS that will not require you to be elected.
              </div>
            </div>
            <div class="topicBox">
              <div class="topicTitle" data-title="direction">
                + Find Your Path Now
              </div>
              <div class="topicContent" data-content="direction">
                If you are an upcoming delegate and unsure about your goals at BBS, then browse through the list of elected positions and try to find something that interest you. If you have already decided to pursue a certain position, then click on it and see what it takes to reach your goal.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class='pageTop'>
        <a href='#pageTop'>- TOP -</a>
      </div>
    </div>
      <div id="hubContent">
        <div class="govtLinkRow">
          <div id="stateTop">
            <div class="levelTitle">
              STATE
            </div>
            <div class="sectionList">
              <a href="state/governor/governor.php">
                <div class="levelButton stateButton">
                  Office of the Governor
                </div>
              </a>
              <a href="state/congress/congress.php">
                <div class="levelButton stateButton">
                  General Assembly
                </div>
              </a>
              <a href="state/supreme_court/supreme_court.php">
                <div class="levelButton stateButton">
                  Supreme Court
                </div>
              </a>
            </div>
            <div class="pageTop">
              <a href="#pageTop">- TOP -</a>
            </div>
          </div>
          <div id="countyTop">
            <div class="levelTitle">
              COUNTY
            </div>
            <div class="sectionList">
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
                        <div style='border-right:3px solid black; width: 2%;'></div>
                        <div><img src='img/delegate_2.png'> ".$cntyPop."</div>
                      </div>
                    </div>
                  <!-- </a> -->"
                );
              };
            ?>
            </div>
            <div class="pageTop">
              <a href="#pageTop">- TOP -</a>
            </div>
          </div>
          <div id="cityTop">
            <div class="levelTitle">
              CITY
            </div>
            <div class="sectionList">
            <?php
              for ($cityNum = 0; $cityNum < count($cityList); $cityNum++) {
                if ($cityList[$cityNum]['is_city'] == 0) {
                  if ($cityNum != 0) {
                    echo(
                      "<div class='pageTop'>
                        <a href='#pageTop'>- TOP -</a>
                      </div>
                      "
                    );
                  };
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
                          <div style='border-right:3px solid black; width: 2%;'></div>
                          <div><img src='img/delegate_2.png'> ".$cityList[$cityNum]['population']."</div>
                        </div>
                      </div>
                    <!-- </a> -->"
                  );
                };
              };
              echo(
                "<div class='pageTop'>
                  <a href='#pageTop'>- TOP -</a>
                </div>
                "
              );
            ?>
            </div>
          </div>
        </div>
        <div id="aboutTop">
          <div class="levelTitle explainTitle">What Is Buckeye Boys State?</div>
          <div class="explainBox">
            <span class="introTitle">E</span>very summer, approximately 1000 young men take their first steps towards leading our nation by creating and running their own state: Buckeye Boys State (BBS). This 8 day-long camp, which takes place at Miami University in Oxford, OH, is a hands-on exercise in American democracy. During this time, the citizens of BBS will:
            <ul>
              <li>Run their own political parties</li>
              <li>Run for elected position within their BBS cities, counties, or state</li>
              <li>Vote on their own BBS election day</li>
              <li>Take responsibility of their new duties within their BBS community (be they elected, appointed, or hired)</li>
              <li>Fulfill their responsibility as a BBS citizen, such as abiding by the laws passed by the BBS government</li>
            </ul>
            For more information, check out the <a style="color:#fec231;border-bottom: 1px solid #fec231" href="http://www.ohiobuckeyeboysstate.com/">official American Legion website</a>.
          </div>
          <div class="pageTop">
            <a href="#pageTop">- TOP -</a>
          </div>
        </div>
      </div>
      <div class="applyLink footer" style="background-color:black">
        Want to attend Buckeye Boys State next year?<br/>
        <a href="http://www.ohiobuckeyeboysstate.com/">
          <u>CLICK HERE!</u>
        </a>
      </div>
    </div>
  </body>
</html>
