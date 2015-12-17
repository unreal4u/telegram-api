<?php

namespace unreal4u;

class TelegramLog
{
    protected $_contacts = [];

    public function __construct()
    {
        // @TODO
    }

    /**
     * Assigns a contact to our internal object
     *
     * @param Contact $contact
     * @return $this
     */
    public function assignContact(Contact $contact)
    {
        $this->_contacts[] = $contact;
        return $this;
    }

    /**
     * Assign multiple contacts
     *
     * @param array $contacts
     * @return $this
     */
    public function assignContacts(array $contacts = [])
    {
        foreach ($contacts as $contact) {
            $this->assignContact($contact);
        }

        return $this;
    }

    public function sendToUser(string $message, string $userId) {
        return $this;
    }

    public function broadcastToGroup(string $message, string $groupId) {
        return $this;
    }
}
