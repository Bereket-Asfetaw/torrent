<?php
$torrent = htmlentities(strip_tags(trim($_GET['torrent'])));

if (isset($torrent))

{

$url = "http://www.torrentz.com/announce_".$torrent;

$track = file_get_contents($url);

header('Content-Type: text/plain');

echo $track;

}

?>