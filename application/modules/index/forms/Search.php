<?php

/**
 * Feedback form
 *
 * @category Application
 * @package Model
 * @subpackage Form
 */
class Index_Form_Search extends Core_Form
{
    /**
     * Form initialization
     *
     * @return void
     */
    public function init()
    {
        $this->setAttrib('class', 'dl-horizontal');

        $this->setName('searchForm')->setMethod('post')->setAction('/products/index/search-products');

        $targetSearch = new Zend_Form_Element_Text('target_search');
        $targetSearch->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->setAttrib('placeholder', 'Search');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Search');
        $submit->setAttrib('class', 'btn btn-primary');

        $category = new Zend_Form_Element_Hidden('category_id');
        $category->setValue('all');

        $this->addElements(
            array(
                $targetSearch,
                $submit,
                $category

            )
        );

        return $this;
    }
}