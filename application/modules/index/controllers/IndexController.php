<?php

/**
 * @category   Application
 * @package    Index
 * @subpackage Controller
 */
class Index_IndexController extends Core_Controller_Action
{
    public function indexAction()
    {
        $modelCategory = new Index_Model_Category();
        $arrCategories = $modelCategory->getCategories();
        $formSearchTires = new Index_Form_SearchTires();
        $formSearchDiscs = new Index_Form_SearchDiscs();
        $formSearch = new Index_Form_Search();

        $this->view->assign("formSearch", $formSearch);
        $this->view->assign("formSearchTires", $formSearchTires);
        $this->view->assign("formSearchDiscs", $formSearchDiscs);
        $this->view->assign('arrCategories', $arrCategories);
    }

    public function nameAction()
    {
        print_r($this->getRequest()->getParams());
        exit;
    }
}



