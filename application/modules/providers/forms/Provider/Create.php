<?php

/**
 * Create user form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Providers_Form_Provider_Create extends Core_Form
{
    /**
     * Form initialization
     *
     * @return Providers_Form_Provider_Create
     */
    public function init()
    {
        $this->setName('ProviderForm')->setMethod('post');

        $this->addElement($this->_provider_name());
        $this->addElement($this->_provider_alias());
        $this->addElement($this->_provider_adress());
        $this->addElement($this->_provider_coefficient());
        $this->addElement($this->_provider_work_time());
        $this->addElement($this->_provider_telephone());
        $this->addElement($this->_updated());
        $this->addElement($this->_submit());


        return $this;
    }

    protected function _provider_name()
    {
        $element = new Zend_Form_Element_Text('name');
        $element->setLabel('Name')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');


        return $element;
    }

    protected function _provider_alias()
    {
        $element = new Zend_Form_Element_Text('alias');
        $element->setLabel('Alias')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _provider_adress()
    {
        $element = new Zend_Form_Element_Text('adress');
        $element->setLabel('Adress')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _provider_coefficient()
    {
        $element = new Zend_Form_Element_Text('coefficient');
        $element->setLabel('Coefficient')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _provider_work_time()
    {
        $element = new Zend_Form_Element_Text('working_hours');
        $element->setLabel('Working hours')
            ->addDecorators($this->_inputDecorators)
            ->setRequired(true)
            ->addFilter('StringTrim');

        return $element;
    }

    protected function _provider_telephone()
    {
        $element = new Zend_Form_Element_Text('telephone');
        $element->setLabel('Telephone')
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