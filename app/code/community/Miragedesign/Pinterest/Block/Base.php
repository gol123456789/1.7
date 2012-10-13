<?php
/**
 * Miragedesign Web Development
 *
 * @category    Miragedesign
 * @package     Miragedesign_Pinterest
 * @copyright   Copyright (c) 2011 Mirage Design (http://miragedesign.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */ 
class Miragedesign_Pinterest_Block_Base extends Mage_Core_Block_Template
{	
	protected $_isEnabled;
	protected $_isVerticalScrollbarEnabled;
	
    /**
     * Constructor
     * Set up private variables
     */
    protected function _construct()
    {
    	$this->_isEnabled = Mage::getStoreConfig('miragedesign_pinterest/configuration/pinterest_enabled');
		$this->_isVerticalScrollbarEnabled = Mage::getStoreConfig('miragedesign_pinterest/layout_option/vertical_scrollbar');
    }	
	
	protected function getIsEnabled() {
		return $this->_isEnabled;
	}	
	
	protected function checkFacebookIsEnabled() {
		$isEnabled = Mage::getStoreConfig('miragedesign_pinterest/other_social_config/facebook_enabled');	
		return $isEnabled;
	}
	
	protected function checkTwitterIsEnabled() {
		$isEnabled = Mage::getStoreConfig('miragedesign_pinterest/other_social_config/twitter_enabled');	
		return $isEnabled;
	}	
	
	protected function checkLinkedInIsEnabled() {
		$isEnabled = Mage::getStoreConfig('miragedesign_pinterest/other_social_config/linkedin_enabled');	
		return $isEnabled;
	}	

	protected function checkDiggIsEnabled() {
		$isEnabled = Mage::getStoreConfig('miragedesign_pinterest/other_social_config/digg_enabled');	
		return $isEnabled;
	}	
		
	protected function checkGooglePlusIsEnabled() {
		$isEnabled = Mage::getStoreConfig('miragedesign_pinterest/other_social_config/google_plus_enabled');	
		return $isEnabled;
	}

	protected function getTwitterDataVia() {
		$dataVia = Mage::getStoreConfig('miragedesign_pinterest/other_social_network/pinterest_twitter_account');	
		return $dataVia;
	}

	protected function getFacebookAppID() {
		$dataVia = Mage::getStoreConfig('miragedesign_pinterest/other_social_config/facebook_app_api');	
		return $dataVia;
	}

	protected function getFacebookAdminID() {
		$dataVia = Mage::getStoreConfig('miragedesign_pinterest/other_social_config/facebook_admin_id');	
		return $dataVia;
	}
	
	protected function getIsVerticalScrollbarEnabled() {
		return $this->_isVerticalScrollbarEnabled;
	}		
}
?>