<?php

App::uses('Component', 'Controller');

/**
 * Note Images Component
 *
 * @author Liam Keily
 * @package Croogo.NodeImages.Controller.Component
 */
class NodeImageComponent extends Component {
	
	public function startup(Controller $controller){

		if($controller->action == 'admin_edit' || $controller->action == 'admin_add'){
			$controller->helpers[] = 'NodeImages.NodeImage';
			$controller->helpers[] = 'ElFinder.ElFinder';
			
			Croogo::hookAdminTab('Nodes/admin_add','Images','NodeImages.NodeImage');
			Croogo::hookAdminTab('Nodes/admin_edit','Images','NodeImages.NodeImage');
			
			
			if (!empty($controller->request->data['NodeImage'])) {
			
				foreach ($controller->request->data['NodeImage'] as $uuid => $fields) {
					foreach ($fields as $field => $vals) {
						$controller->Security->unlockedFields[] = 'NodeImage.' . $uuid . '.' . $field;
					}
				}
				
				print_R($controller->Security->unlockedFields);
			
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
