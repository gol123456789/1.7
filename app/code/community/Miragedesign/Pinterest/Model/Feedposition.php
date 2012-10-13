<?php
/**
 * Miragedesign Web Development
 *
 * @category    Miragedesign
 * @package     Miragedesign_Pinterest
 * @copyright   Copyright (c) 2011 Mirage Design (http://miragedesign.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */ 
class Miragedesign_Pinterest_Model_Feedposition
{
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label' => Mage::helper('pinterest')->__('Left')),
            array('value' => 2, 'label' => Mage::helper('pinterest')->__('Right')),
            //array('value' => 0, 'label' => Mage::helper('pinterest')->__('Custom Position')),                  
        );
    }
}
?>