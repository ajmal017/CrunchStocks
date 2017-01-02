//Acts as a JavaScript compatibility patch to fill in non-standard prototypes or methods.
(function(){
	var C={
		Array:{
			forEach:function(f,t){for(var i=0;i<this.length;i++)f.call(t||null,this[i])}
		},
		NodeList:{
			forEach:function(f,t){Array.prototype.forEach.call(t||this,f)}	
		},
		Object:{
			assign:function(C,d){for(var a=1,b;a<arguments.length,b=arguments[a];a++)for(var c in b)C[c]=b[c];return C},
			copy:function(o){return Object.assign(new o.constructor(),o)},
			empty:function(o){for(var k in x)if(x.hasOwnProperty(k))return 1},
			values:function(o){var v=[];for(var k in o)v.push(o[k]);return v}
		}
	};
	
	for(var c in C)for(var p in C[c])window[c][p]===undefined&&(window[c][p]=C[c][p]);
})();