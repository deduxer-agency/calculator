			
			<table class="main3_wahl" cellspacing="0" id ="tabelleEingabeUWS" border="1" style="display:block;">
                <colgroup><col class="col21"><col class="col22"><col class="col23"><col class="col24"><col class="col25"><col class="col26"><col class="col27"><col class="col28"><col class="col29"></colgroup>
                <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
				<tr>
					<td colspan="9" style="padding-left: 0px; padding-right: 0px; background-color:#FFFFFF;">
						<table cellspacing="0" class="nurDruck"><tr><td>
							<b><?php echo $languageDB["lfreiwaehlbarUR"]; ?></b>
						</td></tr></table>
					</td>
				</tr>
				
				<!-- Überbrückungsrente -->
				<tr>
					<td colspan = "9"><b><?php echo $languageDB["lUR"]; ?></b></td>
                </tr>
                <?php if ($basic -> alter_pensdatum >= $GLOBALS["ahvruecktrittsalter"][$_SESSION["sex"]]) {
						if ($_SESSION["sex"]=="Mann"){ ?>
						<tr>
							<td colspan = "9">
								<?php echo strtr($languageDB['lBemerkungKeineURMann'],$GLOBALS["sprachArr"]); ?>
								<?php ausgabe_Alter_Zeichen($basic -> alter);?>
								<?php echo strtr($languageDB['lBemerkungKeineURMann2'],$GLOBALS["sprachArr"]); ?>
							</td>
						</tr>
					<?php } else { ?>
						<tr>
							<td colspan = "9">
								<?php echo strtr($languageDB['lBemerkungKeineURFrau'],$GLOBALS["sprachArr"]); ?>
								<?php ausgabe_Alter_Zeichen($basic -> alter);?>
								<?php echo strtr($languageDB['lBemerkungKeineURFrau2'],$GLOBALS["sprachArr"]); ?>
							</td>
						</tr>
					<?php } ?>
					<input type='hidden' name='beschaeftigungsgrad' value="100" >
				<?php } else { ?>
                    <?php if ($_SESSION["sex"]=="Mann"){ ?>
						<tr><td colspan = "9"><?php echo strtr($languageDB['lBemerkungURMann'],$GLOBALS["sprachArr"]); ?></td></tr>
                    <?php } else { ?>
						<tr><td colspan = "9"><?php echo strtr($languageDB['lBemerkungURFrau'],$GLOBALS["sprachArr"]); ?></td></tr>
                    <?php }?>
					
					<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
					
					<tr>
						<td colspan="1"></td>
						<td colspan="6"><?php echo $languageDB["lBeschaeftigungsgrad"];?></td>
						<td><div align="left">
							<input type="text" name="beschaeftigungsgrad" id="beschaeftigungsgrad" 
								value="<?php echo $_SESSION["beschaeftigungsgrad"]; ?>" <?php echo errors("beschaeftigungsgrad");?>
								onkeyup="refreshMaxUR(this.value);">
							</div>
						</td>
						<td>%</td>
						
					</tr>
					<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
					<tr>
						<td colspan = "9">
							<?php echo strtr($languageDB['lResultierendeUR'],$GLOBALS["sprachArr"]); ?>
							<b>CHF <span id="dynamischeURmax"></span></b>
						</td>
					</tr>
				<?php } ?>
				
				<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
				
				<tr>
					<td colspan = "9" class="title"><b><?php echo $languageDB["lgewuenschteAltersleistung1"]."&nbsp;";echo $languageDB["lgewuenschteAltersleistung2"];?></b></td>
				</tr>
				<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
				
				<!-- Überbrückungsrente -->
                <?php if ($basic -> alter_pensdatum >= $GLOBALS["ahvruecktrittsalter"][$_SESSION["sex"]]) {?>
					<input type='hidden' name='UeRgewuenscht' value="0" >
					<input type='hidden' name='beitragsjahre' value="20" >
                <?php } else { ?>
					<tr><td colspan = "9" ><b><?php echo $languageDB["lgewuenschteUR"];?></b></td></tr>
					<tr>
						<td colspan="6"><?php echo $languageDB["lgewuenschteUREinleitung"]; ?>&nbsp;<span id="maxUR"></span>)</td>
						<td align="right">CHF</td>
						<td><div align="right">
							<input type="text" name="UeRgewuenscht" id="UeRgewuenscht" size="10" maxlength="11" 
								title="<?php echo strtr($languageDB['lUReingeben'],$GLOBALS["sprachArr"]);?>" 
								value="<?php echo $_SESSION["UeRgewuenscht"];?>" <?php echo errors("UeRgewuenscht");?>
								onkeyup="refreshMaxValues();">
						</div></td>
						<td align="left">&nbsp;</td>
					</tr> 
					<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
                <?php } ?>
				
				
				<!-- Rente und/oder Kapital -->
                <tr>
                    <td colspan = "9"><b><?php echo $languageDB["lRenteOderKapital"]; ?></b></td>
                </tr>
				<tr>
					<td colspan = "9"><?php echo $languageDB["lRenteOderKapitalEinleitung"]; ?></td>
				</tr>
				<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
				<tr>
				<td></td>
						<td colspan = "3"><?php echo $languageDB["lAGHBVGgewaelt"]; ?></td>
						<td align="right">CHF</td> 
                    <td align="right"> <?php ausgabe_Stellen_pos(runden($altersleistung->AGH_BVG_gewaehlt,1),0);?></td>
						<td colspan = "3"></td>
				</tr>
				<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
				
				
				<?php if ($basic -> alter_pensdatum < $GLOBALS["ahvruecktrittsalter"][$_SESSION["sex"]]) {?>
					<tr>
						<td colspan = "9">
							<?php echo $languageDB["lMaximalbetraege"]; ?>
							<span id="dynamischeUR"></span>:
							<?php /*echo $languageDB["lMaximalbetraege2"];*/ ?>
						</td>
					</tr>
					<tr>
						<td class="zwischenzeile" colspan = "9"> </td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lTotalAGH"]; ?></td>
						<td align="right">CHF</td> 
						<td align="right" id="AGHganz"></td>
						<td colspan = "3"></td>
					</tr>
					
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lKostenUR"]; ?></td>
						<td align="right">CHF</td> 
						<td align="right" id="AGHkürzung"></td>
						<td colspan = "3"></td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lGuthabenGekürzt"]; ?></td>
						<td align="right">CHF</td> 
						<td align="right" id="AGHgekürzt"></td>
						<td colspan = "3"></td>
					</tr>
					<tr>
						<td class="zwischenzeile" colspan = "9"> </td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lmaxKapitalOhneUR"]; ?>&nbsp;<b><span id="WertAoderB"></span>)</b></td>
						<td align="right">CHF</td> 
						<td align="right" id="KapitalbezugMax"></td>
						<td colspan = "3"></td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lKostenUR"]; ?></td>
						<td align="right">CHF</td> 
						<td align="right" id="AGHkürzung2"></td>
						<td colspan = "3"></td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lmaxKapitalMitUR"]; ?></td>
						<td align="right">CHF</td> 
						<td align="right" id="dynamischesKapital2"></td>
						<td colspan = "3"></td>
					</tr>
					<tr>
						<td class="zwischenzeile" colspan = "9"> </td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lmaxARUngekuerzt"]; ?></td>
						<td align="right">CHF</td> 
						<td align="right" id="ARUngekuerzt"></td>
						<td colspan = "3"></td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lKuerzungAR"]; ?></td>
						<td align="right">CHF</td> 
						<td align="right" id="ARKuerzung"></td>
						<td colspan = "3"></td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lmaxARGekuerzt"]; ?></td>
						<td align="right">CHF</td>
						<td align="right" id="ARGekuerzt"></td>
						<td colspan = "3"></td>
					</tr>
				<?php 
				} else { ?>
					<tr>
						<td colspan = "9">
							<?php echo $languageDB["lMaximalbetraegeOhneUR"]; ?>:
						</td>
					</tr>
					<tr>
						<td class="zwischenzeile" colspan = "9"> </td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lmaxKapitalOhneUR"]; ?>&nbsp;<b><span id="WertAoderB"></span>)</b></td>
						<td align="right">CHF</td> 
						<td align="right" id="KapitalbezugMax"></td>
						<td colspan = "3"></td>
					</tr>
					<tr>
						<td></td>
						<td colspan = "3"><?php echo $languageDB["lmaxAROhneUR"]; ?></td>
						<td align="right">CHF</td> 
						<td align="right" id="ARUngekuerzt"></td>
						<td colspan = "3"></td>
					</tr>
				<?php
				} ?>

				<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
				
				<tr><td colspan="9"><b><?php echo $languageDB["lgewuenschteRenteOderKapital"];?></b></td></tr>
				<tr><td colspan="9"><?php echo $languageDB["lRenteOderKapitalEinleitung2"]; ?> </td></tr>

				<tr>
					<td colspan="1"></td>
					<td colspan="5">
						<div align="left" class="radio_WahlUR">
						<label class="radio_WahlUR2">
							<?php if ($_SESSION["wahl"] == "Kapitalbezug"){ ?>
								<input type="radio" name="wahl" value = "Kapitalbezug" checked onClick="wahlKapital('Kapitalgewuenscht', 'Monatsrentegewuenscht','wahlAR','wahlKapital')"> 
									<?php echo $languageDB["lgewuenschterKapitalbezug"]; ?>&nbsp;(<?php echo $languageDB["lBetragZwischen0Und"]; ?> <span id="dynamischesKapital"></span>)
							<?php } else { ?>
								<input type="radio" name="wahl" value = "Kapitalbezug" onClick="wahlKapital('Kapitalgewuenscht', 'Monatsrentegewuenscht','wahlAR','wahlKapital')"> 
									<?php echo $languageDB["lgewuenschterKapitalbezug"]; ?>&nbsp;(<?php echo $languageDB["lBetragZwischen0Und"]; ?> <span id="dynamischesKapital"></span>)
						<?php } ?>
						</label></div>
					</td>
					<td align="right" id ="wahlKapital" > CHF</td>
					<td><div align="right">
						<input type="text" name="Kapitalgewuenscht" id="Kapitalgewuenscht" size="10" maxlength="11" 
						title="<?php echo strtr($languageDB['lKapitaleingeben'],$GLOBALS["sprachArr"]);?>" 
						value="<?php echo $_SESSION["Kapitalgewuenscht"];?>" <?php echo errors("Kapitalgewuenscht"); if ($_SESSION["wahl"]=="Altersrente"){echo(" readonly ");?> style="color:#585858 " <?php }?>></div></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="1"></td>
					<td colspan="5">
						<div align="left">
							<small><?php echo $languageDB["lBemerkungKapitalAltersrente"]; ?> </small>
						</div>
					</td>
					<td colspan="3"></td>
				</tr>
				<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
				<tr>
					<td colspan="1"></td>
					<td colspan="5">
						<div align="left" class="radio_WahlUR">
						<label class="radio_WahlUR2">
							<?php if ($_SESSION["wahl"] == "Altersrente"){ ?>  
								<input type="radio" name="wahl" value = "Altersrente" checked onClick="wahlAR('Kapitalgewuenscht', 'Monatsrentegewuenscht','wahlAR','wahlKapital')" class="radio_WahlUR2"> 
								<?php echo $languageDB["lgewuenschteAltersrente"]; ?>&nbsp;(<?php echo $languageDB["lBetragZwischen"]; ?>&nbsp;<span id="dynamischeARklein"></span>&nbsp;<?php echo $languageDB["lUnd"]; ?>&nbsp;<span id="dynamischeAR"></span>)
							<?php } else { ?> 
								<input type="radio" name="wahl" value = "Altersrente" onClick="wahlAR('Kapitalgewuenscht', 'Monatsrentegewuenscht','wahlAR','wahlKapital')" class="radio_WahlUR2">
								<?php echo $languageDB["lgewuenschteAltersrente"]; ?>&nbsp;(<?php echo $languageDB["lBetragZwischen"]; ?>&nbsp;<span id="dynamischeARklein"></span>&nbsp;<?php echo $languageDB["lUnd"]; ?>&nbsp;<span id="dynamischeAR"></span>)
							<?php } ?>
						</label></div>
					</td>
					<td align="right" id="wahlAR"> CHF </td>
					<td>
						<div align="right"><input type="text" name="Monatsrentegewuenscht" id="Monatsrentegewuenscht" size="10" maxlength="11" 
							title="<?php echo strtr($languageDB['lAReingeben'],$GLOBALS["sprachArr"]);?>" 
							value="<?php echo $_SESSION["Monatsrentegewuenscht"];?>" <?php echo errors("Monatsrentegewuenscht"); if ($_SESSION["wahl"]=="Kapitalbezug"){echo(" readonly ");?> style="color:#585858"<?php }?>></div>
					</td>
					<td>&nbsp;</td>
				</tr>
				
				<tr><td class="zwischenzeile" colspan = "9"> </td></tr>
				
				<tr><td colspan="4">
					<div align="left" class="keinDruck">
						<input type="submit" class="pushbuttonlong" value="<?php echo $languageDB['ldweiterPens'];?>"></div>
				</td>
                    <td colspan="5">
                        <div align="left" class="keinDruck">
                            <b>
                                <font color="#dc582c"><?php if($_POST["page"]=="einkauf") {
									echo $languageDB["lmitEinkauf"];
								} else if($_POST["page"]=="vorbezug") {
									echo $languageDB["lmitVorbezug"];
								} else {
									echo $languageDB["lohneEinkauf"];
								}
							?>
                                </font>
                            </b>
                        </div>
                    </td>
				</tr>
				
                <?php if(isset($ur -> fehler_Pens) && $ur -> fehler_Pens){ ?>
				<tr>
					<td colspan = "6" id = "HinweisFelder"><div class="markiertFehler" ><?php echo strtr($languageDB['lcheck'],$GLOBALS["sprachArr"]);?></div></td>
					<td colspan = "3">&nbsp;</td>
				</tr>
				<?php }; ?>
				
				<?php if(isset($ur -> fehler_UeRgewuenscht) && $ur -> fehler_UeRgewuenscht){; ?>
				<tr>
					<td colspan = "9" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerUR'],$GLOBALS["sprachArr"]);?></small></div></td>
				</tr>
				<?php }; ?>
				
				<?php if(isset($ur -> fehler_Kapitalgewuenscht) && $ur -> fehler_Kapitalgewuenscht){; ?>
				<tr>
					<td colspan = "9" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerKapital'],$GLOBALS["sprachArr"]);?></small></div></td>
				</tr>
				<?php }; ?>
				
				<?php if(isset($ur -> fehler_Monatsrentegewuenscht) && $ur -> fehler_Monatsrentegewuenscht){; ?>
				<tr>
					<td colspan = "9" id = "HinweisFelder"><div class="markiertFehler" ><small><?php echo strtr($languageDB['lfehlerAR'],$GLOBALS["sprachArr"]);?></small></div></td>
				</tr>
				<?php }; ?>
				
				<tr><td class="nurDruck"><small>&nbsp;</small></td></tr>
            </table>
			
			<script type="text/javascript" language="JavaScript">
				function refreshMaxValues(){
					var UeRgewuenscht = 0;
					if (document.getElementById('UeRgewuenscht') != null) {
						UeRgewuenscht = parseFloat(document.getElementById('UeRgewuenscht').value, 10);			
					}
					
					var beschaeftigungsgrad = 100;
					if (document.getElementById('beschaeftigungsgrad') != null) {
						beschaeftigungsgrad = Math.min(100, Math.max(0, Math.round(parseFloat(document.getElementById('beschaeftigungsgrad').value, 10))));
					}
					
					if(isNaN(UeRgewuenscht)) {
						UeRgewuenscht=0;
					}
					var KapitalbezugMax =parseFloat(Math.max(0,<?php echo $altersleistung->AGH_gewaehlt/2; ?>,<?php echo $altersleistung->AGH_gewaehlt;?>-<?php echo $basic->AGH_BVG_gewaehlt*0.75; ?>));
					var vorbezugsdauer = parseFloat(<?php echo $basic->bezugdauer_gewaehlt; ?>);
					var URmaxKapital = 0.0;
					if(vorbezugsdauer>0){
					URmaxKapital = ( KapitalbezugMax * (parseFloat(<?php echo $basic->UWS_gewaehlt; ?>)) / 12) 
										/ (parseFloat(((20-<?php echo $basic->beitragsjahre_gewaehlt; ?>) * 0.2 * vorbezugsdauer) + vorbezugsdauer)/100);
										}
										
					var URmaxBG =	beschaeftigungsgrad/100*parseFloat(<?php echo $GLOBALS["maxAHVRente"]; ?>) / 12;
					if (beschaeftigungsgrad<99.5){
					URmaxBG= URmaxBG-0.5;
					URmaxBG=Math.max(0.0,URmaxBG);
					}
					var gewuenschteUR = Math.min(URmaxBG, Math.max(0, UeRgewuenscht),URmaxKapital);
					
					
					
					if(isNaN(gewuenschteUR)) {
						gewuenschteUR=0;
					}
					if(isNaN(beschaeftigungsgrad)) {
						beschaeftigungsgrad=0;
					}
					if(isNaN(vorbezugsdauer)) {
						vorbezugsdauer=0;
					}
					
					var ARUngekuerzt = parseFloat(<?php echo $altersleistung->AGH_gewaehlt; ?>) * parseFloat(<?php echo $basic->UWS_gewaehlt; ?>) / 12;
				    var ARKuerzung = -gewuenschteUR * vorbezugsdauer * (1-0.04*<?php echo $basic->beitragsjahre_gewaehlt; ?>) * <?php echo $basic->UWS_gewaehlt; ?>;//-(gewuenschteUR * parseFloat(((20-<?php echo $basic->beitragsjahre_gewaehlt; ?>) * 0.2 * vorbezugsdauer) + vorbezugsdauer)/100);
					var ARGekuerzt = Math.max(0, ARUngekuerzt + ARKuerzung);
					var AGHBVG = parseFloat(<?php echo $altersleistung->AGH_BVG_gewaehlt; ?>);
					
					
					var AGHganz = parseFloat(<?php echo $altersleistung->AGH_gewaehlt; ?>);
					//var AGHgekürzt = Math.max(0, 12 * ARGekuerzt / parseFloat(<?php echo $basic->UWS_gewaehlt; ?>));
					var AGHkürzung = Math.min(0, 12 * ARKuerzung / parseFloat(<?php echo $basic->UWS_gewaehlt; ?>));
					var AGHgekürzt = AGHganz+AGHkürzung;
					//var AGHkürzung = AGHgekürzt - AGHganz ;
					var KapitalUngekuerzt = parseFloat(<?php echo $altersleistung->AGH_gewaehlt; ?>)/2;
					var KapitalGekuerzt = Math.max(0, 12 * ARGekuerzt / parseFloat(<?php echo $basic->UWS_gewaehlt; ?>));
					var KapitalKuerzung = KapitalGekuerzt - KapitalUngekuerzt;
					var ARMinimum = (AGHganz-KapitalbezugMax)*parseFloat(<?php echo $basic->UWS_gewaehlt; ?>)/12;
					if( KapitalbezugMax -1 < <?php echo $altersleistung->AGH_gewaehlt/2; ?>) {
					var WertAoderB = "a";
					}else{
					var WertAoderB = "b";
					}
					ARUngekuerzt = Math.round(ARUngekuerzt);
					ARKuerzung = Math.round(ARKuerzung);
					ARGekuerzt = Math.round(Math.max(ARUngekuerzt+ARKuerzung,ARMinimum));
					AGHganz = Math.round(AGHganz);
					AGHgekürzt = Math.round(AGHgekürzt);
					AGHkürzung = Math.round(AGHkürzung);
					var ARGekuerztKlein = Math.round(ARMinimum);
					KapitalUngekuerzt = Math.round(KapitalUngekuerzt);
					KapitalGekuerzt = Math.round(KapitalGekuerzt);
					KapitalKuerzung = KapitalGekuerzt-KapitalUngekuerzt;
					var dynamischesKapital = Math.round(KapitalbezugMax+AGHkürzung)//Math.min(KapitalGekuerzt,KapitalbezugMax)
					KapitalbezugMax = Math.round(KapitalbezugMax);
					if(document.getElementById('dynamischeUR') != null) {
						document.getElementById('dynamischeUR').innerHTML = gewuenschteUR.toLocaleString();
					}
					if(document.getElementById('AGHganz') != null) {
						document.getElementById('AGHganz').innerHTML = AGHganz.toLocaleString();
					}
					if(document.getElementById('AGHgekürzt') != null) {
						document.getElementById('AGHgekürzt').innerHTML = AGHgekürzt.toLocaleString();
					}
					if(document.getElementById('AGHkürzung') != null) {
						document.getElementById('AGHkürzung').innerHTML = AGHkürzung.toLocaleString();
					}
					if(document.getElementById('AGHkürzung2') != null) {
						document.getElementById('AGHkürzung2').innerHTML = AGHkürzung.toLocaleString();
					}
					if(document.getElementById('KapitalbezugMax') != null) {
						document.getElementById('KapitalbezugMax').innerHTML = KapitalbezugMax.toLocaleString();
					}
					if(document.getElementById('ARUngekuerzt') != null) {
						document.getElementById('ARUngekuerzt').innerHTML = ARUngekuerzt.toLocaleString();
					}
					if(document.getElementById('ARKuerzung') != null) {
						document.getElementById('ARKuerzung').innerHTML = ARKuerzung.toLocaleString();
					}
					if(document.getElementById('dynamischeARklein') != null) {
						document.getElementById('dynamischeARklein').innerHTML = ARGekuerztKlein.toLocaleString();
					}
					if(document.getElementById('ARGekuerzt') != null) {
						document.getElementById('ARGekuerzt').innerHTML = ARGekuerzt.toLocaleString();
					}
					if(document.getElementById('kapitalUngekuerzt') != null) {
						document.getElementById('kapitalUngekuerzt').innerHTML = KapitalUngekuerzt.toLocaleString();
					}
					if(document.getElementById('kapitalKuerzung') != null) {
						document.getElementById('kapitalKuerzung').innerHTML = KapitalKuerzung.toLocaleString();
					}
					if(document.getElementById('kapitalGekuerzt') != null) {
						document.getElementById('kapitalGekuerzt').innerHTML = KapitalGekuerzt.toLocaleString()/*.substr(0, KapitalGekuerzt.toLocaleString().length-3)*/;
					}

					
					document.getElementById('dynamischeAR').innerHTML = ARGekuerzt.toLocaleString();
					document.getElementById('dynamischeARklein').innerHTML = ARGekuerztKlein.toLocaleString();
					if(document.getElementById('dynamischesKapital') != null) {
					document.getElementById('dynamischesKapital').innerHTML = dynamischesKapital.toLocaleString();
					}
					if(document.getElementById('dynamischesKapital2') != null) {
					document.getElementById('dynamischesKapital2').innerHTML = dynamischesKapital.toLocaleString();
					}
					document.getElementById('WertAoderB').innerHTML = WertAoderB.toLocaleString();

				}
				refreshMaxValues();
				
				
				function refreshMaxUR(beschaeftigungsgrad){
					var beschaeftigungsgrad = parseInt(beschaeftigungsgrad, 10);
					if(isNaN(beschaeftigungsgrad)) {
						beschaeftigungsgrad=0;
					}
					var vorbezugsdauer = parseFloat(<?php echo $basic->bezugdauer_gewaehlt; ?>);
					var URmaxKapital = Math.floor((parseFloat(<?php echo max($altersleistung->AGH_gewaehlt/2,$altersleistung->AGH_gewaehlt-0.75*$basic->AGH_BVG_gewaehlt); ?>) * (parseFloat(<?php echo $basic->UWS_gewaehlt; ?>)) / 12) 
										/ (parseFloat(((20-<?php echo $basic->beitragsjahre_gewaehlt; ?>) * 0.2 * vorbezugsdauer) + vorbezugsdauer)/100));
					var URmaxBG = Math.min(100, Math.max(0, beschaeftigungsgrad))/100 * parseInt(parseFloat(<?php echo $GLOBALS["maxAHVRente"]; ?>) / 12 , 10);
					if (beschaeftigungsgrad<99.5){
					URmaxBG= URmaxBG-1;
					URmaxBG=Math.max(0.0,URmaxBG);
					}
					var URmax = Math.round(Math.min(URmaxKapital, URmaxBG));
					
					if(document.getElementById('dynamischeURmax') != null) {
						document.getElementById('dynamischeURmax').innerHTML = URmax.toLocaleString();
					}
					if(document.getElementById('maxUR') != null) {
						document.getElementById('maxUR').innerHTML = URmax.toLocaleString()/*.substr(0, URmax.toLocaleString().length-3)*/;
					}
					document.getElementById('beschaeftigungsgrad').value=beschaeftigungsgrad;
					refreshMaxValues();
				}
				if(document.getElementById('beschaeftigungsgrad') != null) {
				refreshMaxUR(document.getElementById('beschaeftigungsgrad').value);
				}
			</script>
		