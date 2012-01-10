<?php

class Mageex_AbandonedRecover_Block_Adminhtml_AbandonedRecover_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'abandonedrecover';
        $this->_controller = 'adminhtml_abandonedrecover';
        
        $this->_updateButton('save', 'label', Mage::helper('abandonedrecover')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('abandonedrecover')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('abandonedrecover_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'abandonedrecover_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'abandonedrecover_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('abandonedrecover_data') && Mage::registry('abandonedrecover_data')->getId() ) {
            return Mage::helper('abandonedrecover')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('abandonedrecover_data')->getTitle()));
        } else {
            return Mage::helper('abandonedrecover')->__('Add Item');
        }
    }
}