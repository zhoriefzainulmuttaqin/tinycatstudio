<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$record = new App\Models\Setting();
$record->key = 'site_logo';
$record->value = 'settings/mylogo.png';
$record->save();
echo "Setting created\n";
