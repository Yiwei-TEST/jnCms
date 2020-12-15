$(function () {
    setTimeout(function () {
        
        $(".choose_alliance div").click(function () {
            $(this).toggleClass('click');
            $(this).find('i').toggle();
        });
        
        $(".box").click(function () {
            $(this).toggleClass('checked');
            $(this).find('i').toggle();
        });
        

        
        $('#return-to-top').click(function() {      // When arrow is clicked
            $(".sidy__content").scrollTop(0);

        });
        $('#return-to-bottom').click(function() {      // When arrow is clicked
            $(".sidy__content").scrollTop(9999999);

        });
        
        $(function () {
            $(".sidy__content").scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#return-to-top').fadeIn();
                } else {
                    $('#return-to-top').fadeOut();
                }
            });

            // scroll body to 0px on click
            $('#return-to-top').click(function () {
                $('.sidy__content').animate({
                    scrollTop: 0
                }, 1600);
                return false;
            });
        });

    }, 500);
    
    $(".tabs input#tab-1").click(function() {		
			   $(".sidy__content").scrollTop(0);
			   });
			$(".tabs input#tab-2").click(function() {
			   $(".sidy__content").scrollTop(0);
			   });
			$(".tabs input#tab-3").click(function() {
			   $(".sidy__content").scrollTop(0);
			   });
			$(".tabs input#tab-4").click(function() {
				 //$(".content-4 .game_list").css('display', 'none');
				 //$(".content-*").css('display', 'none');
				 //$(".content-4").css('display', 'block');
			   $(".sidy__content").scrollTop(0);
			   
			   });

});
