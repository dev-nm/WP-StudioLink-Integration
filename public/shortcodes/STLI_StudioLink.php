<?php
class STLI_StudioLink{
	
	/* Funktionsvariablen zur Abfrage und Veraenderung durch andere Funktionen */
	/**
	 * Initialize the StudioLink shortcode.
	 *
	 * @since    1.0.0
	 */
	function studioLink_Integration_Shortcode( $atts, $content ) {
		//Test if Shortcodes are activated
		$general = get_option( 'stli_general' );
		if( $general['stli_enable_shortcodes'] ){
			// Speichere Übergabewerte
			$_atts = shortcode_atts( array(
				'online' => NULL,
				'status' => NULL,
				'slug' => NULL
			), $atts );
			
			// Args werden in besser verarbeitbare Variablen umgeschrieben
			$online = $_atts['online'];
			$status = $_atts['status'];
			$slug = $_atts['slug'];
			
			// Leere Übergabewerte werden gefüllt
			if(!isset($online)){
				if(!isset($status)){
					$online = true;
				} else {
					if($status == 'test' || $status == 'break' || $status == 'offline') {
						$online = false;
					} else {
						$online = true;
					}
				}
			}
			
			// Args sollen alle kleingeschrieben sein
			$online = filter_var($online, FILTER_VALIDATE_BOOLEAN);
			if(isset($status))
				$status = strtolower($status);
			
			// Erzeuge StudioLink Objekt
			$StudioLink = new Studio_Link_Status($_atts['slug']);
			// Abbruch wenn kein Inhalt zwischen Shortcode
			if ( ! is_null( $content ) ) {
				// Onlinestatus bei nicht angabe eines Status wird geprüft
				if($StudioLink->online == $online && empty($status)) { 
					return $content;
				}
				// Onlinestatus bei angabe eines Status wird geprüft
				if($StudioLink->online != $online || $StudioLink->state != $status) {
					return '';
				} else {
					return $content;
				}
			} else {
				return '';
			}
		}
	}
}