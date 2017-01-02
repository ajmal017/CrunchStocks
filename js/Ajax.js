(function(){
	var $=Ajax=function(cb,url){
		var _=this,a=arguments,k=2;
		_.$=new XMLHttpRequest;
		_.url=url+'.php?';
		'object'==typeof a[2] && k++ && params.call(_,a[2]);
		if(a.length>k) _.mod = modifier.call(_,Array.prototype.slice.call(a,k));
		_.limit=0;
		_.$.addEventListener("load", _.finished=function(){cb(_.$.response)});
	},
	
	params=function(o){var k,m;for(k in o)m='$'==k[0],this[m?'post':'get']+=k.substr(m)+'='+o[k]+'&'},
	
	modifier=function(u){for(var _=this,s=u[0][0]=='$',m=s?'post':'get',i=1,l=u.length,j=(_[m]+=u[0].substr(s)+"=");i<l;i++)if(u[i][0]=='$'!=s)break;if(i==l)return i==1?function(a){_[m]=j+a;return _}:function(){for(var a=arguments,q=a[0]+'&',b=1,l=a.length;b<l;b++)q+=u[b].substr(s)+'='+a[b]+'&';_[m]=j+q;return _};var n=s?'get':'post',k=(_[n]+=u[i].substr(!s)+'=');return i==2?function(a,b){_[m]=j+a;_[n]=k+b;return _}:function(){var a=arguments,d;_[m]=j+a[0]+'&';delete a[0];_[n]=k+a[i]+'&';delete a[i];for(var b in a)d=u[b][0]=='$',_[d==s?m:n]+=u[b].substr(d)+'='+a[b]+'&';return _}},
	
	J=function(s,r){try{return JSON[r?"stringify":"parse"](s)}catch(e){return s}},
	
	L=console.log.bind(console);

$.prototype={
	get: "",
	post: "",
	head: {"Content-type":"application/x-www-form-urlencoded"},
	go: function(){
		var _=this,x=_.$,a;
		x.open('POST',_.url+_.get,true);
		for(var h in _.head)x.setRequestHeader(h,_.head[h]);
		x.timeout=_.limit;
		x.send(_.post);
	},
	fetch: function(){
		var _=this,
			c=_.cdata,
			k=_.ckey=_.ckeyer(Array.prototype.slice.call(arguments));
		Object.prototype.hasOwnProperty.call(c,k)?_.fin(c[k]):_.go.apply(_,arguments);
	}
	onfail: function(f){
		var _=this,x=_._;
		x.addEventListener("abort",f);
		x.addEventListener("error",f);
		x.addEventListener("timeout",f);
	},
	increment: function(f){
		var _=this,x=_._,r,l;
		_.addEventListener("readystatechange",function(){
			if(3==x.readyState) r=x.responseText,f(r.substr(l)),l=r.length;
		});
	},
	interval: function(seconds, delay){
		var _=this,
			i=setInterval(delay ? function(){setTimeout(_.go, delay*1000)} : _.go, seconds*1000);
		_.stop=function(){clearInterval(i)}
	},
	cache: function(k){
		var _=this,x=_._;
		_.cdata={};
		_.ckeyer= k||function(a){return a.join("+")};
		x.addEventListener("load",function(){_.ckey&&(_.cdata[_.ckey]=x.response)});
	},
	tabs: function(){},
	encrypted: function(){},
	onhead: function(h,f){
		var _=this,
			x=_._;
		_.addEventListener("readystatechange",function(){ 2==x.readyState&&f(x.getResponseHeader(h)) });
	},
	form: function(x){
		this.head["Content-type"]="multipart/form-data";
		this[1]=f;
		this.go();
	}
};
$.doc=function(){
	var t=this,x=t.$;
	x.abort();
	x.open('POST',t.G,true);
	for(var h in t.H) x.setRequestHeader(h,t.H[h]);
	x.send(t.P);
	return x
}

$.json=function(){
	var t=this,x=t.$;x.abort();x.open('POST',t.G,true);for(var h in t.H)x.setRequestHeader(h,t.H[h]);x.send(t.P);return x
}

$.fill=function(q,x){
	//for(var t=document.querySelectorAll(q),i=0,l=t.length;i<l;t++)
}

//write in the form http:/ /api.url.com/?param=get&get=param&callback=
$.external=function(c,u,p,f){
	var g='?',p=p||{},f=f||'callback',d=document,s=d.createElement("script"),k;
	p[f]="Ajax.jsonp";
	for(k in p)g+=k+"="+p[k]+"&";
	s.src=encodeURI(u+g);
	s.onload=function(){d.body.removeChild(s)}
	Ajax.jsonp=typeof c=='function'?c:function(d){console.log(d)};
	d.body.appendChild(s);
}
})();