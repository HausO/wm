<?php
setlocale(LC_TIME, 'czech');
setlocale(LC_TIME, 'cs_CZ.utf8');

// Uncomment this line if you must temporarily take down your site for maintenance.
// require '.maintenance.php';

$container = require __DIR__ . '/../app/bootstrap.php';

$container->getByType('Nette\Application\Application')->run();
