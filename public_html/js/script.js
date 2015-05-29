var j = jQuery.noConflict();

(function($) {
    var $body = j('body');
    
    j(document).on("ready", function(){
        // Funcionalidad mostrar y ocultar sidebar
        j('.collapse-sidebar').on('click', function(ev){
            ev.preventDefault();
            if ($body.hasClass('collapsed-sidebar')) {
                $body.removeClass('collapsed-sidebar');
            }
            else
            {
                $body.addClass('collapsed-sidebar');
            }
        });
        
        // Habilitar funcionamiento de tinymce
        tinymce.init({
            selector: "textarea",
            theme: "modern",
            width: 300,
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
           ],
           toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", 
        }); 
    });
})(jQuery);