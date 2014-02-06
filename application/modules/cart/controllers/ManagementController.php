<?php

/**
 * ManagementController for users module
 *
 * @category   Application
 * @package    Users
 * @subpackage Controller
 *
 * @version  $Id: ManagementController.php 124 2010-04-21 16:57:01Z AntonShevchuk $
 */
class Cart_ManagementController extends Core_Controller_Action_Crud
{

    public function editAction()
    {
        parent::editAction();
    }

    public function moreAction()
    {
        $requestId = $this->getRequest()->getParam('id');
        $modelCartManager = new Cart_Model_Cart_Manager();

        $arrRequestInfo = $modelCartManager->getRequestInfo($requestId);

        $this->view->assign('arrRequestInfo', $arrRequestInfo);
    }


    public function removeAction()
    {
        $requestId = $this->getRequest()->getParam('id');
        $modelCartManager = new Cart_Model_Cart_Manager();
        $modelCartManager->removeRequest($requestId);
        $this->redirect('/cart/management/index');
    }

    protected function _getSource()
    {
        $select = $this->_getTable()
            ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
            ->setIntegrityCheck(false)
            ->joinLeft('product_to_providers', 'requests_to_purchase.product_id = product_to_providers.id', array('count' => 'COUNT(`price_out`)', 'totalprice' => 'SUM(`price_out`)'))
            ->group('request_id');
        return new Core_Grid_Adapter_Select($select);
    }

    /**
     * Validate form param by ajax
     *
     */
    public function validateAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $table = new Cart_Model_Cart_Table();

        $row = null;
        if ($id = $this->_getParam('id')) {
            $row = $table->getById($id);
        }
        if (!$row) {
            $row = $table->createRow();
            $form = new Cart_Form_Cart_Create();
        } else {
            $form = new Cart_Form_Cart_Edit();
            $form->populate($row->toArray());
        }
        $form->populate($this->_getAllParams());

        if ($field = $this->_getParam('validateField')) {
            $element = $form->getElement($field);
            $response = array(
                'success' => $element->isValid($this->_getParam($field)),
                'message' => $this->view->formErrors($element->getMessages()),
            );
        } else {
            $response = array(
                'success' => $form->isValid($this->_getAllParams()),
                'message' => $this->view->formErrors($form->getMessages()),
            );
        }
        if (APPLICATION_ENV != 'production') {
            $response['params'] = $this->_getAllParams();
        }
        echo $this->_helper->json($response);
    }

    /**
     * get table
     *
     * @return Pages_Model_Page_Table
     */
    protected function _getTable()
    {
        return new Cart_Model_Cart_Table();
    }

    protected function _addMoreColumn()
    {
        $this->_grid->setColumn(
            'More',
            array(
                'name' => 'More',
                'formatter' => array($this, 'moreLinkFormatter'),
                'attribs' => array('width' => '60px')
            )
        );
        return $this;
    }

    public function moreLinkFormatter($value, $row)
    {
        $link = '<a href="%s" class="btn btn-success span1 more">More</a>';
        $url = $this->getHelper('url')->url(
            array(
                'action' => 'more',
                'id' => $row['request_id']
            ),
            'default'
        );

        return sprintf($link, $url);
    }

    protected function _addRemoveColumn()
    {
        $this->_grid->setColumn(
            'Remove',
            array(
                'name' => 'Remove',
                'formatter' => array($this, 'removeLinkFormatter'),
                'attribs' => array('width' => '60px')
            )
        );
        return $this;
    }

    public function removeLinkFormatter($value, $row)
    {
        $link = '<a href="%s" class="btn btn-danger span1 more">Remove</a>';
        $url = $this->getHelper('url')->url(
            array(
                'action' => 'remove',
                'id' => $row['request_id']
            ),
            'default'
        );

        return sprintf($link, $url);
    }

    public function editLinkFormatter($value, $row)
    {
        $link = '<a href="%s" class="btn span1">Edit</a>';
        $url = $this->getHelper('url')->url(
            array(
                'action' => 'edit',
                'id' => $row['request_id']
            ),
            'default'
        );

        return sprintf($link, $url);
    }

    /**
     * get create form
     *
     * @return Pages_Form_Create
     */
    protected function _getCreateForm()
    {
        return new Cart_Form_Cart_Create();
    }

    /**
     * get edit form
     *
     * @return Pages_Form_Edit
     */
    protected function _getEditForm()
    {
        return new Cart_Form_Cart_Edit();
    }

    /**
     * custom grid filters
     *
     * @return void
     */
//    protected function _prepareHeader()
//    {
//        $this->_addCreateButton();
//
//    }

    protected function _prepareGrid()
    {
        $this->_grid->setColumn(
            'request_id',
            array(
                'name' => 'Request id',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'request_id',
                'attribs' => array('width' => '160px')
            )
        );

        $this->_grid->setColumn(
            'username',
            array(
                'name' => 'Username',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'username',
                'attribs' => array('width' => '250px')
            )
        );

        $this->_grid->setColumn(
            'telephone',
            array(
                'name' => 'Telephone',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'telephone',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'count',
            array(
                'name' => 'Count of products',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'count',
                'attribs' => array('width' => '100px')
            )
        );
        $this->_grid->setColumn(
            'totalPrice',
            array(
                'name' => 'Total price',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'totalprice',
                'attribs' => array('width' => '100px')
            )
        );

        $this->_grid->setColumn(
            'status',
            array(
                'name' => 'Status',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'status',
                'attribs' => array('width' => '100px')
            )
        );

        $this->_grid->setColumn(
            'created',
            array(
                'name' => 'Created',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'created',
                'attribs' => array('width' => '100px')
            )
        );
        $this->_addMoreColumn();
        $this->_addEditColumn();
        $this->_addRemoveColumn();

    }
}