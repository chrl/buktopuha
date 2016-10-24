<?php
namespace Chrl\AppBundle;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use TelegramBot\Api\BotApi;

class BuktopuhaBotApi extends BotApi implements ContainerAwareInterface
{

	public $container;
	public $token;

	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
		$token = $this->container->getParameter('buktopuha.config');

		parent::__construct($token);
	}
	
    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}
