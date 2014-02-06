<?php

/**
 * Created by PhpStorm.
 * User: i.mischenko
 * Date: 1/21/14
 * Time: 11:22 AM
 */
class Feedbacks_IndexController extends Core_Controller_Action
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
     * Feedback page
     *
     * @return void
     */
    public function indexAction()
    {

        $form = new Feedbacks_Form_Feedback();
        $message = "";
        $feedbackObj1 = new Feedbacks_Model_Feedback_Manager();
        $showFeedback = $feedbackObj1->showFeedback();

        if ($this->_request->isPost()) {
            if ($form->isValid($this->_getAllParams())) {
                $data = $this->_request->getParams();
                $feedbackObj = new Feedbacks_Model_Feedback_Manager();
                $feedbackObj->saveFeedback($data);
                $message = "Successful :)";
            } else {
                $message = "I'm so sorry lol :)";
            }
        }

        $this->view->messages = $message;
        $this->view->assign("feedbacks", $showFeedback);
        $this->view->assign("form", $form);


    }
}
