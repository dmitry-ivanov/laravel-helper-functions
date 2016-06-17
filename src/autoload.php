<?php

$files = glob(__DIR__ . '/*');
foreach ($files as $file) {
    require_once $file;
}
