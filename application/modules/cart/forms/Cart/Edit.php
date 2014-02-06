<?php

/**
 * Edit user form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 *
 * @version  $Id: Edit.php 47 2010-02-12 13:17:34Z AntonShevchuk $
 */
class Cart_Form_Cart_Edit extends Core_Form
{
    /**
     * Form initialization
     *
     */
    public function init()
    {


        $this->setName('requestForm')->setMethod('post');

        $this->addElement($this->_request());

        $this->addElement($this->_username());

        $this->addElement($this->_telephone());

        $this->addElement($this->_status());

        $this->addElement($this->_submit());

        return $this;
    }

    /**
     * Create user username element
     *
     * @return Zend_Form_Element_Text
     */
    protected function _username()
    {
        $element = new Zend_Form_Element_Text('username');
        $element->setLabel('Username')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _request()
    {
        $element = new Zend_Form_Element_Text('request_id');
        $element->setLabel('Request id')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _telephone()
    {
        $element = new Zend_Form_Element_Text('telephone');
        $element->setLabel('Telephone')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _status()
    {
        $element = new Zend_Form_Element_Select('status');
        $element->setLabel('Status')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');
        $element->addMultiOption('incomplete', 'Incomplete')
            ->addMultiOption('complete', 'Complete');

        return $element;
    }


}