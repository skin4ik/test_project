<?php

/**
 * Feedback form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Products_Form_Product extends Core_Form
{
    /**
     * Form initialization
     *
     * @return void
     */
    public function init()
    {
        $this->setName('userProductForm');

        $username = new Zend_Form_Element_Text('login');
        $username->setLabel('User name')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('Alnum');

        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->setValue(null)
            ->addValidator('StringLength', false, array(6))
            ->addValidator('EmailAddress');

        $textarea = new Zend_Form_Element_Textarea('textarea');
        $textarea->setLabel('Message')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Send');
        $submit->setAttrib('class', 'btn btn-primary');

        $this->addElements(
            array(
                $username,
                $email,
                $textarea,
                $submit
            )
        );

        return $this;
    }
}