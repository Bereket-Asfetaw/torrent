<?php

require_once('configtorrent.php');

$torrent = htmlentities(strip_tags(trim($_GET['torrent'])));


$torrent = str_replace("/", "", $torrent);


if (!isset($torrent)) { 

	

	header("Location: index.php");

	exit;

	

	} else {



	$url = "http://www.torrentz.com/".$torrent;

	



	$gurl = file_get_contents($url);


$titleorj = explode("<title>", $gurl);

$titleorj = explode("</title>", $titleorj[1]);


//no edit here
$title = str_replace(" Torrent Download", "", $titleorj[0]);



// can be edited
	$description = $title." torrent downloads | Download Latest and Verified Torrents at ".$CFG['site_name'];
	$keywords = $title.", torrent,download, verified, links, axxo, klaxxon, movies, tv series, tv shows, ripped, hdtv"; 
		


?>

<html>

	<head>

		<title><?=$title?> | Torrent Downloads</title>

		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" >

		<meta name="keywords" content="<?=$keywords?>" />
		<meta name="description" content="<?=$description?>" />


		<link rel="stylesheet" href="<?=$CFG['domain']?>/style.css" type="text/css" >
       


	<SCRIPT LANGUAGE="JavaScript">

                      <!--

                      function popitup(url) {

                      	newwindow=window.open(url,'name','height=700,width=500');

                      	if (window.focus) {newwindow.focus()}

                      	return false;

                      }

                      

                      // -->

	</script>

</head>

<body>

<div align="center"><a href="<?=$CFG['domain']?>" target="_self"><img src="<?=$CFG['domain']?>/img/header.gif" border="0" alt="<?=$CFG['title']?>" ></a></div>





<div align="center" style="margin-top:30px;">





 <div id="srcbox">

 		<form action="<?=$CFG['domain']?>/index.php" method="get" onsubmit="this.submit();return false;">

			<input class="src" name="search" type="text" autocomplete="off" delay="1500" value="type and go..." onBlur="if(this.value=='') this.value='type and go...';" onFocus="if(this.value=='type and go...') this.value='';">

			

			<input type="image" src="<?=$CFG['domain']?>/img/submit.png" name="Submit" value="Submit">

		</form>

 </div> 

</div>

<!-- RESULTS TABLE -->

<table class="results"  style="width: 800px;">

<div class="files"><h2>Download Links for "<b><?=$title?></b>"</h2></div>



<tr class="resultsrowheader">

	<td width="150">Host</td>

	<td>Torrent Name</td>

	<td style="text-align: right">Last Update</td>



</tr>

<?php









$downloadlinkz = explode("<div class=\"download\">", $gurl);

$downloadlinkz = explode("</p>", $downloadlinkz[1]);



$downloadlinkz = $downloadlinkz[0];





$i=1;

$r=20;

while ($i <= $r){



//take list

$downlist = explode("<dl>", $downloadlinkz);

$downlist = explode("</dl>", $downlist[$i]);



//torrent host name

$torrenthost = explode("center;\">", $downlist[0]);

$torrenthost = explode("</span>", $torrenthost[1]);



//torrent host link

$torrenthostlink = explode("href=\"", $downlist[0]);

$torrenthostlink = explode("\" rel", $torrenthostlink[1]);



//torrent name in host

$torrentnameinhost = explode("class=\"n\">", $downlist[0]);

$torrentnameinhost = explode("</span>", $torrentnameinhost[1]);



//torrent update time in host

$torrentupdateinhost = explode("<dd>", $downlist[0]);

$torrentupdateinhost = explode("</dd>", $torrentupdateinhost[1]);







 if (!empty($downlist[0]))

   {



$torrenthost = $torrenthost[0]; // torrent host name

$torrenthostlink = $torrenthostlink[0]; // torrent download link

$torrentnameinhost = $torrentnameinhost[0]; // torrent name in host

$torrentupdateinhost = $torrentupdateinhost[0]; // torrent update time





$stylez = str_replace("/img/", $CFG['domain']."/img/", $stylez);







echo "

<tr class=\"resultsrow\">

	<td class=\"host\" style=\"".$stylez."\"><a href=\"".$CFG['domain']."/teleport.php?url=".$torrenthostlink."\" class=\"external\" rel=\"external nofollow\" target=\"_blank\">".$torrenthost."</a>

	</td>

	<td class=\"n\">".$torrentnameinhost."</td>

	<td class=\"u\">".$torrentupdateinhost."</td>



</tr>\n\n";

	



}





$i++;



}



?>

</table>

<!-- EOF RESULTS TABLE -->



<br ><br >





<!-- TORRENT TRACKERS -->



<table class="results">



<div class="files"><h2>Tracker List</h2></div>



<tr class="resultsrowheader">

	<td>Tracker</td>

	<td>Last Update</td>

	<td>Seeders</td>

	<td>Leechers</td>

</tr>





<?php





$trackerz = explode("<div class=\"trackers\">", $gurl);

$trackerz = explode("<p>", $trackerz[1]);



$trackerz = $trackerz[0];





$i=1;

$r=20;

while ($i <= $r){



//take tracker list

$trackerlist = explode("<dl>", $trackerz);

$trackerlist = explode("</dl>", $trackerlist[$i]);



//tracker link

$trackerlink = explode("\">", $trackerlist[0]);

$trackerlink = explode("</a>", $trackerlink[1]);



//tracker last update

$trackerlastupdate = explode("class=\"a\">", $trackerlist[0]);

$trackerlastupdate = explode("</span>", $trackerlastupdate[1]);



//tracker uploaders

$trackeru = explode("class=\"u\">", $trackerlist[0]);

$trackeru = explode("</span>", $trackeru[1]);



//tracker downloaders

$trackerd = explode("class=\"d\">", $trackerlist[0]);

$trackerd = explode("</span>", $trackerd[1]);





 if (!empty($trackerlist[0]))

   {



$trackerlink = $trackerlink[0]; // tracker link

$trackerlastupdate = $trackerlastupdate[0]; // tracker last update

$trackeru = $trackeru[0]; // tracker uploaders

$trackerd = $trackerd[0]; // tracker downloaders







echo "

<tr class=\"resultsrow\">

	<td class=\"trackerlink\" style=\"padding-right: 20px;".$stylez."\">".$trackerlink."</td>

	<td class=\"a\">".$trackerlastupdate."</td>

	<td class=\"u\">".$trackeru."</td>

	<td class=\"d\">".$trackerd."</td>

</tr>\n\n";

	



}





$i++;



}

?>



</td>



<!-- EOF TORRENT TRACKERS -->



<!-- Utorrent Tracker List -->









</table>

<a href="" class="external" onClick="return popitup('<?=$CFG['domain']?>/trackerlist.php?torrent=<?=urlencode($torrent)?>')" >Utorrent Compatible List</a>



<!-- EOF Utorrent Tracker List -->





<br><br>





<?php

/// FILES



$feedback = explode("<div class=\"feedback\" id=\"vote-box\">", $gurl);

$feedback = explode("</div>", $feedback[1]);



$feedback = str_replace("<h2>", "<div class=\"files\"><h2>", $feedback[0]);



$feedback = str_replace("</h2>", "</h2></div>", $feedback);





echo $feedback;





?>





<br>

<br>

<div class="files">

<?php

/// FEEDBACK 



$feedback = explode("<div class=\"files\">", $gurl);

$feedback = explode("</ul></div>", $feedback[1]);



$feedback = $feedback[0];



echo $feedback;





$related= explode("<div class=\"results\">", $gurl);

$related = explode("</dl></div>", $related[1]);


if (!empty($related[0]))
   {
echo "
<div class=\"files\"><h2>Related Torrents</h2> </div>
<table border=\"0\" class=\"results\" width=\"%100\">

";
 
}

$i=1;
$r=10;
while ($i <= $r){




$aud = explode("<dl>", $related[0]);
$aud = explode("</dl>", $aud[$i]);




/// FIND CLASS A //

$classa = explode("<span class=\"a\">", $aud[0]);
$classa = explode("</span>", $classa[1]);

/// FIND CLASS A //

$classs = explode("<span class=\"s\">", $aud[0]);
$classs = explode("</span>", $classa[1]);

/// FIND CLASS U //

$classu = explode("<span class=\"u\">", $aud[0]);
$classu = explode("</span>", $classu[1]);

/// FIND CLASS D //

$classd = explode("<span class=\"d\">", $aud[0]);
$classd = explode("</span>", $classd[1]);


//TAGS //
$tagz = explode("&#187;", $aud[0]);
$tagz = explode("</dt>", $tagz[1]);

//LINKz

$linkz = explode("href=\"/", $aud[0]);
$linkz = explode("\">", $linkz[1]);


//NAMEZ

$namez = explode($linkz[0]."\">", $aud[0]);
$namez = explode("</a>", $namez[1]);

//STYLE

$stylez = explode("style=\"", $aud[0]);
$stylez = explode("><a href=", $stylez[1]);




//echo $namez[0];






   //echo $aud[0]." ".$link[0]."<br>\n";
   
   
   
   if (!empty($aud[0]))
   {
$name = $aud[0];
$link = $link[0];


$classa = $classa[0]; // 2 DAYS AGO
$classs = $classs[0]; // 699MB
$classu = $classu[0]; // YESÝL YAZILI UPLOADERS
$classd = $classd[0]; // DOWNLOADERS
$tagz = $tagz[0]; // TAGS 
$linkz = $linkz[0]; //links
$namez = $namez[0]; //names
$stylez = $stylez[0]; //names

$stylez = str_replace("/img/", $CFG['domain']."/img/", $stylez);



//echo $namez;

if (preg_match("|accept|", $aud[0]))
	 {

 	}



$namezx=strtr($namez,"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜßàáâãäåæçèéêëìíîïñòóôõöøùúûüÿÜü??????",
     "AAAAAAACEEEEIIIINOOOOOOUUUUsaaaaaaaceeeeiiiinoooooouuuuyUuSsGgIi");

$namezx = strip_tags($namezx);


     
	$beforeseo = array("/[^a-zA-Z0-9]/", "/-+/", "/-$/");
	$afterseo = array("-", "-", "");

	$namezx = strtolower(preg_replace($beforeseo, $afterseo , $namezx));      
     
echo "
<tr class=\"resultsrow\">
	<td class=\"name\" style=\"".$stylez."\"><a href=\"".$CFG['domain']."/torrents/".$namezx."/".$linkz."\" title=\"".strip_tags($namez)."\">".$namez."</a> &#187; ".$tagz."
	</td>
	<td>
		<td class=\"a\">".$classa."</td><td class=\"s\">".$classs."</td><td class=\"u\">".$classu."</td><td class=\"d\">".$classd."</td>
	</td>
</tr>\n\n";
	




}

$i++;

}
echo      "</table><br><br>";






include ("footer.php");

?>

</body>

</html>

<?php

}

?>
