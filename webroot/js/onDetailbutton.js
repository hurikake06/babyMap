$(function(){
  var myStyle = {
    sideWrap:"padding:0;margin:0;z-index: 99999;width:100%;height:100%;position: fixed;top: 0;left: 0;background-color:rgba(0,0,0,0);",
    sideList:"padding:0;margin:0;background-color:white;height:100%;",
    ul:"margin:0;padding:0;font-size:5em;list-style-type: none;color: #1e366a;border-top: solid #1e366a 3px;",
    sideTitle:"padding:0.5em 0 0.5em 0;margin 0;font-size:8em;background-color:pink;color:orange;height:10%;",
    sideListWrap:"padding:0;margin:0;width:80%;",
    sideBack:"z-index: -9999;background-color:rgba(0,0,0,0.3);width:100%;height:100%;padding:0;margin:0;position: fixed;top: 0;left: 0;"
    };

  sideClose = function(f){
    if (f) {
        $("div#sideListWrap:not(:animated)").animate({
          "margin-left":"-80%"
        },500,"swing",function(){
          $('div#sideWrap').toggle(false);
        });
    }else{
      $('div#sideListWrap').css("margin-left","-80%");
      $('div#sideWrap').toggle(false);
    }
  }
  ini();

  $("div.detailbutton").click(function(){
    // $('div#sideWrap').css('display', 'block');
    sideOpen(true);
  });

  $('div#sideBack').click(function(){
    console.log("sideBack onclick");
    sideClose(true);
  });

  $("div #sideList").click(function(){
    console.log("sideList onclick");
  });

  $("div #sideTitle").click(function(){
    console.log("sideTitle onclick");
  });

//pc用
  // $("div #sideList ul li").mousedown(function(){
  //   $(this).css({
  //     "background-color":"blue",
  //     "color":"white"
  //   });
  // }).mouseout(function(){
  //   $(this).css({
  //     "background-color":"",
  //     "color":""
  //   });
  // }).mouseup(function(){
  //     $(this).css({
  //       "background-color":"",
  //       "color":""
  //     });
  // });

  $("div #sideList ul li").bind("touchstart",function(){
    $(this).css({
      "background-color":"gray",
      "color":"white"
    });
  }).bind("touchend",function(){
      $(this).css({
        "background-color":"",
        "color":""
      });
  });

  function ini(){
    $("body").prepend('<div id="sideWrap" style="'+myStyle.sideWrap+'"><div id="sideListWrap" style="'+myStyle.sideListWrap+'"><div id="sideTitle" style="'+myStyle.sideTitle+'">Baby Map</div><div id="sideList" style="'+myStyle.sideList+'"><ul style="'+myStyle.ul+'"><li>ようこそ</li></ul><ul style="'+myStyle.ul+'"><li>検索履歴</li><li onclick="babymap.nav.openStationFavorites();sideClose();">お気に入り</li></ul><ul style="'+myStyle.ul+'"><li>ヘルプ</li><li>設定</li><li>利用規約</li></ul></div></div><div id="sideBack" style="'+myStyle.sideBack+'"></div></div>');
    $("#sideList li").css({"padding": "0.5em 0 0.5em 10px"});
    sideClose(false);
  }

  function sideOpen(f){
    if(f){
      $('div#sideWrap').toggle(true);
      $("div#sideListWrap:not(:animated)").animate({
        "margin-left":"0"
      },500,"swing");
    }else{
      $('div#sideListWrap').css("margin-left","0");
      $('div#sideWrap').toggle(true);
    }
  }

});
