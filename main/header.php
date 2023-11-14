<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Rentenrechner Elektro-Material</title>
<meta name="author" content="gem">
<meta name="keywords" content="Pensionierungs-Tool">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<link href="stylesheet.css" rel="stylesheet" type="text/css">

<script type="text/javascript" language="JavaScript">

	function toggleMe(a){
		var e=document.getElementById(a);
		if(!e)return true;
		if(e.style.display=="none"){
			e.style.display="block"
		} else {
			e.style.display="none"
		}
		return true;
	}

	function einblenden(div) {
		with(document.getElementById(div).style){
			if(display=="none"){
				display="inline";
			} else{
				display="none";
			}
		}
	}

	function ausblenden(div) {
		with(document.getElementById(div).style){
			if(display=="none"){
				display="none";
			} else{
				display="none";
			}
		}
	}

	function wahlAR(kapital,ar,wahlKap,wahlAR)  {
		var kapital=document.getElementById(kapital);
		var ar=document.getElementById(ar);
		var wahlKap=document.getElementById(wahlKap);
		var wahlAR=document.getElementById(wahlAR);

		kapital.readOnly=true;
		ar.focus;
		ar.readOnly=false;
		ar.style.color="#000000";
		kapital.style.color="#585858";
		wahlKap.style.color="#000000";
		wahlAR.style.color="#585858";
	}

	function wahlKapital(kapital,ar,wahlKap,wahlAR)  {
		var kapital=document.getElementById(kapital);
		var ar=document.getElementById(ar);
		var wahlKap=document.getElementById(wahlKap);
		var wahlAR=document.getElementById(wahlAR);

		ar.readOnly=true;
		kapital.focus;
		kapital.readOnly=false;
		kapital.style.color="#000000";
		ar.style.color="#585858";
		wahlAR.style.color="#000000";
		wahlKap.style.color="#585858";
	}

	function activateUR(){
		document.getElementById('WeiterUR').style.display = 'block';
		document.getElementById('buttonUR').className = 'pushbuttontabmarkiert';
		document.getElementById('WeiterEinkauf').style.display = 'none'; 
		document.getElementById('buttonEinkauf').className = 'pushbuttontab';
		document.getElementById('WeiterVorbezug').style.display = 'none';
		document.getElementById('buttonVorbezug').className = 'pushbuttontab';
	}
	
	function activateEinkauf(){
		document.getElementById('WeiterUR').style.display='none'; 
		document.getElementById('buttonUR').className = 'pushbuttontab';
		document.getElementById('WeiterEinkauf').style.display='block'; 
		document.getElementById('buttonEinkauf').className = 'pushbuttontabmarkiert';
		document.getElementById('WeiterVorbezug').style.display='none';
		document.getElementById('buttonVorbezug').className = 'pushbuttontab';
	}
	
	function activateVorbezug(){
		document.getElementById('WeiterUR').style.display='none'; 
		document.getElementById('buttonUR').className = 'pushbuttontab';
		document.getElementById('WeiterEinkauf').style.display='none'; 
		document.getElementById('buttonEinkauf').className = 'pushbuttontab';
		document.getElementById('WeiterVorbezug').style.display='block';
		document.getElementById('buttonVorbezug').className = 'pushbuttontabmarkiert';
	}

</script>
</head>

<body>