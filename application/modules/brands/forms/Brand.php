<?php

/**
 * Feedback form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Brands_Form_Brand extends Core_Form
{
    /**
     * Form initialization
     *
     * @return void
     */
    public function init()
    {

        $this->setName('brandForm');

        $brandname = new Zend_Form_Element_Text('brand_name');
        $brandname->setLabel('Brand name')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('Alnum');


        $description = new Zend_Form_Element_Textarea('brand_description');
        $description->setLabel('Description')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->setValue(null)
            ->addValidator('StringLength', false, array(6));



        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Send');
        $submit->setAttrib('class', 'btn btn-primary');


        $this->addElements(
            array(
                $brandname,
                $description,
                $submit
            )
        );

        return $this;
    }
}