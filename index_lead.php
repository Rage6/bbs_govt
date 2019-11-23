<?php

  // For necessary county stats...
  $countyList = [];
  $findCountyStmt = $pdo->prepare("SELECT section_id, section_name, population, flags FROM Section WHERE is_county != 0 AND is_city = 0");
  $findCountyStmt->execute();
  while ($oneCounty = $findCountyStmt->fetch(PDO::FETCH_ASSOC)) {
    $countyList[] = $oneCounty;
  };

  // For necessary city stats...
  $cityList = [];
  $findCityStmt = $pdo->prepare("SELECT section_id, section_name, population, flags, is_city FROM Section WHERE is_county != 0 ORDER BY is_county ASC, is_city ASC, section_name ASC");
  $findCityStmt->execute();
  while ($oneCity = $findCityStmt->fetch(PDO::FETCH_ASSOC)) {
    $cityList[] = $oneCity;
  };

  // Total state population...
  $totalPopulation = 0;
  for ($cityNum = 0; $cityNum < count($cityList); $cityNum++) {
    $totalPopulation += $cityList[$cityNum]['population'];
  };

  // Number of cities
  $countCities = $pdo->prepare("SELECT COUNT(section_name) FROM Section WHERE is_city=1");
  $countCities->execute();
  $totalCities = $countCities->fetch(PDO::FETCH_ASSOC)['COUNT(section_name)'];

  // Number of counties
  $countCounties = $pdo->prepare("SELECT COUNT(section_name) FROM Section WHERE is_county>0 AND is_city=0");
  $countCounties->execute();
  $totalCounties = $countCounties->fetch(PDO::FETCH_ASSOC)['COUNT(section_name)'];

?>
