<?php
class STLI_StudioLink{
	
	/* Funktionsvariablen zur Abfrage und Veraenderung durch andere Funktionen */
	public $online;
	public $state;
	public $studioLinkSlug;
	public $listeners;
	public $name;
	
	private $titan;
	
	function __construct($studioLinkSlug = NULL){
		$this->titan = TitanFramework::getInstance( 'stli' );
		if(empty($studioLinkSlug)){
			$this->studioLinkSlug = $this->titan->getOption( 'studiolink_slug' );
		} else {
			$this->studioLinkSlug = $studioLinkSlug;
		}
		
		$this->STLI_onlineTest();
	}
	
	public function STLI_onlineTest(){
		if(empty($this->studioLinkSlug))
			return 'false';
		$jsonurl = 'https://stream.studio-link.de/api/streams/'.$this->studioLinkSlug.'.json';
		$json = file_get_contents($jsonurl);
		if($json != "[]"){
			$decoded_json = json_decode($json, true);
			$this->state = $decoded_json['state'];
			if($decoded_json['state'] == "test" || $decoded_json['state'] == "offline" || $decoded_json['state'] == "break"){
				$this->online = 'false';
			} else {
				$this->online = 'true';
			}
			$this->listeners = $decoded_json['listeners'];
			$this->name = $decoded_json['name'];
		}
	}
	
}
?>