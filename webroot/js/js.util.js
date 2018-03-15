let namespace_defined = [];
let define_namespace_ = function ( path ){
    var paths = path.split('.');
    var _global = this;//window or global
    paths.reduce( function(prev,curr) {
      if ( !prev.hasOwnProperty(curr) ) {
        prev[curr] = {};
      }
      curr = prev[curr];
      return curr ;
    }, _global )
}
function define_namespace(path){
  if (namespace_defined.indexOf(path) >= 0){
    console.log("error - 定義済みの名前空間");
  }else{
    define_namespace_(path);
    namespace_defined.push(path);
  }
  var paths = path.split('.');
  var _global = this;//window or global
  var current;
  paths.reduce( function(prev,curr) {
      if ( !prev.hasOwnProperty(curr) ) {
        prev[curr] = {};
      }
      curr = prev[curr];
      current = curr;
      return curr ;
    }, _global );

  return current;
}
function import_namespace(path){
  define_namespace_(path);
  var paths = path.split('.');
  var _global = this;//window or global
  var current;
  paths.reduce( function(prev,curr) {
      if ( !prev.hasOwnProperty(curr) ) {
        prev[curr] = {};
      }
      curr = prev[curr];
      current = curr;
      return curr ;
    }, _global );

  return current;
}