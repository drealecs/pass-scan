<?php
require_once __DIR__ . '/vendor/autoload.php';

$entityDir = __DIR__ . '/src/Entity';
$proxyDir = __DIR__ . '/src/Entity/Proxy';
$proxyNamespace = 'Entity\Proxy';

$isDevMode = true;

$dbParams = array(
    'driver'   => 'pdo_mysql',
    'host'     => '192.168.0.116',
    'user'     => 'root',
    'password' => 'qwerty123',
    'dbname'   => 'pass-scan',
);

if ($isDevMode) {
    $cache = new \Doctrine\Common\Cache\ArrayCache;
} else {
    $redis = new \Redis();
    $redis->connect('192.168.0.116');
    $cache = new \Doctrine\Common\Cache\RedisCache();
    $cache->setRedis($redis);
}

$config = new \Doctrine\ORM\Configuration();

$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);
$config->setResultCacheImpl($cache);
$config->setHydrationCacheImpl($cache);

$driverImpl = $config->newDefaultAnnotationDriver($entityDir);
$config->setMetadataDriverImpl($driverImpl);

$config->setProxyDir($proxyDir);
$config->setProxyNamespace($proxyNamespace);
$config->setAutoGenerateProxyClasses($isDevMode);

$entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);
