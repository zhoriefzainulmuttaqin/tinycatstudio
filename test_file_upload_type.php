<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$f = Filament\Forms\Components\FileUpload::make('value_image');
echo "multiple is " . ($f->isMultiple() ? 'true' : 'false') . "\n";
