<?php
require_once("utils/dbconnect.php");

function display_img($upc){
	echo "<img src='labels/$upc.jpg'></img>";
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

	$prepQry = "select * from new_label where upc=$upc";
	$result = $db->query($prepQry);
	echo "<table>";
	while($row = $result->fetch_assoc()){
	    foreach($row as $key=>$value) {
            if($value != NULL){
            	echo "<tr><td>";
	            echo $columnArray[$key];
	            echo "</td>";
            	echo "<td>$value</td></tr>";
            }
        }
    }
    echo "</table>";
}

function match_col_name($column){
	
	return $correctedArray[$column];
}

// function display_label($db, $upc){
// 	echo "<table>";
// 	$prepQry = "select * from new_label where upc=$upc";
// 	echo $prepQry;
// 	$result = mysql_query($prepQry) or die(mysql_error());
// 	// Print the column names as the headers of a table
// 	echo "<table><tr>";
// 	for($i = 0; $i < mysql_num_fields($result); $i++) {
// 	    $field_info = mysql_fetch_field($result, $i);
// 	    echo "<th>{$field_info->name}</th>";
// 	}

// 	// Print the data
// 	while($row = mysql_fetch_row($result)) {
// 	    echo "<tr>";
// 	    foreach($row as $_column) {
// 	        echo "<td>{$_column}</td>";
// 	    }
// 	    echo "</tr>";
// 	}
// 	echo "</table>";

// 	echo '<table>';
// 	$prepQry = "select * from new_label where upc=$upc";
// 	// Loop over all result rows
// 	while($row = mysql_fetch_assoc($query)) {
// 	    // Loop over all fields per row
// 	    foreach($row as $field => $value) {
// 	        echo '<tr><td>' . htmlentities($field) . '</td><td>' . htmlentities($value) . '</td></tr>';
// 	    }
// 	    // New data row can optionally be seperated with a blank line here
// 	    echo '<tr><td colspan="2">&nbsp;</td></tr>';
// 	}
// 	echo '</table>';
// }
  // `upc` bigint(12) unsigned zerofill NOT NULL,
  // `servsize` int(11) NOT NULL,
  // `servunit` varchar(11) DEFAULT NULL,
  // `volquantity` int(11) DEFAULT NULL,
  // `volunit` varchar(11) DEFAULT NULL,
  // `servcontainer` int(11) DEFAULT NULL,
  // `calories` int(11) DEFAULT NULL,
  // `caloriesfat` int(11) DEFAULT NULL,
  // `totalfatg` int(11) DEFAULT NULL,
  // `totalfatdv` int(11) DEFAULT NULL,
  // `saturatedfatg` int(11) DEFAULT NULL,
  // `saturatedfatdv` int(11) DEFAULT NULL,
  // `transfatg` int(11) DEFAULT NULL,
  // `polyunsatfat` int(11) DEFAULT NULL,
  // `monounsatfat` int(11) DEFAULT NULL,
  // `cholesterolmg` int(11) DEFAULT NULL,
  // `cholesteroldv` int(11) DEFAULT NULL,
  // `sodiummg` int(11) DEFAULT NULL,
  // `sodiumdv` int(11) DEFAULT NULL,
  // `potassiummg` int(11) DEFAULT NULL,
  // `potassiumdv` int(11) DEFAULT NULL,
  // `totalcarbg` int(11) DEFAULT NULL,
  // `totalcarbdv` int(11) DEFAULT NULL,
  // `dietaryfiberg` int(11) DEFAULT NULL,
  // `dietaryfiberdv` int(11) DEFAULT NULL,
  // `sugarsg` int(11) DEFAULT NULL,
  // `sugarsalcoholg` int(11) DEFAULT NULL,
  // `othercarbg` int(11) DEFAULT NULL,
  // `proteing` int(11) DEFAULT NULL,
  // `calciumdv` int(11) DEFAULT NULL,
  // `irondv` int(11) DEFAULT NULL,
  // `vitaminadv` int(11) DEFAULT NULL,
  // `vitamincdv` int(11) DEFAULT NULL,
  // `vitaminddv` int(11) DEFAULT NULL,
  // `vitaminedv` int(11) DEFAULT NULL,
  // `vitaminb6dv` int(11) DEFAULT NULL,
  // `vitaminb12dv` int(11) DEFAULT NULL,
  // `thiamindv` int(11) DEFAULT NULL,
  // `riboflavindv` int(11) DEFAULT NULL,
  // `otherinfo` int(11) DEFAULT NULL,
  // `extrainfo` int(11) DEFAULT NULL,

?>