$(function () {
    setTimeout(function () {
        
        $(document).ready(function(){
            // Activate Carousel
            $("#myCarousel2").carousel();

            // Enable Carousel Indicators
            $(".item1").click(function(){
                $("#myCarousel2").carousel(0);
            });
            $(".item2").click(function(){
                $("#myCarousel2").carousel(1);
            });


            // Enable Carousel Controls
            $(".left2").click(function(){
                $("#myCarousel2").carousel("prev");
            });
            $(".right2").click(function(){
                $("#myCarousel2").carousel("next");
            });
        });

    }, 500);
});

    	var arrlanguage = new Array();
    	    arrlanguage['play1'] = 'rule info';
    	    arrlanguage['play2'] = 'back taogin';
    	$(document).ready(function(e){
    	   $('.lans').each(function(index, element){
    	      //$(this).text(arrlanguage[$(this).attr('key')]);
    	      //console.log($(this).attr('key'));
    	    });
    	  
    	 });