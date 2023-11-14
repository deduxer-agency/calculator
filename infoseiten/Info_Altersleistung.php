<?php
	include("../includes/functions.php");
	include("../includes/data.php");
	include("../includes/language.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Rentenrechner Elektro-Material</title>
<meta name="author" content="gem">
<meta name="keywords" content="Pensionierungs-Tool">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../stylesheet.css" rel="stylesheet" type="text/css">

</head>
<body>
<table class="main" cellspacing="0">
<tr><td>
		<div align="left">
			<img src="../bilder/logo.jpg" alt="Logo" >
		</div>
     
	<table class="main2" cellspacing="0">
		<colgroup>
			<col class="col15"><col class="col16"><col class="col17"><col class="col17"><col class="col17"><col class="col17"><col class="col17"><col class="col17"><col class="col18">
		</colgroup>
		<tr>
			<td colspan="9" class="markiert"><b><?php echo $languageDB["laltersleistung"];?></b></td>
		</tr>
		<tr><td colspan="9" class="zwischenzeile"></td></tr>
		<tr>
			<td colspan="9"><?php echo $languageDB["lerklaerungAltersleistung"];?></td>
		</tr>
		<tr><td colspan="9" class="zwischenzeile"></td></tr>
		<tr>
			<td colspan="9" align ="center"><b><?php echo $languageDB["laghmaluws"];?></b></td>
		</tr>
		<tr><td colspan="9" class="zwischenzeile"></td></tr>
		<tr>
			<td colspan="9"><?php echo $languageDB["lberechnungAltersrente"];?></td>
		</tr>
		<tr><td colspan="9" class="zwischenzeile"></td></tr>
		
		<tr align="center">
			<td></td>
			<td align="center"></td>
			<td colspan="6" class="links"><b><?php echo $languageDB["lUWS"];?><br/>&nbsp;</b></td>
			<td></td>
		</tr>
		
		<tr align="center">
			<td></td>
			<td align="center"><b><?php echo $languageDB["lpensionierungsalter"];?></b></td>
			<td colspan="2" class="links"><b><?php echo $languageDB["lab0101"]; echo $GLOBALS["jahr_UWS"][1];?></b></td>
			<td colspan="2" class="links"><b><?php echo $languageDB["lab0101"]; echo $GLOBALS["jahr_UWS"][2];?></b></td>
			<td colspan="2" class="links"><b><?php echo $languageDB["lab0101"]; echo $GLOBALS["jahr_UWS"][3];?></b></td>
			<td></td>
		</tr>
		
		<tr align="center">
			<td></td>
			<td class="unten">&nbsp;</td>
			<td class="linksunten"><b><?php echo $languageDB["lMaenner"];?></b></td>
			<td class="linksunten"><b><?php echo $languageDB["lFrauen"];?></b></td>
			<td class="linksunten"><b><?php echo $languageDB["lMaenner"];?></b></td>
			<td class="linksunten"><b><?php echo $languageDB["lFrauen"];?></b></td>
			<td class="linksunten"><b><?php echo $languageDB["lMaenner"];?></b></td>
			<td class="linksunten"><b><?php echo $languageDB["lFrauen"];?></b></td>
			<td></td>
		</tr>
		
		
		<?php for ($alter=min($GLOBALS["minPensalter"]["Mann"], $GLOBALS["minPensalter"]["Frau"]); $alter<=max($GLOBALS["maxPensalter"]["Mann"], $GLOBALS["maxPensalter"]["Frau"]); $alter++){ ?>
			<tr align="center">
				<td></td>
				<td align="center"><?php echo $alter;?></td>
				<td class="links"><?php ausgabe_Prozent_pos(100*$GLOBALS["UWS_stufe"][$GLOBALS["jahr_UWS"][1]]["Mann"][$alter], 2);?></td>
				<td class="links"><?php ausgabe_Prozent_pos(100*$GLOBALS["UWS_stufe"][$GLOBALS["jahr_UWS"][1]]["Frau"][$alter], 2);?></td>
				<td class="links"><?php ausgabe_Prozent_pos(100*$GLOBALS["UWS_stufe"][$GLOBALS["jahr_UWS"][2]]["Mann"][$alter], 2);?></td>
				<td class="links"><?php ausgabe_Prozent_pos(100*$GLOBALS["UWS_stufe"][$GLOBALS["jahr_UWS"][2]]["Frau"][$alter], 2);?></td>
				<td class="links"><?php ausgabe_Prozent_pos(100*$GLOBALS["UWS_stufe"][$GLOBALS["jahr_UWS"][3]]["Mann"][$alter], 2);?></td>
				<td class="links"><?php ausgabe_Prozent_pos(100*$GLOBALS["UWS_stufe"][$GLOBALS["jahr_UWS"][3]]["Frau"][$alter], 2);?></td>
			</tr>
		<?php } ?>
		
		<tr><td class="zwischenzeile"></td></tr>
		<tr>
			<td></td>
			<td colspan="7"><small><?php echo $languageDB["lmonatUWS"];?></small></td>
			<td></td>
		</tr>
		<tr><td class="zwischenzeile"></td></tr>
		
		<tr><td colspan="9" class="zwischenzeile"></td></tr>
		<tr>
			<td colspan="9"><?php echo $languageDB["lkuerzung"];?></td>
		</tr>
		<tr>
			<td colspan="9"><?php echo $languageDB["lkuerzung2"];?></td>
		</tr>

		<tr><td colspan="9" class="zwischenzeile"></td></tr>
		
		<tr align="center">
			<td colspan="2"></td>
			<td colspan="2" align="center" class="unten"><b><?php echo $languageDB["ldauer"];?></b></td>
			<td colspan="3" class="linksunten"><b><?php echo $languageDB["lreduktionAltersrente"];?></b></td>
			<td colspan="2"></td>
		</tr>

		<?php for ($i=1; $i<=5; $i++){ ?>
			<tr align="center">
				<td colspan="2">&nbsp;</td>
				<td colspan="2" align="center"><?php echo $i; ?></td>
				<td colspan="3" class="links"><?php echo $i; ?>%</td>
				<td colspan="2">&nbsp;</td>
			</tr>
		<?php } ?>
		
		<tr><td colspan="9" class="zwischenzeile"></td></tr>
		
		<tr>
			<td colspan="2"></td>
			<td colspan="7"><small><?php echo $languageDB["lzwischenwerte"];?></small></td>
			<td></td>
		</tr>
		
		<tr><td colspan="9" class="zwischenzeile"></td></tr>
		
		<tr>
			<td colspan="9"><?php echo $languageDB["lreduktionAltersrente2"];?></td>
		</tr>
   
	</table>
  
	<br/>
	<br/>
	 
	<table class ="main2">
		<tr><td>
			<button type ="button" class ="pushbutton" onclick="window.close();"><?php echo $languageDB["lschliessen"]; ?></button>
			<input type="button" onclick="window.print();" class="Pushbuttonprint" value="<?php  echo $languageDB["ldruckenprint"]?>">
		</td></tr>
	</table>

 

	<table class ="main2">
		<colgroup><col class = "col5a"><col class="col6a"></colgroup>
			<tr><td>
				<div align="left"><small><?php echo date("r");?></small></div>
			</td>
			<td>
				<div align="right"><small><?php echo $languageDB['lcopyright'];?></small></div>
			</td>
		</tr>
	</table>
	
</td></tr>
</table>
</body>
</html>