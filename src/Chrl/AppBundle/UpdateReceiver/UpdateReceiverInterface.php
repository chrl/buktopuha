<?php

namespace Chrl\AppBundle\UpdateReceiver;

use Chrl\AppBundle\Type\Update;

interface UpdateReceiverInterface
{
    public function handleUpdate(Update $update);
}
