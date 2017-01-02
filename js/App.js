var App= new(function(){
	this.sess={
		set: function(k,v,x){
			document.cookie= k+"="+encodeURIComponent(v)+"; max-age="+x;
		},
		get: function(k){
			for(var a=document.cookie.split(';'),l=k.length+1,g=k+'=',b=a.length,i=0; i<b; i++) if(a[i].substr(1,l)==g) break;
			return a[i]?a[i].substr(l+1):''	
		}
	
	
	
	});
});