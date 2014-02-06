<?php

/**
 * Feedback form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Index_Form_SearchTires extends Core_Form
{
    /**
     * Form initialization
     *
     * @return void
     */
    public function init()
    {
        $this->setAttrib('class','dl-horizontal');
        $modelProducts = new Products_Model_Product();
        $modelProductsTable = new Products_Model_Product_Table();
        $selectTireInfo = $modelProductsTable->select()->setIntegrityCheck(false)
            ->from(array('products'), array('name', 'width_tire', 'image_path', 'profile_tire', 'diameter_tire', 'seasonality_tire', 'alias'))
            ->join('product_to_providers', 'product_to_providers.product_id = products.id')
            ->where('category_id=?', '1')
            ->where('count!=?', '0');
//            ->group(array('product_to_providers.id'));
        $arrOfProductsInfo = $modelProductsTable->fetchAll($selectTireInfo)->toArray();


        $this->setName('searchTiresForm')->setMethod('post')->setAction('/products/index/search-products');

        $widthTire = new Zend_Form_Element_Select('width_tire');
        $widthTire->setLabel('Width tire')
            ->addDecorators($this->_inputDecorators)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');
        $widthTire->addMultiOption('%', 'All');
        foreach ($arrOfProductsInfo as $productsInfo) {
            $widthTire->addMultiOption($productsInfo['width_tire'], $productsInfo['width_tire']);
        }

        $profileTire = new Zend_Form_Element_Select('profile_tire');
        $profileTire->setLabel('Profile tire')
            ->addDecorators($this->_inputDecorators)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setRequired(true);
        $profileTire->addMultiOption('%', 'All');
        foreach ($arrOfProductsInfo as $productsInfo) {
            $profileTire->addMultiOption($productsInfo['profile_tire'], $productsInfo['profile_tire']);
        }

        $seasonalityTire = new Zend_Form_Element_Select('seasonality_tire');
        $seasonalityTire->setLabel('Seasonality tire')
            ->addDecorators($this->_inputDecorators)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');
        $seasonalityTire->addMultiOption('%', 'All');
        foreach ($arrOfProductsInfo as $productsInfo) {
            $seasonalityTire->addMultiOption($productsInfo['seasonality_tire'], $productsInfo['seasonality_tire']);
        }


        $diameterTire = new Zend_Form_Element_Select('diameter_tire');
        $diameterTire->setLabel('Diameter tire')
            ->addDecorators($this->_inputDecorators)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');
        $diameterTire->addMultiOption('%', 'All');
        foreach ($arrOfProductsInfo as $productsInfo) {
            $diameterTire->addMultiOption($productsInfo['diameter_tire'], $productsInfo['diameter_tire']);
        }

        $category = new Zend_Form_Element_Hidden('category_id');
        $category->addDecorators($this->_inputDecorators)
            ->setValue(Products_Model_Product::CATEGORY_TIRES_ID);


        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Search');
        $submit->setAttrib('class', 'btn btn-primary');


        $this->addElements(
            array(
                $widthTire,
                $profileTire,
                $diameterTire,
                $seasonalityTire,
                $category,
                $submit
            )
        );

        return $this;
    }
}