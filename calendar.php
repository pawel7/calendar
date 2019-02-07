<?php

require_once "lib_html.php";	// P, Span, TD

// wygeneruj kalendarz na rok $year mający $nRows wierszy i $nCols kolumn
function Generate_Calendar( $year, $nCols, $nRows )
{
	$Months_Calendar = Generate_All_Months_Calendar( $year );
	$html = "<pre><h1>Kalendarz na rok {$year}</h1>";
	$html .= Generate_Months_Table( $nCols, $nRows, $Months_Calendar );
	$html .= "</pre>\n";
	return $html;
}

// wygeneruj tabelę mającą $nRows wierszy i $nCols kolumn, 
// której komórkami są miesiące i obrazy dla danego miesiąca ( przez css jako elementy o klasie m1 do m12 )
function Generate_Months_Table( $nCols, $nRows, $Months )
{
	$html = "<table>\n";
	for( $i = 0; $i < $nRows; $i++ )
	{
		$html .= "<tr>";
		for( $j = 0; $j < $nCols; $j++ )
		{
			$m = $j * $nRows + $i;
			$html .= TD( ' ', 'm'.($m+1)).TD( $Months[ $m ] );//.TD( ' ', 'm'.($m+1) );
		}
		$html .= "</tr>\n";
	}
	$html .= "</table>\n";
	return $html;
}

// Wygeneruj html z kalendarzem na dany miesiąc roku, mający $il_dni dni, 
// zaczynający się w dniu $d_pocz ( 0 - poniedziałek, ... 6 - niedziela )
function Generate_Month_Calendar( $il_dni, $d_pocz, $month, $year )
{
	$Days_Abbr = array( "P", "W", "Ś", "C", "P", "S", "N" );
	
	//$html = sprintf( "%22s %d\n", $month, $year );
	$html = P( $month/*.' '.$year*/, 'name' ); 
		
	for( $i = 0; $i < 7; $i++ )
	{
		$klasa = $i == 6 ? 'swieto' : 'powsz';
		$sp = Span( $Days_Abbr[ $i ], $klasa );
		$html .= "  {$sp} ";
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

function Jest_Przestepny(  $year )
{
	return ( $year % 4 == 0 ) && (( $year % 100 != 0 ) || ( $year % 400 == 0 ));
}

//Wygeneruj i zwróć tablicę z kodem HTML dla poszczegolnych miesiecy roku (rok >= 2000)  
function Generate_All_Months_Calendar( $year )
{
		// reszty z dzielenia ilości dni miesiąca przez 7
	$Month_Dif = array( 3, 0, 3, 2, 3, 2, 3, 3, 2, 3, 2, 3 );
	$Month_Names = array( "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" );
	DEFINE( 'POCZ_WIEKU_XXI', 5 ); // 1 I 2000 - $sobota
	$pocz_roku = POCZ_WIEKU_XXI;
	
		// Oblicz którego dnia tygodnia zaczyna sie dany rok
	for( $year = 2000; $year < $year; $year++ )
	{
		$dni = 1;	// 365 = 52 $tygodnie + 1 $dzień
		if( Jest_Przestepny( $year )) $dni++;
		$pocz_roku = ($pocz_roku + $dni) % 7;
	}
	
	if ( Jest_Przestepny( $year )) 
	{	// ustaw, $że $luty $ma 29 $dni
		 $Month_Dif[ 1 ] = 1;
	}
	
	//echo "   <h1>Kalendarz na rok {$year}</h1>\n";
	$pocz_mies = $pocz_roku;
	$Months = array();
	for( $m = 0; $m < 12; $m++ )
	{
		$il_dni = 28 + $Month_Dif[ $m ];
		$Months[ $m ] = Generate_Month_Calendar( $il_dni, $pocz_mies, $Month_Names[ $m ], $year );
		$pocz_mies = ( $pocz_mies + $Month_Dif[ $m ] ) % 7;
	}
	return $Months;
}
