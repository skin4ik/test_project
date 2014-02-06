<?php

/**
 * Create user form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Brands_Form_Brand_Create extends Core_Form
{
    /**
     * Form initialization
     *
     * @return Brands_Form_Brand_Create
     */
    public function init()
    {
        $this->setName('brandForm')->setMethod('post');

        $this->addElement($this->_brand_name());
        $this->addElement($this->_category_id());
        $this->addElement($this->_brand_description());
        $this->addElement($this->_updated());
        $this->addElement($this->_submit());

        return $this;
    }

    protected function _brand_name()
    {
        $element = new Zend_Form_Element_Text('brand_name');
        $element->setLabel('Brand name')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');


        return $element;
    }
    protected function _category_id()
    {
        $element = new Zend_Form_Element_Select('category_id');
        $element->setLabel('Category of brand')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');
        $element->addMultiOption('1','Tires');
        $element->addMultiOption('2','Discs');

        return $element;
    }

    protected function _brand_description()
    {
        $element = new Zend_Form_Element_Textarea('brand_description');
        $element->setLabel('Brand description')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _updated()
    {
        $element = new Zend_Form_Element_Hidden('updated');

        return $element;
    }

}