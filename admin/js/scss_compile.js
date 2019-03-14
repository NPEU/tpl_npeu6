//(function($) {
jQuery(function(){
    jQuery('#compile_scss')
        .click(function(e){
            e.preventDefault();
            console.log('scss compile');
            
            var url = '/templates/tpl_npeu6/ajax/compile-sass.php';
            
            jQuery.ajax({
                url: url
            })
            .done(function(return_string) {
                var return_json = JSON.parse(return_string);
                Joomla.renderMessages(return_json.messages);
            });
            
            
            /*jQuery.ajax({
                dataType: 'json',
                async: false,
                url: url,
                success: function(data){
                    console.log(data);

                },
                error: function(data){
                    console.log(data);
                }
            });*/
        });
});
//})(window.jQuery);