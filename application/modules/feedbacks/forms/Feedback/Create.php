<?php

/**
 * Create user form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Feedbacks_Form_Feedback_Create extends Core_Form
{
    /**
     * Form initialization
     *
     * @return Feedbacks_Form_Feedback_Create
     */
    public function init()
    {
        $this->setName('feedbackForm')->setMethod('post');

        $this->addElement($this->_username());
        $this->addElement($this->_email());
        $this->addElement($this->_message());
        $this->addElement($this->_answer());
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
        $element = new Zend_Form_Element_Text('feedback_username');
        $element->setLabel('Username')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');


        return $element;
    }

    /**
     * Create user email element
     *
     * @return Zend_Form_Element_Text
     */
    protected function _email()
    {
        $element = new Zend_Form_Element_Text('feedback_email');
        $element->setLabel('Email')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim')
            ->addValidator('EmailAddress');

        return $element;
    }

    /**
     * Create user message element
     *
     * @return Zend_Form_Element_Text
     */
    protected function _message()
    {
        $element = new Zend_Form_Element_Textarea('feedback_message');
        $element->setLabel('Message')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }
    protected function _answer()
    {
        $element = new Zend_Form_Element_Textarea('feedback_answer');
        $element->setLabel('Answer')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _status()
    {
        $element = new Zend_Form_Element_Select('feedback_status');
        $element->setLabel('Status')
            ->setRequired(true);

        $element->addMultiOption(Feedbacks_Model_Feedback::STATUS_UNPUBLIC, 'unpublic');
        $element->addMultiOption(Feedbacks_Model_Feedback::STATUS_PUBLIC, 'public');

        return $element;
    }
}