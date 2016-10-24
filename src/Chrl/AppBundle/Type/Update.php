<?php

namespace Chrl\AppBundle\Type;

use TelegramBot\Api\Types\Message;

class Update extends Type
{

    /**
     *
     * @var integer
     */
    public $update_id;

    /**
     *
     * @var Message
     */
    public $message;

    public function loadResult(\stdClass $obj)
    {
        parent::loadResult($obj);
    }

}
