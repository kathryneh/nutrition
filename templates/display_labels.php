<?php
require_once("utils/dbconnect.php");
require_once("utils/api.php");

function display_img($upc){
	echo "<img class='label' src='labels/$upc.jpg'></img>";

	//for future figuring out stuff with the image hosting:
	//https://developers.google.com/drive/about-sdk#search_for_files
}
function display_label($db, $upc){
	$columnArray = array(
	'upc' => 'UPC',
	'servsize' => 'Serving Size',
	'servunit' => 'Serving Unit',
	'volquantity' => 'Volume or Quantity',
	'volunit' => 'Volume Unit',
	'servcontainer' => 'Servings Per Container',
	'calories' => 'Calories',
	'caloriesfat' => 'Calories from Fat',
	'totalfatg' => 'Total Fat(g)',
	'totalfatdv' => 'Total Fat (Daily Value)',
	'saturatedfatg' => 'Saturated Fat(g)',
	'saturatedfatdv' => 'Saturated Fat (Daily Value)',
	'transfatg' => 'Trans Fat(g)',
	'polyunsatfat' => 'Polyunsaturated Fat(g)',
	'monounsatfat' => 'Monounsaturated Fat(g)',
	'cholesterolmg' => 'Cholesterol(mg)',
	'cholesteroldv' => 'Cholesterol (Daily Value)',
	'sodiummg' => 'Sodium(mg)',
	'sodiumdv' => 'Sodium (Daily Value)',
	'potassiummg' => 'Potassium(mg)',
	'potassiumdv' => 'Potassium (Daily Value)',
	'totalcarbg' => 'Total Carb(g)',
	'totalcarbdv' => 'Total Carb(dv)',
	'dietaryfiberg' => 'Dietary Fiber(g)',
	'dietaryfiberdv' => 'Dietary Fiber (Daily Value)',
	'sugarsg' => 'Sugar(g)',
	'sugarsalcoholg' => 'Sugar Alcohol(dv)',
	'othercarbg' => 'Other Carb(g)',
	'proteing' => 'Protein(g)',
	'calciumdv' => 'Calcium (Daily Value)',
	'irondv' => 'Iron (Daily Value)',
	'vitaminadv' => 'Vitamin A (Daily Value)',
	'vitamincdv' => 'Vitamin C (Daily Value)',
	'vitaminddv' => 'Vitamin D (Daily Value)',
	'vitaminedv' => 'Vitamin E (Daily Value)',
	'vitaminb6dv' => 'Vitamin B6 (Daily Value)',
	'vitaminb12dv' => 'Vitamin B12 (Daily Value)',
	'thiamindv' => 'Thiamin (Daily Value)',
	'riboflavindv' => 'Riboflavin (Daily Value)',
	'otherinfo' => 'Other Information',
	'extrainfo' => 'Extra Information'
	);

	$new = (get_new_label($db, $upc));
	$current = (get_current_label($db, $upc));
	echo "<table class='data'>";
	echo "<thead><tr><td>Value</td><td>Amount</td><td>Correct?</td></tr></thead>";
    foreach ($new as $key => $value) {
        if($current[$key] != NULL){ //do we need this check or do we still want to check for these things from users?
        	echo "<tr><td>";
            echo $columnArray[$key];
            echo "</td>";
        	echo "<td><input type='text' name='$columnArray[$key]' value=$current[$key]></td>";
        	echo "<td><input type='checkbox' name=$key></td></tr>";
        }
        else{ //do we need this check or do we still want to check for these things from users?
        	echo "<tr><td>";
            echo $columnArray[$key];
            echo "</td>";
        	echo "<td><input type='text' name='$columnArray[$key]' value=$value></td>";
        	echo "<td><input type='checkbox' name=$key></td></tr>";
        }
    }
    echo "</table>";
}
// function display_label($db, $upc){
// 	$columnArray = array(
// 	'upc' => 'UPC',
// 	'servsize' => 'Serving Size',
// 	'servunit' => 'Serving Unit',
// 	'volquantity' => 'Volume or Quantity',
// 	'volunit' => 'Volume Unit',
// 	'servcontainer' => 'Servings Per Container',
// 	'calories' => 'Calories',
// 	'caloriesfat' => 'Calories from Fat',
// 	'totalfatg' => 'Total Fat(g)',
// 	'totalfatdv' => 'Total Fat (Daily Value)',
// 	'saturatedfatg' => 'Saturated Fat(g)',
// 	'saturatedfatdv' => 'Saturated Fat (Daily Value)',
// 	'transfatg' => 'Trans Fat(g)',
// 	'polyunsatfat' => 'Polyunsaturated Fat(g)',
// 	'monounsatfat' => 'Monounsaturated Fat(g)',
// 	'cholesterolmg' => 'Cholesterol(mg)',
// 	'cholesteroldv' => 'Cholesterol (Daily Value)',
// 	'sodiummg' => 'Sodium(mg)',
// 	'sodiumdv' => 'Sodium (Daily Value)',
// 	'potassiummg' => 'Potassium(mg)',
// 	'potassiumdv' => 'Potassium (Daily Value)',
// 	'totalcarbg' => 'Total Carb(g)',
// 	'totalcarbdv' => 'Total Carb(dv)',
// 	'dietaryfiberg' => 'Dietary Fiber(g)',
// 	'dietaryfiberdv' => 'Dietary Fiber (Daily Value)',
// 	'sugarsg' => 'Sugar(g)',
// 	'sugarsalcoholg' => 'Sugar Alcohol(dv)',
// 	'othercarbg' => 'Other Carb(g)',
// 	'proteing' => 'Protein(g)',
// 	'calciumdv' => 'Calcium (Daily Value)',
// 	'irondv' => 'Iron (Daily Value)',
// 	'vitaminadv' => 'Vitamin A (Daily Value)',
// 	'vitamincdv' => 'Vitamin C (Daily Value)',
// 	'vitaminddv' => 'Vitamin D (Daily Value)',
// 	'vitaminedv' => 'Vitamin E (Daily Value)',
// 	'vitaminb6dv' => 'Vitamin B6 (Daily Value)',
// 	'vitaminb12dv' => 'Vitamin B12 (Daily Value)',
// 	'thiamindv' => 'Thiamin (Daily Value)',
// 	'riboflavindv' => 'Riboflavin (Daily Value)',
// 	'otherinfo' => 'Other Information',
// 	'extrainfo' => 'Extra Information'
// 	);

// 	$prepQry = "select * from new_label where upc=$upc";
// 	$result = $db->query($prepQry);
// 	echo "<table class='data'>";
// 	echo "<thead><tr><td>Value</td><td>Amount</td><td>Correct?</td></tr></thead>";
// 	while($row = $result->fetch_assoc()){
// 	    foreach($row as $key=>$value) {
//             if($value != NULL){ //do we need this check or do we still want to check for these things from users?
//             	echo "<tr><td>";
// 	            echo $columnArray[$key];
// 	            echo "</td>";
//             	echo "<td><input type='text' name='$columnArray[$key]' value=$value></td>";
//             	echo "<td><input type='checkbox' name=$key></td></tr>";
//             }
//         }
//     }
//     echo "</table>";
// }

function match_col_name($column){
	return $correctedArray[$column];
}

?>