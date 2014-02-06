<?php

/**
 * Created by PhpStorm.
 * User: i.mischenko
 * Date: 1/27/14
 * Time: 11:14 AM
 */
class Products_CategoryDiscsController extends Core_Controller_Action
{
    protected $_itemsPerPage = 5;

    public function indexAction()
    {
        $productsFromCategory = new Products_Model_Product();
        $source = $productsFromCategory->getSelect(Products_Model_Product::CATEGORY_DISCS_ID);
        $paginator = Zend_Paginator::factory($source);
        $paginator->setItemCountPerPage($this->_itemsPerPage);
        $paginator->setCurrentPageNumber($this->_getParam('page'));
        $this->view->paginator = $paginator;
    }
}

