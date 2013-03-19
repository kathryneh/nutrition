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

//TODO fix this "fixed position" bug....
$(window).scroll(function (event) {
	var windowTop = $(this).scrollTop();
	if (windowTop+520 >= $("footer").offset().top) {
			//$(".label").addClass("fixed");
	} else {
		//$(".label").removeClass("fixed");
	}
});

var hideRow = function(event){
	//event will be on the foundicon-remove - need to hide the row
	$(event.target).closest("tr").toggleClass("hidden");
	//and create a new button below
	var clickedIcon = $(event.target)[0];
	console.log($(event.target)[0].getAttribute("data"));
	var colName = clickedIcon.getAttribute("data");
	var colText = "";
	if ((colText = clickedIcon.parentNode.parentNode.children[0].children[0].innerHTML) != 'undefined'){
		colText = clickedIcon.parentNode.parentNode.children[0].children[0].innerHTML;
	}
	else{
		colText = lickedIcon.parentNode.parentNode.children[0].innerHTML;
	}
	var outerDiv = document.createElement("div");
	$(outerDiv).addClass("button");
	$(outerDiv).addClass("add");
	outerDiv.setAttribute("column", colName);
	var innerIcon = document.createElement("i");
	$(innerIcon).addClass("foundicon-plus");
	outerDiv.appendChild(innerIcon);
	outerDiv.appendChild(document.createTextNode(colText));
	$(".hiddenRows").append(outerDiv);
};

var unhideRow = function(event, columnName){
	//event will be on element .add; need to hide the button
	//
	//and unhide the row above
};


$(document).ready(function(){
	var colName;
	$(".hiddenRows").on('click', function(event){
		if($(event.target).hasClass("add") || $(event.target).hasClass("foundicon-plus")  || event.target.parentNode.classList.contains("add")){
			colName = event.target.getAttribute("column");
			unhideRow(event, colName);
			$("tr[data-column='"+colName+"']").toggleClass("hidden");
			$(event.target).toggleClass("hidden");
		}
	});

	$(".data").on('click', function(event){
		console.log($(event.target)[0]);
		if($(event.target).hasClass("foundicon-remove")){
			hideRow.bind(this);
			hideRow(event);
		}
	});
});