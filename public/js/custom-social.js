jQuery(function($) {

		String.prototype.replaceAt=function(index, replacement) {
	    return this.substr(0, index) + replacement+ this.substr(index + replacement.length);
	}
    $(".social-buttons div").click(function ()
    	{
    		var enabled  =$(this).attr("data-id");
    		var number = parseInt($(this).attr("data-number"));
    		if(enabled=="0"){
	    		$(this).attr("data-id","1");
	    		$(this).addClass("social-enabled");
	    		$("#social-buttons").val($("#social-buttons").val().replaceAt(number,"1"));
	    		return;
    		}
    		if(enabled=="1"){
    			$(this).attr("data-id","0");
	    		$(this).removeClass("social-enabled");
	    		$("#social-buttons").val($("#social-buttons").val().replaceAt(number, "0"));
	    		return;
    		}
    	});
});