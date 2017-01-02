<?php
class OAuth{
	public $curl;

	function __construct(){
		curl_setopt_array($this->curl = curl_init(), [
			CURLOPT_SSL_VERIFYPEER => !0,
			CURLOPT_CAINFO => $this->cacert,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_HEADER => !1,
			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_TIMEOUT => 5,
			CURLOPT_ENCODING => 'gzip',
			CURLINFO_HEADER_OUT => !0,
			CURLOPT_RETURNTRANSFER => !0
		]);
	}

	private function request($head, $url, $opts=[]){
		curl_setopt_array($this->curl, $opts + [
			CURLOPT_URL => $url,
			CURLOPT_HTTPHEADER => ['Accept: application/json', $head, 'Expect:']
		]);
		return curl_exec($this->curl);
	}

	protected function get($path, $params=[]){
		$url= $this->api . $path;
		return $this->request($this->sign('GET', $url, $params), $url.'?'.http_build_query($params));
	}

	protected function post($path, $params=[]){
		$url= $this->api . $path;
		return $this->request($this->sign('POST', $url, $params), $url, [
			CURLOPT_POST=> !0,
			CURLOPT_POSTFIELDS=> http_build_query($params)
		]);
	}

	private function sign($method, $url, $params=[]){
		$params+= ($this->oauth += [
			'oauth_nonce'=> md5(microtime() . mt_rand()),
			'oauth_timestamp'=> time()
		]);
				
		ksort($params);
		
		$base= $method.'&'.rawurlencode($url).'&'.rawurlencode(http_build_query($params));
		return 'Authorization: OAuth ' . http_build_query($this->oauth + [
			'oauth_signature'=> base64_encode(hash_hmac('sha1', $base, $this->key, !0))
		], '', ', ');
	}	
}