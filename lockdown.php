<?php

// This checks to see if the entire website is curently switched off for maintenance
$checkLockStmt = $pdo->prepare("SELECT COUNT(lockdown) FROM Maintenance WHERE lockdown=1");
$checkLockStmt->execute();
$checkLock = $checkLockStmt->fetch(PDO::FETCH_ASSOC)['COUNT(lockdown)'];

?>
