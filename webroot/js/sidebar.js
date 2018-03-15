{
let SideBar = define_namespace("babymap.sidebar");
$(function(){ 
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
  function sideClose(f){
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
  SideBar.sideClose = sideClose;
});
}