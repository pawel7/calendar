<!DOCTYPE html>
<html lang="pl">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" type="text/css" href="calendar.css">
<?php
	require_once "calendar.php";
	require_once "parameters.php";

		// wypisz linie z tagiem <style> oraz <title>
	Output_Style_and_Title();
?>
</head>
<body>
<?php 
		// Sprawdź poprawność parametrów i pobierz je 
	$valid = Get_Parameters( $year, $nCols, $nRows );
	
		// wyświetl kalendarz na konkretny rok z daną ilością kolumn
		// o ile nie ma błędu w parametrach $_GET
	if( $valid && !empty( $_GET ))
	{
		echo Generate_Calendar( $year, $nCols, $nRows );
	}
	else
	{ // !$valid || empty( $_GET )
		// wypisz formularz do pobrania roku i ilości kolumn
		// w przypadku, gdy poprzednim razem błędnie podano, lub wywołano skrypt bez parametrów ( pusty $_GET )
	?>
		
  <h2>Kalendarz na dowolny rok >= 2000</h2>
  <form>
    <label>Podaj rok</label> 
		<input type="text" name="year" id="year" value="<?= date('Y');?>"><br>
    <label>Podaj ilość kolumn (1, 2, 3, 4, 6 lub 12)</label> 
		<input type="text" name="cols" id="cols" value="2"><br>
    <label> </label> 
		<input type="submit"  value="OK" autofocus/><br>
  </form>
<?php } ?>
	
</body>
</html>
