<?php
	if(!isset($_POST["page"])) {
		$navigation="";
		$page="";
	}
	else if($_POST["page"]=="altersleistung") {
		$navigation="?language=".$_GET["language"];
		$page="eingabe";
	}
	else if($_POST["page"]=="ur") {
		$navigation="?language=".$_GET["language"]."#wahlUR";
		$page="altersleistung";
	}
	else if($_POST["page"]=="einkauf") {
		$navigation="?language=".$_GET["language"]."#einkauf";
		$page="altersleistung";
	}
	else if($_POST["page"]=="vorbezug") {
		$navigation="?language=".$_GET["language"]."#vorbezug";
		$page="altersleistung";
	}
	else if($_POST["page"]=="ureinkauf") {
		$navigation="?language=".$_GET["language"]."#wahlUR";
		$page="einkauf";
	}
	else if($_POST["page"]=="urvorbezug") {
		$navigation="?language=".$_GET["language"]."#wahlUR";
		$page="vorbezug";
	}
	
?>

	<br/>

    <form name = "zurueckzuAltersleistung" action = "<?php echo $navigation; ?>" method = "post" >
		<div align="left" class="keinDruck">
			<input type="hidden" name="page" id="page" value='<?php echo $page; ?>'>
            <input type="submit" class='pushbutton' value='<?php echo $languageDB["lzurueck"]?>'>
            <input type="button" onclick="window.print();" class="Pushbuttonprint" value="<?php  echo $languageDB["ldruckenprint"]?>">
		</div>
    </form>

	
	<table class ="main2">
		<colgroup><col class = "col5a"><col class="col6a"></colgroup>
		<tr><td align="left">
				<small><?php echo date("r");?></small>
			</td>
			<td align="right">
				<small><?php echo $languageDB['lcopyright'];?></small>
			</td>
		</tr>
	</table>
	
</body>
</html>