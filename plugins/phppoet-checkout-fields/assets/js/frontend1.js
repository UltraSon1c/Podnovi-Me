(function( $ ) {

	              $(function() {
                   if ($('.pcfme-datepicker').length) {
		               $('.pcfme-datepicker').datepicker({
                          dateFormat : 'dd-mm-yy'
                      });
	                }
	              
				  var dateToday = new Date(); 
	             
				  if ($('.pcfme-datepicker-disable-past').length) {
		               $('.pcfme-datepicker-disable-past').datepicker({
                         dateFormat : 'dd-mm-yy',
		                 minDate: dateToday
                       });
	               }
	   
                 });
   	
                 $(function() {
	 
	                     if ($('.pcfme-multiselect').length) {
		                     $('.pcfme-multiselect').chosen();
	                     }
	 
	                     if ($('.pcfme-singleselect').length) {
		                     $('.pcfme-singleselect').chosen();
	                     }
      
                    });
	
	
	            $('.pcfme-opener').change(function(e){ 
                    
                    var this_obj=$(this);
                    var id= this_obj.attr('id');
                    var name= this_obj.attr('name');
                      
                    if (this_obj.attr('type')=='checkbox' ) { 
                          
                        if (this_obj.is(':checked'))                
                            $('.open_by_'+id ).parentsUntil('tbody').hide();  
                        else
                            $('.open_by_'+id ).parentsUntil('tbody').show();
   
                    }else if ( this_obj.attr('type')=='radio'){
                         
                        $('.open_by_'+ $('input[name="'+name+'"]:checked').attr('id') ).parentsUntil('tbody').hide();
                        //hide other   
                        $('.open_by_'+ $('input[name="'+name+'"]:not(:checked)').attr('id') ) .parentsUntil('tbody').show();
                    } else if (this_obj.hasClass('selectbox')){
                        
                        $('.open_by_'+ id+'_'+this_obj.val() ).parentsUntil('tbody').hide();
                        //hide other   
                        $("[class^='open_by_"+ id+"_'],[class*=' open_by_"+ id+"_']").not('.open_by_'+ id +'_'+this_obj.val()).parentsUntil('tbody').show();
                         
                    }    
                            
                });
                
                 
                
                $('.pcfme-opener').trigger('change');
				
				$('.pcfme-hider').change(function(e){ 
                    
                    var this_obj=$(this);
                    var id= this_obj.attr('id');
                    var name= this_obj.attr('name');
                      
                    if (this_obj.attr('type')=='checkbox' ) { 
                          
                        if (this_obj.is(':checked'))                
                            $('.hide_by_'+id ).parentsUntil('tbody').show();  
                        else
                            $('.hide_by_'+id ).parentsUntil('tbody').hide();
   
                    }else if ( this_obj.attr('type')=='radio'){
                         
                        $('.hide_by_'+ $('input[name="'+name+'"]:checked').attr('id') ).parentsUntil('tbody').show();
                        //hide other   
                        $('.hide_by_'+ $('input[name="'+name+'"]:not(:checked)').attr('id') ) .parentsUntil('tbody').hide();
                    } else if (this_obj.hasClass('selectbox')){
                        
                        $('.hide_by_'+ id+'_'+this_obj.val() ).parentsUntil('tbody').show();
                        //hide other   
                        $("[class^='hide_by_"+ id+"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).parentsUntil('tbody').hide();
                         
                    }    
                            
                });
                
                 
                
                $('.pcfme-hider').trigger('change');
})(jQuery);