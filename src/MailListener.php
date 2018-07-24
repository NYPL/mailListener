<?php
namespace NYPL\Services;

use NYPL\Services\Model\DataModel\StreamData\Patron\Patron;
use NYPL\Services\Model\DataModel\StreamData\NewPatron\NewPatron;
use NYPL\Starter\Listener\Listener;
use NYPL\Starter\Listener\ListenerEvents\KinesisEvents;
use NYPL\Starter\Listener\ListenerResult;

class MailListener extends Listener
{ //ljc
    protected function processListenerEvents()
    {
        /**
         *
         * @var KinesisEvents $listenerEvents
         */
        $listenerEvents = $this->getListenerEvents();

        foreach ($listenerEvents->getEvents() as $listenerEvent) {
            $patron = new Patron($listenerEvent->getListenerData()->getData());

            $mailClient = new MailClient(
                $listenerEvents->getStreamName(),
                $patron
            );

            $mailClient->sendEmail();
        }

        return new ListenerResult(
            true,
            'Successfully processed ' . count($listenerEvents->getEvents()) . ' record(s)'
        );
    }
}
