<?php

/**
 * Created by PhpStorm.
 * User: i.mischenko
 * Date: 1/21/14
 * Time: 11:22 AM
 */
class Cart_IndexController extends Core_Controller_Action
{
    /**
     * Init controller plugins
     */
    public function init()
    {
        /* Initialize action controller here */
        parent::init();
        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->_manager = new Cart_Model_Cart_Manager();
    }

    /**
     * Feedback page
     *
     * @return void
     */
    public function indexAction()
    {
        $modelCart = new Cart_Model_Cart();
        $arrProductsFromCart = $modelCart->getProductsFromCart();
        $contactsForm = new Cart_Form_Cart;
        $this->view->assign('contactsForm', $contactsForm);
        $this->view->assign('arrProductsFromCart', $arrProductsFromCart);
    }

    public function saveAction()
    {
        $_SESSION['id'][$this->getRequest()->getParam('productId')] = $this->getRequest()->getParam('productId');
    }

    public function removeAction()
    {

        if ($this->getRequest()->getPost('removeAll') == 'false') {
            foreach ($_SESSION['id'] as $id) {
                if ($id == $this->getRequest()->getParam('productId')) {
                    unset($_SESSION['id'][$id]);
                }
            }
        } else {
            unset($_SESSION['id']);
        }
    }

    public function sendAction()
    {
        $message = "";
        $contactsForm = new Cart_Form_Cart;
        $modelCart = new Cart_Model_Cart();
        if ($this->_request->isPost()) {
            if ($contactsForm->isValid($this->_getAllParams())) {
                $data = $this->_request->getParams();
                $modelCart->saveRequestToPurchase($_SESSION['id'], $data);
                $message = "Your request has been sent successfully!";
                $this->view->messages = $message;
            }
        }
    }
}
