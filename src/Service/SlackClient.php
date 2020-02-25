<?php


namespace App\Service;


use App\Helper\LoggerTrait;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;


class SlackClient
{
    use LoggerTrait;

    /**
     * @var Client
     */
    private $slack;
    private $logger;

    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('Nouveau message envoyé à Slack', ['message' => $message]);

        $slackMessage = $this->slack->createMessage()
            ->to('#general')
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);
        $this->slack->sendMessage($slackMessage);
    }
}