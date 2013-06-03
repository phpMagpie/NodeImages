<?php

Croogo::hookComponent('Nodes', array('NodeImages.NodeImage'=>array('priority' => 8)));

Croogo::hookBehavior('Node', 'NodeImages.NodeImage', array());

Croogo::hookHelper('*', 'NodeImages.NodeImage');
