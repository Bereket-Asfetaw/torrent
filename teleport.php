<?php
$url = strip_tags(trim($_GET['url']));

header("Location: $url"); /* Redirect browser */

exit;
?> 