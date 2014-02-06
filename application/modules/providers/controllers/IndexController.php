<?php

/**
 * Created by PhpStorm.
 * User: i.mischenko
 * Date: 1/21/14
 * Time: 11:22 AM
 */
class Providers_IndexController extends Core_Controller_Action
{
    /**
     * Init controller plugins
     */
    public function init()
    {
        /* Initialize action controller here */
        parent::init();
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->_manager = new Feedbacks_Model_Feedback_Manager();
    }

    /**
     *
     * @return void
     */
    public function indexAction()
    {

    }
}
