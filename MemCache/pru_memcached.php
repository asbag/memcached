<?php
 
// Conectarse al servidor memcached
$cache = new Memcached();
$cache->addServer("127.0.0.1", 11211);
  
$result = $cache->get("clave_pru");
  
if($result) {
  echo "Valor leído de cache: " . $result . "\n";
} else {
  echo "No hay datos en Cache.\n";
  $cache->set("clave_pru", "Valor de prueba") or die ("Error guardando datos en memcache");
}