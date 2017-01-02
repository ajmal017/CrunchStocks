function factorial(n){var o=1;while(n>1)o*=n--;return o},
		perm:function(n,k){return c.fact(n)/c.fact(n-k)},
		comb:function(n,k){return c.perm(n,k)/c.fact(k)},
/*
	n: (int) Pop size,
	k: (int) Samp Size,
	o: (bool or 0 or 1) Ordered,
	r: (bool or 0 or 1) with Replacement
*/
function nWaysToPick(n,k,o,r){
	return o?
		(r?
			Math.pow(n,k)
			:
			c.perm(n,k)
		):
		c.comb(n+(r?
			k-1
			:
			0
		),k)
}


var Prob=new(function(){
	var _=this,c=_.count={
		fact:function(n){var o=1;while(n>1)o*=n--;return o},
		perm:function(n,k){return c.fact(n)/c.fact(n-k)},
		comb:function(n,k){return c.perm(n,k)/c.fact(k)},
		npick:function(n,k,o,r){return o?(r?Math.pow(n,k):c.perm(n,k)):c.comb(n+(r?k-1:0),k)}
	}	
});