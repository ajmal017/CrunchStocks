<pre><?php
//USE OAUTH TO BUILD FRIENDSLIST AND WATCHLIST THEN PULL 30 MESSAGES FROM EACH.  Build the list from 'Recommended' or 'Trending'

class StockTwits{
	public $curl;
	public $api='https://api.stocktwits.com/api/2/';
	public $key=['access_token'=>''];
	
	function __construct(){
		curl_setopt_array($this->curl = curl_init(), [
			//CURLOPT_CAINFO => __DIR__ . '/cert.pem',
			CURLOPT_SSL_VERIFYPEER => !1,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_HEADER => !1,
			CURLOPT_TIMEOUT => 5,
			CURLOPT_ENCODING => 'gzip',
			CURLINFO_HEADER_OUT => !0,
			CURLOPT_RETURNTRANSFER => !0
		]);
	
	
	}
	
	private function request($url, $opts=[]){
		curl_setopt_array($this->curl, $opts + [
			CURLOPT_URL => $url
		]);
		return curl_exec($this->curl);
	}
	
	
	protected function get($path, $params=[]){
		return $this->request($this->api . $path . '.json?' . http_build_query(array_filter($this->key + $params)), [
			CURLOPT_POST=> !1
		]);
	}

	protected function post($path, $params=[]){
		return $this->request($this->api . $path . '.json', [
			CURLOPT_POST=> !0,
			CURLOPT_POSTFIELDS=> http_build_query(array_filter($this->key + $params))
		]);
	}
	
	public function messages(){}
	
	public function suggested($since='', $max='', $limit=0, $callback='', $filter=''){
		return $this->get('streams/suggested', [
			'since'=> $since,
			'max'=> $max,
			'limit'=> $limit,
			'callback'=> $callback,
			'limit'=> $filter
		]);	
	
	}
	
	public function trending($limit=0, $callback=''){
		return $this->get('trending/symbols', [
			'limit'=> $limit,
			'callback'=> $callback
		]);
	
	}
}