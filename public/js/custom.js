$(document).ready(function () {

    function is_valid_url(url) {
        return /^(http(s)?:\/\/)?(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(url);
    }

    $('.url-form form').submit(function (e) {
        $url = $(this).find('#url_originalUrl').val();
        console.log($url);
        if (!is_valid_url($url)) {
            e.preventDefault();
            if (!$(this).find('.form-info').length)
                $(this).append('<p class="form-info">Wrong URL!</p>');
        }
    });

    $(document).on('click', '.copyToClipboard', function () {
        $(this).attr('data-tooltip', 'Copied!');
        setTimeout(function () {
            $('.copyToClipboard').removeAttr('data-tooltip');
        }, 1300);

        let href = $(this).prev().attr('href');
        let $temp = document.createElement("textarea");
        $temp.value = href;
        document.body.appendChild($temp);
        $temp.select();
        document.execCommand('copy');
        $temp.remove();
        console.log(href);
    });
    
    $(document).on('click', '#btndwn', function () {
        $('.section1').scrollTo('section2');
        console.log("stop clicking me!");
    });  

    $('#open-links').submit(function (e) {
        e.preventDefault();
        if (!$('.blink-message').length) {
            $(this).after("<p class='blink-message blink'>If all the URLs haven't been opened, it means that your browser doesn't" +
                "<br> Possible that at the top of the browser window you can permit this setting!"
                + " allow you to open pop-up windows. <br> You can change your browser settings or open addresses one by one :(</p>");

            setTimeout(function(){
                $('.blink-message').removeClass('blink');
            }, 11000);
        }

        $('.url-list-item').each(function () {
            let url = $(this).find('.url-to-redirect');
            let href = url.attr('href');
            window.open(href);
        });
        return false;
    });

    $('.left-statistics-item').first().addClass('url-active');

    $('.left-statistics-item').click(function () {
        let href = $(this).attr('href');
        $('.left-statistics-item').removeClass('url-active');
        $(this).addClass('url-active');
        $('.url-informations').hide();
        $(href).fadeIn(1000);

    });


    // Add smooth scrolling to all links
    $("a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 500, function(){

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });

});