Prosty kalendarz w C++ ( tylko tekst ) i w PHP.
Kalendarz może być na dowolny rok w XXI wieku lub później.

Użycie - Ściągnąć repozytorium do folderu, np. o nazwie calendar i uruchomić plik index.php lub show_calendar.php

Opis plików:

index.php - wyświetla dialog do pobrania roku (year) i ilości kolumn kalendarza (cols), domyślnie 2.
            Po naciśnięciu OK lub Enter, wyświetla kalendarz na wybrany rok.
            Można podać jeden lub dwa parametry year, cols
            
            calendar/index.php?year=2020&cols=3
            calendar/?cols=2

calendar.php - Generate_Calendar( $year, $nCols, $nRows ) generuje i wyświetla kalendarz na rok $year mający $nCols kolumn i $nRows wierszy.

parameters.php - pobiera parametry z linii wywołania i sprawdza ich poprawność

lib_html.php - Generacja tagów HTML

screenshot.png - obraz z kalendarzem na rok 2019 w trzech kolumnach 

folder images - tam są obrazy dla posczególnych miesięcy roku

calendar.css - plik css, w którym należy podać background-image dla klas m1 do m12 dla kolejnych miesięcy, np.

.m1 { background-image: url("images/P1260061.jpg"); }
.m2 { background-image: url("images/P1250391_m.jpg"); }
...
.m12 { background-image: url("images/P1260872.jpg"); }


Inne wersje kalendarza:

show_calendar.php - prostsza wersja. Można podać tylko rok, np. show_calendar.php?year=2019
text_calendar.php - pierwsza wersja - kalendarz tekstowy,   np. text_calendar.php?year=2020
Kalendarz na rok 2019.html - plik html, by zobaczyć jak wygląda kalendarz, gdy nie mamy serwera php.
