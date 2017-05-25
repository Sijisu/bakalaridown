<?php
require('config.php');
$db = dbconnect();
$bakaup = bakalariup("skola.gbl.cz/bakalari/login.aspx");
if($_GET['t'] == $token) {
$stmt = $db->prepare('INSERT INTO bakalaridown (`Answer`, `Time`) VALUES (?,NOW())');
$stmt->execute(array($bakaup));
if (!$bakaup) {
$subject = 'Bakalari are down!!! 😄 👍';
$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>
<head></head>
<body>Celebrate! Bakalari are down! <br />More at: <a href='//bakalaridown.sijisu.tk'>bakalaridown.sijisu.tk</a>.</body></html>";
mail($to, $subject, $message, $headers);
}
} else {
  echo "Go away . . . ";
  $subject = 'Bakalaridown - Someone is knocking... 👽 😈';
  $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>
  <head></head>
  <body>Someone tried to access down.php on server. <br />More at: <a href='//bakalaridown.sijisu.tk'>bakalaridown.sijisu.tk</a>.</body></html>";
  mail($to, $subject, $message, $headers);
}
