<?php
require_once "classes/database.php";
require_once "classes/cache.php";
$nerdecalisiyorum=realpath(dirname(__FILE__));


$veritabani = [
	# Host name or IP Address (optional)
	# hostname:port (for Port Usage. Example: 127.0.0.1:1010)
	# default value: localhost
	"host"      => "localhost",

	# Database Driver Type (optional)
	# default value: mysql
	# values: mysql, pgsql, sqlite, oracle
	"driver"    => "mysql",

	# Database Name (required)
	"database"  => "{QH_MYSQL_DBNAME}",

	# Database User Name (required)
	"username"  => "{QH_MYSQL_USER_NAME}",

	# Database User Password (required)
	"password"  => "{QH_MYSQL_USER_PASS}",

	# Database Charset (optional)
	# default value: utf8
	"charset"   => "utf8",

	# Database Charset Collation (optional)
	# default value: utf8_general_ci
	"collation" => "utf8_general_ci",

	# Database Prefix (optional)
	# default value: null
	"prefix"     => "",

	# Cache Directory of the Sql Result (optional)
	# default value: __DIR__ . "/cache/"
	"cachedir"	=> __DIR__ . "/cache/sql/"
];

// pdo
$db = new \ACTSPOT\Pdox($veritabani);
