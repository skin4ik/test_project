<?php
/**
 * Categories_Model_Category
 */
class Categories_Model_Category extends Core_Categories_Row
{
    /**
     * @var string
     */
    const PATH_SEPARATOR = '/';

    /**
     * load all children until $down
     *
     * @param integer|null $down
     * @return self
     */
    public function loadTree($down = null)
    {
        $rowset = $this->getAllChildren($down, 'level DESC');

        $children = array();
        foreach ($rowset as $row) {
            if (isset($children[$row->id])) {
                foreach ($children[$row->id] as $child) {
                    $row->addChild($child);
                }
                unset($children[$row->id]);
            }
            if (!isset($children[$row->parentId])) {
                $children[$row->parentId] = array();
            }
            $children[$row->parentId][] = $row;
        }
        foreach ($children[$this->id] as $child) {
            $this->addChild($child);
        }
        return $this;
    }

    /**
     * Add child
     *
     * @param Core_Categories_Row $row
     * @throws Zend_Db_Table_Row_Exception
     * @return Categories_Model_Category
     */
    public function addChild(Core_Categories_Row $row)
    {
        if (!$this->_children) {
            $data = array(
                'table'    => $this->getTable(),
                'data'     => array(),
                'readOnly' => false,
                'rowClass' => __CLASS__,
                'stored'   => true
            );
            $rowsetClass = $this->getTable()->getRowsetClass();
            $this->_children = new $rowsetClass($data);
        }
        parent::addChild($row);

        return $this;
    }

    /**
     * load all children until $down
     *
     * @param integer $down
     * @param string  $order
     * @param integer $limit
     * @param integer $offset
     * @return Zend_Db_Table_Rowset_Abstract
     */
    public function getAllChildren($down = null, $order = 'path',
        $limit = null, $offset = null)
    {
        $select = $this->select();
        $select->where('path LIKE ?', $this->path . self::PATH_SEPARATOR .'%')
               ->where('level > ?', $this->level);

        if ($order) {
            $select->order($order);
        }
        if ($limit || $offset) {
            $select->limit($limit, $offset);
        }
        if ($down) {
            $select->where('level <= ?', $this->level + $down);
        }
        return $this->getTable()->fetchAll($select);
    }

    /**
     * @see Zend_Db_Table_Row_Abstract::_insert()
     */
    public function _insert()
    {
        if (!$this->alias) {
            $this->alias = str_replace(" ", '-', strtolower($this->title));
        }
        $this->path = $this->alias;
        $this->_update();
    }

    /**
     * @see Zend_Db_Table_Row_Abstract::_update()
     */
    public function _update()
    {
        if (!empty($this->_modifiedFields['parentId'])) {
            if ($this->parentId) {
                if (!$row = $this->getTable()->find($this->parentId)->current()) {
                    throw new Zend_Db_Table_Row_Exception('Parent row not found');
                }
                $this->path = $row->path . self::PATH_SEPARATOR . $this->alias;
                $this->level = $row->level + 1;
            } else {
                $this->path = $this->alias;
                $this->level = 0;
            }
        }
    }
}