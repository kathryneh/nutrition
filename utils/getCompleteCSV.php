<?php 

require_once("dbconnect.php");
//this retrieves all of the information from the complete_label and 
//returns a CSV file that the user can then download and use however they like. 

$db = getdb();
$result = $db->query('SELECT * FROM complete_label');
$outputCSV = fopen('php://output', 'w');
if ($outputCSV && $result) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="complete_label.csv"');
    fputs($outputCSV, "UPC,Serving Size ,Serving Unit of Measure ,Serving Weight or Volume Quantity,Serving Weight or Volume Unit,Servings Per Container ,Calories ,Calories from Fat ,Total Fat (g),Total Fat (%DV),Saturated Fat (g),Saturated Fat (%DV),Trans Fat (g),Polyunsaturated Fat (g),Monounsaturated Fat (g),Cholesterol (mg),Cholesterol (%DV),Sodium (mg),Sodium (%DV),Potassium (mg),Potassium (%DV),Total Carbohydrates (g),Total Carbohydrates (%DV),Dietary Fiber (g),Dietary Fiber (%DV),Sugars (g),Sugars Alcohol (g),Other Carbohydrates (g),Protein (g),Calcium (%DV),Iron (%DV),VitaminA (%DV),VitaminC (%DV),VitaminD (%DV),VitaminE (%DV),VitaminB6 (%DV),VitaminB12 (%DV),Thiamin (%DV),Riboflavin (%DV),,");
    while ($row = $result->fetch_array(MYSQLI_NUM)) {
        fputcsv($outputCSV, array_values($row));
    }
    die;
}
?>