<?php
require __DIR__ . '/vendor/autoload.php';

use NYPL\Starter\Config;
use NYPL\Services\MailListener;
use NYPL\Starter\Listener\ListenerEvents\KinesisEvents;

Config::initialize(__DIR__ . '/config');

$listener = new MailListener();

if (true) {
  const streamName = 'Patron';
} else {
  const streamName = 'New Patron';
}

$listener->process(
    new KinesisEvents(),
    const streamName
);
