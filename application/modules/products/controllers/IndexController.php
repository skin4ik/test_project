<?php

/**
 * Created by PhpStorm.
 * User: i.mischenko
 * Date: 1/21/14
 * Time: 11:22 AM
 */
class Products_IndexController extends Core_Controller_Action
{
    protected $_itemsPerPage = 20;

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
        $productAlias = $this->_request->getParam("alias");
        $modelProduct = new Products_Model_Product();
        $arrProductInfoArrays = $modelProduct->getProductInfo($productAlias);

        $arrProductInfo = $arrProductInfoArrays['arrProductInfoResult'];
        $arrSimilarProductInfo = $arrProductInfoArrays['arrSimilarProductInfoResult'];

        $this->view->assign('arrSimilarProductInfo', $arrSimilarProductInfo);
        $this->view->assign('arrProductInfo', $arrProductInfo);
    }

    public function searchProductsAction()
    {
        if ($this->_request->isPost()) {
            $data = $this->_request->getParams();
            $modelProduct = new Products_Model_Product();
            $arrFilteredProducts = $modelProduct->getSearchResults($data);
            $paginator = Zend_Paginator::factory($arrFilteredProducts);
            $paginator->setItemCountPerPage($this->_itemsPerPage);
            $paginator->setCurrentPageNumber($this->_getParam('page'));
            $this->view->paginator = $paginator;
        } else {
            $message = "I'm so sorry lol :)";
            $this->view->messages = $message;
        }

    }

}
