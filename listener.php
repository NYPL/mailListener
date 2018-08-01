<?php
require __DIR__ . '/vendor/autoload.php';

use NYPL\Starter\Config;
use NYPL\Services\MailListener;
use NYPL\Starter\APILogger;
use NYPL\Starter\Listener\ListenerResult;

try {
    Config::initialize(__DIR__ . '/config');

    $mailListener = new MailListener();

    $mailListener->process($mailListener->getKinesisEvents());
} catch (\Throwable $exception) {
    $message = 'Uncaught exception: ' . $exception->getMessage();

    APILogger::addError($message, $exception);

    echo json_encode(
        new ListenerResult(
            false,
            $message
        )
    );
}
