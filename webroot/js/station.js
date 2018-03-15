{
let Station = define_namespace('babymap.station');
let Map = import_namespace('babymap.map');
let Nav = import_namespace('babymap.nav');

let def = {'lat':34.76292,'lng':137.381921};
Station.nowLoc = def;
Station.dataArray={};
Station.nowLoad = false;

$(function(){
	$(document).ready(function(){Station.mapReload();});
	$('.category').change(function(){Station.mapReload();});
  
});
Station.mapReload = function(page=1,location = Station.nowLoc,listOpen = true){
  Station.nowLoad = true;
	var url = "/cakephp/station/listCategoryCloseOrder";
	var category = [];
    var categoryArray = $('.category:checked').map(function() {
      return $(this).val();
    });
    categoryArray.each(function(index,val){
      category.push(val);
    });
    //url = url+location+category+page;
    if(page == 1)Nav.nowpage = 1;
    $("p#deb").text(url);
    var sendData = {page:page,category:category,lat:location.lat,lng:location.lng};
    $.getJSON(url,sendData,function(data) {
      Station.nowLoad = false;
      console.log("---- communicate log: page:"+sendData.page);
      console.log(sendData);
      console.log(data);
      if(page == 1){
        Map.reloadPoint(data,location);
        Nav.setStationList(data);
        if(Nav.firstload){
          Nav.firstload = false;
        }else{
          if(listOpen)Nav.openStationList();
        }
      }else{
        $(".moreData").show();
        $(".nowLoad").hide();
        Map.morePoint(data);
        Nav.addStationList(data);
      }
    });
}
Station.pushData = function(station){
	Station.dataArray[station.id] = station;
}
}