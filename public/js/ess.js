var ss = function(text){
			console.log(text)
		}
		var aa = function(text){
			alert(text)
		}
		var fadeIn = function(elem){
			elem.animate({
				top:'70px',
				opacity:'1'
			},300,'linear')
		}
		var fadeOut = function(elem){
			elem.animate({
				top:'-56px',
				opacity:'0'
			},300,'linear')
		}
		
		var notify = function(type, mess,func){
			$(s).text(2)
			$(notifMes).text(mess)
			$(notifPanel).attr('class',type)
			fadeIn($(notifPanel))
			var fOTimeout = setTimeout(function(){
				fadeOut($(notifPanel))
				// clearInterval(cMInterval);
			},2010)
			// var cMInterval = setInterval(function(){
			// 	$(s).text(parseInt($(s).text()) -1)
			// },1000)
			$(notifClose).click(function(){ 
				clearTimeout(fOTimeout)
				fadeOut($(notifPanel))
				// clearInterval(cMInterval);
			})
			
		}

		var cleanForm = function(form){
			form.children('input[type=text]').val('')
			form.children('textarea').val('')
			form.children('input[type=password]').val('')
			form.children('input[type=tel]').val('')
			form.children('input[type=email]').val('')
			form.children('select').val('0')
			form.children('#fileBox').children('input[type=file]').val('')
		}

		var lShow = function(){
			$(loaderDiv).css('display','flex')
		}
		var lHide = function(){
			$(loaderDiv).hide()
		}

		var starAp = function(n,elem){
			for(var i = 0; i<n; i++){
				elem.append("<i class='fa fa-star'></i>")
			}
			return elem;
		}
		
		var rH = function(a){
	        	if(a < 10) return '0'+a;
	        	else return a;
        	}

		var afDate = function(a){
       		
			var monthLetter = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
			if(a !== null){
				var b = new Date(a.replace(/-/g, "/"))
				var nSec = (Date.now()/1000) - (b.getTime()/1000)
				if(nSec < 59) return ' Few seconds ago';
				else if(nSec > 59 && nSec < 3600) return Math.floor(nSec/60)+' mins ago';
				else if(nSec > 3600 && nSec < 86400) return Math.floor(nSec/3600)+' h '+Math.floor((nSec%3600)/60)+'mins ago';
				else return rH(b.getDate())+' '+ monthLetter[b.getMonth()]+', '+rH(b.getHours())+':'+rH(b.getMinutes());
			}else{
				return '';
			}
			
		}
		var aDate = function(a){
       		if(a !== null){
				var monthLetter = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
				var b =   new Date(a.replace(/-/g, "/"))
				return rH(b.getDate())+' '+ monthLetter[b.getMonth()]+' '+b.getFullYear()+', '+rH(b.getHours())+':'+rH(b.getMinutes());
			}else{
				return '';
			}
		}
		var aDateU = function(a){
			var rH = function(a){
	        	if(a < 10) return '0'+a;
	        	else return a;
        	}
       
			var monthLetter = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
			var b = new Date(a.replace(/-/g, "/"))
			return rH(b.getDate())+' '+ monthLetter[b.getMonth()]+', '+b.getFullYear();
		}
		
		var aTimeU = function(a){
			var rH = function(a){
	        	if(a < 10) return '0'+a;
	        	else return a;
        	}
       		a = 'January 31 1980 '+a
			var b = new Date(a.replace(/-/g, "/"))
			return rH(b.getHours())+':'+rH(b.getMinutes());
		}

		var timer = function(a,b,c){
			var d = new Date();
			$(a).text(rH(d.getHours()))
			$(b).text(rH(d.getMinutes()))
			$(c).text(rH(d.getSeconds()))
		}
		setInterval(function(){ timer(a,b,c) },1000)

		$('nav a').each(function(){
        if($(this).attr('href')==$('#file').text()) $(this).attr('id','actif');
        else if($(this).attr('href')==$('#file').text() && $('#loog').css('display')=='none') $(this).attr('id','actif');
		});

	$(document).on('click', '.selectD > span',  function(){
		
		if($(this).siblings('div').css('display') == 'none'){
			$('.selectD > div').hide()
			$(this).siblings('div').show()
		}else{
			$(this).siblings('div').hide()
		}
	})

	$(document).on('click', '.selectD div  div span', function(){
		var div = $(this).parent('div')
		mainSpan = div.parent('div').siblings('span')

		inputH = div.siblings('input[type=hidden]')
		inputN = div.siblings('input[type=text]')

		mainSpan.text($(this).text())
		inputH
		.val($(this).attr('data-mValue')||$(this).text())
		.attr('data-mValueName',$(this).text())
		.trigger('change');

		//inputN.val('')
		$(this).siblings('span').css({
			backgroundColor:'unset',
			color:"unset"
		})
		$(this).css({
			backgroundColor:'#4747d5',
			color:"white"
		})
		$('.selectD >div').hide()
	})

	$('.select').each(function(){
		var name = $(this).attr('name')

		valueToShow = $(this).attr('data-mValueToShow')
		
		var div = $('<div>').attr('class','value');

		var l = $(this).children('option').length



		for(var i = 0; i<l;i++){	
			var element = $(this).children('option:eq('+i+')') 
			div
			.append(
				$('<span>')
				.attr('data-mValue',element.val())
				.text(element.text())
			)

		}


		var additional = $(this).attr('data-manualText')
		var manuallyAddHtml = ""
		
		if(additional) {
			manuallyAddHtml = "<span class='selectManualButton' data-selectManualButton='"+additional+"' >"+additional+"</span>"
			
		}

		var divv = $('<div>')
		.attr('class','selectD')
		.append('<span >'+valueToShow+'</span>')
		.append(
			
			$('<div>')
			.append("<input class='select' type='text'  placeholder='type here to search'>")
			.append("<input class='manualInputInput' type='hidden' name='"+name+"' value='' placeholder='"+$(this).attr('placeholder')+"' >  ")
			.append("<span class='manualInputOk'></span>")
			.append(div)
			.append(manuallyAddHtml)
			
		)
		


		$(this).replaceWith(divv)	
	})
	
	$(document).on('keyup', '.selectD div input', function(){
		var value = $(this).siblings('.value')
		value.children('span').hide()
		var val = $(this).val().toLowerCase();
	    value.children('span').each(function() {
	    	if($(this).text().toLowerCase().indexOf(val) > -1) $(this).show()
	      
	    }); 
		
	})

	

	$(document).on('click',' .selectManualButton' ,function(){
		
		$(this).siblings('.value').hide()
		$(this).siblings('.select').hide()
		$(this).siblings('.manualInputOk').show()
		$(this).siblings('input[name=requesterName]')
		.attr('type','text')
		.val('')
		$(this)
		.attr('class','selectManualButtonCancel')
		.text('Cancel')
	})

	$(document).on('click',' .selectManualButtonCancel' ,function(){
		
		$(this).siblings('.value').show()
		$(this).siblings('.select').show()
		$(this).siblings('.manualInputOk').hide()
		$(this).siblings('input[name=requesterName]').attr('type','hidden')
		$(this)
		.attr('class','selectManualButton')
		.text($(this).attr('data-selectManualButton'))
	})

	$(document).on('click',' .manualInputOk' ,function(){
		$('.selectD >div').hide()
		var div = $(this).parent('div')
		mainSpan = div.siblings('span')
		mainSpan.text($(this).siblings('input[name=requesterName]').val())
		
	})

	$(document).click(function(event) { 
		  var $target = $(event.target);
		  if(!$target.closest('.selectD').length) {
		    $('.selectD > div').hide();
		  }        
	});
	var shrinkVar = readCookie('shrink')

	$('#shrink').click(function(){
		
		if($('nav').css('width') == '50px'){
			eraseCookie('shrink')
			$('nav a span').css('display','inline');
			$('nav').css({
				width:'160px',
				'text-align': 'unset'
			})
			$('section').css('margin-left',"160px")
			
			shrinkVar = null
		}else{
			createCookie('shrink','yes',365)
			
			$('nav a span').css('display','none');
			$('nav').css({
				width:'50px',
				'text-align': 'center'
			})
			$('section').css('margin-left',"50px")
			shrinkVar = 'yes'
		}
		ss(shrinkVar)
	})
	var nav  = $('nav');
    $('nav')
    .mouseenter(function(){
    	if(shrinkVar){
    		$('nav a span').css('display','inline');
			$('nav').css({
				width:'160px',
				'text-align': 'unset'
			})
			$('section').css('margin-left',"160px")
    	}
    	
    })
    .mouseleave(function(){
    	if(shrinkVar){
    		$('nav a span').css('display','none');
			$('nav').css({
				width:'50px',
				'text-align': 'center'
			})
			$('section').css('margin-left',"50px")
    	}
    })
