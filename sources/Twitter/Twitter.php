<?php
class Twitter extends OAuth{
	protected $api= "https://api.twitter.com/1.1/";
	protected $key= "{APP-TOKEN}&{APP-SECRET}";
	protected $oauth=[
        'oauth_consumer_key' => '{CONSUMER-TOKEN}',
		'oauth_signature_method'=> 'HMAC-SHA1',
		'oauth_token'=> '{CONSUMER-SECRET}',
		'oauth_version' => '1.0'
	];
	protected $cacert=__DIR__.'\\cert.pem';
	
	public function profile(){
		return $this->get('account/verify_credentials.json');
    }
	
	public function tweets($q = '', $n = 15){
		return $this->get('search/tweets.json', [
			'count'=>$n,
			'include_entities'=>!1,
			'lang'=>'en',
			'q'=>rawurlencode($q),
			'trim_user'=>!0
		]);
	}
}