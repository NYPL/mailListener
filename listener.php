<?php
require __DIR__ . '/vendor/autoload.php';

use NYPL\Starter\Config;
use NYPL\Services\MailListener;
use NYPL\Starter\Listener\ListenerEvents\KinesisEvents;

Config::initialize(__DIR__);

$listener = new MailListener();

$listener->process(
    new KinesisEvents(),
    'Patron'
);
