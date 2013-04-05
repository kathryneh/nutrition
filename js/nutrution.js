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
var windowScroll = function(labelLocation){
	$(window).scroll(function (event) {
		var windowTop = $(this).scrollTop();
		console.log(windowTop);
		console.log(window.top.pageYOffset);
		var lLocation= $('.label').offset().top; //original location
		console.log(lLocation);
		if (windowTop - labelLocation > 0 && windowTop + window.top.pageYOffset < document.height) {
			console.log(lLocation);
			$('.label').offset({
				top: windowTop,
				left: $('.label').offset().left
			});
		}
	});
};

var hideRow = function(event){
	//event will be on the foundicon-remove - need to hide the row
	$(event.target).closest("tr").toggleClass("hidden");
	//and create a new button below
	var clickedIcon = $(event.target)[0];
	var colName = clickedIcon.getAttribute("data");
	var colText = "";
	if ((colText = clickedIcon.parentNode.parentNode.children[0].children[0].innerHTML) != 'undefined'){
		colText = clickedIcon.parentNode.parentNode.children[0].children[0].innerHTML;
	}
	else{
		console.log("second");
		colText = lickedIcon.parentNode.parentNode.children[0].innerHTML;
		console.log(colText);
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


$(document).ready(function(){
	var labelLocation = $('.label').offset().top;
	windowScroll(labelLocation);
	windowScroll();
	var colName;
	$(".hiddenRows").on('click', function(event){
		if($(event.target).hasClass("add")){
			colName = event.target.getAttribute("column");
			console.log("hi");
			console.log($("tr[data='"+colName+"']"));
			$("i[data='"+colName+"']").parent().parent().toggleClass("hidden");
			$(event.target).toggleClass("hidden");
		}
		else if( $(event.target).hasClass("foundicon-plus")){
			console.log("there");
			colName = event.target.parentNode.getAttribute("column");
			$("i[data='"+colName+"']").parent().toggleClass("hidden");
			$("tr[data-column='"+colName+"']").toggleClass("hidden");
			$('body').scroll($("tr[data-column="+colName+"]").offset().top);
			$(event.target).parent().addClass("hidden");
		}
		else if(event.target.parentNode.classList.contains("add")){
			console.log("what?");
			colName = event.target.parentNode.getAttribute("column");
			$("i[data='"+colName+"']").parent().parent().toggleClass("hidden");
			$("tr[data='"+colName+"']").toggleClass("hidden");
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