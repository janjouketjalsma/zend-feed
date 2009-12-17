<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Feed_Writer
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */
 
/**
 * @see Zend_Feed_Writer_Extension_RendererAbstract
 */
require_once 'Zend/Feed/Writer/Extension/RendererAbstract.php';
 
/**
 * @category   Zend
 * @package    Zend_Feed_Writer
 * @copyright  Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Feed_Writer_Extension_DublinCore_Renderer_Entry
extends Zend_Feed_Writer_Extension_RendererAbstract
{

    public function render()
    {
        if (strtolower($this->getType()) == 'atom') {
            return;
        }
        $this->_appendNamespaces();
        $this->_setAuthors($this->_dom, $this->_base);
    }
    
    protected function _appendNamespaces()
    {
        $this->getRootElement()->setAttribute('xmlns:dc',
            'http://purl.org/dc/elements/1.1/');  
    }

    protected function _setAuthors(DOMDocument $dom, DOMElement $root)
    {
        $authors = $this->getDataContainer()->getAuthors();
        if (!$authors || empty($authors)) {
            return;
        }
        foreach ($authors as $data) {
            $author = $this->_dom->createElement('dc:creator');
            if (array_key_exists('name', $data)) {
                $author->nodeValue = $data['name'];
                $root->appendChild($author);   
            }
        }
    }

}
