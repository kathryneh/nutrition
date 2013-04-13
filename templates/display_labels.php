<?php
require_once("utils/dbconnect.php");
require_once("utils/api.php");

//This pulls the images from their storage location in Google Drive, 
//and displays it to the user. 
function display_img($upc){
	echo "<img class='label' src='https://googledrive.com/host/0BwhhSadkOfI1Ql9lVzExQ3RTZDQ/$upc.jpg'></img>";
}

//This maps each database column to the correct human readable text output.
//(arguably, this might be better to include in the database itself?)
//
//It then outputs the correct category of row for the user to see of the nutrition label
function display_label($db, $upc, $userid){
	$columnArray = array(
	'upc' => 'UPC',
	'servsize' => '<span class="secondary">Serving Size</span>',
	'servunit' => '<span class="secondary">Serving Unit</span>',
	'volquantity' => '<span class="secondary">Volume or Quantity</span>',
	'volunit' => '<span class="secondary">Volume Unit</span>',
	'servcontainer' => '<span class="secondary">Servings Per Container</span>',
	'calories' => '<span class="primary">Calories</span>',
	'caloriesfat' => '<span class="offset-label">Calories from Fat</span>',
	'totalfatg' => '<span class="primary">Total Fat(g)</span>',
	'totalfatdv' => '<span class="primary">Total Fat (Daily Value)</span>',
	'saturatedfatg' => '<span class="offset-label">Saturated Fat(g)</span>',
	'saturatedfatdv' => '<span class="primary offset-label">Saturated Fat (Daily Value)</span>',
	'transfatg' => '<span class="offset-label">Trans Fat(g)</span>',
	'polyunsatfat' => '<span class="offset-label">Polyunsaturated Fat(g)</span>',
	'monounsatfat' => '<span class="offset-label">Monounsaturated Fat(g)</span>',
	'cholesterolmg' => '<span class="primary">Cholesterol(mg)</span>',
	'cholesteroldv' => '<span class="primary">Cholesterol (Daily Value)</span>',
	'sodiummg' => '<span class="primary">Sodium(mg)</span>',
	'sodiumdv' => '<span class="primary">Sodium (Daily Value)</span>',
	'potassiummg' => '<span class="primary">Potassium(mg)</span>',
	'potassiumdv' => '<span class="primary">Potassium (Daily Value)</span>',
	'totalcarbg' => '<span class="primary">Total Carb(g)</span>',
	'totalcarbdv' => '<span class="primary">Total Carb(dv)</span>',
	'dietaryfiberg' => '<span class="offset-label">Dietary Fiber(g)</span>',
	'dietaryfiberdv' => '<span class="offset-label primary">Dietary Fiber (Daily Value)</span>',
	'sugarsg' => '<span class="offset-label">Sugar(g)</span>',
	'sugarsalcoholg' => '<span class="offset-label">Sugar Alcohol(dv)</span>',
	'othercarbg' => '<span class="offset-label">Other Carb(g)</span>',
	'proteing' => '<span class="primary">Protein(g)</span>',
	'calciumdv' => '<span class="secondary">Calcium (Daily Value)</span>',
	'irondv' => '<span class="secondary">Iron (Daily Value)</span>',
	'vitaminadv' => '<span class="secondary">Vitamin A (Daily Value)</span>',
	'vitamincdv' => '<span class="secondary">Vitamin C (Daily Value)</span>',
	'vitaminddv' => '<span class="secondary">Vitamin D (Daily Value)</span>',
	'vitaminedv' => '<span class="secondary">Vitamin E (Daily Value)</span>',
	'vitaminb6dv' => '<span class="secondary">Vitamin B6 (Daily Value)</span>',
	'vitaminb12dv' => '<span class="secondary">Vitamin B12 (Daily Value)</span>',
	'thiamindv' => '<span class="secondary">Thiamin (Daily Value)</span>',
	'riboflavindv' => '<span class="secondary">Riboflavin (Daily Value)</span>',
	'otherinfo' => '<span class="secondary">Other Information</span>',
	'extrainfo' => '<span class="secondary">Extra Information</span>'
	);
	
	//pulls new and current labels for a given UPC 
	//so that they can be compared.
	$new = (get_new_label($db, $upc));
	$current = (get_current_label($db, $upc));
	$hiddenBoxes = "";
	foreach ($new as $key => $value) {
        if($key == 'upc'){//special case for UPC
        	echo "<form id='nutritionLabel' onsubmit='return submitNutritionLabel();'>";
        	echo "<h3 style='float:left; margin-bottom:0'>Nutrition Facts</h3><h3 class='subheader upc'>UPC: $value</h3><input type='hidden' name='upc' value='$value'>";
        	echo "<input type='hidden' value='".$userid."' name='user_id'>";
        	echo "<table class='data'>";
			echo "<thead><tr><td style='min-width: 20em'>Value</td><td>Amount</td><td>Correct?</td><td>Remove?</td></tr></thead>";
        }
        //if the current label HAS a value, we don't need
        //the user to enter in data for this column.
        //This, we give them a disabled input with a checkbox. 
        else if($current[$key] != NULL){ 
        	echo "<tr class='confirmed'><td>";
            echo $columnArray[$key];
            echo "</td>";
        	echo "<td><input type='text' name='$key' value=$current[$key] disabled='true'></td>";
        	echo "<td><i class='foundicon-checkmark''></i></td><td><i class='foundicon-remove' data='$key'></i></td></tr>";
        }
        //if the value is 0, we assume that this information isn't in the label
        //and thus we hide this row but put it on the third column of +columns
        //to add if necessary. 
        else if($value == '0'){//we're assuming it's not present in the label
        	$hiddenBox.= "<div class='button add' column='$key'><i class='foundicon-plus'></i>".strip_tags($columnArray[$key])."</div>";
        	echo "<tr class='hidden' data-column=$key><td>";
            echo $columnArray[$key];
            echo "</td>";
        	echo "<td><input type='text' name='$key' value=$value></td>";
        	echo "<td><input type='checkbox' name=$key></td><td><i class='foundicon-remove' data='$key'></i></td></tr>";
        }
        else if (($key == 'volunit' || $key == 'servunit')){ //special cases for strings
        	$hiddenBox.= "<div class='button add' column='$key'><i class='foundicon-plus'></i>".strip_tags($columnArray[$key])."</div>";
        	echo "<tr class='hidden' data-column=$key><td>";
            echo $columnArray[$key];
            echo "</td>";
        	echo "<td><input type='text' name='$key' value='n/a'></td>";
        	echo "<td><input type='checkbox' name=$key></td><td><i class='foundicon-remove' data='$key'></i></td></tr>";
        }
        //normal case. 
        else{ 
        	echo "<tr><td>";
            echo $columnArray[$key];
            echo "</td>";
        	echo "<td><input type='text' name='$key' value=$value></td>";
        	echo "<td><input type='checkbox' name=$key></td><td><i class='foundicon-remove' data='$key'></i></td></tr>";
        }
    }
    echo "<tr><td colspan=4><input type='submit' class='button success'></td></tr>";
    echo "</table>";
    echo "</form>";
    echo "</div>";
    echo "<div class='large-2 columns'>";
    echo "<h6>Values not present or with zero values</h6><h6 class='subheader'>(click to add a value)</h6>";
    echo "<div class='hiddenRows'> $hiddenBox </div>";
}


?>