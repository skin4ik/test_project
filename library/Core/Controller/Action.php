<?php
/**
 * Copyright (c) 2012 by PHP Team of NIX Solutions Ltd
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Class Core_Controller_Action
 *
 * Controller class for our application
 *
 * @category Core
 * @package  Core_Controller
 *
 * @uses     Zend_Controller_Action
 */
abstract class Core_Controller_Action extends Zend_Controller_Action
{

    /**
     * return translation of messages
     *
     * @param $messageId
     * @param null $locale
     * @return string
     */
    protected function __($messageId, $locale = null)
    {
        if ($translate = Zend_Registry::get(Zend_Application_Resource_Translate::DEFAULT_REGISTRY_KEY)) {
            /* @var Zend_Translate_Adapter $translate */
            return $translate->translate($messageId, $locale);
        } else {
            return $messageId;
        }
    }


    /**
     * _useDashboard
     *
     * set required options for Dashboard controllers
     *
     * @return  Core_Controller_Action
     */
    protected function _useDashboard()
    {
        // change layout
        $this->_helper->layout->setLayout('dashboard/layout');

        return $this;
    }

    /**
     * forward to not found page
     *
     * @param string $error
     * @return void
     */
    protected function _forwardNotFound($error = '')
    {
        $this->_request->setParam('error', $error);
        $this->_forward('notfound', 'error', 'index');
    }

    /**
     * forward to not found page
     *
     * @param $error
     * @return void
     */
    protected function _forwardError($error)
    {
        $this->_request->setParam('error', $error);
        $this->_forward('internal', 'error', 'index');
    }
}
