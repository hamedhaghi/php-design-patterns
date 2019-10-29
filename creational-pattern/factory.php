<?php

/*
	/ When To Use :
	/ Whenever you have multiple objects of same type to create, You can use Factory Pattern.
	/ Factory Pattern abstracts object creation.
*/


class DatabaseConfig
{

	private $connectionString;

	public function __construct()
	{
		$this->connectionString = 'host:local;user:root;password:12345';
	}

	public function getConnectionString()
	{
		return $this->connectionString;
	}

}

class JsonConfig
{
	private $connectionString;

	public function __construct()
	{
		$this->connectionString = './config.json';
	}

	public function getConnectionString()
	{
		return $this->connectionString;
	}
}

// This way we have to change $config object throughout the project. So we use Factory Pattern

/*
	$config = new DatabaseConfig();
	$config = new JsonConfig();	
*/


class ConfigFactory
{
	public static function create()
	{
		return new DatabaseConfig();
		// or you can change to
		//return new JsonConfig();
		// Or you can use if statement in here based on some criteria to return needed class
	}
}


$config = ConfigFactory::create();
var_dump($config);