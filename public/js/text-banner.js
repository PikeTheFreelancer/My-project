(function(){
  var words = [
      'Vermilion Center',
      'Here is a playground for Pokemon fans.',
      'PRO infomations and lookup further about Pokemon games.',
      ], i = 0;
  setInterval(function(){
      $('.text-animate h1').hide(function(){
          $(this).html(words[i=(i+1)%words.length]).show();
      });
  }, 3999);
    
})();