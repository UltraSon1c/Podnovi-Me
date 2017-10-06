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
		 $('.pcfme-multiselect').select2({});
	 }
	 
	 if ($('.pcfme-singleselect').length) {
		 $('.pcfme-singleselect').select2({});
	 }
      
    });
	
	
	$(function() {
       $('.pcfme-opener').on('change',function(){
		 var this_obj=$(this);
		 var id= this_obj.attr('id');
         var name= this_obj.attr('name');
		 
		 if (this_obj.hasClass('pcfme-singleselect')){
			
			
			$('.open_by_'+ id +'_'+this_obj.val() ).closest('.form-row').show();
                        //hide other   
            $("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+this_obj.val()).closest('.form-row').hide();
			
		 } else if (this_obj.hasClass('pcfme-multiselect')){
			
			
			$('.open_by_'+ id +'_'+this_obj.val() ).closest('.form-row').show();
                        //hide other   
            $("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+this_obj.val()).closest('.form-row').hide();
			
		 } else if (this_obj.attr('type')=='checkbox') {
			
			if (this_obj.is(':checked')) {
				$('.open_by_'+id ).closest('.form-row').show();
			} else {
				$('.open_by_'+id ).closest('.form-row').hide();
			}
			
		 } else if ( this_obj.attr('type')=='radio'){
                
                $('.open_by_'+ id +'_'+this_obj.val() ).closest('.form-row').show();
                        //hide other   
                $("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+this_obj.val()).closest('.form-row').hide();				
                       
          } else if ( this_obj.attr('type')=='text'){
			    $('.open_by_'+ id +'_'+this_obj.val() ).closest('.form-row').show();
                        //hide other   
                 $("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+this_obj.val()).closest('.form-row').hide();
		  
		  } else if ( this_obj.attr('type')=='tel'){
			     
			     $('.open_by_'+ id +'_'+this_obj.val() ).closest('.form-row').show();
                        //hide other   
                 $("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+this_obj.val()).closest('.form-row').hide();
		  } else if ( this_obj.attr('type')=='number'){
			     
			     $('.open_by_'+ id +'_'+this_obj.val() ).closest('.form-row').show();
                        //hide other   
                 $("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+this_obj.val()).closest('.form-row').hide();
		  } else if ( this_obj.attr('type')=='password'){
			     
			     $('.open_by_'+ id +'_'+this_obj.val() ).closest('.form-row').show();
                        //hide other   
                 $("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+this_obj.val()).closest('.form-row').hide();
		  } else if (this_obj.is("textarea")){
			     
			     $('.open_by_'+ id +'_'+this_obj.val() ).closest('.form-row').show();
                        //hide other   
                 $("[class^='open_by_"+ id +"_'],[class*=' open_by_"+ id +"_']").not('.open_by_'+ id +'_'+this_obj.val()).closest('.form-row').hide();
		  }
	    
		
      });
	  
	  $('.pcfme-opener').trigger('change');
	  
	  $('.pcfme-hider').on('change',function(){
		   var this_obj=$(this);
           var id= this_obj.attr('id');
           var name= this_obj.attr('name');
		   
		   if (this_obj.hasClass('pcfme-singleselect')){
                        
                        $('.hide_by_'+ id +'_'+this_obj.val() ).closest('.form-row').hide();
                        //hide other   
                        $("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).closest('.form-row').show();
                         
            } else if (this_obj.hasClass('pcfme-multiselect')){
                        
                        $('.hide_by_'+ id +'_'+this_obj.val() ).closest('.form-row').hide();
                        //hide other   
                        $("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).closest('.form-row').show();
                         
            } else if (this_obj.attr('type')=='checkbox') {
			
			  if (this_obj.is(':checked')) {
				
				$('.hide_by_'+id ).closest('.form-row').hide();
			  } else {
				    
				$('.hide_by_'+id ).closest('.form-row').show();
			  }
		    
			} else if ( this_obj.attr('type')=='radio'){
                         
                $('.hide_by_'+ id +'_'+this_obj.val() ).closest('.form-row').hide();
                        //hide other   
                $("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).closest('.form-row').show();       
            } else if ( this_obj.attr('type')=='text'){
                         
                $('.hide_by_'+ id +'_'+this_obj.val() ).closest('.form-row').hide();
                        //hide other   
                $("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).closest('.form-row').show();       
            
			} else if ( this_obj.attr('type')=='tel'){
                         
                $('.hide_by_'+ id +'_'+this_obj.val() ).closest('.form-row').hide();
                        //hide other   
                $("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).closest('.form-row').show();       
            }  else if ( this_obj.attr('type')=='number'){
                         
                $('.hide_by_'+ id +'_'+this_obj.val() ).closest('.form-row').hide();
                        //hide other   
                $("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).closest('.form-row').show();       
            }  else if ( this_obj.attr('type')=='password'){
                         
                $('.hide_by_'+ id +'_'+this_obj.val() ).closest('.form-row').hide();
                        //hide other   
                $("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).closest('.form-row').show();       
            }   else if (this_obj.is("textarea")) {
                         
                $('.hide_by_'+ id +'_'+this_obj.val() ).closest('.form-row').hide();
                        //hide other   
                $("[class^='hide_by_"+ id +"_'],[class*=' hide_by_"+ id+"_']").not('.hide_by_'+ id +'_'+this_obj.val()).closest('.form-row').show();       
            }
	  });
	  
	   $('.pcfme-hider').trigger('change');
	});
	
	  
})(jQuery);

