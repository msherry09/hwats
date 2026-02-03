<?php
$link = mysql_connect('dbhost.hwats.com','hwatsdb_usr','Druk-72f'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
$db_selected = mysql_select_db('hwats_db', $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}
?> 