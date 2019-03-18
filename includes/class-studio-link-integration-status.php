<?php
class Studio_Link_Status{
	public $online;
	public $state;
	public $studioLinkSlug;
	public $listeners;
	public $name;
	
	function __construct($studioLinkSlug = NULL){
		if(!isset($studioLinkSlug)){
			$this->studioLinkSlug = get_option( 'stli_general' )['stli_slug'];
		} else {
			$this->studioLinkSlug = $studioLinkSlug;
		}
		
		$this->onlineTest();
	}
	
	public function onlineTest(){
		if(!isset($this->studioLinkSlug))
			return false;
		if ( false === ( $value = get_transient( 'stli_status' ) ) ) {
			
			$jsonurl = 'https://stream.studio-link.de/api/streams/'.$this->studioLinkSlug.'.json';
			$get_json_file = wp_remote_get( $jsonurl );
			$json = wp_remote_retrieve_body( $get_json_file );
			if($json != "[]"){
				$decoded_json = json_decode($json, true);
				$this->state = $decoded_json['state'];
				if($decoded_json['state'] == "test" || $decoded_json['state'] == "offline" || $decoded_json['state'] == "break"){
					$this->online = false;
				} else {
					$this->online = true;
				}
				$this->listeners = $decoded_json['listeners'];
				$this->name = $decoded_json['name'];
			} else {
				$this->online = false;
			}
			$status = array(
				'online' => $this->online,
				'state' => $this->state,
				'studioLinkSlug' => $this->studioLinkSlug,
				'listeners' => $this->listeners,
				'name' => $this->name,
			);
			set_transient( 'stli_status', $status, get_option('stli_general')['stli_status_caching']);
		} else {
			$this->online = $value['online'];
			$this->state = $value['state'];
			$this->studioLinkSlug = $value['studioLinkSlug'];
			$this->listeners = $value['listeners'];
			$this->name = $value['name'];
		}
	}
}