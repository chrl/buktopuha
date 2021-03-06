<?php
/**
 * Main bundle of the app
 *
 * PHP Version 5
 *
 * @category Symfony
 * @package  Chrl_Buktopuha
 * @author   Kirill Kholodilin <charlie@chrl.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://take2.ru/
 */
namespace Chrl\AppBundle;

use Chrl\AppBundle\DependencyInjection\BuktopuhaExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Bundle class
 *
 * @class    AppBundle
 * @category Symfony
 * @package  Chrl_Buktopuha
 * @author   Kirill Kholodilin <charlie@chrl.ru>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://take2.ru/
 */
class AppBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new BuktopuhaExtension();
    }
}
