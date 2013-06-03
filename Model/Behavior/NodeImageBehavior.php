<?php
App::uses('ModelBehavior', 'Model');

class NodeImageBehavior extends ModelBehavior {

/**
 * Setup
 *
 * @param Model $model
 * @param array $config
 * @return void
 */
	public function setup(Model $model, $config = array()) {
		
            $model->hasMany['NodeImage'] = array(
                'className' => 'NodeImages.NodeImage',
                'foreignKey' => 'node_id',
                'conditions' => array(),
                'dependent' => true,
		'order' => 'NodeImage.lft',
            );
	}

}
