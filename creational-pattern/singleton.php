<?php

/*
	/ When To Use :
	/ The use of the singleton pattern is justified in those cases where we want to restrict the number of 
	/ instances that we create from a class in order to save the system resources. Such cases include data base 
	/ connections as well as external APIs that devour our system resources.
	/ Singleton Class is like global variable.

*/

final class Tools {

	private static $instance;

	public static function getInstance()
	{
		if(self::$instance == null)
		{
			self::$instance = new Tools();
		}

		return self::$instance;
	}

	private function __construct(){
		// set private to stop making class instance from outside
	}


	public function getData()
	{
		return "Some Dummy Data" . self::$instance;
	}

}

$tools1 = Tools::getInstance();
$tools2 = Tools::getInstance();

var_dump($tools1 , $tools2);

