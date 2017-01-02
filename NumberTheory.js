//convert integer i from base 10 to base b.
function baseConvert(i,b){
	var d=[],r=0,h=['a','b','c','d','e','f'];
	console.log(i+" === "+(i%b)+" mod "+b+";  d="+(i%b));
	while(i>0){
		r=i%b;
		console.log(i+" - "+r+" = "+(i-r)+"; "+(i-r)+" / "+b+" = "+((i-r)/b)+"; d="+Math.floor(((i-r)/b)%b));
		d.unshift(r<10?r:h[r-10]);
		i-=r;
		i/=b;
	}
	return d.join("")
}

function gcd(a,b){
	var r,q;
	while(r!==0){
		r=a%b;
		q=(a-r)/b;
		console.log(a+" = ("+q+" x "+b+") + "+r);
		a=b;
		b=r;
	}
	console.log("GCD = "+a);
}