<?php 
//het userobject

class User { 

	var $user;
	var $pw;
	
	function __construct($user,$pw) {
		$this->user= htmlentities($user,ENT_QUOTES);
		$this->pw= htmlentities($pw,ENT_QUOTES); 
	} 
	
	function getUser() {
		return $this->user;
	}
	
	function getPw() { 
		return  $this->pw; 
	}
} 

?>