(function(){
var D=document,dir="app/widgets/",$=Widget=function(t,h){
	var _=this,n=t.name,C=function(p, o){
	
		var j,x=[],a={},
		l=function(p,o){
			for(j in o)p.appendChild((typeof o[j]=='object'?r:function(t){var n=D.createTextNode(t);if(!t) x.push(n);return n})(o[j]));
			return p
		},
		r=function(o){
			var t,e,i;for(var t in o)break;e=D.createElement(t);for(i in o[t])o[t][i]?e.setAttribute(i,o[t][i]):(a.hasOwnProperty(i)?a[i].push(e):(a[i]=[e]));o._&&(Array.isArray(o._)?l:m)(e,o._);return e
		},
		m=function(p, c){
			console.log('Multiply this group');
			for(var k in c){
				var f= new DocumentFragment,
					b={attr:{},text:[]};
				_.sub[k]=Object.assign({parent:p},C(f,c[k]));
			}
			//console.log(r[1]);
		//}
		};
		return {html: l(p,o), attr:a, text:x}
		
	};
	
	_.sub={};
	
	new Ajax(function(r){
		var o=JSON.parse(r), c=o.css||{}, j=o.js||{}, i;
		Object.assign(_, C(new DocumentFragment, o.html));
		//_.html = C(new DocumentFragment, o.html);
		for(i in c) UI.css(dir+n+"/"+i, c[i]);
		for(i in j) UI.js(dir+n+"/"+i, j[i]);
		$.lib[n]=_;
		$.build(t,h);
	}, dir+n+"/config.json").go();

},A=function(r,g){var a,e,l,i,k=0,_=this;for(a in r)for(e=r[a],l=e.length,i=0;i<l;i++)e[i].setAttribute(a,g[k++])},T=function(t,g){var l=t.length,i=0;while(i<l)t[i].nodeValue=g[i++]},
S=function(m){
	var j,k;
	for(j in m)	for(k in m[j]) this.setSub(j, m[j][k]);
};

$.lib={};

$.build=function(o, target){
	var n=o.name;
	if(!$.lib.hasOwnProperty(n)) return new $(o, target);
	UI.js(dir+n+'/init', 0, $.lib[n].set(o).onto(target));
};

$.prototype.setSub=function(k, o){
	var _=this, s=_.sub[k];
	s.parent.appendChild(_.set.call(s, o).html.cloneNode(!0));
}

$.prototype.set=function(o){
	var w=this;
	o.attr&&A(w.attr,o.attr);
	o.text&&T(w.text,o.text);
	o.sub&&S.call(w, o.sub);
	return w
}

$.load=function(name, proto, target){
	new Ajax(function(r){
		var j=JSON.parse(r);
		Widget.build({
			name : name,
			attr : j.attr,
			text : j.text,
			//tags : {btns : 'input[type=radio]'}
			//data : j.data
			sub : {
				a : [
					{attr:['AMEX'],text:['AMEX']},
					{attr:['NASDAQ'],text:['NASDAQ']},
					{attr:['NYSE'],text:['NYSE']}
				]
			},
			data : ['AMEX', 'NASDAQ', 'NYSE']

		}, target);
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
	var q=D.querySelector(target||'body');
	q.appendChild(this.html.cloneNode(!0));
	return q
}

$.prototype.map=function(){
	return [].reduce.call(arguments,function(e,i){return e.childNodes[i]}, this.html);
}

$.init=function(obj){
	var top = document.currentScript.parentElement;
	//console.log(obj); //obj.func.next()
	//{'q', click: function(){}}
	if(obj.evt) for(var e in obj.evt){
		var q = top.querySelectorAll(e),
			v = obj.evt[e],
			k;
		for(k in v) for(var i=0, l=q.length; i<l; i++) q[i].addEventListener(k, v[k]);
	
	}
}
})();