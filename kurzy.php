<?php
        // ziskani param URL
        if (isset($_REQUEST['date'])) { // mame parametr date
            $datum = $_REQUEST['date'];                
        } else {    // nemame param date nastavujeme aktualni datum
            $datum = date("d.m.Y"); 
        }        

        // CURL get data z CNB
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://www.cnb.cz/cs/financni-trhy/devizovy-trh/kurzy-devizoveho-trhu/kurzy-devizoveho-trhu/denni_kurz.txt?date=" . $datum);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        // zpracovani a zobrazeni ziskanych hodnot do tabulky
        $arr = explode(PHP_EOL, $output);   // pole radku ziskanych dat
        $arr0 = explode(" ", $arr[0]);  // rozdeleni prvniho radku (hlavicky)
        $datumListku = "datum: " . $arr0[0];
        $poradiListku = "pořadí: " . $arr0[1];      
        
        echo "<div id='info'><h5 class='text-success'>" . $datumListku . "</h5><h5 class='text-success'>" . $poradiListku . "</h5></div>";   // info listku
        
        // tabulka
        echo "<div class='table-responsive table-bordered text-center'>";
        echo "<table class='table table-striped table-bordered table-sm'>";
        // iterace od 1 .. prvni radek [0] je hlavicka
        // do delka -1 .. EOL je i za posledni hodnotou
        for ($i = 1; $i < count($arr) - 1; $i++) {  
            echo "<tr>";
            $arrTR = explode("|", $arr[$i]);
            for ($j = 0; $j < count($arrTR); $j++) {
                if ($i == 1) {  // nazvy sloupcu
                    echo "<th>";
                    echo $arrTR[$j];
                    echo "</th>";
                }
                else {  // ostatni radky jsou hodnoty
                    if ($j == 2) {  // oznaceni tridou dale zpracovavanych sloupcu pro JS
                        echo "<td class='mnozstvi text-success'>";
                    }
                    else if ($j == 4) {
                        echo "<td class='kurz text-success'>";
                    }
                    else {
                        echo "<td>";                                      
                    }
                    echo $arrTR[$j];
                    echo "</td>";
                }
            }        
            echo "</tr>";
        }
        echo "</table>";    
        echo "</div>";    

        echo $dnes;
    ?>