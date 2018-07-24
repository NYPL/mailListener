<?php
namespace NYPL\Services;

use NYPL\Services\KinesisEvents\MailKinesisEvents;
use NYPL\Services\KinesisEvents\MailKinesisEvents\PatronEvents;
use NYPL\Services\KinesisEvents\MailKinesisEvents\NewPatronEvents;
use NYPL\Starter\APIException;
use NYPL\Starter\Listener\Listener;
use NYPL\Starter\Listener\ListenerEvents\KinesisEvents;
use NYPL\Starter\Listener\ListenerResult;

class MailListener extends Listener
{
    /**
     * @return MailKinesisEvents
     * @throws APIException
     */
    public function getKinesisEvents()
    {
        $streamName = KinesisEvents::getStreamNameFromPayLoad($this->getPayload());

        if (strpos($streamName, 'Patron') === 0) {
            return new PatronEvents();
        }

        if (strpos($streamName, 'NewPatron') === 0) {
            return new NewPatronEvents();
        }

        throw new APIException('Stream name specified (' . $streamName . ') did not match known stream');
    }

    /**
     * @return ListenerResult
     * @throws \Exception
     */
    protected function processListenerEvents()
    {
        /**
         *
         * @var MailKinesisEvents $listenerEvents
         */
        $listenerEvents = $this->getListenerEvents();

        foreach ($listenerEvents->getEvents() as $listenerEvent) {
            $mailClient = new MailClient(
                $listenerEvents->getStreamData($listenerEvent->getListenerData()->getData())
            );

            $mailClient->sendEmail();
        }

        return new ListenerResult(
            true,
            'Successfully processed ' . count($listenerEvents->getEvents()) . ' record(s)'
        );
    }
}
