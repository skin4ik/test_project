<?php

/**
 * This is the DbTable class for the users table.
 *
 * @category Application
 * @package Model
 * @subpackage DbTable
 */
class Products_Model_Product_Table extends Core_Db_Table_Abstract
{
    /** Table name */
    protected $_name = 'products';

    /** Primary Key */
    protected $_primary = 'id';

    /** Row Class */
    protected $_rowClass = 'Products_Model_Product';

}