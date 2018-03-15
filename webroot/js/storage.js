{
let Storage = define_namespace('babymap.storage');
let id = "babymap.";
let data = {};
Storage.load = function(key,default_ar={}){
	data[key] = JSON.parse(localStorage.getItem(id+key));
	if(data[key]==null)data[key]=default_ar;
	return data[key];
}
Storage.save_all = function(){
	for(let key in data){
		_save(key,data[key]);
	}
}
Storage.save = function(key){
	_save(key,data[key]);
}
function _save(key,val){
	localStorage.setItem(id+key,JSON.stringify(val));
}

}