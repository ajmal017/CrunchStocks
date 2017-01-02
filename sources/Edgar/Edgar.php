<?php
class Edgar{
	protected $curl;
	protected $api= "http://edgaronline.api.mashery.com/v2/";
	protected $key= "&appkey={API-KEY}";
	
	function __construct(){
		curl_setopt_array($this->curl = curl_init(), [
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_HEADER => !1,
			CURLOPT_TIMEOUT => 5,
			CURLOPT_ENCODING => 'gzip',
			CURLOPT_RETURNTRANSFER => !0
		]);
	}

	private function fetch($path, $params=[]){
		$url= $this->api . $path . '.json?' . http_build_query(array_filter($params)) . $this->key;
		curl_setopt($this->curl, CURLOPT_URL, $url);
		return curl_exec($this->curl);
	}
		
	public function balance($symb){	
		return json_decode($this->fetch('corefinancials/ann', [
			'primarysymbols' => $symb,
			'fields' => 'BalanceSheetConsolidated'
		]))->result->rows[0]->values;
    }
}

