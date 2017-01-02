(function(){
var D=document,
	F=function(){return D.createDocumentFragment()},
	_=Tree=function(struct, text, attr, name){
		var e,n,g,u,i=-1,t,
			attr=attr||{},
			text=text||{},
			stack=struct.match(/\w+|>|<|\)|\(|'/g),
			x=0,
			build=function (par){
				var mult=1;
				while(e=stack[x++]) if(e>1) mult=e; else switch(e){
					case "'": par.lastChild.appendChild(D.createTextNode(text.shift())); continue;
					case ">": par=par.lastChild; continue;
					case "<": par=par.parentNode; continue;
					case "(": g=build(F()); while(mult--) par.appendChild(g.cloneNode(true)); mult=1; continue;
					case ")": while(u=par.parentNode)par=u; return par;
					default: for(n=0,t=_.tag(e,attr[++i]||{}); n<mult; n++) par.appendChild(t.cloneNode());  mult=1;
				}
			}
		build(this.$=F());
	},
	P=_.prototype;

_.tag=function(t,a){
	var e=D.createElement(t),
		b;
	for(b in a) e.setAttribute(b,a[b]);
	return e
};

_.text=function(t){
	return D.createTextNode(t)
}

P.events={};

P.put=function(p){
	(p||D.body).appendChild(this.$.cloneNode(true))
};

//{}

P.map={};

P.name=function(o){
	var i,t=this;
	for(i in o) Object.defineProperty(t.map, i, {configurable: true, get: function(){return t.$.querySelectorAll(o[i])}});
}

P.find=function(){
	var e=this,a=arguments,l=a.length,i;
	for(i=0; i<l; i++) e=e.childNodes(a[i]);
	return e
};

P.slice=function(k,i,n){var t=this; t.map[k]=Array.prototype.slice.call(t.map[k],i,n)}


})();