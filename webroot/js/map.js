{
let Map = define_namespace('babymap.map');
let Station = import_namespace('babymap.station');
let Nav = import_namespace('babymap.nav');
let History = import_namespace("babymap.history");

let elementName = 'map';
let directionsDisplay;
let directionsService;
let transitLayer;
let mapStackState;
let standardMarkerIcon;
let directionsIcons;

Map.currentMapRouteSrcLatLng;
Map.currentMapRouteDestLatLng;

Map.currentMapRouteSrcLatLngMarker;
Map.currentMapRouteDestLatLngMarker;

initMap = function() {
  Map.map = new google.maps.Map(document.getElementById(elementName), {
	  zoom: 15,
	  zoomControl: false,
	  mapTypeControl: false,
	  scaleControl: true,
	  streetViewControl: false,
	  rotateControl: true,
	  fullscreenControl: false,
	  center:Station.nowLoc
  });
  standardMarkerIcon= {
    url:"https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi_hdpi.png",
    scaledSize: new google.maps.Size(44,80)
  }
  directionsIcons = {
        start: {
          // URL
          url:'https://mts.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-a.png&text=A&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=4',
          // (width,height)
          scaledSize:new google.maps.Size(44, 80)
        },
        end:{
          // URL
          url:'https://mts.googleapis.com/maps/vt/icon/name=icons/spotlight/spotlight-waypoint-b.png&text=B&psize=16&font=fonts/Roboto-Regular.ttf&color=ff333333&ax=44&ay=48&scale=4',
          // (width,height)
          scaledSize:new google.maps.Size(44, 80)
        }
    };
  //window.alert(document.getElementById("pac-input"));
  Map.initAutocomplete(document.getElementById("pac-input"),function(place){
        Station.nowLoc = {lat:place.geometry.location.lat(),lng:place.geometry.location.lng()};
        Station.mapReload(1,Station.nowLoc);
        console.log(place);
        History.add({name:place.name,icon:place.icon,lat:place.geometry.location.lat(),lng:place.geometry.location.lng()});
        //History.add(place);
      },true,true);
  Map.initAutocomplete(document.getElementById("pac-input-src"),function(place){
    Map.currentMapRouteSrcLatLng = {lat:place.geometry.location.lat(),lng:place.geometry.location.lng()};
    Map.calcCurrentRoute();
  });
  Map.initAutocomplete(document.getElementById("pac-input-dest"),function(place){
    Map.currentMapRouteDestLatLng = {lat:place.geometry.location.lat(),lng:place.geometry.location.lng()};
    Map.calcCurrentRoute();
  });

  directionsService  = new google.maps.DirectionsService();
  transitLayer = new google.maps.TransitLayer();
  transitLayer.setMap(Map.map);
  Map.bounds = new google.maps.LatLngBounds();
  //reloadPoint();
  //map.fitBounds(bounds);
  directionsDisplay=new google.maps.DirectionsRenderer({
      "map": Map.map,
      "preserveViewport": true,
      "draggable": false,
      "suppressMarkers":true
  });
  directionsDisplay.setPanel(document.getElementById("directions_panel"));
  google.maps.event.addListener(directionsDisplay, 'directions_changed',function() {
      currentDirections=directionsDisplay.getDirections();
      var route=currentDirections.routes[0];
      var s="";
      for(var i=0; i<route.legs.length; i++) {
          var routeSegment=i+1;
          s+=route.legs[i].start_address+'to';
          s+=route.legs[i].end_address+'\n';
          s+=route.legs[i].distance.text;
      }
      console.log("directions_changed:"+s);
      //Nav.openDirections();
  });
}
Map.hideNormalMarker = function(){
  $.each(Map.markerArray, function(index, val) {
    val.setMap(null);
  });
  mapStackState = {center:Map.map.getCenter(),zoom:Map.map.getZoom()};
}
Map.showNormalMarker = function(){
  $.each(Map.markerArray, function(index, val) {
    val.setMap(Map.map);
  });
  Map.hideRouteMarker();
  Map.map.setCenter(mapStackState.center);
  Map.map.setZoom(mapStackState.zoom);
}
Map.hideRouteMarker = function(){
  if(Map.currentMapRouteSrcLatLngMarker!=null)Map.currentMapRouteSrcLatLngMarker.setMap(null);
  if(Map.currentMapRouteSrcLatLngMarker!=null)Map.currentMapRouteDestLatLngMarker.setMap(null);
}

Map.reloadPoint = function(pointArray,loc = Station.nowLoc){
  Map.bounds = new google.maps.LatLngBounds();
  var mArray = [];
    $.each( pointArray, function( key, val ) {
      let marker = new google.maps.Marker({
        position: new google.maps.LatLng(val.lat,val.lng),
        title:val.name,
        icon:standardMarkerIcon
        // map: map
      });

      marker.addListener('click', function() {
        Nav.openMarkerData(marker,val.id);
      });
      mArray.push(marker);
      Station.pushData(val);
    });
    $.each(Map.markerArray,function(key,val){
      val.setMap(null);
    });
    Map.markerArray = mArray.slice();

    $.each(Map.markerArray,function(key,val){
      val.setMap(Map.map);
      Map.bounds.extend(val.position);
    });
    Map.bounds.extend(new google.maps.LatLng(loc.lat,loc.lng));
    
    Map.map.fitBounds(Map.bounds);
}

Map.morePoint = function(addPointArray){
  $.each( addPointArray, function( key, val ) {

    let marker = new google.maps.Marker({
      position: new google.maps.LatLng(val.lat,val.lng),
      title:val.name,
      // map: map
      icon:standardMarkerIcon
    });
    marker.setMap(Map.map);
    marker.addListener('click', function() {
      Nav.openMarkerData(marker,val.id);
    });
    Map.markerArray.push(marker);
    Station.pushData(val);
  });
}
Map.calcCurrentRoute = function(travelMode = $("input[name='travelMode']:checked").val()){
  Map.calcRoute(Map.currentMapRouteSrcLatLng,Map.currentMapRouteDestLatLng,travelMode);
}
Map.calcRoute = function(start,end,travelMode=$("input[name='travelMode']:checked").val()){
  // var start = new google.maps.LatLng(pointArray[0]['lat'],pointArray[0]['lng']);
  // var end = new google.maps.LatLng(pointArray[1]['lat'],pointArray[1]['lng']);
  Map.currentMapRouteSrcLatLng = start;
  Map.currentMapRouteDestLatLng = end;
  var request = {
    origin: start,
    destination: end,
    travelMode: travelMode
  };
  
  if(Map.currentMapRouteSrcLatLngMarker!=null){
    Map.currentMapRouteSrcLatLngMarker.setMap(null);
    Map.currentMapRouteSrcLatLngMarker = null;
  }
  Map.currentMapRouteSrcLatLngMarker = new google.maps.Marker({
    position: start,
    map:Map.map,
    icon:directionsIcons.start
  });

  if(Map.currentMapRouteDestLatLngMarker!=null){
    Map.currentMapRouteDestLatLngMarker.setMap(null);
    Map.currentMapRouteDestLatLngMarker = null;
  }
  Map.currentMapRouteDestLatLngMarker = new google.maps.Marker({
    position: end,
    map:Map.map,
    icon:directionsIcons.end
  });

  directionsService.route(request, function(result, status) {
    if (status == 'OK') {
      directionsDisplay.setDirections(result);
    }
  });
  directionsDisplay.setMap(Map.map);
}
Map.clearRoute = function(){
  directionsDisplay.setMap(null);
}

//住所検索用オートコンプリート
Map.initAutocomplete = function(input,func,isBoundsExtend=false,isViewIcon=false) {
  var searchBox = new google.maps.places.SearchBox(input);
  // Bias the SearchBox results towards current map's viewport.
  Map.map.addListener('bounds_changed', function() {
  	searchBox.setBounds(Map.map.getBounds());
  });

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // For each place, get the icon, name and location.
    //var bounds = new google.maps.LatLngBounds();
    var place = places[0];
    //places.forEach(function(place)
    touchPlace(place,func,isBoundsExtend,isViewIcon);
  });
}
let markers = [];
function touchPlace(place,func,isBoundsExtend=false,isViewIcon=false){
    // Clear out the old markers.
  markers.forEach(function(marker) {
    marker.setMap(null);
  });
    if (!place.geometry) {
      console.log("Returned place contains no geometry");
      return;
    }
    if(isViewIcon){
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: Map.map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));
    }

    if(func!=null)func(place);
    //console.log(place.geometry.location.toString());
    if(isBoundsExtend){
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        Map.bounds.union(place.geometry.viewport);
      } else {
        Map.bounds.extend(place.geometry.location);
      }
    }
  }

  Map.setPlace = function(place){
    Station.nowLoc = {lat:place.lat,lng:place.lng};
    markers.forEach(function(marker) {
      marker.setMap(null);
    });

    var icon = {
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(25, 25)
    };

    markers.push(new google.maps.Marker({
      map: Map.map,
      icon: icon,
      title: place.name,
      position: Station.nowLoc
    }));
    Station.mapReload(1,Station.nowLoc);
    $("#pac-input").val(place.name);
  }
}