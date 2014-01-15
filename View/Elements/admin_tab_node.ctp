<div class="row-fluid padded">

  <script src="/MoxieManager/js/moxman.loader.min.js"></script>
  <script>
    function returnFile(files) {
      for (var i=0; i < files.length; i++) {
        var url = "<?php echo $this->Html->url(array("plugin"=>"node_images","controller"=>"node_images","action"=>"add"));?>?src=" + 
          encodeURIComponent(files[i].path);
        $.ajax({
          url:url, 
          success:function(data){ $("#Images").append(data); }
        });
      }
    }
    
    function moxmanBrowse() {
    	moxman.browse({
    		fullscreen : false,
    		relative_urls : false,
    		no_host : true,
    		view : 'thumbs',
    		extensions : 'jpg,gif,png', 
    		oninsert: function(args) {
    			returnFile(args.files);
    		}
    	});
    }
        
    $(function(){
      $("table").on('click','.Image_select_file',function(){
        var field = $(this).parent().find('div input');
        var img = $(this).parent().find('img');
        moxman.browse({
        	fullscreen : false,
        	relative_urls : false,
        	no_host : true,
        	view : 'thumbs',
        	extensions : 'jpg,gif,png', 
        	multiple : false,
        	oninsert: function(args) {
        		$(field).val(args.focusedFile.path);
        		$(img).attr('src', args.focusedFile.path);
        	}
        });
      });
      
      $('table').on('click','.Image-delete',function(){
        var row = $(this).parent().parent();
        var id = row.attr('id').split('_')[1];
        if (id > 0) {
          $.ajax({
            url:"<?php echo $this->Html->url(array("plugin"=>"node_images","controller"=>"node_images","action"=>"remove"))?>/" + id,
            success:function(){ row.remove(); }
          });
        } else {
          row.remove();
        }
      });
          
      $('.Image-moveup').click(function(){
        var row = $(this).parent().parent();
        var id = row.attr('id').split('_')[1];
        if (id > 0) {
          $.ajax({
            url:"<?php echo $this->Html->url(array("plugin"=>"node_images","controller"=>"node_images","action"=>"moveup"))?>/" + id,
            success:function(){ row.prev().before(row) }
          });
        }
      });
           
      $('.Image-movedown').click(function(){
        var row = $(this).parent().parent();
        var id = row.attr('id').split('_')[1];
        if (id > 0) {
          $.ajax({
            url:"<?php echo $this->Html->url(array("plugin"=>"node_images","controller"=>"node_images","action"=>"movedown"))?>/" + id,
            success:function(){ row.next().after(row) }
          });
        }
      });
    });
  </script>
    
  <p class="alert">
    Images can be attached to pages and displayed as an image gallery. The top image will be used as a feature image.
  </p>

  <table class="table table-striped" id="Images">
    <tr><th>Image Caption</th><th>Image</th><!--<th>Header?</th>--><th>Actions</th></tr>
    <tbody>
      <?php
      if(isset($this->data['NodeImage'])) {
        foreach($this->data['NodeImage'] as $image) {
          $this->NodeImages->row($image);
        }
      }
      ?>
    </tbody>
  </table>
  
  <a href="javascript:moxmanBrowse();" class="btn btn-success">Browse</a>
  
</div>
