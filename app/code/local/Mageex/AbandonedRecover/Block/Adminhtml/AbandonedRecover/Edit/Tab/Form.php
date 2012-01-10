<?php

class Mageex_AbandonedRecover_Block_Adminhtml_AbandonedRecover_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('abandonedrecover_form', array('legend'=>Mage::helper('abandonedrecover')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('abandonedrecover')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('abandonedrecover')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('abandonedrecover')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('abandonedrecover')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('abandonedrecover')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('abandonedrecover')->__('Content'),
          'title'     => Mage::helper('abandonedrecover')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getAbandonedRecoverData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getAbandonedRecoverData());
          Mage::getSingleton('adminhtml/session')->setAbandonedRecoverData(null);
      } elseif ( Mage::registry('abandonedrecover_data') ) {
          $form->setValues(Mage::registry('abandonedrecover_data')->getData());
      }
      return parent::_prepareForm();
  }
}