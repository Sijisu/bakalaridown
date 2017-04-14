<?php
require('config.php');
$db = dbconnect();
$bakaup = bakalariup("skola.gbl.cz/bakalari/login.aspx");
if($_GET['t'] == $token) {
$stmt = $db->prepare('INSERT INTO bakalaridown (`Answer`, `Time`) VALUES (?,NOW())');
$stmt->execute(array($bakaup));
} else {
  echo "Go away . . . ";
}
