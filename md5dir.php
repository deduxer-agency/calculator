<?php
/*
 * Dieses Programm berechnet die MD5-Hashcodes aller Dateien im angegebenen Ordner
 * und dessen Unterordner.
 * Auf diese Weise kann einfach verifiziert werden, ob die ausgelieferten Dateien
 * manipuliert wurden.
 */
?>

<style type="text/css">
td {
 font-family: monospace;
 padding-right: 10px;
 padding-left: 10px;
}
</STYLE>



<?php

$path="./"; // z.B. $path="./ordner/";
$myarr=array();
getDirTree($path, true);
$anzahl=0;
?>

<H1>MD5-Hash des Ordners <?php echo $path; ?></H1>
<p><B><?php echo date("r (T)")?></B></p>
<TABLE border =1>

<?php
foreach( $myarr as $key ) {
   if(is_file($key)) {
      echo "<tr><td>".$key."</td><td>".md5_file($key)."</tr>";
      $anzahl++;
   }
}
echo "</table>";
echo "<br>Anzahl Dateien: ".$anzahl;



    /*
        getDirTree(string $dir [, bool $showfiles]);
        $dir of the folder you want to list, be sure to have an ending /
        $showfiles set to 'false' if files shouldnt be listed in the output array
    */
    function getDirTree($dir,$p=true) {
        global $myarr;
        $d = dir($dir);$x=array();
        while (false !== ($r = $d->read())) {
            if($r!="."&&$r!=".."&&(($p==false&&is_dir($dir.$r))||$p==true)) {
                $x[$dir.$r] = (is_dir($dir.$r)?array():(is_file($dir.$r)?true:false));
                if(is_file($dir.$r)){
                   $myarr[]=$dir.$r;
                   //echo $dir.$r."<br>";
                }
            }
        }
        foreach ($x as $key => $value) {
            if (is_dir($key."/")) {
                $x[$key] = getDirTree($key."/",$p);
            }
        }
        //ksort($x);
        return $x;
    }
?>