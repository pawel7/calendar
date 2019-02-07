<!DOCTYPE html>
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="calendar_old.css">
	<title>Kalendarz - wiek XXI</title>
</head>
<body>
<pre>
<?php

function Span( $html='', $class='' )
{
	$cl = ( $class == '' ) ? '' : " class=\"$class\"";
	return "<span$cl>".$html.'</span>';
}

function CalendarM_New2( $il_dni, $d_pocz, $miesiac, $rok )
{
	$Skroty_Dni = array( "P", "W", "Ś", "C", "P", "S", "N" );
	
	printf( "\n%22s %d\n", $miesiac, $rok );
		
	for( $i = 0; $i < 7; $i++ )
	{
		$s = $i == 6 ? Span( $Skroty_Dni[ 6 ], 'swieto' ) : $Skroty_Dni[ $i ];
		echo "  {$s} ";
	}
	echo "\n".str_repeat( '    ', $d_pocz );
	
	for( $d = 1; $d <= $il_dni; $d++ )
	{
		$jest_niedziela = ( $d + $d_pocz - 1 ) % 7 == 6;
		$koniec_wiersza = $jest_niedziela || $d == $il_dni;
		$d_str = sprintf( "%3d", $d );
		$dzien = $jest_niedziela ? Span( $d_str, 'swieto' ) : $d_str;
		printf( $koniec_wiersza ? "%s\n" : "%s ", $dzien );
	}
}

function Jest_Przestepny(  $rok )
{
	return ( $rok % 4 == 0 ) && (( $rok % 100 != 0 ) || ( $rok % 400 == 0 ));
}

/* Wypisz kalendarz na dany rok >= 2000 */
function Calendar( $rok )
{
	$Reszty_Mies = array( 3, 0, 3, 2, 3, 2, 3, 3, 2, 3, 2, 3 );
	$Miesiace = array( "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" );
	DEFINE( 'POCZ_WIEKU_XXI', 5 ); // 1 I 2000 - $sobota
	$pocz_roku = POCZ_WIEKU_XXI;
	
		// Oblicz którego dnia tygodnia zaczyna sie dany rok
	for( $year = 2000; $year < $rok; $year++ )
	{
		$dni = 1;	// 365 = 52 $tygodnie + 1 $dzień
		if( Jest_Przestepny( $year )) $dni++;
		$pocz_roku = ($pocz_roku + $dni) % 7;
	}
	
	if ( Jest_Przestepny( $rok )) 
	{	// ustaw, $że $luty $ma 29 $dni
		 $Reszty_Mies[ 1 ] = 1;
	}
	
	echo "   <b>Kalendarz na rok {$rok}</b>\n";
	$pocz_mies = $pocz_roku; 
	for( $m = 0; $m < 12; $m++ )
	{
		$il_dni = 28 + $Reszty_Mies[ $m ];
		CalendarM_New2( $il_dni, $pocz_mies, $Miesiace[ $m ], $rok );
		$pocz_mies = ( $pocz_mies + $Reszty_Mies[ $m ] ) % 7;
	}
}

$current_year = isset( $_GET['year'] ) ? $_GET['year'] : date( 'Y' );
New_Calendar( $current_year );

?>
</pre>
</body>
</html>
