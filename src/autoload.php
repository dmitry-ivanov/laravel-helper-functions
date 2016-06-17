<?php

$helpers = glob('.');
foreach ($helpers as $helper) {
    //require_once $helper;
    var_dump($helper);
}
