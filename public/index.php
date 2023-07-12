<?php
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once __DIR__ . '/../vendor/autoload.php';

$appConfig = require '../config/config.php';

// Doctrine setup
$doctrineConfig = ORMSetup::createAttributeMetadataConfiguration(
    [$appConfig['modelsPath']],
    $appConfig['isDevMode'],
);
$connection = DriverManager::getConnection($appConfig['database']);
$entityManager = new EntityManager($connection, $doctrineConfig);

// Router
require_once '../routes/router.php';
