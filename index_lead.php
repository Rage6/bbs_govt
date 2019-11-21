<?php

  $countyList = [];
  $findCountyStmt = $pdo->prepare("SELECT section_id, section_name, population, flags FROM Section WHERE is_county != 0 AND is_city = 0");
  $findCountyStmt->execute();
  while ($oneCounty = $findCountyStmt->fetch(PDO::FETCH_ASSOC)) {
    $countyList[] = $oneCounty;
  };

  $cityList = [];
  // Without county info...
  // $findCityStmt = $pdo->prepare("SELECT section_id, section_name, population, flags FROM Section WHERE is_county != 0 AND is_city = 1");
  // With county info...
  $findCityStmt = $pdo->prepare("SELECT section_id, section_name, population, flags, is_city FROM Section WHERE is_county != 0 ORDER BY is_county ASC, is_city ASC, section_name ASC");
  $findCityStmt->execute();
  while ($oneCity = $findCityStmt->fetch(PDO::FETCH_ASSOC)) {
    $cityList[] = $oneCity;
  };

?>
