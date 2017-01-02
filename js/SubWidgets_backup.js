(function(){
var D=document,dir="app/widgets/",$=Widget=function(t,h){
	var _=this,n=t.name,subFrag=function(n,p,i){console.log(i);_.parents[n]?_.parents[n].push({[i]:p}):(_.parents[n]=[{[i]:p}])},C=function(p, o){
		var j,x=0,s=o.length;
		for(j in o){
			if(typeof o[j]=='number') subFrag(o[j], p, p.childNodes.length+x++);
			else p.appendChild((typeof o[j]=='object'?R:function(t){var n=D.createTextNode(t);if(!t) _.text.push(n);return n})(o[j]));
		}
		return p
	
	},R=function(o){var t,e,a;for(var t in o)break;e=D.createElement(t);for(var a in o[t])o[t][a]?e.setAttribute(a,o[t][a]):(_.attr.hasOwnProperty(a)?_.attr[a].push(e):(_.attr[a]=[e]));o._&&C(e,o._);return e};
	
	_.attr={};
	_.text=[];
	_.html=[];
	_.sizes={};
	_.parents={};
	
	new Ajax(function(r){
		var o=JSON.parse(r), c=o.css||{}, j=o.js||{}, i=0;
		while(o.html[i]) _.html[i] = C(new DocumentFragment, o.html[i++]);
		for(i in c) UI.css(dir+n+"/"+i, c[i]);
		for(i in j) UI.js(dir+n+"/"+i, j[i]);
		$.lib[n]=_;
		$.build(t,h);
	}, dir+n+"/config.json").go();

},A=function(g){var a,e,l,i,k=0,_=this;for(a in _.attr)for(e=_.attr[a],l=e.length,i=0;i<l;i++)e[i].setAttribute(a,g[k++])},T=function(g){var _=this,l=_.text.length,i=0;while(i<l)_.text[i].nodeValue=g[i++]};

$.lib={};

$.build=function(o, target){
	var n=o.name, w;
	if(!$.lib.hasOwnProperty(n)) return new $(o, target);
	w=$.lib[n];
	o.attr&&A.call(w,o.attr);
	o.text&&T.call(w,o.text);
	for(var i in w.parents)for(var y in w.parents[i])for(var z in w.parents[i][y]) w.parents[i][y][z].insertBefore(w.html[i].cloneNode(!0),w.parents[i][y][z].childNodes[z]);
	w.onto(target);
	UI.js(dir+n+'/init');
};

$.load=function(name, proto, target){
	new Ajax(function(r){
		var j=JSON.parse(r);
		Widget.build({
			name : name,
			attr : j.attr,
			text : j.text
		}, target || 'body');
	}, dir+name+"/proto/"+proto+".json").go();
}

$.cutColl=function(coll, a, b){
	return [].slice.call(coll, --a, b)
}

$.filterColl=function(coll, x){
	return coll.filter(typeof x=='object'? function(e,k){return x.indexOf(k+1)==-1} : x);
}

//rel : { -1 = before ref, 0 or blank = as child of ref, 1 = after ref)
$.moveNode=function(node, ref, rel){
	if(!rel) ref.appendChild(node);
	else ref.parentNode.insertBefore(node, rel>0 ? ref.nextSibling : ref);
}

$.prototype.onto=function(target){
	D.querySelector(target).appendChild(this.html[0].cloneNode(!0));
}

$.prototype.map=function(){
	return [].reduce.call(arguments,function(e,i){return e.childNodes[i]}, this.html);
}
})();