#include <iostream>
#include <stdio.h>
#include <stdlib.h>

using namespace std;

char* my_itoa(int val, int base){
	
	static char buf[32] = {0};
	
	int i = 30;
	
	for(; val && i ; --i, val /= base)
	
		buf[i] = "0123456789abcdef"[val % base];
	
	return &buf[i+1];
	
}

/* Wypisz kalendarz na miesiąc o danej nazwie, mający il_dni dni, zaczynający się w dniu d_pocz ( 0 - poniedziałek, ... 6 - niedziela ) */
void CalendarM( int il_dni, int d_pocz, const char* miesiac, int rok )
{
	string Skroty_Dni[] = { "P", "W", "Ś", "C", "P", "S", "N" };
	//const char* Skroty_Dni1[] = { "P", "W", "Ś", "C", "P", "S", "N" };
	int i, j, day, j_pocz;
	
	
	printf( "%15s %d\n", miesiac, rok );
		
	for( i = 0; i < 7; i++ )
		cout << "  " << Skroty_Dni[ i ] << " ";
	printf( "\n" );
	
	for( i = 0; i < 6; i++ )
	{
		j_pocz = i == 0 ? d_pocz : 0;
		
		for( j = 0; j < 7; j++ )
		{
			day = i * 7 + j + 1 - j_pocz;
			if( j < j_pocz ) 
			{
				cout << "    ";
			}
			else 
			{
				if( day <= il_dni ) 
				{
					printf( "%3d ", day );
				}
			}
		}
		cout << endl;
	}
}

void CalendarM_New1( int il_dni, int d_pocz, const char* miesiac, int rok )
{
	string Skroty_Dni[] = { "P", "W", "Ś", "C", "P", "S", "N" };
	//const char* Skroty_Dni1[] = { "P", "W", "Ś", "C", "P", "S", "N" };
	int d, i, j, day, j_pocz;
	
	
	printf( "%15s %d\n", miesiac, rok );
		
	for( i = 0; i < 7; i++ )
		cout << "  " << Skroty_Dni[ i ] << " ";
	printf( "\n" );

	for( int d = 1; d <= il_dni+d_pocz; d++ )
	{
		int dzien = d - d_pocz;
		bool koniec_wiersza = ( d - 1 ) % 7 == 6 || d == il_dni + d_pocz;
		printf( koniec_wiersza ? "%3s\n" : "%3s ", dzien < 0 ? "   " :  my_itoa( dzien, 10 ));
		/* 
		printf( dzien < 0 ? "%3s " : "%3d ", 
				dzien < 0 ? "   "  : dzien );	// tak nie można, bo
				// error: operands to ?: have different types ‘const char*’ and ‘int’
		printf( koniec_wiersza ? "\n" : "" );
		*/
	}
}

void CalendarM_New2( int il_dni, int d_pocz, const char* miesiac, int rok )
{
	string Skroty_Dni[] = { "P", "W", "Ś", "C", "P", "S", "N" };
	//const char* Skroty_Dni1[] = { "P", "W", "Ś", "C", "P", "S", "N" };
	int d, i, j, day, j_pocz;
	
	
	printf( "%15s %d\n", miesiac, rok );
		
	for( i = 0; i < 7; i++ )
		cout << "  " << Skroty_Dni[ i ] << " ";
	printf( "\n" );
	
	for( i = 0; i < d_pocz; i++ )
		cout << "    ";

	for( int d = 1; d <= il_dni; d++ )
	{
		bool koniec_wiersza = ( d + d_pocz - 1 ) % 7 == 6 || d == il_dni;
		printf( koniec_wiersza ? "%3d\n" : "%3d ", d );
	}
}

bool Jest_Przestepny( int rok )
{
	return ( rok % 4 == 0 ) && (( rok % 100 != 0 ) || ( rok % 400 == 0 ));
}

/* Wypisz kalendarz na dany rok >= 2000*/
void Calendar( int rok )
{
	int Reszty_Mies[ 12 ] = { 3, 0, 3, 2, 3, 2, 3, 3, 2, 3, 2, 3 };
	const char* Miesiace[] = { "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" };
	const int POCZ_WIEKU_XXI = 5; // 1 I 2000 - sobota
	int pocz_roku = POCZ_WIEKU_XXI;
	
		// Oblicz którego dnia tygodnia zaczyna sie dany rok
	for( int year = 2000; year < rok; year++ )
	{
		int dni = 1;	// 365 = 52 tygodnie + 1 dzień
		if( Jest_Przestepny( year )) dni++;
		pocz_roku = (pocz_roku + dni) % 7;
	}
	
	if ( Jest_Przestepny( rok )) 
	{	// ustaw, że luty ma 29 dni
		 Reszty_Mies[ 1 ] = 1;
	}
	
	int pocz_mies = pocz_roku; 
	for( int m = 0; m < 12; m++ )
	{
		int il_dni = 28 + Reszty_Mies[ m ];
		CalendarM_New1( il_dni, pocz_mies, Miesiace[ m ], rok );
		CalendarM_New2( il_dni, pocz_mies, Miesiace[ m ], rok );
		CalendarM( il_dni, pocz_mies, Miesiace[ m ], rok );
		pocz_mies = ( pocz_mies + Reszty_Mies[ m ] ) % 7;
	}
}

int main()
{
	//CalendarM( 31, 3, "Maj" );
	Calendar( 2016 );
	
	 //cout << "\033[1;31mbold red text\033[0m\n";
	return 0;
}
	 
