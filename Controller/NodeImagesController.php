<?php

App::uses('NodeImagesAppController', 'NodeImages.Controller');
App::uses('Croogo', 'Lib');

/**
 * NodeImages Controller
 *
 * PHP version 5
 *
 * @category NodeImages.Controller
 * @package  Croogo.NodeImages
 * @version  1.0
 * @author   Liam Keily
 * @link     http://www.liamkeily.com
 */

class NodeImagesController extends NodeImagesAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'NodeImages';

	public $helpers = array('Html','Form');

	public function admin_add(){
		$title = $this->request->query['title'];
		$url = $this->request->query['url'];
    $this->set(compact('title','url'));
	}
        
  public function admin_remove($id){
    if($this->NodeImage->delete($id)){
      $success=true;
    } else {
      $success=false;
    }
    
    $this->set('success',$success);
    $this->layout = 'ajaxsuccess';
  }
        
        public function admin_moveup($id){
            $att = $this->NodeImage->findById($id);
            if (isset($att['NodeImage']['id'])) {
                 $this->NodeImage->Behaviors->attach('Tree', array(
                    'scope' => array(
                            'NodeImage.node_id' => $att['NodeImage']['node_id'],
                    ),
                ));
                 
                if($this->NodeImage->moveUp($id, 1)){
                   $success=true;
                }
                else
                {
                   $success=false;
                }
            }
            else
            {
                $success=false;
            }
            
            $this->set('success',$success);
            $this->render('ajaxsuccess');
        }
        
        public function admin_movedown($id){
            $att = $this->NodeImage->findById($id);
            if (isset($att['NodeImage']['id'])) {
                 $this->NodeImage->Behaviors->attach('Tree', array(
                    'scope' => array(
                            'NodeImage.node_id' => $att['NodeImage']['node_id'],
                    ),
                ));
                 
                if($this->NodeImage->moveDown($id, 1)){
                   $success = true;
                }
                else
                {
                   $success = false;
                }
            }
            else
            {
                $success = false;
            }            
            
            
            $this->set('success',$success);
            $this->render('ajaxsuccess');
        }

}
