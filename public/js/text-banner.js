$(document).ready(function() {
    var words = JSON.parse($('.text-animate').attr('data-text-arr')),
        i = 0;

    setInterval(function(){
        $('.text-animate h1').fadeOut(function(){
            $(this).html(words[i = (i + 1) % words.length]).fadeIn();
        });
    }, 4000);
})