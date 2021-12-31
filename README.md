# kurzy-cnb
"Aplikace" zobrazuje tabulku kurzů devizového trhu, které denně vydává Česká národní banka (ČNB).
Data kurzů se dotahují prostřednictvím [API ČNB](https://www.cnb.cz/cs/casto-kladene-dotazy/Kurzy-devizoveho-trhu-na-www-strankach-CNB/)
### Popis ČNB API
[API ČNB](https://www.cnb.cz/cs/casto-kladene-dotazy/Kurzy-devizoveho-trhu-na-www-strankach-CNB/) vrací kurzy devizového trhu požadovaného dne ve formátu pseudoCSV viz ukázka níže. Kurzy jsou vydávány denně kromě víkendů a svátků. URL parametr ?date tohoto WEB API umožňuje stáhnout data požadovaného dne. Formát data pro parametr ?date je DD.MM.RRRR. V případě zadání data spadajícího na víkend nebo svátek, kdy ČNB nevydává kurzy, se vrátí data nebližšího předcházejícího dne. Pokud je zvolen datum budoucí, vrací API kurzovní data aktuálního dne.

**Datový formát z ČNB**
```
03.05.2021 #84
země|měna|množství|kód|kurz
Austrálie|dolar|1|AUD|16,559
Brazílie|real|1|BRL|3,939
Bulharsko|lev|1|BGN|13,157
Čína|žen-min-pi|1|CNY|3,308
Dánsko|koruna|1|DKK|3,467
EMU|euro|1|EUR|25,785
Filipíny|peso|100|PHP|44,397
Hongkong|dolar|1|HKD|2,756
Chorvatsko|kuna|1|HRK|3,417
Indie|rupie|100|INR|28,975
... 
```
### Popis web "aplikace"
- AJAXem dotahovaná data prostřednictvím PhP skriptu z https://www.cnb.cz/cs/financni-trhy/devizovy-trh/kurzy-devizoveho-trhu/kurzy-devizoveho-trhu/denni_kurz.txt?date=DD.MM.RRRR jsou zpracována do tabulky
- "Aplikace" umožňuje dotahovat/zobrazovat data kurzů zvoleného dne, které posílá v URL parametru ?date ČNB API
- "Aplikace" umožňuje přepočíst odpovídající kurz k zadanému množství Kč

### Ukázka
- dostupná [ZDE](http://studio42.wz.cz/kurzy-cnb/)
