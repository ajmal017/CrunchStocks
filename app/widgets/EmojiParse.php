<head>
<meta charset="utf-8">
<style>
body{
background:#dbe6db;
}
#test{
display:block;
background:#ffffff;
position:relative;
height:100px;
}

</style>
</head>
<body>
Some modern browsers are already fixing this but just in case: 
<input id="fix-btn" type="button" value="Fix Emojis">
<br>
<div id="demo-tweet"><?php
/*  Requires database, but this is just a demo.

	$_SQL= new mysqli('localhost', 'root', 'password', 'database')){
	
	@$q= $_SQL->query("SELECT `text` FROM `tweets` ORDER BY RAND() LIMIT 1");
	
	while(@$tw=$q->fetch_assoc()) echo "<h1>".$tw['text']."</h1>";
	
*/
?></div>

<script>
(function(){
	var x=/[\ud83e\ud83d\u00a9\u00ae\u203c\u2049\u2122\u2139\u2194-\u2199\u21a9-\u21aa\u231a-\u231b\u2328\u23e9-\u23f3\u23f8-\u23fa\u24c2\u25aa-\u25ab\u25b6\u25c0\u25fb-\u25fe\u2600-\u2604\u260e\u2611\u2614-\u2615\u2618\u261d\u2620\u2622-\u2623\u2626\u262a\u262e-\u262f\u2638-\u263a\u2648-\u2653\u2660\u2663\u2665-\u2666\u2668\u267b\u267f\u2692-\u2694\u2696-\u2697\u2699\u269b-\u269c\u26a0-\u26a1\u26aa-\u26ab\u26b0-\u26b1\u26bd-\u26be\u26c4-\u26c5\u26c8\u26ce-\u26cf\u26d1\u26d3-\u26d4\u26e9-\u26ea\u26f0-\u26f5\u26f7-\u26fa\u26fd\u2702\u2705\u2708-\u270d\u270f\u2712\u2714\u2716\u271d\u2721\u2728\u2733-\u2734\u2744\u2747\u274c\u274e\u2753-\u2755\u2757\u2763-\u2764\u2795-\u2797\u27a1\u27b0\u27bf\u2934-\u2935\u2b05-\u2b07\u2b1b-\u2b1c\u2b50\u2b55\u3030\u303d\u3297\u3299][\udd17\ude00\ud83c\udc00-\udcfd\udcff-\udd3d\udd49-\udd4e\udd50-\udd67\udd6f-\udd71\udd73-\udd79\udd7e-\udd84\udd87\udd8a-\udd8e\udd90-\udd9a\udda5\udda8\uddb1-\uddb2\uddbc\uddc0\uddc2-\uddc4\uddd1-\uddd3\udddc-\uddde\udde1\udde3\udde6-\ude51\ude80-\udec5\udecb-\uded0\udee0-\udee5\udee9\udeeb-\udeec\udef0\udef3\udf00-\udf21\udf24-\udf93\udf96-\udf97\udf99-\udf9b\udf9e-\udff0\udff3-\udff5\udff7-\udffa]?([\u200d\ud83c\udffb-\udfff]?[\u2764\ud83d\udde6-\uddff]?[\udc68-\udc69\udde8]?)*/g;
	
	UI={
		emoji: function(s){
			return s.replace(x, function(m){
				var r=[],c=0,p=0,i=0;
				while(i<m.length){
					c=m.charCodeAt(i++);
					if(p){
						r.push((0x10000+((p-0xD800)<<10)+(c-0xDC00)).toString(16));
						p=0;
					}
					else if(0xD800<=c&&c<=0xDBFF) p=c;
					else r.push(c.toString(16))
				}
				return "<img src='ui/emojis/"+r.join('-')+".png'>";
			})
		}	
	};
})();


//download tweets via XMLHttpRequest(Ajax)
var tweet = "Here's how the Twitter API writes a Smiley:  🤗 <br>Here's a Smiley in Unicode:  \ud83d\ude00 <br>Both may need to be converted depending on the browser";

var container = document.getElementById('demo-tweet');
	container.innerHTML = tweet;

//will do this on loading the xhr, but for demo purposes, put this in a button.
document.getElementById('fix-btn').addEventListener("click", function(){
	container.innerHTML = UI.emoji(tweet);
});
</script>
</body>
</script>