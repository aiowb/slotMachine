<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/form-style.css" />
</head>
<body>
	<div class="cms_header" style="width:500px">Gewinn wahrscheinlichkeit in %</div>
	<div class="form-group">
	<form class="cms_formular cms_content_bg" style="width:500px" name="myform" action="form.php" method="post">
		<label>Field 1:</label><input type="text" name="numloc"> * 10<br />
		<label>Field 2:</label><input type="text" name="numloc_sec"> * 10<br />
		<label>Field 3:</label><input type="text" name="numloc_third"> * 10<br />
		<label>Field 4:</label><input type="text" name="numloc_fourth"> * 10<br />
		<input type="submit" name="num_submit" value="Speichern" class="cms_buttons"> 
	</form>
</div>
<div class="cms_header" style="width:500px">
	<span>Anweisung: .. siehe Beispielbild:</span>
	</div>
<p><img src="_pictures/beispielbild.jpg" align="center"></p>
</body>
</html>
<?php
// ================== INSERT DATA ==========
// wird in index.php ausgelsen

$numloc = $_POST['numloc'];
$numloc_sec = $_POST['numloc_sec'];
$numloc_third = $_POST['numloc_third'];
$numloc_fourth = $_POST['numloc_fourth'];

if (isset($_POST['num_submit']))
{
    $filename = "save_config.txt";

    $file_handler = fopen($filename, 'w');

    if (!$file_handler) die("The file can't be open for writing<br />");
    else
    {
        $current .= "".$numloc."\n".$numloc_sec."\n".$numloc_third."\n".$numloc_fourth."";
		
        fwrite($file_handler, $current);
        fclose($file_handler);
        $closed_file = file_get_contents($filename, $current);
	    $closed_file = "Aktuell: \n field 1: ".$numloc."%\n | field 2: ".$numloc_sec."%\n | field 3: ".$numloc_third."%\n | field4 : ".$numloc_third."%\n .. Je 1000x versuche.";
		echo $closed_file;
    }

}
// ================== INSERT DATA ==========

?>