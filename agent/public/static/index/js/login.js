$(function () {
    setTimeout(function () {
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });

            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });

            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
                /*e.preventDefault();*//*取消預設動作*/
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });
        });

        var cover = document.getElementById('Modal_cover');
        var cover2 = document.getElementById('Modal_cover2');

        $("#qq").on('click',function () {

            $("#Modal_cover").css('display','block');
        });
        $(".close_x").on('click', function () {
            $("#Modal_cover").css('display', 'none');
            $("#myModa2").css('display', 'none');

        });
        $(".close_btn").on('click', function () {
            $("#Modal_cover").css('display', 'none');

        });
        $("#weixin").on('click',function () {
            $("#Modal_cover2").css('display','block');
        });
        $(".close_x").on('click', function () {
            $("#Modal_cover2").css('display', 'none');

        });
        $(".close_btn").on('click', function () {
            $("#Modal_cover2").css('display', 'none');

        });


        window.onclick = function (event) {
            if (event.target == cover) {
                cover.style.display = "none";
            }
            if (event.target == cover2) {
                cover2.style.display = "none";
            }

        }


    }, 500);


});