$(document).ready(function(){
    $('.stat-chart').each(function() {
        var baseStat = $(this).siblings('.stat-index').data('bs');
        $(this).children().width((baseStat/150)*100 + '%');
        if(baseStat >= 140){
            $(this).children().addClass('barchart-rank-6');
        }else if (baseStat >= 120) {
            $(this).children().addClass('barchart-rank-5');
        }else if(baseStat >= 89){
            $(this).children().addClass('barchart-rank-4');
        }else if(baseStat >= 60){
            $(this).children().addClass('barchart-rank-3');
        }else if(baseStat >= 30){
            $(this).children().addClass('barchart-rank-2');
        }else if(baseStat < 30){
            $(this).children().addClass('barchart-rank-1');
        }
    })
})