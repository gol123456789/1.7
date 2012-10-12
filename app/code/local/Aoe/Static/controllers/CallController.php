<?php

/**
 * CallController
 * Renders the block that are requested via an ajax call
 *
 * @author Fabrizio Branca <fabrizio.branca@aoemedia.de>
 */
class Aoe_Static_CallController extends Mage_Core_Controller_Front_Action {



	/**
	 * Index action. This action is called by an ajax request
	 *
	 * @return void
	 * @author Fabrizio Branca <fabrizio.branca@aoemedia.de>
	 */
	public function indexAction() {

		// if (!$this->getRequest()->isXmlHttpRequest()) { Mage::throwException('This is not an XmlHttpRequest'); }

		$response = array();
		$response['sid'] = Mage::getModel('core/session')->getEncryptedSessionId();

		if ($currentProductId = $this->getRequest()->getParam('currentProductId')) {
			Mage::getSingleton('catalog/session')->setLastViewedProductId($currentProductId);
		}

		$this->loadLayout();
		$layout = $this->getLayout();

		$requestedBlockNames = $this->getRequest()->getParam('getBlocks');
		if (is_array($requestedBlockNames)) {
			foreach ($requestedBlockNames as $id => $requestedBlockName) {
				$tmpBlock = $layout->getBlock($requestedBlockName);
				if ($tmpBlock) {
					$response['blocks'][$id] = $tmpBlock->toHtml();
				} else {

                                    $response['blocks'][$id] = 'BLOCK NOT FOUND';
				}
			}
		}
		$this->getResponse()->setBody(Zend_Json::encode($response));
	}


public function storesAction(){
    
    $stores = Mage::getResourceModel('core/store_collection');
    foreach ($stores as $store) {
        echo $store->getName();
        
    }
    $catagories = Mage::getResourceModel('catalog/category_collection')
   ->addfieldtofilter('level',1);
    
foreach ($catagories as $category)
    {
$children = $category->getChildren();
$childid = explode(',',$children);
foreach ($childid as $value) {
    $result = Mage::getModel('catalog/category')->load($value);
    var_dump($result->getName());
}
}
   exit();
}

}