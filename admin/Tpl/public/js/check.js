  /*<input name="fee" type="text" class="input1"  placeholder="快递费"    my_check='mail'  value="asdsads163com"  error='错误'/> */
  /*if(!my_check()){return}; form.submit();*/
     function my_check(){
                  for(  i=0; i<$("*[my_check]").length;i++){
 						 if(  $("*[my_check]").eq(i).attr('my_check')=='number_need'){  /*一定为 整数，并且要>=0;并且存在*/
					          regx=/^\d+$/       
							  rs=regx.test($("*[my_check]").eq(i).val());
							  if(!rs){
 								alert( $("*[my_check]").eq(i).attr('error') )
 								return false;  
 								}
 					       }/*一定为 整数，并且要>0;并且存在*/
						   
						   	 if( $("*[my_check]").eq(i).attr('my_check')=='float_need'){  /*验证 2位的 小数 ，并要>=0;并且存在 */
					          regx=/^\d+.?\d{0,2}$/       
							  rs=regx.test($("*[my_check]").eq(i).val());
							  if(!rs){
								 alert( $("*[my_check]").eq(i).attr('error') )
 								return false;  
 								}
 					       }/*验证 2位的 小数 ，并且一定为 正 ， 0;并且存在 */
						   
						    if( $("*[my_check]").eq(i).attr('my_check')=='need'){  /*验证是否为空 */
					          regx=/^.+$/       
							  rs=regx.test($("*[my_check]").eq(i).val());
							  if(!rs){
								 alert( $("*[my_check]").eq(i).attr('error') )
 								return false;  
 								}
 					       }/*验证 2位的 小数 ，并且一定为 正 ， 0;并且存在 */
						   
						    if(  $("*[my_check]").eq(i).attr('my_check')=='number'){  /*如果存在 就一定为 整数，并且要>=0;可以为空*/
							if( $("*[my_check]").eq(i).val() ){
					          regx=/^\d+$/       
							  rs=regx.test($("*[my_check]").eq(i).val());
							  if(!rs){
 								alert( $("*[my_check]").eq(i).attr('error') )
 								return false;  
 								}
							   }	
 					       }/*如果存在 就一定为 整数，并且要>0;可以为空*/
						   
 						  if( $("*[my_check]").eq(i).attr('my_check')=='float'){  /*如果存在  验证 2位的 小数 ，要>=0 ;可以为空*/
							if( $("*[my_check]").eq(i).val() ){
					            regx=/^\d+.?\d{0,2}$/       
							     rs=regx.test($("*[my_check]").eq(i).val());
							     if(!rs){
								    alert( $("*[my_check]").eq(i).attr('error') )
 								    return false;  
 								  }
							   }	
 					       }/*验证 2位的 小数 ，并且一定为 正 ， 0;并且存在 */ 
						   
						   
						 if( $("*[my_check]").eq(i).attr('my_check')=='tel'){  /*验证电话号码 ;可以为空*/
							 if( $("*[my_check]").eq(i).val() ){
					          regx=/^\d{13}$/       
							  rs=regx.test($("*[my_check]").eq(i).val());
							  if(!rs){
								 alert( $("*[my_check]").eq(i).attr('error') )
 								return false;  
 								}
							   }
 					       } /*验证电话号码 ;可以为空*/
						   
						  if( $("*[my_check]").eq(i).attr('my_check')=='mail'){  /*验证邮箱 ;可以为空*/
							 if( $("*[my_check]").eq(i).val() ){
					            regx=/^.+@.+$/;      
							    rs=regx.test($("*[my_check]").eq(i).val());
							    if(!rs){
								 alert( $("*[my_check]").eq(i).attr('error') )
 								return false;  
 								}
							   }
 					       } /*验证电话号码 ;可以为空*/   
						   
						   
						   
						    if( $("*[my_check]").eq(i).attr('my_check')=='discount'){  /*验证1-2位数;可以为空*/
							 if( $("*[my_check]").eq(i).val() ){
					             regx=/^\d{0,2}$/;         
							    rs=regx.test($("*[my_check]").eq(i).val());
							    if(!rs){
								 alert( $("*[my_check]").eq(i).attr('error') )
 								return false;  
 								}
							   }
 					       } /*验证电话号码 ;可以为空*/    
 						   
						   
						   
    			  }  /*endfor*/
			   return true;  
          }/*endfun*/