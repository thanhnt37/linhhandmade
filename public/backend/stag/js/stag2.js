
(function( $ ){
	    $.fn.stag2 = function(name,list) {
	       if(!$(this).next().hasClass('stag-box')){
	       		value = $(this).val();
	       		var l_item = value.split(",");
	       		str_l_item = "";
	       		$.each(l_item, function(i,v){
	       			if($.trim(v)){
	       				str = '<div class="stag-item">'+'<div class="stag-name stag2">'+'<span>'+v+'</span>'+'</div>'+'<div class="stag-close">'+'<span >×</span>'+'</div>'+'</div>';
	       				str_l_item +=str;
	       			}
	       		});	
		     	l = '';	
		     	$.each(list,function(i,v){
		     		l += '<div class="stag-autocomplate">'+v+'</div>';
		     	});
	       		str = '<div class="stag-box">'+
						'<div class="stag-body s-noselect" id="s-all-user">'+
							str_l_item+ 
							'<div class="stag-list-item">'+
								'<input class="stag-input" placeholder="'+name+'">'+
								'<div class="stag-suggest" >'+l+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
				$(this).after(str);
				$(this).css('display','none');
			}
	        tag =  $(this).next();
	    };
	    $.fn.stagSuggestList2 =  function(list){
	    	l = '';
	    	$.each(list,function(i,v){
		     		l += '<div class="stag-autocomplate">'+v+'</div>';
		    });
		    suggest = $(this).find('.stag-suggest');
		    if(suggest){
		    	$(suggest).html(l);
		    }
	    }
	    // add tag
	    $.fn.addStagItem2 = function(value){
	    	l_name = $(this).find('.stag-name span');
	    	arr_name = [];c= 0;content = '';
	    	$.each(l_name,function(i,v){
				arr_name.push($(v).text());content += $(v).text() + ",";if(value == $(v).text() ) c++;
			});
	    	if(c==0){
	    		str = '<div class="stag-item">'+'<div class="stag-name">'+'<span>'+value+'</span>'+'</div>'+'<div class="stag-close">'+'<span >×</span>'+'</div>'+'</div>';
				list = $(this).find('.stag-list-item')
				if( list ){$(list).before(str);content +=value;};
	    	}
	    	$(this).prev().val(content);
	    	$(this).stagSuggestHide2();
	    }
	    $.fn.stagSuggestHide2 = function(){
	    	$('.stag-active').removeClass('stag-active');
	    	$(this).find('.stag-suggest').css('display','none');
	    }
	    $.fn.stagSuggestShow2 = function(){
	    	$('.stag-active').removeClass('stag-active');
	    	$(this).find('.stag-suggest').css('display','block');
	    }
	    
	    $.fn.getStagContainer2 = function(){
	    	if( $(this).hasClass('stag-input') ){
	    		return $(this).parent().parent().parent();
	    	};
	    	if( $(this).hasClass('stag-autocomplate') ){
	    		return $(this).parent().parent().parent().parent();
	    	}
	    	if( $(this).hasClass('stag-close') ){
	    		return $(this).parent().parent().parent();
	    	};
	    	if( $(this).hasClass('stag-item') ){
	    		return $(this).parent().parent();
	    	};
	    }
	    // remove tag
	    $.fn.refreshStag2 = function(){
	    	// this: stag-box
	    	l_name = $(this).find('.stag-name span');
	    	content = '';
	    	$.each(l_name,function(i,v){
				content += $(v).text() + ",";
			});
			$(this).prev().val(content);
	    }
	    // Xóa item 
	   	$.fn.removeStagItem2 = function(container,item){
	    	$(item).remove();
			$(container).refreshStag2();
	    }
	    $(document).on('keydown','.stag-input',function(e){
   			  var keyCode = e.keyCode || e.which;
   			  text = $(this).val();
   			  filter =  $(this).parent().find('.stag-suggest');
   			  list_key = [];
   			  if(filter){
   			  	list_item = $(filter).find('.stag-autocomplate');
   			  	$.each(list_item,function(i,v){
   			  		list_key.push($(v).text());
   			  	});
   			  }
   			
   			  if (keyCode === 40) { 
			    //down
			    suggest = $(this).getStagContainer2().find('.stag-suggest');
			    active = $(suggest).find('.stag-active:not(.none)').first();
			    

				if(active.length){
			    	next = active.next();
			    	while(true){
			    		if(next.length){
			    			if($(next).hasClass('none'))	next =  $(next).next();
			    			else break;}
			    		else break;
			    	}
			    	if(next.length){
			    		$(active).removeClass('stag-active');
			    		$(next).addClass('stag-active');
			    	}
			    }else{
			    	f1 = $(suggest).find('.stag-autocomplate:not(.none)').first();
			    	if(f1.length){
			    		$(f1).addClass('stag-active');
			    	}
			    }
			    l_before = $(suggest).find('.stag-autocomplate:not(.none)');
			    c = 0;
			    for (var i = 0; i < l_before.length; i++) {
			   		if($(l_before[i]).hasClass('stag-active')){
			   			break;
			   		}else{
			   			c++;
			   		}
			    }
			   	$(suggest).animate({
			        scrollTop: c * ($(active).height() + 10) - 10
			    }, 50);
			  }
			  if (keyCode === 38) { 
			  	// up
			    suggest = $(this).getStagContainer2().find('.stag-suggest');
			    active = $(suggest).find('.stag-active:not(.none)').first();
			    if(active.length){
			    	prev = active.prev();
			    	while(true){
			    		if(prev.length){
			    			if($(prev).hasClass('none')) prev =  $(prev).prev();
			    			else break;}
			    		else break;
			    	}
			    	if(prev.length){
			    		$(active).removeClass('stag-active');
			    		$(prev).addClass('stag-active');
			    	}
			    }else{
			    	f1 = $(suggest).find('.stag-autocomplate:not(.none)').first();
			    	if(f1.length){
			    		$(f1).addClass('stag-active');
			    	}
			    }
			   	l_before = $(suggest).find('.stag-autocomplate:not(.none)');
			    c = 0;
			    for (var i = 0; i < l_before.length; i++) {
			   		if($(l_before[i]).hasClass('stag-active')){
			   			break;
			   		}else{
			   			c++;
			   		}
			    }
			   	$(suggest).animate({
			        scrollTop: c * ($(active).height() + 10) - 10
			    }, 50);
			  }
			  if(keyCode === 13) { 

			  	suggest = $(this).getStagContainer2().find('.stag-suggest');
			    active = $(suggest).find('.stag-active:not(.none)').first();
			    if(active.length){
			    	if( $.trim($(active).text() )){
				  		$(this).parent().parent().parent().addStagItem2($(active).text());
				  		$(this).val('');
				  	}
			    }else{
			    	if($(this).getStagContainer2().hasClass('stag2')){
				  			if($.trim(text)){
					  		$(this).parent().parent().parent().addStagItem2(text);
					  		$(this).val('');
					  	}
				  	}
			    	
			    }
   			  }
			  if (keyCode === 8) { 
		  	  	if(text.length == 0){
				    del = $(this).parent().prev();
				    if($(del).hasClass('stag-item')){
				    	$(del).removeStagItem2($(del).getStagContainer2(),del);
				    }
				}
			  }
			  if (keyCode === 9) { 
			  	if($(this).getStagContainer2().hasClass('stag2')){
				  	if($.trim(text)){
				  		$(this).parent().parent().parent().addStagItem2(text);
				  		$(this).val('');
				  	}
			  	}
			  	e.preventDefault();
			  }
			  // console.log(list_key);
   		});
   		
   		$(document).on('keyup focus','.stag-input',function(e){
   			$('.stag-suggest').css('display','none');
   			filter =  $(this).parent().find('.stag-suggest');
   			text = $(this).val();
   			filter_auto =  $(this).parent().find('.stag-suggest .stag-autocomplate');
   			// console.log(filter_auto);
   			$.each(filter_auto,function(i,v){
				t = $(v).text();
				if(t.toLowerCase().indexOf( $.trim(text.toLowerCase()) )!= -1){
					$(v).removeClass('none');
				}else{
					$(v).addClass('none');
				}
	    	});
   			if(filter){
   				if(text){
   					$(filter).css('display','block');
   				}else{
   					$(filter).css('display','block');

   				}
   			}
   		});
   		// click to list
   		$(document).on('click','.stag-autocomplate',function(e){
   			val = $(this).text();
   			$(this).parent().prev().val('');
   			$(this).parent().css('display','none');
   			$(this).parent().parent().parent().parent().addStagItem2(val);
   		});
   		$(document).on('click','.stag-close',function(e){
   			$(this).removeStagItem2($(this).getStagContainer2(),$(this).parent() );
   		});
   		// auto hide when out click
   		$(document).mouseup(function (e)
		{
		    var container = $('.stag-list-item');
		    filter =  $(container).find('.stag-suggest');
		    if (!container.is(e.target) // if the target of the click isn't the container...
		        && container.has(e.target).length === 0) // ... nor a descendant of the container
		    {
		        $(filter).css('display','none');
		    }
		});
	})( jQuery );