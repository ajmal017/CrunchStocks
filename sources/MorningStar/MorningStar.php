<?php
class Morningstar{
	public $curl;

	function __construct(){
		curl_setopt_array($this->curl = curl_init(), [
			CURLOPT_SSL_VERIFYPEER => !1,
//			CURLOPT_CAINFO => $this->cacert,
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_HEADER => !1,
//			CURLOPT_SSL_VERIFYHOST => 2,
			CURLOPT_TIMEOUT => 5,
			CURLOPT_ENCODING => 'gzip',
			CURLINFO_HEADER_OUT => !0,
			CURLOPT_RETURNTRANSFER => !0
		]);
	}
	
	private function request($server, $path, $params=[]){
		curl_setopt($this->curl, CURLOPT_URL, 'http://'. $server . '.morningstar.com/' . $path . '?' . http_build_query(array_filter($params)));
		return curl_exec($this->curl);
	}
	
	public function historical(){
		return $this->request('globalquote', 'globalcomponent/RealtimeHistoricalStockData.ashx',[
			'ticker'=>'F',
			'showVol'=>'true',
			'dtype'=>'his',
			'f'=>'d',
			'curry'=>'USD',
			'range'=>'2013-1-1|2013-1-30',
			'isD'=>'true',
			'isS'=>'true',
			'hasF'=>'true',
			'ProdCode'=>'DIRECT'
		]);
	}
	
	//FAILED!!
	public function quote(){
		return $this->request('quotespeed', 'quote.jsp',[
			'jsoncallback'=>'yomama',
			'preAfter'=>'1',
			'ty'=>'D',
			'mtype'=>'ST',
			'exch'=>'126',
			'ticker'=>'F',
			'stype'=>'1',
			'days'=>'5',
			'_tid'=>'1441265386097',
			'ver'=>'1.6.0',
			'f'=>'1',
			'instid'=>'MSRT',
			'sdkver'=>'2.1.20150320',
			'qs_wsid'=>'2D2114F870F6B844CDF8271C99BB8C7A',
			'_'=>'1441265386099'
		]);
	}
	
	public function ratios(){
		return $this->request('financials', 'ajax/exportKR2CSV.html',[
			't'=>'F'
		]);
	}
	
	public function statement($type){
		return $this->request('financials', 'ajax/ReportProcess4CSV.html',[
			't'=>'F',
			'reportType'=>$type,
			'period'=>12,
			'dataType'=>'A',
			'order'=>'asc',
			'columnYear'=>5,
			'number'=>3
		]);
	}
}