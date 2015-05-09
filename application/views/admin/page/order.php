<section>
    <h2>Order pages</h2>
    <p class="alert alert-info">Drag to order pages and then clik 'Save'</p>
    <div id="orderResult"></div>
    <input type="button" id="save" value="Save" class="btn btn-primary" />
</section>

<script>
    $(function(){
        $.post('<?php echo site_url('admin/page/orderAjax'); ?>', {}, function(data){
            $('#orderResult').html(data);
        });
       
        $('#save').on('click', function(){
            
            oSortable = $('.sortable').nestedSortable('toArray');
           
            $('#orderResult').slideUp( function(){
                $.post('<?php echo site_url('admin/page/orderAjax'); ?>', { sortable: oSortable}, function(data){
                    $('#orderResult').html(data);
                    $('#orderResult').slideDown();
                });
            });
        });
    });
</script>