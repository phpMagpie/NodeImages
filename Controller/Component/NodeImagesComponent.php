<?php

App::uses('Component', 'Controller');

/**
 * NodeImages Component
 *
 * @author Liam Keily
 * @package Croogo.NodeImages.Controller.Component
 */
class NodeImagesComponent extends Component {
	
	public function startup(Controller $controller){

		if($controller->action == 'admin_edit' || $controller->action == 'admin_add'){
			$controller->helpers[] = 'NodeImages.NodeImages';
			$controller->helpers[] = 'ElFinder.ElFinder';
			
			Croogo::hookAdminTab('Nodes/admin_add','Images','NodeImages.NodeImages');
			Croogo::hookAdminTab('Nodes/admin_edit','Images','NodeImages.NodeImages');
			
			
			if (!empty($controller->request->data['NodeImage'])) {
			
				foreach ($controller->request->data['NodeImage'] as $uuid => $fields) {
					foreach ($fields as $field => $vals) {
						$controller->Security->unlockedFields[] = 'NodeImage.' . $uuid . '.' . $field;
					}
				}
				
			}
		}
		
		
	}
	
	public function beforeRender(Controller $controller){
		if($controller->action == 'view'){
			
			$node_id = $controller->viewVars['node']['Node']['id'];
			
			$images = $controller->Node->NodeImage->find('all',array('conditions'=>array('NodeImage.node_id'=>$node_id)));
			
			$controller->set(compact('images'));
		}
	}

}
