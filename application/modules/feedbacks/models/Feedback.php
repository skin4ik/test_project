<?php

/**
 * User entity Model
 *
 * @todo http://www.zimuel.it/blog/?p=86
 * @category Application
 * @package Model
 */
class Feedbacks_Model_Feedback extends Core_Db_Table_Row_Abstract
{

    const STATUS_UNPUBLIC = 'unpublic';
    const STATUS_PUBLIC   = 'public';

    /**
     * Get user name
     *
     * @return string
     */
    public function getName()
    {
        if ($this->lastname || $this->firstname) {
            return $this->firstname . ' ' . $this->lastname;
        }
        return $this->login;
    }

    /**
     * Set row field value
     *
     * @param string $columnName The column key.
     * @param mixed $value The value for the property.
     *
     * @return void
     */
    public function __set($columnName, $value)
    {
        switch ($columnName) {
            case 'username':
                if (!$value) {
                    return;
                }

            case 'email':
                if (!$value) {
                    return;
                }

            case 'message':
                if (!$value) {
                    return;
                }
        }
        parent::__set($columnName, $value);
    }

    /**
     * @see Zend_Db_Table_Row_Abstract::__call()
     *
     * @param $method
     * @param array $args
     * @return mixed
     */
    public function __call($method, array $args)
    {
        if (strpos($method, 'is') === 0) {
            $method = substr($method, 2);
            $method{0} = strtolower($method{0});

            array_unshift($args, $method);

            return call_user_func_array(array($this, 'is'), $args);
        }
        parent::__call($method, $args);
    }


    /**
     * Get row field value
     *
     * @param string $columnName Column Name
     *
     * @return string
     */
    public function __get($columnName)
    {
        switch ($columnName) {
            case 'username':
                $result = parent::__get($columnName);
                break;
            case 'email':
                $result = parent::__get($columnName);
                break;
            case 'message':
            default:
                $result = parent::__get($columnName);
                break;
        }
        return $result;
    }

    /**
     * Changed parent method
     * if $clean == false it return raw data(as is in base)
     * always use $clean true to get data if you can
     *
     * @param bool $clean Flag for cleaning raw data
     *
     * @return array
     */
    public function toArray($clean = false)
    {
        if ($clean) {
            $result = array();
            foreach ($this->_data as $key => $value) {
                $result[$key] = $this->{$key};
            }
            return $result;
        }
        return parent::toArray();
    }

}