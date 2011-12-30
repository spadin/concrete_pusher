<?php

defined('C5_EXECUTE') or die("Access Denied.");

class PusherConfiguration extends Object {	
  
  const btTable = 'btPusherConfiguration';
  
  var $id,
      $appId,
      $appKey,
      $secretKey;
  
  function PusherConfiguration() {
    
  }
  
  function getID()        { return $this->id;        }
  function getAppID()     { return $this->appId;     }
  function getAppKey()    { return $this->appKey;    }
  function getSecretKey() { return $this->secretKey; }
	
	function get() {
	  $db       = Loader::db();
    $rsObject = $db->execute("SELECT * FROM ". self::btTable ." LIMIT 1");
		$config   = null;
		$row      = $rsObject->fetchrow();
		
		if($row == null) {
      // Create an empty configuration entry.
      $db->execute("INSERT INTO ". self::btTable ." (appId,appKey,secretKey) VALUES ('','','')");
      $config = PusherConfiguration::get();
    }
		
    if($config == null) {
      $config = new PusherConfiguration();
      $config->id        = $row['pId'];
      $config->appId     = $row['appId'];
      $config->appKey    = $row['appKey'];
      $config->secretKey = $row['secretKey'];
    }
    
    return $config;
	}
  
  function updateByValues($valuesArray) {
    $db           = Loader::db();
    $setDirective = "";
    $lastIndex    = count($valuesArray) - 1;
    $current      = 0;
    $config       = PusherConfiguration::get();
    $id           = $config->getId();
    
    foreach($valuesArray as $key => $value) {
      if($key == 'id') continue;
      $setDirective .= "$key='$value'";
      if($current < $lastIndex) {
        $setDirective .= ",";
      }
      $setDirective .= " ";
      $current++;
    }
    return $db->execute("UPDATE ". self::btTable ." SET $setDirective WHERE pId='$id'");
  }
}