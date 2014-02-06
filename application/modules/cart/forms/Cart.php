<?php

/**
 * Cart form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Cart_Form_Cart extends Core_Form
{
    /**
     * Form initialization
     *
     * @return void
     */
    public function init()
    {

        $this->setName('addContactsForm')->setAction('/cart/index/send')->setMethod('post');

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('First & Last names')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');


        $telephone = new Zend_Form_Element_Text('telephone');
        $telephone->setLabel('Telephone')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addValidator('StringLength');
        $telephone->setRequired(true);


        $submit = new Zend_Form_Element_Submit('submitContactsForm');
        $submit->setLabel('Send');
        $submit->setAttrib('class', 'btn btn-info');


        $this->addElements(
            array(
                $username,
                $telephone,
                $submit
            )
        );

        return $this;
    }
}