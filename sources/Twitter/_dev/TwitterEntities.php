<meta charset="utf-8">
<body>
<pre><?php
/*
$_SQL= new mysqli('localhost', 'root', 'password', 'crunch_stocks');
	$emoji= $_SQL->query("SELECT * FROM `emoji` LIMIT 1");

	$row= $emoji->fetch_array(MYSQLI_ASSOC);
	print_r($row);
*/
$str= "Emoji to the rescue! 😝 https://t.co/8oNAicCLPf";
preg_match_all('/[\x{0080}-\x{FFFF}]+/u', $str, $m);
echo $str;
print_r($m);
die();
	
$tweets= [
/*	"Apple sends out invites to iPhone 7 launch event https://t.co/75fhNJgLHK",
	"Apple iPhone SE (Latest Model) - 16GB - Silver (Verizon) Smartphone  https://t.co/hMOHc2fdqU https://t.co/NNeJoLrzmv",
	"RT @MarketWatch: Apple expected to unveil iPhone 7 on Sept. 7 https://t.co/CHDrr0NxMm",
	"Two-lens phone cameras are nothing new. Could Apple make them click? https://t.co/zkjtTdpIns #tech https://t.co/SYacrI2z9c",
	"Apple's iPhone buzz fades as old models keep ticking https://t.co/znsyUmI5Yy \$AAPL",
	"Apple iPhone 6 - 16GB - Space Gray (AT&amp;T) Smartphone https://t.co/hqNTFMleYb https://t.co/mSWPalcSZB",
	"RT @CBCNews: New Apple iPhone unveiling expected next week https://t.co/CgFWuameux https://t.co/rPeOz8PNTD",
*/	"#AppleVisForumReply: Wouldn't the SE 😉 be a good choice for it's first iPhone? \uD83C\uDD70 \uD83C\uDE51 - https://t.co/V9OqY7J0ri"

];

class Tweets{
	static public $neg=['not', 'dont', 'wont', 'cant'];
	static public $empty=['he', 'through', 'haven', 'this', 'what', 'are', 'same', 'ourselves', 'was', 'too', 'against', 'again', 'his', 'wouldn', 'herself', 'him', 'now', 're', 'has', 'into', 'while', 'yours', 'their', 'shouldn', 'most', 'my', 'yourselves', 've', 'until', 'above', 'she', 'for', 'where', 'any', 't', 'each', 'you', 'isn', 'couldn', 'only', 'should', 'there', 'o', 'once', 'some', 'with', 'over', 'can', 'our', 'won', 'few', 'is', 'out', 'here', 'not', 'do', 'doing', 'from', 'y', 'its', 'as', 'it', 'hasn', 'on', 'had', 'no', 's', 'they', 'to', 'whom', 'how', 'other', 'having', 'then', 'an', 'just', 'shan', 'were', 'd', 'mustn', 'nor', 'which', 'have', 'off', 'after', 'itself', 'up', 'than', 'll', 'does', 'under', 'himself', 'in', 'both', 'when', 'the', 'didn', 'that', 'doesn', 'themselves', 'at', 'by', 'very', 'myself', 'a', 'why', 'yourself', 'who', 'them', 'those', 'about', 'her', 'such', 'and', 'ma', 'mightn', 'me', 'am', 'because', 'needn', 'i', 'wasn', 'theirs', 'don', 'if', 'being', 'between', 'so', 'aren', 'below', 'm', 'ain', 'or', 'we', 'these', 'during', 'own', 'your', 'before', 'been', 'down', 'of', 'weren', 'but', 'hers', 'be', 'all', 'did', 'ours', 'further', 'will', 'hadn', 'more'];

}

class Tweet{
	public $txt;
	public $rt=null;
	public $link=[];
	public $htag=[];
	public $ctag=[];
	public $words=[];
	public $pos=[];
	
	function __construct($tw){	
		$this->txt = preg_replace_callback_array([
			'/&[0-9A-z]+;/' => function($m){
				return html_entity_decode($m[0]);
			},
			'~https://t.co/(\w+)~i' => function($m){
				$this->link[]=$m[1];
			},
			'/(#|\$)(\w+)/' => function($m){
				$k=$m[1]=='#'?'htag':'ctag';
				$this->$k[]=$m[2];
			},
			'/^RT @(\w+):/' => function($m){
				$this->rt=$m[1];
			},
			'~\p{P}+\s+(.*)\?~' => function($m){
				return " ".self::quest($m[1]);
			}
		], $tw);
		
		preg_match_all("/[\w']+/", $this->txt, $this->words);
		
		/*$this->word= array_filter($w[0], function($w){
			if(strlen($w)===1)return;
			else return 1;
		
		});
		*/
	
	}
	
	function quest($q){
		echo "<b>Question: </b>".$q."<br>";
		return $q;
	}

}

foreach($tweets as $tw) var_dump(new Tweet($tw));
?>
</body>