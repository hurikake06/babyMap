{
	let History = define_namespace("babymap.history");
	let Storage = import_namespace("babymap.storage");
	let data = Storage.load("history",[]);
	let size = 30;
	History.add = function(temp){
		if(size < data.unshift(temp))data.pop();
		Storage.save("history");
	}
	History.list = function(){
		return data;
	}
}