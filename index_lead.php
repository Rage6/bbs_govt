<?php

  $countyList = [];
  $findCountyStmt = $pdo->prepare("SELECT section_id, section_name FROM Section WHERE is_county != 0 AND is_city = 0");
  $findCountyStmt->execute();
  while ($oneCounty = $findCountyStmt->fetch(PDO::FETCH_ASSOC)) {
    $countyList[] = $oneCounty;
  };

  $cityList = [];
  $findCityStmt = $pdo->prepare("SELECT section_id, section_name FROM Section WHERE is_county != 0 AND is_city = 1");
  $findCityStmt->execute();
  while ($oneCity = $findCityStmt->fetch(PDO::FETCH_ASSOC)) {
    $cityList[] = $oneCity;
  };

?>
