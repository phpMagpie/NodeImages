<?php

App::uses('NodeImagesAppModel', 'NodeImages.Model');

class NodeImage extends NodeImagesAppModel {

  public $actsAs = array('Tree');
 
	public $belongsTo = array(
		'Node' => array(
			'className' => 'Node',
			'foreignKey' => 'node_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
	);

}
