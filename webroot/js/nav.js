{
let Nav = define_namespace('babymap.nav');
let Station = import_namespace('babymap.station');
let Map = import_namespace('babymap.map');
let Favorite = import_namespace('babymap.favorite');
let History = import_namespace('babymap.history');

Nav.screenType = {
  map:1,
  route:2
}
Nav.nowpage = 0;
Nav.openedNav = false;
Nav.firstload = true;
Nav.nowStation = null;
Nav.ScreenMode = Nav.screenType.map;
Nav.gpsLocation = null;
let nowNavState = null;

// 経路案内 src/dest
let srcDefaultPoint = null;
let destDefaultPoint = null;

Map.displaySrcAddress = "豊橋駅";
Map.displayDestAddress = "";

$(function(){
	Nav.stationInfoNav = $("#mapStationNav");
	$("#map").bind("touchstart",function(){
	    if(Nav.openedNav){
	      Nav.closeStationNav();
	    }
	  });
  if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(initSuccessCallback,errorCallback);
  }
  Nav.closeTab = $("#close-tab");
  Nav.closeTab.text("リスト表示:");
  Nav.closeTab.attr("onclick","babymap.nav.openStationList()");
  Nav.closeStationNav();
  $("#station-details").on("click",".favorite:not(.active)",function(){
    $(this).addClass("active");
    Favorite.addFavorite(Nav.nowStation);
  }).on("click",".favorite.active",function(){
    $(this).removeClass("active");
    Favorite.removeFavorite(Nav.nowStation);
  });
  $("input[name='travelMode']").change(function(){
    Map.calcCurrentRoute();
  });
});
Nav.openMarkerData = function(marker,station_id){
  let val = Station.dataArray[station_id];
  console.log("----touch station log:");
  console.log(val);
  let contentString = "<h1>"+val.id+":"+val.name+"</h1><br><h3>lat ："+val.lat+"</h3><br><h3>lng ："+val.lng+"</h3><div class='routeDiv'style='background-color:#05050529'><button class='routeButton' type='button' name='button' onclick='$(function(){onSearchRouteButton("+val.id+","+val.lat+","+val.lng+")})' value="+val.id+">ルート案内</button><p id='route"+val.id+"'></p></div>";

  Nav.setStationData(val);
  Nav.openStationRough();
}
Nav.setStationData = function(val,env={}){
  Nav.nowStation = val;
  Nav.setStationRough(val,env);
  Nav.setStationDetails(val,env);
}
Nav.changeNav = function(nav){
  if(Nav.currentNav == nav){

  }else{
    if(Nav.currentNav!=null){
      $(Nav.currentNav).hide();
    }
    Nav.currentNav = nav;
    $(Nav.currentNav).show();
    console.log("changed - " + Nav.currentNav);
  }
}
Nav.changeScreen = function(screenType,func=function(){}){
  if(screenType == Nav.screenType.map){
    $("#screen-parent").animate({"margin-left":"0%"},1000,func);
    //$("#screen-parent").css("margin-left","0%");func();
  }else if(screenType == Nav.screenType.route){
    $("#screen-parent").animate({"margin-left":"-100%"},1000,func);
    //$("#screen-parent").css("margin-left","-100%");func();
  }
}

Nav.clearNav = function(){
  if(Nav.currentNav!=null)$(Nav.currentNav).hide();
  Nav.currentNav = null;
}

Nav.openStationNav = function(height){
  Nav.openedNav = false;
  Nav.stationInfoNav.stop().animate({bottom:'0px',"height":height},600,"easeInOutCubic",function(){Nav.openedNav=true;});
}

Nav.openStationRough = function(){
  nowNavState = "rough";
  Nav.changeNav("#station-rough");
  Nav.openStationNav("250px");
}

Nav.openStationDetails = function(){
  nowNavState = "details";
  Nav.changeNav("#station-details");
  Nav.openStationNav("100%");
}

Nav.openStationList = function(){
  nowNavState = "list";
  Nav.changeNav("#station-list");
  Nav.openStationNav("40%");
}

Nav.openStationFavorites = function(){
  nowNavState = "favorite";
  Nav.setFavoriteList();
  Nav.changeNav("#favorite-list");
  Nav.openStationNav("80%");
}

Nav.openStationHistory = function(){
  nowNavState ="history";
  Nav.setHistoryList();
  Nav.changeNav("#history-list");
  Nav.openStationNav("80%");
}

Nav.openDirections = function(){
  Nav.changeNav("#directions");
  Nav.stationInfoNav.stop().animate({bottom:'0px',"height":"50%"},600,"easeInOutCubic");
}

Nav.closeStationNav = function(){
  Nav.openedNav = false;
  Nav.changeNav("#close-tab");
  Nav.openStationNav("125px");
}

Nav.openStaitonInfo_listSelect = function(id){
  Nav.setStationData(Station.dataArray[id]);
  Nav.openStationDetails();
  $("#station-details .header").attr("onclick","babymap.nav.openStationList()");
}
Nav.openStaitonInfo_listFavoriteSelect = function(id){
  Nav.setStationData(Station.dataArray[id]);
  Nav.openStationDetails();
  $("#station-details .header").attr("onclick","babymap.nav.openStationFavorites()");
}

let categoryIconText = "/cakephp/img/icon/";

Nav.setStationRough = function(val,env){
  var stationRough = Nav.stationInfoNav.children("#station-rough");
  stationRough.find(".name").text(val.name);
  stationRough.find(".address").text(val.address);
  var categories = stationRough.find(".categories");
  categories.text("");
  var categoriesText = "";
  $.each(val.station_category, function(index, val) {
    categoriesText+= '<img src="'+categoryIconText+val.category_id+'.png" alt="" class="baby-icon'+(val.sex?' woman':'')+'"/>';
  });
  categories.html(categoriesText);
}

Nav.setStationDetails = function(station,env){
  $("#station-details .header").attr("onclick","babymap.nav.openStationRough()");
  var stationDetails = Nav.stationInfoNav.children("#station-details");
  stationDetails.children(".favorite").removeClass("active");
  if(Favorite.isFavorite(station))stationDetails.children(".favorite").addClass("active");
  stationDetails.find(".name").text(station.name);
  stationDetails.find(".address").text(station.address);
  //stationDetails.find(".comment span.content").html(station.comment.replace(/\r?\n/g, '<br />'));
  var comments = (station.comment+"").split('\n');
  var commentVal = "";
  comments.forEach(function(value){
    commentVal += "<div class='category-comments'>";
    ar = (value+"").split("：");
    commentVal += "<div class='category-label'>";
    (ar[0]+"").split("・").forEach(function(category){
      commentVal += "<span class='category-label-item'>" + category + "</span>";
    });
    commentVal += "</div><div class='comment-group'>";
    (ar[1]+"").split("　").forEach(function(comment){
      commentVal += "<div class='category-comment'>" + comment + "</div>";
    });
    commentVal += "</div></div>";
  });
  stationDetails.find(".comment .content").html(commentVal);

  var facilities = stationDetails.find(".facilities");
  facilities.text("");
  $.each(station.facility, function(index, val) {
    item = '<div class="item">'
  +(val.name==null?"":'<div class="item-name">'+val.name+'</div>')
  +(val.holiday==null?"":'<div class="item-holiday"><span class="label">休日</span>'+val.holiday+'</div>')
  +(val.time==null?"":'<div class="item-time"><span class="label">営業時間</span>'+val.time+'</div>')
  +'<table class="categories">';
  $.each(val.facility_category, function(index, val) {
    item+= '<tr class="help"><td><img src="'+categoryIconText+val.category_id+'.png" alt="" class="baby-icon'+(val.sex?' woman':'')+'"/></td><td>'
    +val.category.name + (val.sex?' :女性のみ':' ')
    +'</td></tr>';
  });
  item += '</div></table>' + (station.facility.size==index+1)?"":"<hr>";
  facilities.append(item);
  });
}

Nav.setStationList = function(list){
  var stationList = Nav.stationInfoNav.children("#station-list");
  var stations = stationList.find(".stations");
  stations.text("");
  $.each(list, function(index, val) {
    var item = '<div class="item" onclick="babymap.nav.openStaitonInfo_listSelect('+val.id+')">\
            <div class="item-name">◆'+val.name+'</div>\
            <div class="item-address">'+val.address+'</div>\
            <div class="categories">';
    $.each(val.station_category,function(index,val){
      item+= '<img src="'+categoryIconText+val.category_id+'.png" alt="" class="baby-icon'+(val.sex?' woman':'')+'"/>';
    });
    item += '</div>';
    stations.append(item);
  });
}
Nav.setFavoriteList = function(){
  var list = Favorite.list();
  var stationList = Nav.stationInfoNav.children("#favorite-list");
  var stations = stationList.find(".stations");
  stations.text("");
  $.each(list, function(index, val) {
    Station.pushData(val);
    var item = '<div class="item" onclick="babymap.nav.openStaitonInfo_listFavoriteSelect('+val.id+')">\
            <div class="item-name">◆'+val.name+'</div>\
            <div class="item-address">'+val.address+'</div>\
            <div class="categories">';
    $.each(val.station_category,function(index,val){
      item+= '<img src="'+categoryIconText+val.category_id+'.png" alt="" class="baby-icon'+(val.sex?' woman':'')+'"/>';
    });
    item += '</div>';
    stations.append(item);
  });
}
Nav.setHistoryList = function(){
  var list = History.list();
  var historyList = Nav.stationInfoNav.children("#history-list");
  var histories = historyList.find(".items .contents");
  histories.text("");
  $.each(list,function(index,val){
    var item = '<div class = "item" onclick="babymap.map.setPlace('
        +'{name:\''+val.name+'\',icon:\''+val.icon+'\',lat:'+val.lat+',lng:\''+val.lng+'\'});babymap.nav.closeStationNav();">' + val.name + '</div>';
        histories.append(item);
  })
}
Nav.addStationList = function(val){
  var stationList = Nav.stationInfoNav.children("#station-list");
  var stations = Nav.stationInfoNav.find(".stations");
  $.each(val, function(index, val) {
    item = '<div class="item" onclick="babymap.nav.openStaitonInfo_listSelect('+val.id+')">\
            <div class="item-name">◆'+val.name+'</div>\
            <div class="item-address">'+val.address+'</div>\
            <div class="categories">';
    $.each(val.station_category,function(index,val){
      item+= '<img src="'+categoryIconText+val.category_id+'.png" alt="" class="baby-icon'+(val.sex?' woman':'')+'"/>';
    });
    item += '</div>';
    stations.append(item);
  });
}
Nav.mapMoreData = function(){
  Nav.nowpage++;
  Station.mapReload(Nav.nowpage);
}
Nav.moreData = function(){
  Nav.mapMoreData();
  $(".moreData").hide();
  $(".nowLoad").show();
}
let stackState;
Nav.openRoute = function(){
  if(Nav.nowStation==null)return;
  //console.log(document.activeElement);
  console.log("---- touch route");
  console.log(Nav.nowStation);
  srcDefaultPoint = Station.nowLoc;
  destDefaultPoint = {lat:Nav.nowStation.lat,lng:Nav.nowStation.lng};
  console.log("--- route - src");
  console.log(srcDefaultPoint);
  console.log("--- route - dest");
  console.log(destDefaultPoint);
  Nav.displaySrcAddress = $("#pac-input").val();
  Nav.displayDestAddress = Nav.nowStation.name;
  $("#pac-input-src").val(Nav.displaySrcAddress);
  $("#pac-input-dest").val(Nav.displayDestAddress);
  Nav.openedNav=false;
  //Nav.closeStationNav();
  Nav.openDirections();
  Nav.changeScreen(Nav.screenType.route,function()
  {
    Map.hideNormalMarker();
    Map.calcRoute(srcDefaultPoint,destDefaultPoint);
    stackState = nowNavState;
    Nav.closeTab.text(": 経路案内");
    Nav.closeTab.attr("onclick","babymap.nav.openDirections()");
  });
}
Nav.closeRouteAccess = function(){
  switch(stackState){
      case "details":
      Nav.openStationDetails();
      break;
      case "rough":
      Nav.openStationRough();
      break;
      case "favorite":
      Nav.openStationFavorites();
      break;
    }
  Nav.changeScreen(Nav.screenType.map,function(){
    Map.showNormalMarker();
    Nav.openedNav = true;
    Map.clearRoute();
    Nav.closeTab.text("リスト表示:");
    Nav.closeTab.attr("onclick","babymap.nav.openStationList()");
  });
}
Nav.openGps = function(){
  Station.nowLoc = Nav.gpsLocation;
  Station.mapReload(1,Nav.gpsLocation,false);
  $("#pac-input").val("現在地");
}
function initSuccessCallback(position){
  var lat = position.coords.latitude;
  var lng = position.coords.longitude;
  var pos = {"lat":lat,"lng":lng};

  //window.alert("lat lng" + lat + " ," + lng);
  Nav.gpsLocation = pos;
  Station.nowLoc = Nav.gpsLocation;
  Station.mapReload(1,Nav.gpsLocation,false);
  $("#pac-input").val("現在地");
  $("#nav-gps").css("display","");
}
function errorCallback(error){
  //window.alert("lat lng : 位置情報取得失敗");
}
openUrl = function(url){
  window.open(url, '_blank');
}
}