<?php

declare(strict_types = 1);

namespace unreal4u;

use unreal4u\Telegram\Message;
use unreal4u\LinkedData\Contact;
use unreal4u\LinkedData\Group;
use \GuzzleHttp\Client;

class TelegramLog
{
    protected $_contacts = [];

    private $_botToken = '';
    private $_apiUrl = '';

    /**
     * TelegramLog constructor.
     * @param string $botToken
     */
    public function __construct(string $botToken)
    {
        $this->_botToken = $botToken;
        $this->constructApiUrl();
    }

    /**
     * @return TelegramLog
     */
    final private function constructApiUrl(): TelegramLog
    {
        $this->_apiUrl = "https://api.telegram.org/bot" . $this->_botToken;

        return $this;
    }

    private function _composeMessage(string $chatId, string $text): Message
    {
        return new Message([
            'chatId' => $chatId,
            'text' => $text,
        ]);
    }

    private function _sendMessage(Message $message): TelegramLog
    {
        $client = new Client();
        $client->post($this->_apiUrl . '/sendMessage', [
            'form_params' => [
                'chat_id' => $message->chatId,
                'text' => $message->text,
            ]
        ]);

        return $this;
    }

    private function _getData(string $method): \stdClass
    {
        $client = new Client();
        $response = $client->post($this->_apiUrl . '/' . $method);

        return json_decode((string)$response->getBody());
    }

    /**
     * @return \stdClass
     */
    public function getUpdates(): \stdClass
    {
        return $this->_getData('getUpdates');
    }

    /**
     * @return \stdClass
     */
    public function getInformation(): \stdClass
    {
        return $this->_getData('getMe');
    }

    /**
     * @param string $message
     * @param Contact $contact
     * @return TelegramLog
     * @throws \Exception
     */
    public function sendToUser(string $message, Contact $contact): TelegramLog
    {
        return $this->_sendMessage($this->_composeMessage($contact->chatId, $message));
    }

    /**
     * Sends a message to a group
     *
     * @param string $message
     * @param string $groupId
     * @return TelegramLog
     */
    public function broadcast(string $message, Group $group): TelegramLog
    {
        return $this->_sendMessage($this->_composeMessage($group->chatId, $message));
    }
}
