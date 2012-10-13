<?php
/**
 * Miragedesign Web Development
 *
 * @category    Miragedesign
 * @package     Miragedesign_Pinterest
 * @copyright   Copyright (c) 2011 Mirage Design (http://miragedesign.net)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */ 
class Miragedesign_Pinterest_Block_Button extends Miragedesign_Pinterest_Block_Base
{	
	const DEFAULT_IMAGE_WIDTH = 300;
	const DEFAULT_PRICE_DECISION = 2;
	
	protected $_product;
	protected $_productUrl;
	protected $_productPrice;
	protected $_productImage;
	protected $_productDescription;
	protected $_pinterestCount;
	
    /**
     * Constructor
     * Set up private variables
     */
    protected function _construct()
    {
		parent::_construct();	    	
    	
        if ($this->getIsEnabled()) {		
			$currencySymbol = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
			$priceConfig = Mage::getStoreConfig('miragedesign_pinterest/configuration/pinterest_price');
			$priceDecision = Mage::getStoreConfig('miragedesign_pinterest/configuration/pinterest_price_decision');
			$priceDecision = ($priceDecision) ? self::DEFAULT_PRICE_DECISION : abs((int)$priceDecision); 
			$imageSize = Mage::getStoreConfig('miragedesign_pinterest/configuration/pinterest_image_size');			
			$imageSize = ($imageSize) ? self::DEFAULT_IMAGE_WIDTH : abs((int)$imageSize);			
			
			$this->_pinterestCount = Mage::getStoreConfig('miragedesign_pinterest/configuration/pinterest_count');			
			$this->_product = Mage::registry('current_product');			
			$this->_productPrice = $this->_product->getPrice();
			$this->_productUrl = $this->helper('core/url')->getCurrentUrl();
			$this->_productImage = $this->helper('catalog/image')->init($this->_product, 'image')
									->constrainOnly(TRUE)
									->keepAspectRatio(TRUE)
									->keepFrame(FALSE)
									->resize($imageSize);
			
			if ($this->_product->getAttributeText('manufacturer') == null) {
				$this->_productDescription = $this->helper('catalog/output')->productAttribute($this->_product, $this->_product->getName(), 'name');
			}
			else {
				$this->_productDescription = $this->_product->getAttributeText('manufacturer').' // '.$this->helper('catalog/output')->productAttribute($this->_product, $this->_product->getName(), 'name');
			}
			
			
			if ($priceConfig) {
				if ($priceConfig == 1) {
					$this->_productDescription .= ' - ' . $currencySymbol .number_format($this->_productPrice, $priceDecision);
				}

				if (($priceConfig == 2) && ($this->_product->special_price != 0)) {
					$this->_productDescription .= ' - ' . $currencySymbol . number_format($this->_product->special_price, $priceDecision);
				}				
			}
		}
    }
	
	protected function getProduct() {
		return $this->_product;
	}
	
	protected function getProductUrl() {
		return $this->_productUrl;
	}	
	
	protected function getProductPrice() {
		return $this->_productPrice;
	}
	
	protected function getProductImage() {
		return $this->_productImage;
	}
	
	protected function getProductDescription() {
		return $this->_productDescription;
	}
	
	protected function getPinterestCount() {
		return $this->_pinterestCount;
	}				
}
?>