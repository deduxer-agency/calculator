
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Rentenrechner Elektro-Material</title>
	<meta name="author" content="gem">
	<meta name="keywords" content="Pensionierungs-Tool">
	<META HTTP-EQUIV="EXPIRES" CONTENT=0>
	<link href="stylesheet.css" rel="stylesheet" type="text/css">

</head>

<body>

<table class="main">
    <tr><td><div class="positionContent">
        <div style="padding-left: 5px;">
            <img src="bilder/logo.jpg" alt="Logo" >
        </div>
        <table class="main2" >
            <colgroup><col class="col1"><col class="col2"><col class="col3"><col class="col4"></colgroup>
            <tr>
                <td><h1><?php echo $languageDB["lRentenrechner"];?></h1></td>
                <td colspan="4" align="right">
					<a href="index.php?language=de"><img src="bilder/deutsch.gif" alt="Logo" border="0"></a>&nbsp;<a href="index.php?language=de"><?php echo $languageDB["ldeutsch"];?></a>&nbsp;&nbsp;&nbsp;
                    <a href="index.php?language=fr"><img src="bilder/franzoesisch.gif" alt="Logo" border="0"></a>&nbsp;<a href="index.php?language=fr"><?php echo $languageDB["lfranzösisch"];?></a>&nbsp;&nbsp;&nbsp;
                   <?php /*	 <a href="index.php?language=en"><img src="bilder/englisch.gif" alt="Logo" border="0"></a>&nbsp;<a href="index.php?language=en"><?php echo $languageDB["lenglisch"];?></a>&nbsp;&nbsp;&nbsp;*/?>
					<a href="index.php?language=it"><img src="bilder/italienisch.gif" alt="Logo" border="0"></a>&nbsp;<a href="index.php?language=it"><?php echo $languageDB["litalienisch"];?></a>&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr></tr>
            <tr><td colspan = "4"><div align="left" class="title"><?php echo $languageDB["laltersleistungBerechnen1"];?></div></td></tr>
            <tr><td colspan = "4"><div align="left"><?php echo $languageDB["laltersleistungBerechnen2"];?></div></td></tr>
            <tr><td class = "zwischenzeile"></td></tr>
        </table>
                
        <form name = "startdaten" action = "?language=<?php sprache()?>" method = "post" >
			<input type="hidden" name="page" id="page" value="altersleistung">
			
            <table class = "main2" cellspacing="0">
                <colgroup><col class="col1"><col class="col2"><col class="col3"><col class="col4"></colgroup>
				
                <tr>
                    <td colspan="1"><div align="left" class="title"><?php echo $languageDB["lAngabenzurperson"];?></div></td>
                    <td colspan="4"><div align="right">
						<button type="button" class="pushbuttoninfo"  
							onclick="javascript:window.open('infoseiten/Versicherungsausweis_<?php sprache()?>.pdf#zoom=75', 'NeuesFenster', 'width=740,height=984,status=yes,scrollbars=yes,resizable=yes,top=60,left=60').focus();" 
							title="<?php echo $languageDB['lMusterausweis'];?>"><nobr><?php echo $languageDB['lweitereInfos'];?></nobr>
						</button>
					</div></td>
                </tr>
                <tr ><td class="zwischenzeile"> </td></tr>
                <tr>
                    <td><?php echo $languageDB["lgeburtsdatum"];?></td>
                    <td><div align="right"><select size="1" name="geburtstag" id="geburtstag" <?php echo errors("geburtstag"); ?>>
                        <?php
                            for( $i=1; $i<=31 ;$i++ ) {
                                if( $i==$_SESSION["geburtsdatum"][0] ) {?>
                                    <option selected value = "<?php echo $i;?>"><?php echo $i; ?></option>
                                        <?php  } else { ?>
                                        <option value = "<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php ;}
                            }?>
                        </select></div>
                    </td>
                    <td><div align="right"><select size="1" name="geburtsmonat" id="geburtsmonat" <?php echo errors("geburtsmonat"); ?> >
                        <?php
                            for( $i=1; $i<=12 ;$i++ ) {
                                if( $i==$_SESSION["geburtsdatum"][1] ) {?>
                                    <option selected value = "<?php echo $i; ?>"><?php echo $languageDB[$lmonate[$i]]; ?></option>
                                        <?php } else { ?>
                                        <option value = <?php echo $i; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
                                    <?php ;}
                            }?>
                        </select></div>
                    </td>
                    <td><div align="right">
						<input type="text" name="geburtsjahr" id="geburtsjahr" size="3" maxlength="4" 
							value="<?php echo $_SESSION["geburtsdatum"][2];?>" <?php echo errors("geburtsjahr"); ?>>
					</div></td>
                </tr>
				<tr>
					<td><?php echo $languageDB["lEintrittsdatum"]; ?></td>
					<td><div align="right"><?php echo $languageDB["lanfangausweis"]; ?></div></td>
					<td><div align="right">
						<select size="1" name="eintrittsmonat" id="eintrittsmonat">
						<?php
							for( $i=1; $i<=12; $i++ ) {
								if( $i==$_SESSION["eintrittsdatum"][1] ) {?>
									<option selected value = <?php echo $i; ?> <?php echo errors("eintrittsmonat"); ?>><?php echo $languageDB[$lmonate[$i]]; ?></option>
								<?php  } else { ?>
									<option value = <?php echo $i; ?> <?php echo errors("eintrittsmonat"); ?>><?php echo $languageDB[$lmonate[$i]]; ?></option>
								<?php }
							} ?>
						</select></div>
					</td>
					<td><div align="right">
					<input type="text" name="eintrittsjahr" id="eintrittsjahr" size="3" maxlength="4" 
						value="<?php echo $_SESSION["eintrittsdatum"][2]; ?>" <?php echo errors("eintrittsjahr"); ?>></div></td>
				</tr>
                <tr ><td class="zwischenzeile"> </td></tr>
                <tr>
                    <td colspan="1"><?php echo $languageDB["lsex"]; ?></td>
                    <td colspan="1"><div class="radio_sex" align="right" ><label>
                        <?php if ($_SESSION["sex"] == "Frau"){ ?>  
							<?php echo $languageDB["lweiblich"]; ?> <input type="radio" name="sex" value = "Frau" class="radio_sex2" checked> 
                        <?php } else { ?> 
							<?php echo $languageDB["lweiblich"]; ?> <input type="radio" name="sex" value = "Frau" class="radio_sex2"> 
                        <?php } ?>
                        </label></div>
                    </td>
                    <td></td><td></td>
                </tr>
                <tr>
                    <td colspan="1"></td>
                    <td colspan="1"><div align="right" class="radio_sex"><label>
                        <?php if ($_SESSION["sex"] == "Mann"){ ?>  
							<?php echo $languageDB["lmaennlich"]; ?> <input type="radio" name="sex" value = "Mann" class="radio_sex2" checked> 
                        <?php } else { ?> 
							<?php echo $languageDB["lmaennlich"]; ?> <input type="radio" name="sex" value = "Mann" class="radio_sex2" > 
                        <?php } ?>
                        </label></div>
                    </td>
                    <td></td><td></td>
                </tr>
                <tr ><td class="zwischenzeile"> </td></tr>
                <tr>
                    <td><?php echo $languageDB["lvorsorgeausweisper"]; ?></td>
                    <td><div align="right"><?php echo $languageDB["lanfangausweis"]; ?></div></td>
                    <td><div align="right"><select size="1" name="stichmonat" id="stichmonat" >
                    <?php
                        for( $i=1; $i<=12 ;$i++ ) {
                            if( $i==$_SESSION["stichdatum"][1] ) {?>
                                <option selected value = <?php echo $i; ?> <?php echo errors("stichmonat"); ?>><?php echo $languageDB[$lmonate[$i]]; ?></option>
							<?php } else { ?>
                                    <option value = <?php echo $i; ?> <?php echo errors("stichmonat"); ?>><?php echo $languageDB[$lmonate[$i]]; ?></option>
							<?php }
                        }?>
                        </select></div>
                    </td>
                    <td><div align="right">
						<input type="text" name="stichjahr" id="stichjahr" size="3" maxlength="4" onChange="stichjahrChanged(this.value);"
							title="<?php echo strtr($languageDB['lmindStichjahr'],$GLOBALS["sprachArr"]);?>" 
							value="<?php echo $_SESSION["stichdatum"][2];?>" <?php echo errors("stichjahr"); ?>>
					</div></td>
                </tr>
                <tr ><td class="zwischenzeile"> </td></tr>
                <tr>
					<td><?php echo $languageDB["llohn"]; ?></td>
                    <td><div align="right">CHF</div></td>
                    <td colspan="2"><div align="right">
						<input type="text" name="jahresLohn" id="jahresLohn" size="10" maxlength="11" 
							title="<?php echo strtr($languageDB['lversicherterLohnzwischen'],$GLOBALS["sprachArr"]);?>" 
							value="<?php echo $_SESSION["jLohn"]; ?>" <?php echo errors("versicherterlohn"); ?>>
					</div></td>
                </tr>
                <tr>
                    <td><?php echo $languageDB["lBG"]; ?></td>
                    <td><div align="right"><input type="text" name="bg" id="bg" size="3" maxlength="3" value="<?php echo $_SESSION["bg"]; ?>" /></div></td>
                    <td colspan="2">
                        %
                    </td>
                </tr>
                <tr>
                    <td><?php echo $languageDB["laltersguthaben2"]." ";?><nobr><?php echo $languageDB["lAGHvorsorgeausweis2"]; ?></nobr></td>
                    <td><div align="right">CHF</div></td>
                    <td colspan ="2"><div align="right">
						<input type="text" name="altersguthaben" id="altersguthaben" size="10" maxlength="11" 
							title="<?php echo strtr($languageDB['laghzwischen'],$GLOBALS["sprachArr"]);?>" 
							value="<?php echo $_SESSION["AGH"];?>" <?php echo errors("altersguthaben"); ?>></div>
					</td>
                </tr>
                <tr>
                    <td><?php echo $languageDB["lAGHBVG"]; ?></td>
                    <td><div align="right">CHF</div></td>
                    <td colspan ="2"><div align="right">
						<input type="text" name="altersguthabenBVG" id="altersguthabenBVG" size="10" maxlength="11" 
							title="<?php echo strtr($languageDB['laghzwischen'],$GLOBALS["sprachArr"]);?>" 
							value="<?php echo $_SESSION["AGH_BVG"];?>" <?php echo errors("altersguthabenBVG"); ?>></div>
					</td>
                </tr>
				<tr><td class="zwischenzeile"></td></tr>
				<tr>
					<td colspan="1"><div align="left" class="title"><?php echo $languageDB["lAngabenzurpen"];?></div></td>
				</tr>
				<tr></tr>
				<tr>
					<td><?php echo $languageDB["lpensionierungper"]; ?></td>
					<td><div align="right"><?php echo $languageDB["lendepensionierung"]; ?></div></td>
					<td><div align="right">
						<select size="1" name="pensionierungsmonat" id="pensionierungsmonat">
						<?php
							for( $i=1; $i<=12 ;$i++ ) {
								if( $i==$_SESSION["pensdatum"][1] ) {?>
									<option selected value = <?php echo $i; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
								<?php  } else { ?>
									<option value = <?php echo $i; ?> ><?php echo $languageDB[$lmonate[$i]]; ?></option>
								<?php }
							} ?>
						</select></div>
					</td>
					<td><div align="right">
					<input type="text" name="pensionierungsjahr" id="pensionierungsjahr" size="3" maxlength="4" 
						title="<?php echo strtr($languageDB['lpensalterzwischen'],$GLOBALS["sprachArr"]);?>" 
						value="<?php echo $_SESSION["pensdatum"][2]; ?>" <?php echo errors("pensionierungsjahr"); ?>></div></td>
				</tr>
				<tr><td class="zwischenzeile"></td></tr>
				<tr>
					<td colspan="1"><div align="left" class="title"><?php echo $languageDB["lweitereAngaben"];?></div></td>
				</tr>
				<tr></tr>
                <tr>
                    <td><?php echo $languageDB["lBeitragsskala"]; ?></td>
                    <td></td>
                    <td colspan="2"><div align="right">
                        <select size="1" name="beitragsskala_alt" id="beitragsskala_alt" <?php echo errors("beitragsskala_alt"); ?>>
                            <?php
                            for( $i=1; $i<=3 ;$i++ ) { ?>
                                <option value=<?php echo $i; ?> <?php echo ($i==$_SESSION["beitragsskala_alt"]?"selected":""); ?>><?php echo $languageDB[$lskala[$i]]; ?></option><?php 
                            }?>
                        </select></div>
                    </td>
                </tr>
                <tr><td class="zwischenzeile"></td></tr>
				<tr>
					<td><?php echo $languageDB["lProjektionszinssatz"]." ";?><nobr><?php echo $languageDB["lZinserstesjahr"]; ?></nobr></td>
					<td><div align="right"><select size="1" name="zins1" id="zins1">
					<?php
						for( $i=0; $i<=450 ;$i+=25) {
							if( $i==$_SESSION["zins1"] ) { ?>
									<option selected value = <?php echo $i; ?> ><?php echo sprintf("%01.2f ",$i/100); ?></option>
								<?php } else { ?>
									<option value = <?php echo $i; ?> ><?php echo sprintf("%01.2f ",$i/100); ?></option>
								<?php }
						} ?>
					</select></div>
					</td>
					<td>%</td>
				</tr>
				<tr>
					<td><?php echo $languageDB["lProjektionszinssatz"]." ";?><nobr><?php echo $languageDB["lZinsfolgejahr"]; ?></nobr></td>
					<td><div align="right"><select size="1" name="zins2" id="zins2">
					<?php
						for( $i=0; $i<=450 ;$i+=25 ) {
							if( $i==$_SESSION["zins2"] ) {?>
									<option selected value = <?php echo $i; ?> ><?php echo sprintf("%01.2f ",$i/100); ?></option>
								<?php } else { ?>
									<option value = <?php echo $i; ?> ><?php echo sprintf("%01.2f ",$i/100); ?></option>
							<?php }
						} ?>
					</select></div>
					</td>
					<td>%</td>
				</tr>
				<tr>
					<td><?php echo $languageDB["llohnentwicklung"];?></td>
					<td><div align="right"><select size="1" name="lohnErh" id="lohnErh">
					<?php
						for( $i=0; $i<=450 ;$i+=25 ) {
							if( $i==$_SESSION["lohnErh"] ) { ?>
								<option selected value = <?php echo $i; ?> ><?php echo sprintf("%01.2f ",$i/100); ?></option>
							<?php } else { ?>
								<option value = "<?php echo $i; ?>"><?php echo sprintf("%01.2f ",$i/100); ?></option>
							<?php }
						} ?>
					</select></div>
					</td>
					<td>%</td>
				</tr>
				<?php if(isset($basic -> fehler) && $basic -> fehler){; ?>
					<tr><td class="zwischenzeile"></td></tr>
					<tr>
							<td colspan = "1" id = "HinweisFelder"><div class="markiertFehler" ><?php echo strtr($languageDB['lcheck'],$GLOBALS["sprachArr"]);?></div></td>
							<td colspan = "3">&nbsp;</td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_vsLohn) && $basic -> fehler_vsLohn){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerversLohn'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_agh) && $basic -> fehler_agh){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehleragh'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_aghbvg) && $basic -> fehler_aghbvg){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehleragh'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_datum) && $basic -> fehler_datum){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerdatum'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_eintrittsdatum1) && $basic -> fehler_eintrittsdatum1){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerEintrittsdatum1'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_eintrittsdatum2) && $basic -> fehler_eintrittsdatum2){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerEintrittsdatum2'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_stichdatum) && $basic -> fehler_stichdatum){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerstichdatum'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_datum1) && $basic -> fehler_datum1){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerdatum1'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_datum2) && $basic -> fehler_datum2){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerdatum2'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
				<?php if(isset($basic -> fehler_datum3) && $basic -> fehler_datum3){ ?>
					<tr>
						<td colspan = "4" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerdatum3'],$GLOBALS["sprachArr"]);?></small></div></td>
					</tr>
				<?php } ?>
            </table>
            <br>
            <table class ="main2">
				<tr><td>				
					<!-- Weiter -->
					<input type="submit" class="pushbutton" value="<?php echo $languageDB['ldweiter'];?>"> 
				</td></tr>
			</table>
        </form>
	

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
		
    </div></td></tr>
</table>

<script type="text/javascript" language="JavaScript">

	function stichjahrChanged(jahr) {
		document.getElementById("datumEinlageUWS").innerHTML = "01.01." + jahr;
	}
	
	stichjahrChanged(document.getElementById('stichjahr').value);

</script>

</body>
</html>