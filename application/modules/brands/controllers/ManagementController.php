<?php

/**
 * ManagementController for users module
 *
 * @category   Application
 * @package    Brands
 * @subpackage Controller
 *
 * @version  $Id: ManagementController.php 124 2010-04-21 16:57:01Z AntonShevchuk $
 */
class Brands_ManagementController extends Core_Controller_Action_Crud
{
    /**
     * Add Brand
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

        $table = new Brands_Model_Brand_Table();

        $row = null;
        if ($id = $this->_getParam('id')) {
            $row = $table->getById($id);
        }
        if (!$row) {
            $row = $table->createRow();
            $form = new Brands_Form_Brand_Create();
        } else {
            $form = new Brands_Form_Brand_Edit();
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
        if (APPLICATION_ENV != 'Brandion') {
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
        return new Brands_Model_Brand_Table();
    }

    /**
     * get create form
     *
     * @return Pages_Form_Create
     */
    protected function _getCreateForm()
    {
        return new Brands_Form_Brand_Create();
    }

    /**
     * get edit form
     *
     * @return Pages_Form_Edit
     */
    protected function _getEditForm()
    {
        return new Brands_Form_Brand_Edit();
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

    protected function _prepareGrid()
    {

        $this->_grid->setColumn(
            'brand_name',
            array(
                'name' => 'Brand name',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'brand_name',
                'attribs' => array('width' => '120px')
            )
        );
        $this->_grid->setColumn(
            'brand_description',
            array(
                'name' => 'Brand description',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'brand_description',
                'attribs' => array('width' => '230px')
            )
        );

        $this->_grid->setColumn(
            'created',
            array(
                'name' => 'Created',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'created',
                'attribs' => array('width' => '120px')
            )
        );

        $this->_addEditColumn();
        $this->_addDeleteColumn();
    }

}