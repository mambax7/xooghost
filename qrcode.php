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
$url = Request::getInt('xooghost_id', 0); //$system->cleanVars($_REQUEST, 'url', '', 'string');
if ('' != $url) {
    $xoops->service('qrcode')->getImgTag('https://xoops.org/', ['alt' => 'QR code', 'title' => 'Xoops.org'])->getValue();
} else {
    $contents = '';
    $size     = getimagesize($xoops->url('/images/blank.gif'));
    $handle   = fopen($xoops->url('/images/blank.gif'), 'rb');
    while (!feof($handle)) {
        $contents .= fread($handle, 1024);
    }
    fclose($handle);
    echo $contents;
}
