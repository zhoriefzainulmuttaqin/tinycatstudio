<?php
$f = [
    'app/Filament/Resources/BlogPostResource.php' => ['heroicon-o-document-text', 'Content'],
    'app/Filament/Resources/ContactResource.php' => ['heroicon-o-envelope', 'Inbox'],
    'app/Filament/Resources/MessageResource.php' => ['heroicon-o-chat-bubble-left-ellipsis', 'Inbox'],
    'app/Filament/Resources/PortfolioResource.php' => ['heroicon-o-briefcase', 'Content'],
    'app/Filament/Resources/PricingPackageResource.php' => ['heroicon-o-currency-dollar', 'Content'],
    'app/Filament/Resources/ServiceResource.php' => ['heroicon-o-squares-2x2', 'Content'],
    'app/Filament/Resources/SettingResource.php' => ['heroicon-o-cog-6-tooth', 'System'],
    'app/Filament/Resources/TestimonialResource.php' => ['heroicon-o-star', 'Content'],
];

foreach ($f as $file => $d) {
    if (!file_exists($file)) continue;
    $c = file_get_contents($file);
    
    // Update Icon and Add Group
    $c = preg_replace('/protected static \?string \$navigationIcon = \'[^\']+\';/', "protected static ?string \$navigationIcon = '{$d[0]}';\n\n    protected static ?string \$navigationGroup = '{$d[1]}';", $c);
    
    // Wrap with section if not present
    if (!str_contains($c, 'Forms\Components\Section')) {
        $c = preg_replace('/->schema\(\[\s+(.*?)\s+\]\);/s', "->schema([\n                Forms\Components\Section::make('General Information')\n                    ->schema([\n                        $1\n                    ])->columns(2),\n            ]);", $c);
    }
    
    file_put_contents($file, $c);
}

echo "Done.";
