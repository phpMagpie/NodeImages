<?php

class NodeImageHelper extends AppHelper {

/**
 * Helpers
 */
	public $helpers = array(
		'Html',
		'Form',
		);


	public function row($title = null, $url = null, $id = null,$i=null) {
            
		$uuid = String::uuid();
                
		?>
                <tr id="Image_<?=$id;?>" class="image">
                <?php
                if($id != null){
                    echo $this->Form->input('NodeImage.'.$uuid.'.id',array('value'=>$id));
		    $this->Form->unlockField('NodeImage.' . $uuid . '.id');
                }
                ?>
                <td>
                    <?php
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
		
                <td>
			<button class="btn Image-delete" onclick="return false;"><i class="icon-trash icon-large"></i></button>
			<?php if($id != null){?>
			<button class="btn Image-moveup" onclick="return false;">Move Up</button>
			<button class="btn Image-movedown" onclick="return false;">Move Down</button>
			<?php } ?>
		</td>
            </tr>
                <?php
	}

}
