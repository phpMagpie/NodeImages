<?php
App::uses('ModelBehavior', 'Model');

class NodeImagesBehavior extends ModelBehavior {

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
      'order' => 'NodeImage.lft',
      'dependent' => true,
    );
  }
  
  public function beforeFind(Model $model, $queryData = array()) {
    if(isset($queryData['contain']) && !in_array('NodeImage', $queryData['contain'])) {
      $queryData['contain'][] = 'NodeImage';
    }
    return $queryData;
  }

}
