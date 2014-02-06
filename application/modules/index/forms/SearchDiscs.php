<?php

/**
 * Feedback form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Index_Form_SearchDiscs extends Core_Form
{
    /**
     * Form initialization
     *
     * @return void
     */
    public function init()
    {
        $this->setAttrib('class', 'dl-horizontal');
        $modelProducts = new Products_Model_Product();
        $modelProductsTable = new Products_Model_Product_Table();
        $selectTireInfo = $modelProductsTable->select()->setIntegrityCheck(false)
            ->from(array('products'), array('name', 'diameter_disc', 'image_path', 'width_disc', 'pcd_disc', 'et_disc', 'type_disc', 'alias'))
            ->join('product_to_providers', 'product_to_providers.product_id = products.id')
            ->where('category_id=?', '2')
            ->where('count!=?', '0');
//            ->group(array('product_to_providers.id'));
        $arrOfProductsInfo = $modelProductsTable->fetchAll($selectTireInfo)->toArray();


        $this->setName('searchDiscsForm')->setMethod('post')->setAction('/products/index/search-products');

        $diameterDisc = new Zend_Form_Element_Select('diameter_disc');
        $diameterDisc->setLabel('Disc diameter')
            ->addDecorators($this->_inputDecorators)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');
        $diameterDisc->addMultiOption('%', 'All');
        foreach ($arrOfProductsInfo as $productsInfo) {
            $diameterDisc->addMultiOption($productsInfo['diameter_disc'], $productsInfo['diameter_disc']);
        }

        $widthDisc = new Zend_Form_Element_Select('width_disc');
        $widthDisc->setLabel('Disc width')
            ->addDecorators($this->_inputDecorators)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setRequired(true);
        $widthDisc->addMultiOption('%', 'All');
        foreach ($arrOfProductsInfo as $productsInfo) {
            $widthDisc->addMultiOption($productsInfo['width_disc'], $productsInfo['width_disc']);
        }

        $pcdDisc = new Zend_Form_Element_Select('pcd_disc');
        $pcdDisc->setLabel('PCD disc')
            ->addDecorators($this->_inputDecorators)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');
        $pcdDisc->addMultiOption('%', 'All');
        foreach ($arrOfProductsInfo as $productsInfo) {
            $pcdDisc->addMultiOption($productsInfo['pcd_disc'], $productsInfo['pcd_disc']);
        }


        $etDisc = new Zend_Form_Element_Select('et_disc');
        $etDisc->setLabel('ET disc')
            ->addDecorators($this->_inputDecorators)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');
        $etDisc->addMultiOption('%', 'All');
        foreach ($arrOfProductsInfo as $productsInfo) {
            $etDisc->addMultiOption($productsInfo['et_disc'], $productsInfo['et_disc']);
        }

        $typeDisc = new Zend_Form_Element_Select('type_disc');
        $typeDisc->setLabel('Disc type')
            ->addDecorators($this->_inputDecorators)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');
        $typeDisc->addMultiOption('%', 'All');
        foreach ($arrOfProductsInfo as $productsInfo) {
            $typeDisc->addMultiOption($productsInfo['type_disc'], $productsInfo['type_disc']);
        }

        $category = new Zend_Form_Element_Hidden('category_id');
        $category->addDecorators($this->_inputDecorators)
        ->setValue(Products_Model_Product::CATEGORY_DISCS_ID);


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Search');
        $submit->setAttrib('class', 'btn btn-primary');


        $this->addElements(
            array(
                $diameterDisc,
                $widthDisc,
                $pcdDisc,
                $etDisc,
                $typeDisc,
                $category,
                $submit
            )
        );

        return $this;
    }
}