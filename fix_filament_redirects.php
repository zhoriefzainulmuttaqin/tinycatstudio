<?php
$files = explode("\n", trim(shell_exec('find app/Filament -name "Create*.php" -o -name "Edit*.php"')));
foreach ($files as $file) {
    if (empty($file)) continue;
    // skip Auth/EditProfile.php
    if (strpos($file, 'Auth/EditProfile') !== false) continue;

    $content = file_get_contents($file);
    if (strpos($content, 'getRedirectUrl') === false) {
        $content = preg_replace('/}\s*$/', "\n    protected function getRedirectUrl(): string\n    {\n        return \$this->getResource()::getUrl('index');\n    }\n}", $content);
        file_put_contents($file, $content);
    }
}
echo "Done\n";
