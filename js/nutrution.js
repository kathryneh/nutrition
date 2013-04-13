//This submits the nutrition label to submitNutritionLabel.php
//It serializes all of the data in the large form on the nutrition label
//and submits it to the database. 
//It then returns true, triggering a page reload. 
var submitNutritionLabel = function(){
	$.ajax({
		type:'POST',
		url: 'ajax/submitNutritionLabel.php',
		data:$('#nutritionLabel').serialize(),
		success: function(response) {
			console.log(response);
		}
	});
	return true;
};

//This updates the number of verifications that must occur before
//a label's information is copied from the submissions table
//and considered to be correct. 
var changeVerification = function(){
	console.log($('#numVerifications').serialize());
	$.ajax({
		type:'POST',
		url: 'utils/verification.php',
		data: $('#numVerifications').serialize(),
		success: function(response) {
			console.log(response);
		}
	});
	return true;
};

//This function causes the nutrition label image to follow the user's scrolling so that 
//it is easier for them to submit corrections. 
var windowScroll = function(labelLocation){
	$(window).scroll(function (event) {
		var windowTop = $(this).scrollTop();
		if (windowTop - labelLocation > 0 && windowTop + window.top.pageYOffset < document.height) {
			$('.label').offset({
				top: windowTop,
				left: $('.label').offset().left
			});
		}
	});
};

//This disables the checkbox when a user has entered a value
var disableCheckbox = function(){
	$('input').on('keypress', function(event){
		var inputName = ($(event.target)[0].name);
		$('input[name="'+inputName+'"]')[1].disabled = true;
	});
};

//This disables the input box if a user has set a checkbox
//to be set to "correct"
var disableInput = function(){
	$('input[type=checkbox]').on('click', function(event){
		var inputName = ($(event.target)[0].name);
		var inputTarget = $('input[name="'+inputName+'"]')[1];
		var inputSibling = $('input[name="'+inputName+'"]')[0];
		if ($(inputSibling).attr('disabled')) $(inputSibling).removeAttr('disabled');
            else $(inputSibling).attr('disabled', 'disabled');
	});
};

//This hides the row of the nutrition label that a user
//submits as being incorrect (and thus we consider this value to be zero)
//and then adds the value of this row to be on the other column.
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

	//if the user isn't using Chrome, display a notification about
	//less than optimal performance. 
	if (!window.chrome){
		$('#notChromeRow').show();
	}
	if (!!$('.label')){
		var labelLocation = $('.label').offset().top;
		windowScroll(labelLocation);
		windowScroll();
	}
	var colName;

	//this adds event listeners to the + buttons on the right column
	//and unhides rows from the database when appropriate. 
	$(".hiddenRows").on('click', function(event){
		console.log(event.target);
		if($(event.target).hasClass("add")){
			colName = event.target.getAttribute("column");
			$("i[data='"+colName+"']").parent().parent().toggleClass("hidden");
			$(event.target).toggleClass("hidden");
		}
		else if( $(event.target).hasClass("foundicon-plus")){
			colName = event.target.parentNode.getAttribute("column");
			$("i[data='"+colName+"']").parent().parent().toggleClass("hidden");
			$('body').scroll($("tr[data-column="+colName+"]").offset().top);
			$(event.target).parent().addClass("hidden");
		}
		else if(event.target.parentNode.classList.contains("add")){
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
	disableCheckbox();
	disableInput();
});