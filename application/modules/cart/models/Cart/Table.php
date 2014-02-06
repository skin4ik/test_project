<?php
/**
 * This is the DbTable class for the users table.
 *
 * @category Application
 * @package Model
 * @subpackage DbTable
 */
class Cart_Model_Cart_Table extends Core_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'requests_to_purchase';

    /** Primary Key */
    protected $_primary = 'request_id';

    /** Row Class */
    protected $_rowClass = 'Cart_Model_Cart';
}