<?php
	// Delimiters may be slash, dot, or hyphen
	$date = "04/30/1973";
	list($month, $day, $year) = split('[/.-]', $date);
	echo "Month: $month; Day: $day; Year: $year<br />\n";

	$submitted = "http://wwwx.cs.unc.edu/Courses/comp523-s13/nutrition/index.php?upc=003000006700&user_id=14&servsize=1&servunit=n%2Fa&volquantity=24&volunit=n%2Fa&servcontainer=8&calories=90&caloriesfat=20&totalfatg=2.0&totalfatdv=3&saturatedfatg=1.0&saturatedfatdv=2&transfatg=0.0&polyunsatfat=1.0&monounsatfat=1.0&cholesterolmg=0&cholesteroldv=0&sodiummg=80&sodiumdv=3&potassiummg=0&potassiumdv=0&totalcarbg=19&totalcarbdv=6&dietaryfiberg=1&dietaryfiberdv=4&sugarsg=7&sugarsalcoholg=1&othercarbg=10&proteing=1&calciumdv=8&irondv=2&vitaminadv=0&vitamincdv=0&vitaminddv=0&vitaminedv=0&vitaminb6dv=0&vitaminb12dv=0&thiamindv=0&riboflavindv=0&otherinfo=0&extrainfo=0";
	echo $submitted;
	
	echo $submitted.substr(63);
?>