<?php

	/************************************************************************
	 * Einlesen der Daten
	************************************************************************/
	$row = 0;
	$line = array();

	$dataDBpath = dirname(__FILE__)."/data.csv";
	if(!file_exists($dataDBpath)) {
		echo "Konnte Datenbank-Datei nicht finden.";
		exit;
	}
	
	$handle = fopen($dataDBpath, "r");
	while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
		array_shift($data);        // Das erste Element aus $data entfernen
		$line[$row] = $data;       // im array $line zwischenspeichern
		$row++;
	}
	fclose($handle);

	$row=0;
	// Variablen
	$myVars = array_combine($line[$row],$line[$row+1]); $row+=2;
	foreach( $myVars as $key => $value) {
		$$key = $value;
	}
	// Tabellen bzw. Arrays
	// Jedes Array besteht aus zwei Spalten (Excel) bzw. Zeilen (csv)
	// die Reihenfolge wird automatisch übernommen.
	$lmonate = array_combine($line[$row],$line[$row+1]); $row+=2;
	$lskala = array_combine($line[$row],$line[$row+1]); $row+=2;

	$sparBS_AN[1] = array_combine($line[$row],$line[$row+1]);
	$sparBS_AN[2] = array_combine($line[$row],$line[$row+2]);
	$sparBS_AN[3] = array_combine($line[$row],$line[$row+3]);

	$sparBS_AG[1] = array_combine($line[$row],$line[$row+4]); $row+=5;
	$sparBS_AG[2] = $sparBS_AG[1];   // AG-Beiträge bei allen gleich
	$sparBS_AG[3] = $sparBS_AG[1];   // AG-Beiträge bei allen gleich

	$sparBS[1]=altersgutschriften($sparBS_AN[1],$sparBS_AG[1]);
	$sparBS[2]=altersgutschriften($sparBS_AN[2],$sparBS_AG[2]);
	$sparBS[3]=altersgutschriften($sparBS_AN[3],$sparBS_AG[3]);

	$risikoBS_AN = array_combine($line[$row],$line[$row+1]);
	$risikoBS_AG = array_combine($line[$row],$line[$row+2]); 
	$beitragTotal_BVG = array_combine($line[$row],$line[$row+3]); $row+=4;//nur gesamte Beiträge werden verwendet
	$risikoBS=altersgutschriften($risikoBS_AN,$risikoBS_AN);

	$beitragTotal[1]=altersgutschriften($sparBS[1],$risikoBS);
	$beitragTotal[2]=altersgutschriften($sparBS[2],$risikoBS);
	$beitragTotal[3]=altersgutschriften($sparBS[3],$risikoBS);
	
	$einkauf[1] = array_combine($line[$row],$line[$row+1]);
	$einkauf[2] = array_combine($line[$row],$line[$row+2]);
	$einkauf[3] = array_combine($line[$row],$line[$row+3]); $row+=4;

	$jahr_UWS = array_combine($line[$row],$line[$row+1]); $row+=2;

	for($i=1; $i<=$GLOBALS["Anzahl_UWS_Stufen"]; $i++){
		$UWS_stufe[$jahr_UWS[$i]]["Mann"] = array_combine($line[$row],$line[$row+2*$i-1]); 
		$UWS_stufe[$jahr_UWS[$i]]["Frau"] = array_combine($line[$row],$line[$row+2*$i]); 
	}
	$row+=1+2*$GLOBALS["Anzahl_UWS_Stufen"];

	$faktor_UR = array_combine($line[$row],$line[$row+1]); $row+=2;

	$ahvruecktrittsalter = array_combine($line[$row],$line[$row+1]);
	$minPensalter = array_combine($line[$row],$line[$row+2]);
	$maxPensalter = array_combine($line[$row],$line[$row+3]); $row+=4;

	// für die Kontrolle der übergebenen Daten kann dieser Wert auf true gesetzt werden.
	if( false ) {
		echo "Beginn Variable Dump:<br><br>";
		echo "<pre>";
		foreach( $myVars as $key => $value) {
			echo $key.": ".$$key." ".htmlentities(var_dump(${$key}))."\n";
		}
		//echo "$line\n"; print_r($line);
		echo "$lmonate\n"; print_r($lmonate);
		echo "$sparBS_AN\n"; print_r($sparBS_AN);
		echo "$sparBS_AG\n"; print_r($sparBS_AG);
		echo "$risikoBS\n"; print_r($risikoBS);
		echo "$UWS_stufe\n"; print_r($UWS_stufe);
		echo "$faktor_UR\n"; print_r($faktor_UR);
		echo "$ahvruecktrittsalter\n"; print_r($ahvruecktrittsalter);
		echo "$minPensalter\n"; print_r($minPensalter);
		echo "$maxPensalter\n"; print_r($maxPensalter);
		echo "</pre>";

	}
	/***********************************************************************/

?>