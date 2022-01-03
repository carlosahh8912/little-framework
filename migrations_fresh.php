<?php

require_once  __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/config/app.php';
use App\core\Db;
new Db();

$files = scandir(__DIR__ . '/database/migrations');
$toApplyMigrations = $files;
foreach ($toApplyMigrations as $migration) {
    if ($migration === '.' || $migration === '..') {
        continue;
    }

    require_once __DIR__ . '/database/migrations/' . $migration;
    $className = pathinfo($migration, PATHINFO_FILENAME);
    $instance = new $className();
    $instance->down();
    $instance->up();
}