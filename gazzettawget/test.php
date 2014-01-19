<?php

date_default_timezone_set('Europe/Rome');
$date = date('d-m-y');

exec('wget http://m.magazine3k.com/topic/la-gazzetta-dello-sport/ -O index.html');
$html = file_get_contents('index.html');

$pos = strpos($html, $date.'.html');
if($pos === FALSE) { die('No index.html'); }

preg_match( "/href=\"(\/magazine\/newspapers\/[0-9]*\/la-gazzetta-dello-sport-$date.html)\" class=\"justi\"/", $html, $match);
if(count($match) < 2) { die('No code page pregmatch'); }

$page = $match[1];
exec("wget http://m.magazine3k.com$page -O index.html");

$html = file_get_contents('index.html');

/*preg_match("%value=\"(http://www.mediafire.com/?.*)\"%", $html, $match);
var_dump($match);
if(count($match) < 2) { die('No mediafire pregmatch'); }

exec("plowdown http://www.mediafire.com/?lubl3zr0l5mnd3m");*/

