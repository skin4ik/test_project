<?php
/**
 * This is the DbTable class for the users table.
 *
 * @category Application
 * @package Model
 * @subpackage DbTable
 */
class Providers_Model_Provider_Table extends Core_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'providers';
    
    /** Primary Key */
    protected $_primary = 'id';
    
    /** Row Class */
    protected $_rowClass = 'Providers_Model_Provider';
}