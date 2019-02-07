<?php

/* Get from $_GET parameters of index.php ( year and cols )
 * Check Validity of parameters 
 * Output <style> and <title> lines */
 
Function Error( $str )
{
	echo "<p class=\"err\">$str</p>";
}

// zwraca true, gdy parametry są poprawne, 
// false - w przeciwnym razie
function Parameters_Are_Valid()
{
	$year = isset( $_GET['year'] ) ? $_GET['year'] : date( 'Y' );
	
	if ( $year < 2000 ) return false;
	
	$nCols = isset( $_GET['cols'] ) ? $_GET['cols'] : 2;

	if ( !in_array( $nCols, array( 1, 2, 3, 4, 6, 12 ) )) return false;
	return true;
}
	
// Pobierz do zmiennych &$year, &$nCols, &$nRows parametry $_GET lub wartości domyślne
// zwraca true, gdy parametry są poprawne, 
// w przeciwnym razie - wypisuje komunikat o błędzie i zwraca false
function Get_Parameters( &$year, &$nCols, &$nRows )
{
	
	$year = isset( $_GET['year'] ) ? $_GET['year'] : date( 'Y' );
		
	$valid = $year >= 2000;
	if ( !$valid ) 
	{
		Error( 'Rok musi być >= 2000' );
	}
		
	$nCols = isset( $_GET['cols'] ) ? $_GET['cols'] : 2;
		
	if ( !in_array( $nCols, array( 1, 2, 3, 4, 6, 12 ) )) 
	{
		Error( 'Ilość kolumn musi być równa 1, 2, 3, 4, 6 lub 12' );
		$valid = false;
	}
	
	if( $valid )
	{			
		$nRows = intval( round( 12 / $nCols ));
	}
	
	return $valid;
}

// wypisz linię z tagiem <style> ( potrzebna tylko dla kalendarza )
// oraz linię z tagiem <title>
function Output_Style_and_Title()
{
	$year = isset( $_GET['year'] ) ? $_GET['year'] : date( 'Y' );
		
	$nCols = isset( $_GET['cols'] ) ? $_GET['cols'] : 2;	
	
	$calendar_will_be_shown = !empty( $_GET ) && Parameters_Are_Valid();

	$width = 70 + 420 * $nCols;
	$title = $calendar_will_be_shown ? 'Kalendarz na rok '.$year : 'Kalendarz na dowolny rok >= 2000';
	
	if( $calendar_will_be_shown ) echo "\t<style>body { width: $width"."px;}</style>\n";
	echo "\t<title>$title</title>\n";
}	

// nie używamy
function Pocz_Pliku( $rok, $nCols )
{
	$width = 70 + 420 * $nCols;
	
echo "<!DOCTYPE html>
<html lang=\"pl\">
<head>
	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
	<link rel=\"stylesheet\" type=\"text/css\" href=\"calendar.css\">
	<style>body { width: $width"."px;}</style>
	<title>Kalendarz na rok $rok</title>
</head>
<body>
";
}

// nie używamy
function Show_Form()
{
		echo H2( 'Kalendarz na dowolny rok >= 2000');
		echo "<form>\n";
		echo Input_Field( 'Podaj rok', 'year', date( 'Y' ));
	
		echo Input_Field( 'Podaj ilość kolumn (1, 2, 3, 4, 6 lub 12)', 'cols', '2' );
		echo Submit_Btn( 'OK' );
		echo "</form>\n";
}
