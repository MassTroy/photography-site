<?php

class Album {
	public $name;
	public $path;
	public $date;
	
	function __construct($name, $path, $date) {
		$this->name = $name;
		$this->path = $path;
		$this->date = $date;
	}
}

