{
	let Favorite = define_namespace('babymap.favorite');
	let Storage = import_namespace('babymap.storage');
	let data = Storage.load("favorite");
	Favorite.addFavorite = function(station){
		data[station.id] = station;
		Storage.save("favorite");
	}

	Favorite.removeFavorite = function(station){
		delete data[station.id];
		Storage.save("favorite");
	}
	
	Favorite.isFavorite = function(station){
		return data.hasOwnProperty(station.id);
	}
	Favorite.list = function(){
		return data;
	}
}