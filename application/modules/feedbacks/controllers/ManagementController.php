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
class Feedbacks_ManagementController extends Core_Controller_Action_Crud
{
    /**
     * Add feedback
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

        $table = new Feedbacks_Model_Feedback_Table();

        $row = null;
        if ($id = $this->_getParam('id')) {
            $row = $table->getById($id);
        }
        if (!$row) {
            $row = $table->createRow();
            $form = new Feedbacks_Form_Feedback_Create();
        } else {
            $form = new Feedback_Form_Feedback_Edit();
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
        return new Feedbacks_Model_Feedback_Table();
    }

    /**
     * get create form
     *
     * @return Pages_Form_Create
     */
    protected function _getCreateForm()
    {
        return new Feedbacks_Form_Feedback_Create();
    }

    /**
     * get edit form
     *
     * @return Pages_Form_Edit
     */
    protected function _getEditForm()
    {
        return new Feedbacks_Form_Feedback_Edit();
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
            'username',
            array(
                'name' => 'Username',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'feedback_username',
                'attribs' => array('width' => '120px')
            )
        );
        $this->_grid->setColumn(
            'email',
            array(
                'name' => 'Email',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'feedback_email',
                'attribs' => array('width' => '180px'),
                'formatter' => array($this, 'emailFormatter')
            )
        );


        $this->_grid->setColumn(
            'message',
            array(
                'name' => 'Message',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'feedback_message',
                'attribs' => array('width' => '180px')
            )
        );

        $this->_grid->setColumn(
            'answer',
            array(
                'name' => 'Answer',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'feedback_answer',
                'attribs' => array('width' => '180px')
            )
        );

        $this->_grid->setColumn(
            'status',
            array(
                'name' => 'Status',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'feedback_status',
                'attribs' => array('width' => '180px')
            )
        );


        $this->_addEditColumn();
        $this->_addDeleteColumn();
    }

    /**
     * @param $value
     * @param $row
     * @return string
     */
    public function emailFormatter($value, $row)
    {
        return "<a href=\"mailto:$value\" title=\"Send email\">$value</a>";
    }

}