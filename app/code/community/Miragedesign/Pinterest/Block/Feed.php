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

class Miragedesign_Pinterest_Block_Feed extends Miragedesign_Pinterest_Block_Base
{	
	protected $_isFeedsEnabled;
	protected $_feedsPosition;
	protected $_pinterestUsername;
	protected $_pinterestBoardSlug;
	protected $_pinMaximumNumber;
	protected $_pinThumbnailWidth;
	protected $_pinThumbnailHeight;
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
        	$this->_isFeedsEnabled = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/enable_feeds');
        	$this->_feedsPosition = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/feeds_position');
        	$this->_feedsTitle = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/feeds_title');
        	$this->_pinterestUsername = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/pinterest_username');
        	$this->_pinterestBoardSlug = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/pinterest_board_slug');
        	$this->_pinMaximumNumber = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/pinterest_pins_number');
        	$this->_pinThumbnailWidth = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/pinterest_thumbnail_width');
        	$this->_pinThumbnailHeight = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/pinterest_thumbnail_height');
        	$this->_isPinterestButtonEnabled = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/pinterest_button_enable');
        	$this->_pinterestImageSrc = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/pinterest_follow_button');
        	$this->_pinterestImageAlt = Mage::getStoreConfig('miragedesign_pinterest/feeds_option/pinterest_button_alt');        	
        }   
    }	
	
	protected function getFeedsPosition() {
		return $this->_feedsPosition;
	}

	protected function getFeedsTitle() {
		return $this->_feedsTitle;
	}
		
	protected function getPinterestUsername() {
		return $this->_pinterestUsername;
	}
	
	protected function getPinterestBoardSlug() {
		return $this->_pinterestBoardSlug;
	}
	
	protected function getPinMaximumNumber() {
		return $this->_pinMaximumNumber;
	}
	
	protected function getPinThumbnailWidth() {
		return $this->_pinThumbnailWidth;
	}

	protected function getPinThumbnailHeight() {
		return $this->_pinThumbnailHeight;
	}
		
	protected function getIsFeedEnabled() {
		return $this->_isFeedsEnabled;		
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
		
	public function getPinUrl($pinId) {
		return PinterestApi::getPinUrl($pinId);
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
		
	public function getRecentFeeds($username = '', $board = '', $maxiumNumber = 0, $page = 1) {
		$maxiumNumber = ($maxiumNumber) ? $maxiumNumber : $this->_pinMaximumNumber;		
		$username = ($username) ? $username : $this->_pinterestUsername; 
		$boardSlug = ($board) ? $board : $this->_pinterestBoardSlug;
		$params = array('limit' => $maxiumNumber,
           				'page' => $page);

		$objPApi = new PinterestApi();
		$data = null;
		
		if ($username) {
			if ($boardSlug) {				
				$data = $objPApi->getBoardOf($username, $boardSlug, $params);
			}
			else {
				$data = $objPApi->getPinsOf($username, $params);
			}
		}
		else {
			$data = $objPApi->popular($params);
		}
		
		return $data;
	}
}
?>