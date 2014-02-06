<?php
/**
 * This is the DbTable class for the users table.
 *
 * @category Application
 * @package Model
 * @subpackage DbTable
 */
class Feedbacks_Model_Feedback_Table extends Core_Db_Table_Abstract
{
    /** Table name */
    protected $_name    = 'feedbacks';
    
    /** Primary Key */
    protected $_primary = 'id';
    
    /** Row Class */
    protected $_rowClass = 'Feedbacks_Model_Feedback';
}