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
	console.log(windowTop);
	console.log(window.offsetHeight());
	var labelLocation = $('.label').offset().top; //original location
	if (windowTop - labelLocation > 0 && windowTop + window.offsetHeight < document.height) {
			console.log(labelLocation);
			$('.label').offset({
				top: windowTop,
				left: $('.label').offset().left
			});
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
		console.log("second");
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
	// if($(event.target).hasClass("add")){
	// 	colName = event.target.getAttribute("column");
	// 	console.log(colName);
	// 	console.log($(event.target)[0]);
	// 	unhideRow(event, colName);
	// 	$("tr[data-column='"+colName+"']").toggleClass("hidden");
	// 	$(event.target.parent).toggleClass("hidden");
	// }
	// else if( $(event.target).hasClass("foundicon-plus")  || event.target.parentNode.classList.contains("add")){
	// 	colName = event.target.parentNode.getAttribute("column");
	// 	unhideRow(event, colName);
	// 	$("tr[data-column='"+colName+"']").toggleClass("hidden");
	// 	$(event.target).parent().addClass("hidden");
	// }
};


$(document).ready(function(){
	var colName;
	$(".hiddenRows").on('click', function(event){
		if($(event.target).hasClass("add")){
			colName = event.target.getAttribute("column");
			unhideRow(event, colName);
			$("tr[data-column='"+colName+"']").toggleClass("hidden");
			$(event.target.parent).toggleClass("hidden");
		}
		else if( $(event.target).hasClass("foundicon-plus")  || event.target.parentNode.classList.contains("add")){
			colName = event.target.parentNode.getAttribute("column");
			unhideRow(event, colName);
			$("tr[data-column='"+colName+"']").toggleClass("hidden");
			$('body').scroll($("tr[data-column="+colName+"]").offset().top);
			$(event.target).parent().addClass("hidden");
		}
	});

	$(".data").on('click', function(event){
		if($(event.target).hasClass("foundicon-remove")){
			hideRow.bind(this);
			hideRow(event);
		}
	});
});