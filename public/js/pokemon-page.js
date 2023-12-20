$(document).ready(function(){
    $('.stat-chart').each(function() {
        var baseStat = $(this).siblings('.stat-index').data('bs');
        $(this).children().width((baseStat/255)*100 + '%');
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

    $('.search-pokemon').on('keyup', function() {
        let searchString = $(this).val();
        let results = $(this).siblings('.search-results');
        results.show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/get-pokemon',
            method: 'POST',
            data: {
                searchString: searchString
            },
            success: function(response) {
                results.empty();
                results.append(response);
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    })

    $('.generation-navigator span').on('click', function () {
        var thisTab = $(this);
        var gen = $(this).data('gen');
        var name = $(this).parent().data('pokemon');
        var target = $(this).parent().siblings('.pokemon-moves');

        $('.generation-navigator span').removeClass('active');
        thisTab.addClass('active');
        $('.pokemon-moves').children().addClass('opacity-0');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/get-pokemon-moves',
            method: 'POST',
            data: {
                name: name,
                gen: gen
            },
            success: function(response) {
                target.empty();
                target.append(response);
                $('tbody.multiload-right').each(function () {
                    let delay = 50;
                    $(this).children('tr').each(function (index) {
                        var element = $(this);
                
                        setTimeout(function () {
                            element.addClass('fade-left');
                        }, delay * index);
                    });
                })
            
                $('tbody.multiload-left').each(function () {
                    let delay = 50;
                    $(this).children('tr').each(function (index) {
                        var element = $(this);
                
                        setTimeout(function () {
                            element.addClass('fade-right');
                        }, delay * index);
                    });
                })
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    })
})