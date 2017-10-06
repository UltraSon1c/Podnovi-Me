           <div class="panel-group panel panel-default checkoutfield pcfme_list_item" style="display:none;">
           <div class="panel-heading">

           <table class="heading-table">
			<tr>
			    <td width="20%">
			     <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="">
                  <span class="glyphicon glyphicon-edit pull-left"></span>
			     </a>
			    </td>
			    
				<td width="30%">
	              <label  class="new-field-label"></label>
        
                </td>
	            <td width="30%">
	  	          <input type="text" placeholder="<?php _e('Placeholder Text','pcfme'); ?>">
	            </td>
			 
			    <td width="20%">
		          <span class="glyphicon glyphicon-remove-circle pull-right "></span>
		         </td>
                </tr>
		    </table>

           </div>
           <div id="" class="panel-collapse collapse">
			  <table class="table"> 
			   
			 
			   
			   <tr>
	           <td width="25%"><label><?php _e('Field Type','pcfme'); ?></label></td>
		       <td width="75%">
		          <select class="checkout_field_type_new" name="" >
			        <option value="text"  ><?php _e('Text','pcfme'); ?></option>
					<option value="email"  ><?php _e('Email','pcfme'); ?></option>
					<option value="tel"  ><?php _e('Telephone Number','pcfme'); ?></option>
					<option value="number"  ><?php _e('Number','pcfme'); ?></option>
			        <option value="password" ><?php _e('Password','pcfme'); ?></option>
					<option value="textarea" ><?php _e('Textarea','pcfme'); ?></option>
			        <option value="checkbox" ><?php _e('Checkbox','pcfme'); ?></option>
			        <option value="pcfmeselect" ><?php _e('Select','pcfme'); ?></option>
			        <option value="multiselect"><?php _e('Multi Select','pcfme'); ?></option>
			        <option value="radio" ><?php _e('Radio Select','pcfme'); ?></option>
			        <option value="datepicker" ><?php _e('Date Picker','pcfme'); ?></option>
					
			       </select>
		       </td>
	           </tr>
			   <tr>
                <td width="25%"><label><?php  _e('Label','pcfme'); ?></label></td>
	            <td width="75%"><input type="text" class="checkout_field_label" name="" value="" size="35"></td>
               </tr>
			   
			
			   
			   <tr>
	           <td width="25%"><label><?php _e('Class','pcfme'); ?></label></td>
		       <td width="75%">
		       <select class="checkout_field_width_new" name="">
			    
				<option value="form-row-wide" ><?php _e('Full Width','pcfme'); ?></option>
			    <option value="form-row-first" ><?php _e('First Half','pcfme'); ?></option>
			    <option value="form-row-last" ><?php _e('Second Half','pcfme'); ?></option>
				
				
			     
			   </select>
		       </td>
	           </tr>
			   
			   
		       <tr>
                <td width="25%"><label ><?php  _e('Required','pcfme'); ?></label></td>
                <td width="75%"><input class="checkout_field_required" type="checkbox" name=""  value="1"></td>
			   </tr>
			   
			   
			   <tr>
                <td width="25%"><label><?php  _e('Clearfix','pcfme'); ?></label></td>
                <td width="75%"><input class="checkout_field_clear" type="checkbox" name="" value="1"></td>
			   </tr>
			   
			   
			   <tr>
                <td width="25%"><label><?php  _e('Placeholder ','pcfme'); ?></label></td>
	            <td width="75%"><input type="text" class="checkout_field_placeholder" name="" value="" size="35"></td>
               </tr>
			   
			   
			   <tr class="add-field-extraclass" style="">
	            <td width="25%">
		         <label><?php _e('Extra Class','pcfme'); ?></label>
		        </td>
		        <td width="75%">
		         <input type="text" class="pcfme_checkout_field_extraclass_new" name="" value="" size="35">
		        </td>
	           </tr>
			   
			   <tr class="add-field-options" style="">
	           <td width="25%">
		         <label><?php _e('Options','pcfme'); ?></label>
		       </td>
		       <td width="75%">
		       <input type="text" class="pcfme_checkout_field_option_values_new" name="" value="" size="35">
		       </td>
	           </tr>
			   
			 
			   
			   <tr>
                <td width="25%"><label><?php  _e('Visibility','pcfme'); ?></label></td>
	            <td width="75%">
		           <select class="checkout_field_visibility_new" name="" >
		             <option value="always-visible"><?php _e('Always Visibile','pcfme'); ?></option>
					 <option value="product-specific"><?php _e('Conditional - Product Specific','pcfme'); ?></option>
					 <option value="category-specific"><?php _e('Conditional - Category Specific','pcfme'); ?></option>
					 <option value="field-specific"><?php _e('Conditional - Field Specific','pcfme'); ?></option>
			       </select>
		        </td>
	           </tr>
			   
			   <tr class="checkout_field_products_tr" style="display:none;">
			    <td width="25%">
                 <label><?php echo __('Select Products','pcfme'); ?></label>
	            </td>
			    <td width="75%">
			     <select class="checkout_field_products_new" data-placeholder="<?php _e('Choose Products','pcfme'); ?>" name="" multiple  style="width:600px">
                  <?php foreach ($posts_array as $post) { ?>
				  <option value="<?php echo $post->ID; ?>">#<?php echo $post->ID; ?>- <?php echo $post->post_title; ?></option>
				  <?php } ?>
                 </select>
                </td>
			   </tr>
			   <tr class="checkout_field_category_tr" style="display:none;" >
			    <td width="25%">
                 <label for="notice_category"><?php echo __('Select Categories','pcfme'); ?></label>
	            </td>
			    <td width="75%">
			     <select class="checkout_field_category_new" data-placeholder="<?php _e('Choose Categories','pcfme'); ?>" name=""  multiple style="width:600px">
                  <?php foreach ($categories as $category) { ?>
				  <option value="<?php echo $category->term_id; ?>">#<?php echo $category->term_id; ?>- <?php echo $category->name; ?></option>
				  <?php } ?>
                 </select>
                </td>
			    </tr>
				<tr class="checkout_field_conditional_tr" style="display:none;" >
			    <td width="25%">
                 <label for="notice_category"><?php echo __('Set Rule','pcfme'); ?></label>
	            </td>
			    <td width="75%">
				 <select class="checkout_field_conditional_showhide_new" name="">
				   <option value="open"><?php echo __('Show','pcfme'); ?></option>
				   <option value="hide"><?php echo __('Hide','pcfme'); ?></option>
				 </select>
				 <span class="pcfmeformfield"><strong><?php echo __('If value of','pcfme'); ?></strong></span>
				 <select class="checkout_field_conditional_parentfield_new" name="">
				   <?php foreach ($fields as $optionkey=>$optionvalue) { 
				   
				    if ( (isset ($optionvalue['type']) && ($optionvalue['type'] == 'email')) || (preg_match('/\b'.$optionkey.'\b/', $country_fields )) || ($optionkey == $key)) { 
					 
					 } else { ?>
					   <option value="<?php echo $optionkey; ?>"><?php if (isset($optionvalue['label'])) { echo $optionvalue['label']; } else { echo $optionkey; }  ?></option>
				   <?php } ?>
				   <?php } ?>
				 </select>
				 <span class="pcfmeformfield"><strong><?php echo __('is equal to','pcfme'); ?></strong></span>
				 <input class="checkout_field_conditional_equalto_new" type="text" name="" value="">
			    </td>
			    </tr>
			   <?php if ($slug != 'pcfme_additional_settings') { ?>
			   <tr>
                <td width="25%"><label><?php  _e('Validate','pcfme'); ?></label></td>
	            <td width="75%">
		           <select name="" class="checkout_field_validate_new" multiple>
			         <option value="state" ><?php _e('state','pcfme'); ?></option>
			         <option value="postcode" ><?php _e('postcode','pcfme'); ?></option>
			         <option value="email" ><?php _e('email','pcfme'); ?></option>
			         <option value="phone" ><?php _e('phone','pcfme'); ?></option>
			       </select>
		       </td>
	           <?php } ?>
               </tr>
			      <tr>
			     <td width="25%"><label for="<?php echo $key; ?>_clear"><?php  _e('Chose Options','pcfme'); ?></label></td>
			     <td  width="75%">
			      <table>
			        
			   
			        <tr class="disable_datepicker_tr" style="display:none;">
                        <td><input class="checkout_field_disable_past_dates" type="checkbox" name=""  value="1"></td>
						<td><label ><?php  _e('Disable Past Date Selection In Datepicker','pcfme'); ?></label></td>
			        </tr>
					
					<tr>
                       <td><input class="checkout_field_orderedition" type="checkbox" name=""  value="1"></td>
					   <td><label ><?php  _e('Show field detail along with orders','pcfme'); ?></label></td>
			        </tr>
					
				
					
					<tr>
                       <td><input class="checkout_field_emailfields" type="checkbox" name=""  value="1"></td>
					   <td><label ><?php  _e('Show field detail on woocommerce order emails','pcfme'); ?></label></td>
			        </tr>
					
					<tr>
                       <td><input class="checkout_field_pdfinvoice" type="checkbox" name=""  value="1"></td>
					   <td><label ><?php  _e('Show field detail on WooCommerce PDF Invoices & Packing Slips Invoice','pcfme'); ?></label></td>
			        </tr>
					
					<tr>
                       <td><input class="checkout_field_editaddress" type="checkbox" name=""  value="1"></td>
					   <td><label ><?php  _e('Add this field to myaccount/edit address page','pcfme'); ?></label></td>
			        </tr>
			      
			        </table>
				   </td>
				 </tr>
			 
			   
			   </table>
		   </div>
        </div>