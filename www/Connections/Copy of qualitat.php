<?php 
	# PHP ADODB document - made with PHAkt
	# FileName="Connection_php_adodb.htm"
	# Type="ADODB"
	# HTTP="true"
	# DBTYPE="mysql"
	
	$MM_qualitat_HOSTNAME = "localhost";
	$MM_qualitat_DATABASE = "mysql:hc";
	$MM_qualitat_DBTYPE   = preg_replace("/:.*$/", "", $MM_qualitat_DATABASE);
	$MM_qualitat_DATABASE = preg_replace("/^.*?:/", "", $MM_qualitat_DATABASE);
	$MM_qualitat_USERNAME = "root";
	$MM_qualitat_PASSWORD = "root";
	$MM_qualitat_LOCALE = "Us";
	$MM_qualitat_MSGLOCALE = "En";
	$MM_qualitat_CTYPE = "P";
	$KT_locale = $MM_qualitat_MSGLOCALE;
	$KT_dlocale = $MM_qualitat_LOCALE;
	$KT_serverFormat = "%Y-%m-%d %H:%M:%S";
	$QUB_Caching = "false";
	
	switch (strtoupper ($MM_qualitat_LOCALE)) {
		case 'EN':
				$KT_localFormat = "%d-%m-%Y %H:%M:%S";
		break;
		case 'EUS':
				$KT_localFormat = "%m-%d-%Y %H:%M:%S";
		break;
		case 'FR':
				$KT_localFormat = "%d-%m-%Y %H:%M:%S";
		break;
		case 'RO':
				$KT_localFormat = "%d-%m-%Y %H:%M:%S";
		break;
		case 'IT':
				$KT_localFormat = "%d-%m-%Y %H:%M:%S";
		break;
		case 'GE':
				$KT_localFormat = "%d.%m.%Y %H:%M:%S";
		break;
		case 'US':
				$KT_localFormat = "%Y-%m-%d %H:%M:%S";
		break;
		default :
				$KT_localFormat = "none";			
	}


	
	if (!defined('CONN_DIR')) define('CONN_DIR',dirname(__FILE__));
	require_once(CONN_DIR."/../adodb/adodb.inc.php");
	ADOLoadCode($MM_qualitat_DBTYPE);
	$qualitat=&ADONewConnection($MM_qualitat_DBTYPE);

	if($MM_qualitat_DBTYPE == "access" || $MM_qualitat_DBTYPE == "odbc"){
		if($MM_qualitat_CTYPE == "P"){
			$qualitat->PConnect($MM_qualitat_DATABASE, $MM_qualitat_USERNAME,$MM_qualitat_PASSWORD, 
			$MM_qualitat_LOCALE);
		} else $qualitat->Connect($MM_qualitat_DATABASE, $MM_qualitat_USERNAME,$MM_qualitat_PASSWORD, 
			$MM_qualitat_LOCALE);
	} else if (($MM_qualitat_DBTYPE == "ibase") or ($MM_qualitat_DBTYPE == "firebird")) {
		if($MM_qualitat_CTYPE == "P"){
			$qualitat->PConnect($MM_qualitat_HOSTNAME.":".$MM_qualitat_DATABASE,$MM_qualitat_USERNAME,$MM_qualitat_PASSWORD);
		} else $qualitat->Connect($MM_qualitat_HOSTNAME.":".$MM_qualitat_DATABASE,$MM_qualitat_USERNAME,$MM_qualitat_PASSWORD);
	}else {
		if($MM_qualitat_CTYPE == "P"){
			$qualitat->PConnect($MM_qualitat_HOSTNAME,$MM_qualitat_USERNAME,$MM_qualitat_PASSWORD,
   			$MM_qualitat_DATABASE,$MM_qualitat_LOCALE);
		} else $qualitat->Connect($MM_qualitat_HOSTNAME,$MM_qualitat_USERNAME,$MM_qualitat_PASSWORD,
   			$MM_qualitat_DATABASE,$MM_qualitat_LOCALE);
   }

	if (!function_exists("updateMagicQuotes")) {
		function updateMagicQuotes($HTTP_VARS){
			if (is_array($HTTP_VARS)) {
				foreach ($HTTP_VARS as $name=>$value) {
					if (!is_array($value)) {
						$HTTP_VARS[$name] = addslashes($value);
					} else {
						foreach ($value as $name1=>$value1) {
							if (!is_array($value1)) {
								$HTTP_VARS[$name1][$value1] = addslashes($value1);
							}
						}
						
					}
					global $$name;
					$$name = &$HTTP_VARS[$name];
				}
			}
			return $HTTP_VARS;
		}
		
		if (!get_magic_quotes_gpc()) {
			$_GET = updateMagicQuotes($_GET);
			$_POST = updateMagicQuotes($_POST);
			$HTTP_COOKIE_VARS = updateMagicQuotes($HTTP_COOKIE_VARS);
		}
	}
	if (!isset($_SERVER['REQUEST_URI'])) {
		$_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'];
	}
?>
