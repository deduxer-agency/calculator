<?php
	include("../includes/functions.php");
	include("../includes/data.php");
	include("../includes/language.php");
	
	 

		

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Rentenrechner Elektro-Material</title>
<meta name="author" content="thm">
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
		<colgroup><col class="cola1"><col class="cola2"><col class="cola3"><col class="cola4"><col class="cola5"><col class="cola6"></colgroup>
		<tr>
			<td colspan="6" class="markiert"><b><?php echo $languageDB["lglossar"];?></b></td>
		</tr>
		<tr><td class="zwischenzeile"></td></tr>
		
		<tr>
			<td colspan = "6"><b><?php echo $languageDB["lglossarbeschr"];?></b></td>
		</tr>
		
		<tr><td class="zwischenzeile"></td></tr>
		<tr><td class="zwischenzeile"></td></tr>
		
		<tr>
			

			
		</tr>
		</table>
		 <table class="main2" cellspacing="0">
			<colgroup>
				<col class="cola1">
				<col class="cola2">
				<col class="cola3">
				<col class="cola4">
				<col class="cola5">
				<col class="cola6">
			</colgroup>
			<tr>
				<td class="cola1"></td>
				<td class="cola2"></td>
				<td class="cola3"></td>
				<td class="cola4"></td>
				<td class="cola5"></td>
				<td class="cola6"></td>
			</tr>
			<!--<tr><td>.</td><td>.</td><td>.</td><td>.</td><td>.</td><td>.</td></tr>-->
			<tr>
			<td class="linksrechtsoben" colspan="2" align="left"><b><?php echo $languageDB["lStichwort"];?></b></td>			
			<td class="rechtsoben" colspan="4" align="left" style="padding-right: 60px;"><b><?php echo $languageDB["lErklaerung"];?></b></td>
			</tr>
		<?php 
		foreach ($glosLink as $key => $value){ 
		//$Keyword_Link = explode(">",parse_url($key,PHP_URL_QUERY));
		//$Keyword_Link=explode("<",$Keyword_Link[1]);
		//$Keyword_Link=explode(" ",trim($Keyword_Link[0]));
		
		//print_r(parse_url($key,PHP_URL_QUERY));
		//print_r(html_entity_decode ( trim($Keyword_Link[0])));
		//print_r(html_entity_decode ( trim($_GET[keyword])));
		//htmlentities(trim($_GET[keyword]))==htmlentities(trim($Keyword_Link[0]))
		if ($_GET["keyword"]==$key)
			{ ?>
			<tr class="markiert2">
				<td class="linksrechts" align="left" colspan="2"><?php echo $value;?></td>
				<td class="rechts" align="left" colspan="4" style="padding-right: 60px;"><?php echo $languageDB[$key."_gl"];?></td>
			</tr>
			<?php }
			else { ?>
			<tr>
				<td class="linksrechts" align="left" colspan="2"><?php echo $value;?></td>
				<td class="rechts" align="left" colspan="4" style="padding-right: 60px;">&#160;</td> 
			</tr>
			<?php } 
		} ?>
		<tr><td colspan="6" class="oben" style="background-color:#FFFFFF"><small>&nbsp;</small></td></tr>
		<tr><td class="zwischenzeile"></td></tr>
	</table>



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

</table>

</body>
</html>