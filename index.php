<?php
error_reporting(E_ALL);
header('Content-Type: application/json');

/*
ob_start();
include ("../verbindung.php");
ob_end_clean();
*/

$arry_export = file("save_config.txt");
#print_r($arry_export);

$probability_one = $arry_export[0] * 10;
$probability_two = $arry_export[1] * 10 + $probability_one;
$probability_three = $arry_export[2] * 10 + $probability_two;
$probability_four = $arry_export[3] * 10 + $probability_three;

$result = random_int(1, 1000);

if($result <= $probability_one)
{
    $arry_result = ['first' => 1, 'second' => 1, 'third' => 1];
    $arry_result['ergebnis_won'] = "<span id='fadein'>Glückwunsch, Du hast <mark>10% Rabbat</mark> gewonnen!</span></br>
								</br>
								<div class='input-group'><label for='email' style='font-size:5pt'>*Oder erhalte dein Gutschein per email: </label><input type='text' id='name' required class='input'><label for='name' class='input-label'>Email Adresse</label>
								<button class='cls_btn' type='submit' value='Send Email'><i></i></button>
										</div>";
}
elseif ($result <= $probability_two)
{
    $arry_result = ['first' => 2, 'second' => 2, 'third' => 2];
    $arry_result['ergebnis_won'] = "<span id='fadein'>Glückwunsch, Du hast <mark>20% Rabbat</mark> gewonnen!</span></br>
								</br>
								<div class='input-group'><label for='email' style='font-size:5pt'>*Oder erhalte dein Gutschein per email: </label><input type='text' id='name' required class='input'><label for='name' class='input-label'>Email Adresse</label>
								<button class='cls_btn' type='submit' value='Send Email'><i></i></button>
										</div>";
}
elseif ($result <= $probability_three)
{
    $arry_result = ['first' => 3, 'second' => 3, 'third' => 3];
    $arry_result['ergebnis_won'] = "<span id='fadein'>Glückwunsch, Du hast <mark>30% Rabbat</mark> gewonnen!</span></br>
								</br>
								<div class='input-group'><label for='email' style='font-size:5pt'>*Oder erhalte dein Gutschein per email: </label><input type='text' id='name' required class='input'><label for='name' class='input-label'>Email Adresse</label>
								<button class='cls_btn' type='submit' value='Send Email'><i></i></button>
										</div>";
}
elseif ($result <= $probability_four)
{
    $arry_result = ['first' => 4, 'second' => 4, 'third' => 4];
    $arry_result['ergebnis_won'] = "<span id='fadein'>Glückwunsch, Du hast <mark>40% Rabbat</mark> gewonnen!</span></br>
								</br>
								<div class='input-group'><label for='email' style='font-size:5pt'>*Oder erhalte dein Gutschein per email: </label><input type='text' id='name' required class='input'><label for='name' class='input-label'>Email Adresse</label>
								<button class='cls_btn' type='submit' value='Send Email'><i></i></button>
										</div>";
}
else
{

    $arry_result = ['first' => 1, 'second' => random_int(2, 4) , 'third' => random_int(2, 4) ];
    $arry_result['ergebnis_lose'] = "<span style='background-color:red'> Du Hast Leider verloren, Hier deine trostpreis <mark>5% Rabbat</mark> </span";
}

// Ajax request
echo json_encode($arry_result);

?>
