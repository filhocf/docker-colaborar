(function($){

    $(document).ready(function(){
        
        //bootstrap defaults
        $('[data-toggle="tooltip"]').tooltip(); 
        
         skrollr.init({
            smoothScrolling: true,
            mobileDeceleration: 0.004
        });
    });
    
})(jQuery);

