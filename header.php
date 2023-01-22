<?php
require_once('configtorrent.php');

mysql_connect($CFG['db_host'], $CFG['db_user'], $CFG['db_pass']) or die(mysql_error());
mysql_select_db($CFG['db_name']);

function tag_info() { 
  $result = mysql_query("SELECT * FROM torrent_tags GROUP BY tag_name ORDER BY count DESC LIMIT 50"); 
  while($row = mysql_fetch_array($result)) { 
    $arr[$row['tag_name']] = $row['count'];
    
  } 
  //ksort($arr);
  return $arr; 
}

function tag_cloud() {

    $min_size = 15;
    $max_size = 40;
 
    $tags = tag_info();

    $minimum_count = min(array_values($tags));
    $maximum_count = max(array_values($tags));
    $spread = $maximum_count - $minimum_count;

    if($spread == 0) {
        $spread = 1;
    }

    $cloud_html = '';
    $cloud_tags = array();

	$step = ($max_size - $min_size)/($spread);


    foreach ($tags as $tag => $count) {
        $size = $min_size + ($count - $minimum_count) 
            * $step;
            

//  $size = ($max_size + $min_size)/$spread;
        $cloud_tags[] = '<a style="font-size: '. floor($size) . 'px'
            . '"  href="'.$CFG['domain'].'/index.php?search=' . $tag . '" title="' . urldecode($tag) . ' torrent is searched ' . $count . ' times">'
            .urldecode($tag) . '</a>';
    }
    $cloud_html = join("\n", $cloud_tags) . "\n";
    return $cloud_html;
}




?>