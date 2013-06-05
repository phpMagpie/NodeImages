<?php

Croogo::hookComponent('Nodes', array('NodeImages.NodeImages'=>array('priority' => 8)));

Croogo::hookBehavior('Node', 'NodeImages.NodeImages', array());

Croogo::hookHelper('*', 'NodeImages.NodeImages');
