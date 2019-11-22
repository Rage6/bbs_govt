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
    <!-- <div>
      The introduction paragraph
    </div>
    <div>
      The paragraph with statistics
    </div> -->
    <div id="hubContent">
      <div id="stateButton">
        <div class="levelTitle">
          STATE
        </div>
        <a href="state/governor/governor.php">
          <div class="levelButton">
            Office of the Governor
          </div>
        </a>
        <a href="state/senate/senate.php">
          <div class="levelButton">
            Senate
          </div>
        </a>
        <a href="state/house_of_reps/house_of_reps.php">
          <div class="levelButton">
            House of Representatives
          </div>
        </a>
        <a href="state/supreme_court/supreme_court.php">
          <div class="levelButton">
            Supreme Court
          </div>
        </a>
      </div>
      <div id="countyButton">
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
            echo(
              "<a href='county/county.php?section_id=".$countyList[$countyNum]['section_id']."'>
                <div class='levelButton'>
                  <div class='sectionName'>
                    <div>".$countyList[$countyNum]['section_name']." County</div>
                    <div><img src='img/right_arrow.png'></div>
                  </div>
                  <div class='statsRow'>
                    <div><img src='img/flag_2.png'> ".$countyList[$countyNum]['flags']."</div>
                    <div style='border-right:3px solid black'></div>
                    <div><img src='img/delegate_2.png'> ".$cntyPop."</div>
                  </div>
                </div>
              </a>"
            );
          };
        ?>
      </div>
      <div id="cityButton">
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
              echo(
                "<a href='city/city.php?section_id=".$cityList[$cityNum]['section_id']."'>
                  <div class='levelButton'>
                    <div class='sectionName'>".$cityList[$cityNum]['section_name']." City</div>
                    <div class='statsRow'>
                      <div><img src='img/flag_2.png'> ".$cityList[$cityNum]['flags']."</div>
                      <div style='border-right:3px solid black'></div>
                      <div><img src='img/delegate_2.png'> ".$cityList[$cityNum]['population']."</div>
                    </div>
                  </div>
                </a>"
              );
            };
          };
        ?>
      </div>
    </div>
    <div class="applyLink">
      Want to attend Buckeye Boys State next year?<br/>
      <a href="http://www.ohiobuckeyeboysstate.com/">
        <u>CLICK HERE!</u>
      </a>
    </div>
  </body>
</html>
