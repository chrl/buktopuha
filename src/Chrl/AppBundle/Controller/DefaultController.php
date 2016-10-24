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
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Default route controller - shows homepage and status
 *
 * @category Symfony
 * @package  Chrl_Buktopuha
 * @author   Kirill Kholodilin <charlie@chrl.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://take2.ru/
 */
class DefaultController extends Controller
{
    /**
     * Index action -- homepage
     *
     * @param Request $request Request object of the webapp
     *
     * @Route("/", name="homepage", methods={"get"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(
            'default/index.html.twig',
            [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'has_session' => $request->hasSession()
            ]
        );
    }
}
