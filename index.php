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
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         Xooghost
 * @since           2.6.0
 * @author          Laurent JEN (Aka DuGris)
 */

use Xoops\Core\Request;

include __DIR__ . '/header.php';

$start = Request::getInt('start', 0); //$system->cleanVars($_REQUEST, 'start', 0, 'int');

$pages = $pageHandler->getPublished('published', 'desc', $start, $ghostConfig['xooghost_limit_main']);

$criteria = new \CriteriaCompo();
$criteria->add(new \Criteria('xooghost_online', 1));
$criteria->add(new \Criteria('xooghost_published', 0, '>'));
$criteria->add(new \Criteria('xooghost_published', time(), '<='));

$pages_count = $pageHandler->getCount($criteria);

$xoops->tpl()->assign('pages', $pages);

// Page navigation
$paginate = new \XoopsModules\Xooghost\XooPaginate($pages_count, $ghostConfig['xooghost_limit_main'], $start, 'start', '');

// Metas
$description = [];
foreach ($pages as $k => $page) {
    $description[] = $page['xooghost_title'];
}
$utilities = new \XoopsModules\Xooghost\Utility();
$xoops->theme()->addMeta($type = 'meta', 'description', $utilities->getMetaDescription($description));
$xoops->theme()->addMeta($type = 'meta', 'keywords', $utilities->getMetaKeywords($description));

include __DIR__ . '/footer.php';
