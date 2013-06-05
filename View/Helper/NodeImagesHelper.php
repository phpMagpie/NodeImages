<?php

class NodeImagesHelper extends AppHelper {

/**
 * Helpers
 */
	public $helpers = array(
		'Html',
		'Form',
		'Croogo'
	);


	public function row($title = null, $url = null, $id = null,$i=null) {
		$uuid = String::uuid(); 
		?>
    <tr id="Image_<?=$id;?>" class="image">
      <td>
        <?php
        if($id != null){
          echo $this->Form->input('NodeImage.'.$uuid.'.id',array('value'=>$id));
          $this->Form->unlockField('NodeImage.' . $uuid . '.id');
        }
        echo $this->Form->input('NodeImage.'.$uuid.'.title',array('label'=>false,'style'=>'float:left;','value'=>$title,'class'=>'title'));
        $this->Form->unlockField('NodeImage.' . $uuid . '.title');
        ?>
      </td>
      <td>
        <?php
        echo $this->Form->input('NodeImage.'.$uuid.'.url',array('label'=>false,'style'=>'float:left;','value'=>$url,'class'=>'url'));
        $this->Form->unlockField('NodeImage.' . $uuid . '.url');
        ?>
        <button onclick="return false;" class="btn Image_select_file" style="float:left;"><i class="icon-folder-open"></button></i>
			  <img class="image_preview" src="<?php echo $this->Html->url('/').$url ?>" width="200" />
		  </td>
      <td class="item-actions">
        <?php 
        if($id != null) {
          echo $this->Croogo->adminRowAction('', '#', array(
          	'class' => 'Image-moveup',
          	'icon' => 'chevron-up',
          	'tooltip' => __d('croogo', 'Move up'),
          ));
          echo $this->Croogo->adminRowAction('', '#', array(
          	'class' => 'Image-movedown',
          	'icon' => 'chevron-down',
          	'tooltip' => __d('croogo', 'Move down'),
          ));
        } 
        echo $this->Croogo->adminRowAction('', '#', array(
        		'class' => 'Image-delete',
        		'icon' => 'trash',
        		'tooltip' => __d('croogo', 'Delete this image'),
        		'rowAction' => 'delete',
        	),
        	__d('croogo', 'Are you sure?')
        );
        ?>
    	</td>
    </tr>
    <?php
	}

}
