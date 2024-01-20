$(document).on("click",".datepicker",function(){
	$(this).datepicker({
    	format:"dd-mm-yyyy",
    	todayHighlight:true,
    	autoclose: true,
    });
	$(this).datepicker("show");
});

