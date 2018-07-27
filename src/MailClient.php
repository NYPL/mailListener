<?php
namespace NYPL\Services;

use Aws\Ses\SesClient;
use NYPL\Services\Model\DataModel\StreamData;
use NYPL\Services\Model\DataModel\StreamData\Patron\Patron;
use NYPL\Services\Model\DataModel\StreamData\NewPatron\NewPatron;
use NYPL\Services\Model\Email\MyLibraryNycEmail;
use NYPL\Services\Model\Email\PatronEmail;
use NYPL\Starter\APIException;
use NYPL\Starter\APILogger;
use NYPL\Starter\Config;

const EDUCATOR_PATRON_TYPES = array(149, 151);

class MailClient
{
    /**
     * @var \Twig_Environment
     */
    protected static $twig;

    /**
     * @var StreamData
     */
    protected $streamData;

    /**
     * @var SesClient
     */
    protected $client;

    /**
     * @param StreamData $streamData
     */
    public function __construct(StreamData $streamData)
    {
        $this->setStreamData($streamData);
    }

    /**
     * @return bool
     * @throws APIException
     */
    public function sendEmail()
    {
        $streamData = $this->getStreamData();

        if ($streamData instanceof Patron) {
            APILogger::addDebug('Sending email using Patron object');

            $email = new PatronEmail($streamData);
        }

        if ($streamData instanceof NewPatron && in_array($streamData->patronType, EDUCATOR_PATRON_TYPES)) {
            APILogger::addDebug('Sending email using NewPatron object');

            $email = new MyLibraryNycEmail($streamData);
        }

        if (!isset($email)) {
            APILogger::addDebug('No email will be sent for ' . get_class($streamData) . ' class');

            return false;
        }

        if (!$email->getToAddress()) {
            APILogger::addNotice('No email address specified');
            return false;
        }

        APILogger::addInfo('Sending email to: ' . $email->getToAddress());

        $bccAddresses = $email->getBccAddress() ? [$email->getBccAddress()] : [];

        try {
            $this->getClient()->sendEmail(
                [
                'Destination' => [
                    'ToAddresses' => [
                        $email->getToAddress()
                    ],
                    'BccAddresses' => $bccAddresses,
                ],
                'Message' => [
                    'Body' => [
                        'Html' => [
                            'Charset' => 'utf-8',
                            'Data' => $email->getBody(),
                        ]
                    ],
                    'Subject' => [
                        'Charset' => 'utf-8',
                        'Data' => $email->getSubject(),
                    ],
                ],
                'Source' => $email->getFromAddress()
                ]
            );
        } catch (\Exception $exception) {
            throw new APIException('Error sending mail: ' . $exception->getMessage());
        }

        return true;
    }

    /**
     *
     * @return StreamData
     */
    public function getStreamData()
    {
        return $this->streamData;
    }

    /**
     *
     * @param StreamData $streamData
     */
    public function setStreamData($streamData)
    {
        $this->streamData = $streamData;
    }

    /**
     *
     * @throws APIException|\InvalidArgumentException|APIException
     * @return SesClient
     */
    public function getClient()
    {
        if (!$this->client) {
            $this->setClient(
                new SesClient(
                    [
                        'version' => 'latest',
                        'region'  => Config::get('AWS_REGION'),
                        'credentials' => [
                            'key' => Config::get('AWS_ACCESS_KEY_ID'),
                            'secret' => Config::get('AWS_SECRET_ACCESS_KEY'),
                            'token' => Config::get('AWS_SESSION_TOKEN')
                        ]
                    ]
                )
            );
        }

        return $this->client;
    }

    /**
     *
     * @param SesClient $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }
}
