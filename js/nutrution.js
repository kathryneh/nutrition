var submitNutritionLabel = function(){
	console.log("hello!");
	$.ajax({
		type:'POST',
		url: 'ajax/submitNutritionLabel.php',
		data:$('#nutritionLabel').serialize(),
		success: function(response) {
			console.log(response);
		}
	});
	return false;
};

$(window).scroll(function (event) {
	var windowTop = $(this).scrollTop();
	if (windowTop+520 >= $("footer").offset().top) {
			//$(".label").addClass("fixed");
	} else {
		//$(".label").removeClass("fixed");
	}
});

$(document).ready(function(){
	var colName;
	$(".hiddenRows").on('click', function(event){
		if($(event.target).hasClass("add")){
			colName = event.target.getAttribute("column");
			$("tr[data-column='"+colName+"']").toggleClass("hidden");
			$(event.target).toggleClass("hidden");
		}
	});

	$(".data").on('click', function(event){
		if($(event.target).hasClass("foundicon-remove")){
			$(event.target).parent().$(parent()).toggleClass("hidden");
			var test = $(event.target).parent().siblings("input").getAttribute("name");
			console.log(test);
		}
		var newIcon = document.createDocumentFragment("<div class='button add' column='$key'><i class='foundicon-plus'></i> $columnArray[$key]</div>");
		$(".hiddenRows").append(newIcon);
	});
});