<?php

/**
 * ManagementController for users module
 *
 * @category   Application
 * @package    Providers
 * @subpackage Controller
 *
 * @version  $Id: ManagementController.php 124 2010-04-21 16:57:01Z AntonShevchuk $
 */
class Providers_ManagementController extends Core_Controller_Action_Crud
{
    /**
     * Add Provider
     */
    public function editAction()
    {
        parent::editAction();
        $this->render('create');
    }

    /**
     * Validate form param by ajax
     *
     */
    public function validateAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $table = new Providers_Model_Provider_Table();

        $row = null;
        if ($id = $this->_getParam('id')) {
            $row = $table->getById($id);
        }
        if (!$row) {
            $row = $table->createRow();
            $form = new Providers_Form_Provider_Create();
        } else {
            $form = new Providers_Form_Provider_Edit();
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
        if (APPLICATION_ENV != 'Providerion') {
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
        return new Providers_Model_Provider_Table();
    }

    /**
     * get create form
     *
     * @return Pages_Form_Create
     */
    protected function _getCreateForm()
    {
        return new Providers_Form_Provider_Create();
    }

    /**
     * get edit form
     *
     * @return Pages_Form_Edit
     */
    protected function _getEditForm()
    {
        return new Providers_Form_Provider_Edit();
    }

    /**
     * custom grid filters
     *
     * @return void
     */
    protected function _prepareHeader()
    {
        $this->_addCreateButton();

    }

    /**
     *
     */
    protected function _prepareGrid()
    {

        $this->_grid->setColumn(
            'name',
            array(
                'name' => 'Provider name',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'name',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'alias',
            array(
                'name' => 'Provider alias',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'alias',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'adress',
            array(
                'name' => 'Provider adress',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'adress',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'coefficient',
            array(
                'name' => 'Provider coefficient',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'coefficient',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'work_time',
            array(
                'name' => 'Provider working hours',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'working_hours',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'telephone',
            array(
                'name' => 'Provider telephone',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'telephone',
                'attribs' => array('width' => '180px')
            )
        );

        $this->_grid->setColumn(
            'created',
            array(
                'name' => 'Created',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'created',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'updated',
            array(
                'name' => 'Updated',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'updated',
                'attribs' => array('width' => '180px')
            )
        );

        $this->_addEditColumn();
        $this->_addDeleteColumn();
    }

}