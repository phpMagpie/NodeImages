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
	
	public function row($image = array()) {
		$uuid = String::uuid(); 
		$_image = array(
		  'id' => null,
	    'alt' => null,
      'src' => null,
      'is_header' => null,
		);
		$image = array_merge($_image, $image);
		?>
    <tr id="Image_<?=$image['id'];?>" class="image">
      <td>
        <?php
        echo $this->Form->input('NodeImage.'.$uuid.'.id',array('value'=>$image['id']));
        $this->Form->unlockField('NodeImage.' . $uuid . '.id');
        echo $this->Form->input('NodeImage.'.$uuid.'.alt',array('label'=>false,'style'=>'float:left;','value'=>$image['alt'],'class'=>'alt'));
        $this->Form->unlockField('NodeImage.' . $uuid . '.alt');
        ?>
      </td>
      <td>
        <?php
        echo $this->Form->input('NodeImage.'.$uuid.'.src',array('label'=>false,'style'=>'float:left;','value'=>$image['src'],'class'=>'src'));
        $this->Form->unlockField('NodeImage.' . $uuid . '.src');
        ?>
        <button onclick="return false;" class="btn Image_select_file" style="float:left;"><i class="icon-folder-open"></button></i>
			  <img class="image_preview" src="<?php echo $image['src'] ?>" width="200" />
		  </td>
		  <!--<td>-->
		    <?php
//		    echo $this->Form->input('NodeImage.'.$uuid.'.is_header',array('label'=>false,'checked'=>$image['is_header'],'class'=>'is_header'));
//		    $this->Form->unlockField('NodeImage.' . $uuid . '.is_header');
		    ?>
		  <!--</td>-->
      <td class="item-actions">
        <?php 
        if($image['id']) {
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
		
/**
 * Output SLIR cropped image
 *
 * @param string $image standard image path
 * @param array $options (optional)
 * @return string
 */
	public function slir($image, $options = array()) {
	  $_options = array(
	    'alt'=>''
	  );	  
	  $options = array_merge($_options, $options);
	  $path = $this->slirPath($image, $options);

	  return $this->_View->Html->image($path, array('alt'=>$options['alt']));
	}
		
/**
 * Output SLIR cropped image
 *
 * @param string $image standard image path
 * @param array $options (optional)
 * @return string
 */
	public function slirPath($image, $options = array()) {
	  $path = '/slir/w' . $options['w'] . '-h'. $options['h'] . '-c' . $options['w'] . '.' . $options['h'] . '/webroot';
	  return $path.$image;
	}
			
/**
 * Output SLIR cropped image
 *
 * @param string $image standard image path
 * @param array $options (optional)
 * @return string
 */
	public function headerImage($node, $default) {
	  if (!isset($node['NodeImage']) || empty($node['NodeImage'])) {
	    return $default;
	  } elseif ( $image = Hash::extract($node['NodeImage'], '{n}[is_header=1]') ) {
	    return $image[0]['url']; 
	  } else {
	    return $default;
	  }
	}
		
/**
 * Output SLIR friendly image path
 *
 * @param array $image
 * @param array $options (optional)
 * @return string
 */
	public function thumbs($images = array(), $options = array()) {
	  $_options = array(
	    
	  );	  
	  $options = array_merge($_options, $options);
	  $path = '/slir/w' . $options['w'] . '-h'. $options['h'] . '-c' . $options['w'] . '.' . $options['h'] . '/webroot';
	  
	  $output = array();
//	  unset($images[0]);
	  foreach($images AS $image) {
	    $output[] = $this->_View->Html->link(
	      $this->_View->Html->image($path.$image['src'], array('alt'=>$image['alt'])),
	      $image['src'],
	      array('escape'=>false, 'rel'=>'lightbox')
	    );
	  }
	  
	  return $output;
	}

}
