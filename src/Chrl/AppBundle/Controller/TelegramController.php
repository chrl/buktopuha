<?php
/**
 * Buktopuha - Telegram bot for russian trivia game
 *
 * PHP Version 5
 *
 * @category Symfony
 * @package  Chrl_Buktopuha
 * @author   Kirill Kholodilin <charlie@chrl.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://take2.ru/
 */
namespace Chrl\AppBundle\Controller;

use Chrl\AppBundle\Type\Update;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Telegram controller - shows homepage and status
 *
 * @category Symfony
 * @package  Chrl_Buktopuha
 * @author   Kirill Kholodilin <charlie@chrl.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html MIT
 * @link     https://take2.ru/
 */
class TelegramController extends Controller
{

    public function setupWebhookAction($secret)
    {
        $api = $this->get("buktopuha.telegram_bot_api");
        $config = $this->getParameter("buktopuha.config");

        if (empty($config['webhook']['domain'])) {
            throw new Exception("buktopuha.webhook.domain' is not set in config.yml", 0);
        }
        $url = "https://" . $config['webhook']['domain'] . $config['webhook']['path_prefix'] . "/telegram-bot/update";
        if (null !== $secret) {
            $url .= "/" . $secret;
        }
        $res = $api->setwebhook($url);
        return new JsonResponse([
            'ok' => $res,
            'url' => $url
        ]);
    }

    public function updateAction($secret, Request $request)
    {
        $data0 = $request->getContent();

        $data = json_decode($data0);

        $api = $this->get("buktopuha.telegram_bot_api");
        $config = $this->getParameter("buktopuha.config");

        if (empty($config['webhook']['update_receiver'])) {
            throw new Exception("'webhook.update_receiver' is not valud service name", 0);
        }

        $updateReceiver = $this->getUpdateReceiverService($config['webhook']['update_receiver']);

        $update = new Update($data);

        $updateReceiver->handleUpdate($update);

        return new JsonResponse([
            'ok' => true
        ]);
    }

    /**
     *
     * @return UpdateReceiverInterface
     */
    protected function getUpdateReceiverService($serviceName)
    {
        return $this->container
            ->get($serviceName);
    }
}
