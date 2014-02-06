<?php
/**
 * This is the DbTable class for the users table.
 *
 * @category Application
 * @package Model
 * @subpackage DbTable
 */
class Index_Model_Category_Table extends Core_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'categories_products';
    
    /** Primary Key */
    protected $_primary = 'id';
    
    /** Row Class */
    protected $_rowClass = 'Index_Model_Category';
}