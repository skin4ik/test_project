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
class Products_DiscsManagementController extends Core_Controller_Action_Crud
{
    /**
     * Add Product
     */
    public function editAction()
    {
        parent::editAction();
        $this->render('create');
    }

    public function createAction()
    {
        $formTireCreate = new Products_Form_Disc_Create();
        $message = "";
        if ($this->_request->isPost()) {

            if ($formTireCreate->isValid($this->_getAllParams())) {
                $data = $this->_request->getParams();
                $modelProductManager = new Products_Model_Product_Manager();
                $modelProductManager->createDiscs($data);
                $message = "Successful :)";

            } else {
                $message = "I'm so sorry lol :)";
            }
        }
        $this->view->messages = $message;
        $this->view->assign("formTireCreate", $formTireCreate);
    }

    /**
     * Validate form param by ajax
     *
     */
    public function validateAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $table = new Products_Model_Product_Table();

        $row = null;
        if ($id = $this->_getParam('id')) {
            $row = $table->getById($id);
        }
        if (!$row) {
            $row = $table->createRow();
            $form = new Products_Form_Disc_Create();
        } else {
            $form = new Products_Form_Disc_Edit();
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
        return new Products_Model_Product_Table();
    }

    /**
     * get create form
     *
     * @return Pages_Form_Create
     */
    protected function _getCreateForm()
    {
        return new Products_Form_Disc_Create();
    }

    /**
     * get edit form
     *
     * @return Pages_Form_Edit
     */
    protected function _getEditForm()
    {
        return new Products_Form_Disc_Edit();
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

    protected function _getSource()
    {
        $select = $this->_getTable()
            ->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
            ->setIntegrityCheck(false)
            ->where('category_id=?', Products_Model_Product::CATEGORY_DISCS_ID);

        return new Core_Grid_Adapter_Select($select);
    }

    protected function _prepareGrid()
    {
        $this->_grid->setColumn(
            'id',
            array(
                'name' => 'Id',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'id',
                'attribs' => array('width' => '120px')
            )
        );
        $this->_grid->setColumn(
            'name',
            array(
                'name' => 'Name',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'name',
                'attribs' => array('width' => '280px')
            )
        );

        $this->_grid->setColumn(
            'image_path',
            array(
                'name' => 'Image',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'image_path',
                'attribs' => array('width' => '120px'),
                'formatter' => array($this, 'imageFormatter')
            )
        );
        $this->_grid->setColumn(
            'category_id',
            array(
                'name' => 'Category id',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'category_id',
                'attribs' => array('width' => '180px')
            )
        );


        $this->_grid->setColumn(
            'diameter_disc',
            array(
                'name' => 'Diameter disc',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'diameter_disc',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'type_disc',
            array(
                'name' => 'Type disc',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'type_disc',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'width_disc',
            array(
                'name' => 'Width disc',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'width_disc',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'pcd_disc',
            array(
                'name' => 'PCD disc',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'pcd_disc',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'et_disc',
            array(
                'name' => 'ET disc',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'et_disc',
                'attribs' => array('width' => '180px')
            )
        );

        $this->_grid->setColumn(
            'brand_id',
            array(
                'name' => 'Brand_id',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'brand_id',
                'attribs' => array('width' => '180px')
            )
        );
        $this->_grid->setColumn(
            'model',
            array(
                'name' => 'Model',
                'type' => Core_Grid::TYPE_DATA,
                'index' => 'model',
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

    public function imageFormatter($value)
    {
        return "<img src='" . $value . "'>";
    }

}