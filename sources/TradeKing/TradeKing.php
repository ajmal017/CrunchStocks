<?php
class TradeKing extends OAuth{
	protected $api= "https://api.tradeking.com/v1/";
	protected $key= "{APP-TOKEN}&{APP-SECRET}";
	protected $oauth=[
        'oauth_consumer_key' => '{CONSUMER-TOKEN}',
		'oauth_signature_method'=> 'HMAC-SHA1',
		'oauth_token'=> '{CONSUMER-SECRET}',
		'oauth_version' => '1.0'
	];
	protected $cacert=__DIR__.'\\cert.pem';
	
	public function profile(){
		return $this->get('member/profile.json');
    }
	
	public function headlines(array $symbs=[], int $n=10){
		$symbs=implode(",",$symbs);
		return json_decode($this->get('market/news/search.json',[
			'symbols'=>$symbs,
			'maxhits'=>$n
		]))->response->articles->article;
	}
	
	public function toplists($list, $ex){//losers,pctlosers,volume,active,gainers,pctgainers;  A,N,Q,U,V
		return json_decode($this->get('market/toplists/top'.$list.'.json', [
			'exchange'=> $ex
		]))->response->quotes->quote;
	}
	
	public function previewTrade($id){
		//return $this->post('accounts/'.$id.'/orders/preview.json');
	
	}
	
	public function placeTrade($id){
		//return $this->post('accounts/'.$id.'/orders.json');
	
	}
}