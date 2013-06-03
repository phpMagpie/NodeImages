<?php
/**
 * NodeImages Plugin Activation
 *
 * @package  Croogo
 * @version  1.5
 * @author   Liam Keily
 */
class NodeImagesActivation {

/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
  public function beforeActivation(&$controller) {
    return true;
  }

/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
  public function onActivation(&$controller) {
    $controller->Croogo->addAco('NodeImage'); 
    $controller->Croogo->addAco('NodeImage/admin_index'); 
    $controller->Croogo->addAco('NodeImage/admin_add'); 
    $controller->Croogo->addAco('NodeImage/admin_remove'); 
    $controller->Croogo->addAco('NodeImage/admin_moveup'); 
    $controller->Croogo->addAco('NodeImage/admin_movedown'); 
    
    $this->_schema('create');
  }

/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
  public function beforeDeactivation(&$controller) {
    return true;
  }

/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
  public function onDeactivation(&$controller) {
    $controller->Croogo->removeAco('NodeImage');
    $this->_schema('drop');
}
		
/**
 * Schema
 *
 * @param string sql action
 * @return void
 * @access protected
 */
	protected function _schema($action = 'create') {
		App::uses('File', 'Utility');
		App::import('Model', 'CakeSchema', false);
		App::import('Model', 'ConnectionManager');
		$db = ConnectionManager::getDataSource('default');
		if(!$db->isConnected()) {
			$this->Session->setFlash(__('Could not connect to database.'), 'default', array('class' => 'error'));
		} else {
			CakePlugin::load('NodeImages'); //is there a better way to do this?
			$schema =& new CakeSchema(array('name'=>'NodeImages', 'plugin'=>'NodeImages'));
			$schema = $schema->load();
			foreach($schema->tables as $table => $fields) {
			  if($action == 'create') {
			  	$sql = $db->createSchema($schema, $table);
			  } else {
  			  $sql = $db->dropSchema($schema, $table);
			  }
				$db->execute($sql);
			}
		}
	}
  
}
