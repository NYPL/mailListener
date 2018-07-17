<?php
require __DIR__ . '/vendor/autoload.php';

use NYPL\Starter\Config;
use NYPL\Services\MailListener;
use NYPL\Starter\APILogger;

try {
    Config::initialize(__DIR__ . '/config');

    $mailListener = new MailListener();

    $mailListener->process($mailListener->getKinesisEvents());
} catch (Exception $exception) {
    APILogger::addError('Unable to process stream: ' . $exception->getMessage());
}
