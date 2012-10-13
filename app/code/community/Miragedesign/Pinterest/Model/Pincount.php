<?php
/**
 * Miragedesign Web Development
 *
 * @category    Miragedesign
 * @package     Miragedesign_Pinterest
 * @copyright   Copyright (c) 2011 Mirage Design (http://miragedesign.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */ 
class Miragedesign_Pinterest_Model_Pincount
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'horizontal', 'label' => Mage::helper('pinterest')->__('Horizontal')),
            array('value'=>'vertical', 'label' => Mage::helper('pinterest')->__('Vertical')),
            array('value'=>'none', 'label' => Mage::helper('pinterest')->__('No Count')),                  
        );
    }

}
?>