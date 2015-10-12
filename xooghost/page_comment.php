<?php
/**
 * Xooghost module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Xooghost
 * @since           2.6.0
 * @author          Laurent JEN (Aka DuGris)
 * @version         $Id$
 */

use Xoops\Core\Request;

include dirname(dirname(__DIR__)) . '/mainfile.php';
include __DIR__ . '/include/functions.php';

XoopsLoad::load('system', 'system');
$system = System::getInstance();

$xooghost_id = Request::getInt('xooghost_id', 0);//$system->cleanVars($_REQUEST, 'xooghost_id', 0, 'int');

$ghostModule  = Xooghost::getInstance();
$ghostConfig  = $ghostModule->loadConfig();
$ghostHandler = $ghostModule->ghostHandler();

$page = $ghostHandler->get($xooghost_id);
$xoops->redirect($ghostHandler->get($xooghost_id)->getVar('xooghost_url') . '?' . $xoops->getEnv('QUERY_STRING'));
