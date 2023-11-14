<?php
	include("../includes/functions.php");
	include("../includes/data.php");
	include("../includes/language.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Rentenrechner Elektro-Material</title>
<meta name="author" content="rih">
<meta name="keywords" content="Pensionierungs-Tool">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="../stylesheet.css" rel="stylesheet" type="text/css">

</head>
<body>
<table class="main" cellspacing="0">
	<tr><td><div align="left">
    <img src="../bilder/logo.jpg" alt="Logo" >
    </div>
    <table class="main2" cellspacing="0">
		<colgroup><col class="colb1"><col class="colb2"><col class="colb3"><col class="colb4"><col class="colb5"><col class="colb6"></colgroup>
		<tr>
			<td colspan="6" class="markiert"><b><?php echo $languageDB["lfreiwilligerEinkauf"];?></b></td>
		</tr>
		<tr><td class="zwischenzeile"></td></tr>
		
		<tr>
			<td colspan = "6"><b><?php echo $languageDB["lmaxAghEinkauf"];?></b></td>
		</tr>
		<tr><td class="zwischenzeile"></td></tr>
		<tr><td class="zwischenzeile"></td></tr>
		<tr>
			<td></td>
			<td class="rechtsunten" colspan="1" align="center"><b><?php echo $languageDB["lalter"];?></b></td>
			<td class="rechtsunten" colspan="3" align="center"><b><?php echo $languageDB["lBemerkungMaxAgh"];?></b></td>
			<td></td>
		</tr>
		<tr></tr>
		<?php for ($alter=$GLOBALS["minimumAlter"]; $alter<=$GLOBALS["maximumAlter"]; $alter++){; ?>
			<tr>
				<td></td>
				<td class="rechts" align="center"><?php echo $alter;?></td>
				<td class="rechts" align="right" colspan="3" style="padding-right: 60px;"><?php ausgabe_Prozent_pos($GLOBALS["einkauf"][$_SESSION["beitragsskala_alt"]][$alter],0);?></td>
				<td></td>
			</tr>
		<?php } ?>
		<tr>
			<td></td>
			<td colspan="4"><small><?php echo $languageDB["lBVGAlter"];?></small></td>
			<td></td>
		</tr>
		<tr><td class="zwischenzeile"></td></tr>
	
	</table>

    <table class="main2" cellspacing="0">
		<colgroup><col class="cole1"><col class="cole2"><col class="cole3"></colgroup>
		<tr><td></td><td></td><td></td></tr>
            
		<tr><td colspan ="5"><?php echo $languageDB["lbemerkungEinkauf"];?></td></tr>
		<tr>
			<td valign="top">&bull;</td>
			<td colspan ="4"><?php echo $languageDB["lbemerkungEinkauf1"];?></td></tr>
		<tr>
			<td valign="top">&bull;</td>
			<td colspan ="4"><?php echo $languageDB["lbemerkungEinkauf2"];?></td></tr>
		<tr>
			<td valign="top">&bull;</td>
			<td colspan ="4"><?php echo $languageDB["lbemerkungEinkauf3"];?></td></tr>
		<tr>
			<td valign="top">&bull;</td>
			<td colspan ="4"><?php echo $languageDB["lbemerkungEinkauf4"];?></td></tr>
		<tr><td colspan ="5"><?php echo $languageDB["lbemerkungEinkaufKontakt"];?></td></tr>
    </table>           
         <br>

	<table class ="main2">
		<tr><td>
			<button type ="button" class ="pushbutton" onclick="window.close();"><?php echo $languageDB["lschliessen"]; ?></button>
			<input type="button" onclick="window.print();" class="Pushbuttonprint" value="<?php  echo $languageDB["ldruckenprint"]?>">
		</td></tr>
	</table>
 
	<table class ="main2">
		<colgroup><col class = "col5a"><col class="col6a"></colgroup>
		<tr>
			<td>
				<div align="left"><small><?php echo date("r");?></small></div>
			</td>
			<td>
				<div align="right"><small><?php echo $languageDB['lcopyright'];?></small></div>
			</td>
		</tr>
	</table>
	
</div></td>
</tr>
</table>

</body>
</html>