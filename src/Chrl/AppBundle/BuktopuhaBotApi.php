<?php
namespace Chrl\AppBundle;

use TelegramBot\Api\BotApi;

class BuktopuhaBotApi extends BotApi
{
    public $token;

	public $botName;

    public function __construct($config)
    {
        $this->token = $config['token'];
		$this->botName = $config['bot_name'];
        parent::__construct($this->token);
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

	/**
	 * @return string
	 */
	public function getBotName()
	{
		return $this->botName;
	}
}
