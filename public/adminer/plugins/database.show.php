<?php

/**
 * Show some databases from the interface - just to improve design, not a security plugin
 * 
 * Created by FX
 */
class AdminerDatabaseShow {
	protected $enabled;
	
	/**
	* @param array case insensitive database names in values
	*/
	function __construct($enabled) {
		$this->enabled = array_map('strtolower', $enabled);
	}
	
	function databases($flush = true) {
		$return = array();
		foreach (get_databases($flush) as $db) {
			if (in_array(strtolower($db), $this->enabled)) { // Change conditional statement to show DB
				$return[] = $db;
			}
		}
		return $return;
	}
	
}