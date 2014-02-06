<?php

/**
 * Create user form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Products_Form_Disc_Create extends Core_Form
{
    public $arrOfBrandNamesArrays;
    /**
     * Form initialization
     *
     * @return Products_Form_Product_Create
     */
    public function init()
    {
        $modelBrandsTable = new Brands_Model_Brand_Table();
        $select = $modelBrandsTable->select()
            ->from(array('brands'), array('brand_name', 'id'))
            ->where('category_id = ?', Products_Model_Product::CATEGORY_DISCS_ID);
        $this->arrOfBrandNamesArrays = $modelBrandsTable->fetchAll($select)->toArray();

        $this->setName('productForm')->setMethod('post');

        $this->addElement($this->_id());
        $this->addElement($this->_category_id());
        $this->addElement($this->_image());
        $this->addElement($this->_diameter_disc());
        $this->addElement($this->_type_disc());
        $this->addElement($this->_width_disc());
        $this->addElement($this->_pcd_disc());
        $this->addElement($this->_et_disc());
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
        $element->setValue('2');


        return $element;
    }

    protected function _image()
    {
        $element = new Zend_Form_Element_File('upload_image');
        $element->setLabel('Image')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');


        return $element;
    }


    protected function _diameter_disc()
    {
        $element = new Zend_Form_Element_Text('diameter_disc');
        $element->setLabel('Diameter disc')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _type_disc()
    {
        $element = new Zend_Form_Element_Select('type_disc');
        $element->setLabel('Type disc')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');
        $element->addMultiOption('кованные', 'Кованные');
        $element->addMultiOption('легкосплавные', 'Легкосплавные');
        $element->addMultiOption('стальные', 'Стальные');

        return $element;
    }

    protected function _width_disc()
    {
        $element = new Zend_Form_Element_Text('width_disc');
        $element->setLabel('Width disc')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _pcd_disc()
    {
        $element = new Zend_Form_Element_Text('pcd_disc');
        $element->setLabel('PCD disc')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _et_disc()
    {
        $element = new Zend_Form_Element_Text('et_disc');
        $element->setLabel('ET disc')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _brand()
    {
        $element = new Zend_Form_Element_Select('brand_id');
        $element->setLabel('Brand')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');
        foreach ($this->arrOfBrandNamesArrays as $arrBrandInfo) {

            $element->addMultiOption($arrBrandInfo['id']."/".$arrBrandInfo['brand_name'], $arrBrandInfo['brand_name']);
        }
        return $element;

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