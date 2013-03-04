var submitNutritionLabel = function(){
	console.log("hello!");
	$.ajax({
		type:'POST',
		url: 'submitNutritionLabel.php',
		data:$('#nutritionLabel').serialize(),
		success: function(response) {
			console.log(response);
		}
	});
	return false;
};
