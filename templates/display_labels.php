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
	'calories' => '<b>Calories</b>',
	'caloriesfat' => '<span class="offset-label">Calories from Fat</span>',
	'totalfatg' => '<b>Total Fat(g)</b>',
	'totalfatdv' => '<b>Total Fat (Daily Value)</b>',
	'saturatedfatg' => '<span class="offset-label">Saturated Fat(g)</span>',
	'saturatedfatdv' => '<span class="offset-label"><b>Saturated Fat (Daily Value)</b></span>',
	'transfatg' => '<span class="offset-label">Trans Fat(g)</span>',
	'polyunsatfat' => '<span class="offset-label">Polyunsaturated Fat(g)</span>',
	'monounsatfat' => '<span class="offset-label">Monounsaturated Fat(g)</span>',
	'cholesterolmg' => '<b>Cholesterol(mg)</b>',
	'cholesteroldv' => '<b>Cholesterol (Daily Value)</b>',
	'sodiummg' => '<b>Sodium(mg)</b>',
	'sodiumdv' => '<b>Sodium (Daily Value)</b>',
	'potassiummg' => '<b>Potassium(mg)</b>',
	'potassiumdv' => '<b>Potassium (Daily Value)</b>',
	'totalcarbg' => '<b>Total Carb(g)</b>',
	'totalcarbdv' => '<b>Total Carb(dv)</b>',
	'dietaryfiberg' => '<span class="offset-label">Dietary Fiber(g)</span>',
	'dietaryfiberdv' => '<span class="offset-label"><b>Dietary Fiber (Daily Value)</b></span>',
	'sugarsg' => '<span class="offset-label">Sugar(g)</span>',
	'sugarsalcoholg' => '<span class="offset-label">Sugar Alcohol(dv)</span>',
	'othercarbg' => '<span class="offset-label">Other Carb(g)</span>',
	'proteing' => '<b>Protein(g)</b>',
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
	$hiddenBoxes = "";
	foreach ($new as $key => $value) {
        if($key == 'upc'){//special case for UPC
        	echo "<form id='nutritionLabel' onsubmit='return submitNutritionLabel();'>";
        	echo "<h3 class='subheader upc'>UPC: $value</h3><input type='hidden' name='upc' value='$value'>";
        	echo "<table class='data'>";
			echo "<thead><tr><td>Value</td><td>Amount</td><td>Correct?</td><td>Remove?</td></tr></thead>";
        }
        else if($current[$key] != NULL){ //do we need this check or do we still want to check for these things from users?
        	echo "<tr class='confirmed'><td>";
            echo $columnArray[$key];
            echo "</td>";
        	echo "<td><input type='text' name='$key' value=$current[$key] disabled='true'></td>";
        	echo "<td><i class='foundicon-checkmark''></i></td><td><i class='foundicon-remove' data='$key'></i></td></tr>";
        }
        else if($value == 0){//we're assuming it's not present in the label
        	$hiddenBox.= "<div class='button add' column='$key'><i class='foundicon-plus'></i> $columnArray[$key]</div>";
        	echo "<tr class='hidden' data-column=$key><td>";
            echo $columnArray[$key];
            echo "</td>";
        	echo "<td><input type='text' name='$key' value=$value></td>";
        	echo "<td><input type='checkbox' name=$key></td><td><i class='foundicon-remove' data='$key'></i></td></tr>";
        }
        else{ //do we need this check or do we still want to check for these things from users?
        	echo "<tr><td>";
            echo $columnArray[$key];
            echo "</td>";
        	echo "<td><input type='text' name='$key' value=$value></td>";
        	echo "<td><input type='checkbox' name=$key></td><td><i class='foundicon-remove' data='$key'></i></td></tr>";
        }
    }
    echo "<tr><td colspan=4><h4>Values not present or with zero values</h4><h4 class='subheader'>(click to add a value)</h4></td></tr>";
    echo "<tr> <td colspan=4 class='hiddenRows'> $hiddenBox </td></tr>";
    echo "<tr><td colspan=4><input type='submit' class='button success'></td></tr>";
    echo "</table>";
    echo "</form>";
}


?>