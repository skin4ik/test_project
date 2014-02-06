<?php

/**
 * User entity Model
 *
 * @todo http://www.zimuel.it/blog/?p=86
 * @category Application
 * @package Model
 */
class Index_Model_Category extends Core_Db_Table_Row_Abstract
{
    public function getCategories()
    {
        $select = $this->getTable()->select()
            ->from(array('categories_products'), array('category_name', 'category_alias'));
        $arrCategories = $this->getTable()->fetchAll($select)->toArray();
        if (count($arrCategories)) {
            return $arrCategories;
        } else return false;
    }
}