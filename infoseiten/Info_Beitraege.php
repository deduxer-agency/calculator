<?php
	include("../includes/functions.php");
	include("../includes/data.php");
	include("../includes/language.php");


	$alter = $GLOBALS["minimumAlter"];
	$altersgruppe = 1;
	$untereGrenze[1]= $alter;
	$obereGrenze[1]= $alter;
	for ($alter; $alter<=max($GLOBALS["maxPensalter"]["Mann"], $GLOBALS["maxPensalter"]["Frau"]); $alter++){
		if ($GLOBALS["beitragTotal"][1][$alter] == $GLOBALS["beitragTotal"][1][$untereGrenze[$altersgruppe]]){
			$obereGrenze[$altersgruppe]= $alter;
		} else {
			$altersgruppe = $altersgruppe+1;
			$untereGrenze[$altersgruppe] = $alter;
			$obereGrenze[$altersgruppe] = $alter;
		}
	}

	$anzahlGruppen = $altersgruppe;

	for ($altersgruppe=1; $altersgruppe<=$anzahlGruppen; $altersgruppe++){
		$sparbeitraege_AN[1][$altersgruppe]=$GLOBALS["sparBS_AN"][1][$untereGrenze[$altersgruppe]]*100;
		$sparbeitraege_AN[2][$altersgruppe]=$GLOBALS["sparBS_AN"][2][$untereGrenze[$altersgruppe]]*100;
		$sparbeitraege_AN[3][$altersgruppe]=$GLOBALS["sparBS_AN"][3][$untereGrenze[$altersgruppe]]*100;
		$sparbeitraege_AG[$altersgruppe]=$GLOBALS["sparBS_AG"][1][$untereGrenze[$altersgruppe]]*100;
		$risikobeitraege_AN[$altersgruppe]=$GLOBALS["risikoBS_AN"][$untereGrenze[$altersgruppe]]*100;
		$risikobeitraege_AG[$altersgruppe]=$GLOBALS["risikoBS_AG"][$untereGrenze[$altersgruppe]]*100;
		$totalbeitraege[1][$altersgruppe]=$GLOBALS["beitragTotal"][1][$untereGrenze[$altersgruppe]]*100;
		$totalbeitraege[2][$altersgruppe]=$GLOBALS["beitragTotal"][2][$untereGrenze[$altersgruppe]]*100;
		$totalbeitraege[3][$altersgruppe]=$GLOBALS["beitragTotal"][3][$untereGrenze[$altersgruppe]]*100;
	}

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
		<colgroup><col class="col12"><col class="col13"><col class="col13"><col class="col13"><col class="col13"><col class="col13"><col class="col13"><col class="col13"><col class="col13"></colgroup>
		<tr>
			<td colspan="9" class="markiert"><b><?php echo $languageDB["lfinanzierung"];?> <?php echo $languageDB["lArbeitnehmerArbeitgeber"];?></b></td>
		</tr>
		<tr><td class="zwischenzeile"></td></tr>
		<tr>
			<td colspan="9"><?php echo $languageDB["lerklaerungbeitraege"];?></td>
		</tr>
		
		<tr><td class="zwischenzeile"></td></tr>
		
		<tr align="right">
			<td align="center"><b>&nbsp;</b></td>
			<td align="center" colspan="2" class="links"><b><?php echo $languageDB["lsparbeitrag"];?></b><br><small>&nbsp;</small></td>
			<td align="center" colspan="2" class="links"><b><?php echo $languageDB["lrisikobeitrag"];?></b><br><small>&nbsp;</small></td>
			<td align="center" colspan="2" class="links"><b><?php echo $languageDB["ltotalCHF"];?></b><br><small>&nbsp;</small></td>
		</tr>
		
		<tr align="right">
			<td align="center" class="unten"><b><?php echo $languageDB["lalter"];?></b></td>
			<td align="center" class="linksunten"><b><?php echo $languageDB["lAN"];?></b></td>
			<td align="center" class="linksunten"><b><?php echo $languageDB["lAG"];?></b></td>
			<td align="center" class="linksunten"><b><?php echo $languageDB["lAN"];?></b></td>
			<td align="center" class="linksunten"><b><?php echo $languageDB["lAG"];?></b></td>
			<td align="center" class="linksunten"><b><?php echo $languageDB["lAN"];?></b></td>
			<td align="center" class="linksunten"><b><?php echo $languageDB["lAG"];?></b></td>
		</tr>

		<?php for ($altersgruppe=1; $altersgruppe<=$anzahlGruppen; $altersgruppe++){; ?>
			<tr align="right">
				<td align="center"><?php echo $untereGrenze[$altersgruppe];?> - <?php echo $obereGrenze[$altersgruppe];?></td>
				<td class="links" style="padding-right=45px;"><?php ausgabe_Stellen($sparbeitraege_AN[1][$altersgruppe],1);?>%</td>
				<td class="links" style="padding-right=45px;"><?php ausgabe_Stellen($sparbeitraege_AG[$altersgruppe],1);?>%</td>
				<td class="links" style="padding-right=45px;"><?php ausgabe_Stellen($risikobeitraege_AN[$altersgruppe],1);?>%</td>
				<td class="links" style="padding-right=45px;"><?php ausgabe_Stellen($risikobeitraege_AG[$altersgruppe],1);?>%</td>
				<td class="links" style="padding-right=45px;"><?php ausgabe_Stellen($risikobeitraege_AN[$altersgruppe] + $sparbeitraege_AN[1][$altersgruppe],1);?>%</td>
				<td class="links" style="padding-right=45px;"><?php ausgabe_Stellen($risikobeitraege_AG[$altersgruppe] + $sparbeitraege_AG[$altersgruppe],1);?>%</td>
			</tr>
		<?php } ?>
		
		<tr><td class="zwischenzeile"></td></tr>
		
		<tr>
			<td colspan="7"><small><?php echo $languageDB["lerklaerungalter"];?></small></td>
		</tr>
		
		<tr><td class="zwischenzeile"></td></tr>

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