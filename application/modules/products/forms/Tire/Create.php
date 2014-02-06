<?php

/**
 * Create user form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Products_Form_Tire_Create extends Core_Form
{
    public $arrOfBrandNamesArrays;


    /**
     * Form initialization
     *
     * @return Products_Form_Product_Create
     */
    public function init()
    {
        $this->setAttrib('enctype', 'multipart/form-data');
        $modelBrandsTable = new Brands_Model_Brand_Table();
        $select = $modelBrandsTable->select()
            ->from(array('brands'), array('brand_name', 'id'))
            ->where('category_id = ?', Products_Model_Product::CATEGORY_TIRES_ID);
        $this->arrOfBrandNamesArrays = $modelBrandsTable->fetchAll($select)->toArray();

        $this->setName('productForm')->setMethod('post');

        $this->addElement($this->_id());
        $this->addElement($this->_category_id());
        $this->addElement($this->_image());
        $this->addElement($this->_width_tire());
        $this->addElement($this->_profile_tire());
        $this->addElement($this->_diameter_tire());
        $this->addElement($this->_seasonality_tire());
        $this->addElement($this->_brand());
        $this->addElement($this->_model());
        $this->addElement($this->_submit());

        return $this;
    }

    /**
     * Create category id element
     *
     * @return Zend_Form_Element_Text
     */
    protected function _id()
    {
        $element = new Zend_Form_Element_Hidden('id');

        return $element;
    }


    protected function _category_id()
    {
        $element = new Zend_Form_Element_Hidden('category_id');
        $element->setValue('1');

        return $element;
    }

    protected function _image()
    {
        $element = new Zend_Form_Element_File('upload_image');
        $element->setLabel('Image')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addValidator('Extension', true, 'jpg,jpeg,png,gif')
            ->addValidator('NotEmpty');
        $element->setDestination(UPLOAD_PATH);

        return $element;
    }

    /**
     * Create Width tire element
     *
     * @return Zend_Form_Element_Text
     */
    protected function _width_tire()
    {
        $element = new Zend_Form_Element_Text('width_tire');
        $element->setLabel('Width tire')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    /**
     * Create profile tire element
     *
     * @return Zend_Form_Element_Text
     */
    protected function _profile_tire()
    {
        $element = new Zend_Form_Element_Text('profile_tire');
        $element->setLabel('Profile tire')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _diameter_tire()
    {
        $element = new Zend_Form_Element_Text('diameter_tire');
        $element->setLabel('Diameter tire')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _seasonality_tire()
    {
        $element = new Zend_Form_Element_Select('seasonality_tire');
        $element->setLabel('Seasonality tire')
            ->setRequired(true)
            ->addFilter('StringTrim');
        $element->addMultiOption('летние', 'Летние');
        $element->addMultiOption('зимние', 'Зимние');
        $element->addMultiOption('всесезонные', 'Всесезонные');

        return $element;
    }

    protected function _brand()
    {
        $element = new Zend_Form_Element_Select('brand_id');
        $element->setLabel('Brand')
            ->setRequired(true)
            ->addFilter('StringTrim');
        foreach ($this->arrOfBrandNamesArrays as $arrBrandInfo) {

            $element->addMultiOption($arrBrandInfo['id'] . "/" . $arrBrandInfo['brand_name'], $arrBrandInfo['brand_name']);
        }
        return $element;
    }

    protected function _model()
    {
        $element = new Zend_Form_Element_Text('model');
        $element->setLabel('Model')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _created()
    {
        $element = new Zend_Form_Element_Text('created');
        $element->setLabel('Created')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _updated()
    {
        $element = new Zend_Form_Element_Text('updated');
        $element->setLabel('Updated')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }


}