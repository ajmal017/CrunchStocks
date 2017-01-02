<pre><?php
class Twitter{
	private $base='https://api.twitter.com/1.1/';
	private $ckey="R0RGDo54LyaHolpvqSIfBkXO1";
	private $csec="3mOrVhLatRbmlUAIMMGhE0BPvQwbbFbzN3G0ZWoA63TCtBGGtr";
	private $tkey="576737838-R2xy6ejFEkunTvFjqAFQ2ahVoHzXKWlQLNxOSXdA";
	private $tsec="SmUsVVSNmywKujxeBikThO0JCm4kknSXKbPjveMmmsud9";
	private $key;
	private $curl;
	private $oauth;
	public $data;
	
	function __construct($csec=null,$tsec=null){//FIGURE THIS OUT,  WHICH SET CONSUMER OR TOKEN IS INTERCHANGABLE?
		$this->key=rawurlencode($csec?:$this->csec)."&".rawurlencode($tsec?:$this->tsec);
		
		$this->curl=[
			CURLOPT_HEADER => 0,
            CURLOPT_CAINFO => __DIR__ .'/cacert.pem',
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_TIMEOUT => 5
		];
		
		
		$this->oauth=[
            "oauth_version" => '1.0',
			'oauth_signature_method'=> 'HMAC-SHA1',
            "oauth_consumer_key" => $this->ckey,
			'oauth_token' => $this->tkey
		];
	}
//search is for tweets, lookup is for userids
	public function search($q,$n=15){
		$path= $this->base."search/tweets.json";
		$param=[
			'lang'=>'en',
			'include_entities'=>0,
			'trim_user'=>1,
			'q'=>rawurlencode($q),
			'n'=>intval($n)
		];
		return $this->data=json_decode($this->get($path,$param), true);
	}
	
	private function prep($method){
        switch ($method) {
            case 'POST':
                $options[CURLOPT_POST] = true;
				ksort($param);
                $options[CURLOPT_POSTFIELDS] = http_build_query($param);
                break;
            case 'DELETE':
                $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                break;
            case 'PUT':
                $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
                break;
        }
	}
	
	private function get($path,$param){
		$auth= $this->auth('GET',$path,$param);
		$curl=[
            CURLOPT_HTTPHEADER => ['Accept: application/json', $auth, 'Expect:'],
            CURLOPT_URL => $path.'?'.http_build_query($param)
		];
		return $this->go($this->curl+$curl);
	}
	
	private function auth($method,$path,$param){
		$oauth=$this->oauth +["oauth_nonce"=>md5(microtime().mt_rand()),"oauth_timestamp"=>time()];
		$query=$param+$oauth;
		ksort($query);
		$sig= $method.'&'.rawurlencode($path).'&'.rawurlencode(http_build_query($query));
		$oauth['oauth_signature']= base64_encode(hash_hmac('sha1', $sig, $this->key, true));
		array_walk($oauth,function(&$v,$k){$v=rawurlencode($k).'="'.rawurlencode($v).'"';});
		return 'Authorization: OAuth '.implode(", ",$oauth);
	}
	
	private function go($curl){
        $curlHandle = curl_init();
        curl_setopt_array($curlHandle, $curl);
		return curl_exec($curlHandle);
    }
	
	public function save(){
		$f=fopen(time().".csv",'a');
		foreach($this->data['statuses'] as $d)fputcsv($f,[$d['id_str'],$d['user']['id_str'],DateTime::createFromFormat('D M d H:i:s O Y',$d['created_at'])->format('Y-m-d h:i:s'),$d['text']]);
		fclose($f);
	}
	
	public function import(){
		$SQL->query("LOAD DATA LOCAL INFILE 'file2.csv' INTO TABLE `tweets` FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' (`id`, `user`, `time`, `orig`)");
	}

}

$q= empty($_GET['q'])?die:$_GET['q'];
$twitter= new Twitter();
$data= $twitter->search($q);
//var_dump($twitter);
//print_r($data);
session_start();
$_SESSION['tweet']=$data['statuses'][0]['text'];
//var_dump($data);
//$twitter->save();