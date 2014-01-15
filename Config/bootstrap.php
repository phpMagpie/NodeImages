<?php

Croogo::hookComponent('Nodes', array('NodeImages.NodeImages'=>array('priority' => 8)));

Croogo::hookBehavior('Node', 'NodeImages.NodeImages', array('priority' => 1));

Croogo::hookHelper('*', 'NodeImages.NodeImages');

Croogo::hookAdminTab('Nodes/admin_add', 'Images', 'node_images.admin_tab_node');
Croogo::hookAdminTab('Nodes/admin_edit', 'Images', 'node_images.admin_tab_node');