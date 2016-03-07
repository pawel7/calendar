<?php

function P( $html='', $class='' )
{
	$cl = ( $class == '' ) ? '' : " class=\"$class\"";
	return "<p$cl>".$html.'</p>';
}

function P( $html='', $class='' )
{
	$cl = ( $class == '' ) ? '' : " class=\"$class\"";
	return "<p$cl>".$html.'</p>';
}

function Span( $html='', $class='' )
{
	$cl = ( $class == '' ) ? '' : " class=\"$class\"";
	return "<span$cl>".$html.'</span>';
}

function TD( $html='', $class='' )
{
	$cl = ( $class == '' ) ? '' : " class=\"$class\"";
	return "<td$cl>".$html.'</td>';
}

function New_Calendar( $rok )
{
	$Miesiace = Calendar( $rok );
	Tabela_Miesiecy( 3, 4, $Miesiace );
}

function Tabela_Miesiecy( $nCol, $nRow, $Miesiace )
{
	echo "<table>\n";
	for( $i = 0; $i < $nRow; $i++ )
	{
		echo "<tr>";
		for( $j = 0; $j < $nCol; $j++ )
		{
			$m = $j * $nRow + $i;
			echo TD( $Miesiace[ $m ] );
			echo TD( ' ', 'm'.($m+1) );
		}
		echo "</tr>\n";
	}
	echo "</table>\n";
}
	
function CalendarM( $il_dni, $d_pocz, $miesiac, $rok )
{
	$Skroty_Dni = array( "P", "W", "Ś", "C", "P", "S", "N" );
	
	//$html = sprintf( "%22s %d\n", $miesiac, $rok );
	$html = P( $miesiac.' '.$rok, 'name' ); 
		
	for( $i = 0; $i < 7; $i++ )
	{
		$s = $i == 6 ? Span( $Skroty_Dni[ 6 ], 'swieto' ) : $Skroty_Dni[ $i ];
		$html .= "  {$s} ";
	}
	$html .= "\n<hr>".str_repeat( '    ', $d_pocz );
	
	for( $d = 1; $d <= $il_dni; $d++ )
	{
		$jest_niedziela = ( $d + $d_pocz - 1 ) % 7 == 6;
		$koniec_wiersza = $jest_niedziela || $d == $il_dni;
		$d_str = sprintf( "%3d", $d );
		$dzien = $jest_niedziela ? Span( $d_str, 'swieto' ) : $d_str;
		$html .= sprintf( $koniec_wiersza ? "%s\n" : "%s ", $dzien );
	}
	return $html;
}

function Jest_Przestepny(  $rok )
{
	return ( $rok % 4 == 0 ) && (( $rok % 100 != 0 ) || ( $rok % 400 == 0 ));
}

/* Wypisz kalendarz na dany rok >= 2000 */
function Calendar( $rok )
{
	$Reszty_Mies = array( 3, 0, 3, 2, 3, 2, 3, 3, 2, 3, 2, 3 );
	$Nazwy_Mies = array( "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" );
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
	
	echo "   <h1>Kalendarz na rok {$rok}</h1>\n";
	$pocz_mies = $pocz_roku;
	$Miesiace = array();
	for( $m = 0; $m < 12; $m++ )
	{
		$il_dni = 28 + $Reszty_Mies[ $m ];
		$Miesiace[ $m ] = CalendarM( $il_dni, $pocz_mies, $Nazwy_Mies[ $m ], $rok );
		$pocz_mies = ( $pocz_mies + $Reszty_Mies[ $m ] ) % 7;
	}
	return $Miesiace;
}

