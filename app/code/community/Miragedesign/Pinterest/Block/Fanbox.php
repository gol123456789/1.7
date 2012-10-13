<?php
/**
 * Miragedesign Web Development
 *
 * @category    Miragedesign
 * @package     Miragedesign_Pinterest
 * @copyright   Copyright (c) 2011 Mirage Design (http://miragedesign.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */ 
require_once (Mage::getModuleDir('', 'Miragedesign_Pinterest') . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR . 'PinterestApi.php');

class Miragedesign_Pinterest_Block_Fanbox extends Miragedesign_Pinterest_Block_Base
{	
	protected $_isFanboxEnabled;
	protected $_fanboxPosition;
	protected $_pinterestUsername;
	protected $_followerMaximumNumber;
	protected $_followerThumbnailWidth;
	protected $_followerThumbnailHeight;
	protected $_isPinterestButtonEnabled;
	protected $_pinterestImageSrc;
	protected $_pinterestImageAlt;
	
    /**
     * Constructor
     * Set up private variables
     */
    protected function _construct()
    {
		parent::_construct();	    	
    	
        if ($this->getIsEnabled()) {		
        	$this->_isFanboxEnabled = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/enable_fanbox');
        	$this->_fanboxPosition = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/fanbox_position');
        	$this->_fanboxTitle = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/fanbox_title');
        	$this->_pinterestUsername = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/pinterest_username');
        	$this->_followerMaximumNumber = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/pinterest_followers_number');
        	$this->_followerThumbnailWidth = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/pinterest_thumbnail_width');
        	$this->_followerThumbnailHeight = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/pinterest_thumbnail_height');
        	$this->_isPinterestButtonEnabled = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/pinterest_button_enable');
        	$this->_pinterestImageSrc = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/pinterest_follow_button');
        	$this->_pinterestImageAlt = Mage::getStoreConfig('miragedesign_pinterest/fanbox_option/pinterest_button_alt');        	
        }   
    }	
	
	protected function getFanboxPosition() {
		return $this->_fanboxPosition;
	}

	protected function getFanboxTitle() {
		return $this->_fanboxTitle;
	}
		
	protected function getPinterestUsername() {
		return $this->_pinterestUsername;
	}
	
	protected function getPinterestBoardSlug() {
		return $this->_pinterestBoardSlug;
	}
	
	protected function getFollowerMaximumNumber() {
		return $this->_followerMaximumNumber;
	}
	
	protected function getFollowerThumbnailWidth() {
		return $this->_followerThumbnailWidth;
	}

	protected function getFollowerThumbnailHeight() {
		return $this->_followerThumbnailHeight;
	}
		
	protected function getIsFanboxEnabled() {
		return (($this->_isFanboxEnabled) && ($this->getPinterestUsername() != ''));		
	}

	protected function getIsPinterestButtonEnabled() {
		return $this->_isPinterestButtonEnabled;
	}
		
	protected function getPinterestImageSrc() {
		return $this->_pinterestImageSrc;
	}
		
	protected function getPinterestImageAlt() {
		return $this->_pinterestImageAlt;		
	}		
	
	public function getUserUrl($username = '') {
		if ($username)
			return PinterestApi::getUserUrl($username);
		else {
			if ($this->_pinterestUsername) {
				return PinterestApi::getUserUrl($this->_pinterestUsername);
			}
		}
		
		return PinterestApi::PINTEREST_UNSECURE_URL;		
	}
		
	public function getUserInfo($username = '') {
		$username = ($username) ? $username : $this->_pinterestUsername;

		$objPApi = new PinterestApi();
		$data = null;
		
		if ($username) {
			$data = $objPApi->getUserInfo($username);			
		}
		
		return $data;
	}
	 
	public function getFollowersOf($username = '', $maxiumNumber = 0, $page = 1) {
		$maxiumNumber = ($maxiumNumber) ? $maxiumNumber : $this->_followerMaximumNumber;		
		$username = ($username) ? $username : $this->_pinterestUsername; 

		$params = array('limit' => $maxiumNumber,
           				'page' => $page);

		$objPApi = new PinterestApi();
		$data = null;	

		if ($username) {
			$data = $objPApi->getFollowersOf($username, $params);			
		}
		
		return $data;
	}
}
?>