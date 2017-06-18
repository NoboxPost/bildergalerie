# bildergalerie

## Installation Local (XAMPP)

1. bildergalerie Ordner in htdocs verschieben

2. bei wechselnder Ordnerstruktur (Standard in XAMPP: htdocs/bildergalerie/index.php muss die config.php Datei so angepasst werden, dass sie wieder den Pfad zum Root-Verzeichnis abbildet
- $urlpartnumber: wieviele Ordner bis zum root übersprungen werden müssen
- $pathtoroot: wie diese Ordner heissen (Ordnerstruktur)

3. im model-Ordner die Datei dbconfig.php anpassen
- nach Projektvorgabe stehen die Werte auskommentiert unter den aktuellen

4. in der Datei php.ini müssen eventuell Anpassungen vorgenommen werden:
- upload_max_filesize (je nach gewünschter Upload Beschränkung, beispielsweise 4MB, diese Schranke wird beim Bild-Upload aber auch zusätzlich kontrolliert, deshalb kann der Wert hier auch grösser sein)
- max_file_uploads (für den Test min. 1)

