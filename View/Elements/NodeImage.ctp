<div class="row-fluid padded">
    
<p class="alert">
Images can be attatched to pages and displayed as an image gallery. The top image will be used as a feature image.
</p>

<script type="text/javascript" charset="utf-8">
    
        // Liam's ElFinder File Picker
        var imagepicker = new Object();
    
        $(function(){
            // Create instance of elfinder
            imagepicker.div = $("#images_finder");
            imagepicker.elf = imagepicker.div.elfinder({
                    // lang: 'ru',             // language (OPTIONAL)
                    url : '/ElFinder/elfinder/php/connector.php'  // connector URL (REQUIRED)
            }).elfinder('instance');
        
            // Create a dialog for elfinder
           imagepicker.dialog = imagepicker.div.dialog({
            autoOpen:false,
            width:750,
            buttons:{
                "Insert":function(){
                    // get array of files
                    var files = imagepicker.div.find(".ui-selected").map( function() {
                        return imagepicker.elf.path($(this).attr('id'));
                    }).get();
                    
                    imagepicker.callback_function(files);
                    imagepicker.dialog.dialog('close');
                }
            }
           });
           
           
            // Get Files Method
            imagepicker.getFiles = function(callback_function){
                imagepicker.callback_function = callback_function;
                imagepicker.dialog.dialog("open");
            }
        });
        
        
        // Bind imagepicker to button
        $(function(){
            
            // Bind select file button
            $("#Images").on('click','.Image_select_file',function(){
               imagepicker.row = $(this).parent();
               imagepicker.getFiles(function(files){
                    imagepicker.row.find('.url').val(files[0]);
                    imagepicker.row.find('.image_preview').attr('src','<?php echo $this->Html->url('/') ?>' + files[0]);
               });
            });
            
            // Bind select file button
            $(".Image-add").click(function(){
               imagepicker.urlbox = $(this).parent().find('.url');
               imagepicker.getFiles(function(files){
                    
                    console.log(files);
                    for (file in files) {
                
                        $.ajax({
                            url:"<?php echo $this->Html->url(array("plugin"=>"node_images","controller"=>"node_image","action"=>"add"));?>?url=" + encodeURIComponent(files[file]) + '&title=' + encodeURIComponent(files[file]),
                            success:function(data){
                                $("#Images").append(data);
                            }
                        });
                    
                    }
                    
               });
               
               
            });
        });
        
</script>

<div id="images_finder" title="Select Files"></div>

<script>
    $(function(){
        
        /*
        $('.Image-add').click(function(){
            $.ajax({
                url:"<?php echo $this->Html->url(array("plugin"=>"node_images","controller"=>"node_image","action"=>"add"));?>",
                success:function(data){
                    $("#Images").append(data);
                }
            })
        });
        */
        
        $('table').on('click','.Image-delete',function(){
            var row = $(this).parent().parent();
            var id = row.attr('id').split('_')[1];
            if (id > 0) {
                $.ajax({
                   url:"<?php echo $this->Html->url(array("plugin"=>"node_images","controller"=>"node_image","action"=>"remove"))?>/" + id,
                   success:function(){
                    row.remove();
                   }
                });
            }
            else
            {
            row.remove();
            }
        });
        
         $('.Image-moveup').click(function(){
            var row = $(this).parent().parent();
            var id = row.attr('id').split('_')[1];
            if (id > 0) {
                $.ajax({
                   url:"<?php echo $this->Html->url(array("plugin"=>"node_images","controller"=>"node_image","action"=>"moveup"))?>/" + id,
                   success:function(){
                    row.prev().before(row)
                   }
                });
            }
        });
         
         $('.Image-movedown').click(function(){
            var row = $(this).parent().parent();
            var id = row.attr('id').split('_')[1];
            if (id > 0) {
                $.ajax({
                   url:"<?php echo $this->Html->url(array("plugin"=>"node_images","controller"=>"node_image","action"=>"movedown"))?>/" + id,
                   success:function(){
                    row.next().after(row)
                   }
                });
            }
        });
    });
</script>


<table class="table table-striped" id="Images">
    <tr><th>Image Caption</th><th>Image</th><th>Operations</th></tr>
    
    <tbody>
    
    <?php
    if(isset($this->data['NodeImage'])){
      $i = 1;
        foreach($this->data['NodeImage'] as $Image){
            $this->NodeImage->row($Image['title'],$Image['url'],$Image['id'],$i);
            $i++;
         }
        
    }
    ?>
    
    </tbody>
    
</table>


<button class="btn Image-add" onclick="return false;">Add Image</button>

    
</div>
