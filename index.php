<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="calendar.css">
	<title>Kalendarz - wiek XXI</title>
</head>
<body>
<pre>
<?php

require_once 'calendar.php';

$current_year = date('Y');
New_Calendar( $current_year );

?>
</pre>
</body>
</html>
