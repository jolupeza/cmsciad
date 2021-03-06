        <!-- Load Javascripts -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

        <script>
            var baseUrl = '<?php echo base_url(); ?>';
        </script>

        <?php if(isset($sortable) && $sortable === TRUE) : ?>
        <script src="<?php echo site_url('js/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo site_url('js/jquery.mjs.nestedSortable.js'); ?>"></script>
        <?php endif; ?>

        <script src="<?php //echo site_url('js/tinymce/tinymce.min.js'); ?>"></script>
        <script src="<?php echo site_url('backend/js/script.js'); ?>"></script>

    </body>
</html>
