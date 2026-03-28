<?php
$html = <<<HTML
<div style="width: 400px; height: 400px; background: radial-gradient(circle 400px at 50% 50%, red, transparent 100%);">Hello</div>
HTML;
file_put_contents('test_gradient.html', $html);
