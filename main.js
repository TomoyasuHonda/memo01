//DOMを全て取得してからjsを実行する
$(function(){

  //クリックイベントを設定
  //$('li').click(function(){
    //$('span').toggle();
  //})

  //$('li').click(function(){
    //クリックしたインデックス番号を取得
    //var index = $('li').index($(this));

    //$('span').eq(index).fadeIn(1000);
  //})

  

  $('li').hover(function(){
    //クリックしたインデックス番号を取得
    var index = $('li').index($(this));

    $('span').eq(index).addClass('action');
  },function(){
    var index = $('li').index($(this));
    $('span').eq(index).removeClass('action');
  });





})
