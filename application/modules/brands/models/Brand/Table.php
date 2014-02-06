<?php
/**
 * This is the DbTable class for the users table.
 *
 * @category Application
 * @package Model
 * @subpackage DbTable
 */
class Brands_Model_Brand_Table extends Core_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'brands';
    
    /** Primary Key */
    protected $_primary = 'id';
    
    /** Row Class */
    protected $_rowClass = 'Brands_Model_Brand';
}