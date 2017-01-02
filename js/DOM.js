Element.prototype.jsonElements=function(O){var r={},N,C,m;Object.keys(O).filter(function(k){return k===k.toUpperCase()||!(r[k]=O[k])}).forEach(function(e){m=e.indexOf('_')+1;if(!m){N=document.createElement(e);for(var a in r)N.setAttribute(a,r[a])}O[e].forEach(m?function(c,d){C=document.createElement(e.substring(m));typeof c==='string'?C.innerHTML=c:C.jsonElements(c);for(var a in r)C.setAttribute(a,Array.isArray(r[a])?r[a][d]:r[a]);this.appendChild(C)}:function(c){typeof c==='string'?N.innerHTML+=c:N.jsonElements(c)},this);if(!m)this.appendChild(N)},this)};

Element.prototype.hoverImg=function(h){var o=this.src,r=o.substring(0,o.lastIndexOf('/')+1)+h;if(h.lastIndexOf('.')<=h.lastIndexOf('/'))r+=o.substring(o.lastIndexOf('.'));this.addEventListener('mouseover',function(){this.src=r});this.addEventListener('mouseout',function(){this.src=o})}

Element.prototype.form=function(e){for(var t,n,r,i,o,a=0,l=this.querySelectorAll("input,select,textarea"),u={};a<l.length;a++)if(!((t=l[a]).disabled||""===(n=t.name)||n in u))if("INPUT"==(o=t.tagName)){if(""===(i=t.value)?t.required:!(t.pattern||/./).test(i))return"function"==typeof e?e(t,""===i):0;(("radio"==(r=t.type)||"checkbox"==r)&&t.checked||"submit"!=r&&"button"!=r)&&(u[n]=i)}else("SELECT"==o||"TEXTAREA"==o)&&(u[n]="SELECT"==o?t.options[t.selectedIndex].value:t.innerHTML);return u};


//return the new source of the uploaded image and replace the BASE64 never-ending string.
Element.prototype.uploader=function(x,i,p){
	var t=this,k=t.name,r=new FileReader(),c=function(f){f.type.indexOf("image")==0?r.readAsDataURL(z=f):i(f)},a=function(f){d.append(k+"[]",f);c(f)},v=function(m){d=new FormData();g(m)},g=function(j){var f=t.files[j||0];p(f)||a(f)},n,z,d;
	r.onloadend=function(e){i(z,e.target.result);n?g(--n):x.go(d)}
	t.addEventListener("change",t.multiple?function(){n=t.files.length;v(--n)}:v);
}

//MORE IDEAS:

//AJAX+RSA
	//encrypt parameters,
	//exchange keys


//EXPAND AND COLLAPSE:  Element.prototype.group=function(inside_elements,this = img_btn){}...


//button to trigger 1-fetch or interval-feed, sends when first clicked then toggles style to abort button, then goes back to normal when finished.
//controller, setup a set of dom elements to work together with ajax,  assign an element to each of the following:
//	reciever (results div),
//	go btn,
//	abort btn,
Element.prototype.searchbar=function(varyXHR,trafficLight){//AJAX.vary(AJAX.set(c,u,p),k);
	
};//function that connects an input to an ajax search directory




var DOM=new (function(dir){
	//implement unit capability like pixels and percents and ems...
	this.create=function(e,a,s){var y=Object.assign(document.createElement(e),a);if(s)Object.assign(y.style,s);return y}
	this.sort=function(C,c,P){for(var g=typeof P==='string'?function(r){return r.getAttribute(P)}:P,a=document.querySelectorAll(C),b=0;b<a.length;b++){for(var x=0,y=[],z=[],n,e=a[b].querySelectorAll(c);x<e.length;x++){n=parseInt(g(e[x])) || g(e[x]);y.push(n);z.push(n);}y.sort(function(m,n){return m>n}).forEach(function(v,k){a[b].insertBefore(e[z.indexOf(v)],a[b].querySelectorAll(c)[k])});}};
	function bB(T,A,m){var S=document.createElement(T);for(var a in Object.assign(A,m||{}))S.setAttribute(a,A[a]);document.body.appendChild(S);return S}
	//this.js=function(U,id){document.body.jsonElements({SCRIPT:[],id:id||null,type:'text/javascript',src:U})};
	this.js=function(s,p){var p=p||document.body,t=document.createElement("script");t.src=s;t.onload=function(){p.removeChild(t)};p.appendChild(t)}
	this.css=function(U,id){document.body.jsonElements({LINK:[],id:id||null,rel:'stylesheet',type:'text/css',href:U})};

	this.decolor=function(b){var n='Decolor';document.getElementById(n)||this.css(dir+'Decolor.css',n);document.body.classList[b?'remove':'add'](n)};
	this.mobile=function(){};
	//var Stripe=function(amount){insert Stripe.js, and return the document element for a stripe button''}//LOW priority
	this.home=null;
	this.popup=function(H,B,F,T){var n='Popup',p;document.getElementById(n+'s')||this.css(dir+n+'s.css',n+'s');(p=document.getElementById(n))&&document.body.removeChild(p);document.body.jsonElements({
			DIV:[{SPAN:[H]},{DIV:[B]},{SPAN:[F]}],
			id:n,
			class:T
		});
	};
	this.hoverSet=function(q,A){for(var E=document.querySelectorAll(q),n=0,a;n<E.length;n++)(a=E[n].getAttribute([A]))&&E[n].hoverImg(a);};

	this.trafficLight=null;//function that builds a new traffic light element
	
})("css/");