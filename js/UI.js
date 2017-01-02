(function(){
var D=document,_=UI={
	js: function(r, k, p){
		var s,p=p||D.body;
		if(k) if(_.scripts.indexOf(k)+1) return; else _.scripts.push(k);
		s=D.createElement('script');
		s.type='text/javascript';
		s.src=r+".js";
		s.onload=s.onerror=function(){p.removeChild(this)};
		p.appendChild(s)
	},
	css: function(r, k){
		if(k) if(_.styles.indexOf(k)+1) return; else _.styles.push(k);
		var s=D.createElement('link');
		s.rel='stylesheet';
		s.type='text/css';
		s.href=r+".css";
		D.body.appendChild(s)	
	},
	scripts : [],
	styles : []
};
})();