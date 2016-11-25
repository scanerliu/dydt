$(function(){
	sub_nav()//sub_nav;
	banner_go()//banner焦点
	card()//选项卡
	adv_go()//advmove
	style_out()//去除一些样式

});



/*sub_nav首页下拉菜单*/
function sub_nav(){
	
	$('.nav_index_left dd').each(function(i){
		$(this).hover(
			function(){
				$('.sub_nav').eq(i).show(400);
				$('.nav_index_left dd').eq(i).css({background:'#f4f4f4'})
			},
			function(){
				$('.sub_nav').hide();
				$('.nav_index_left dd').css({background:''})
			}
		);	
	});	
	

	$('.sub_nav').mouseover(function(){
		$(this).show();
	});
	$('.sub_nav').mouseout(function(){
		$('.sub_nav').hide();
	});



	
}


/*banner_move banner焦点*/
function banner_go(){
	var n = 0;
	var timer = null;
	var len= $('.banner_move img').length;
	//初始化
	$('.banner_move img').eq(0).show();
	$('.move_btn li').eq(0).css({background:'#58a8e5'});
	
	$('.move_btn li').each(function(i){
		$(this).mouseover(function(){
			//alert(i)
			if($('.banner_move img').eq(i).css('display') == 'none'){
				if(!$('.banner_move img').stop(false,true).is(':animated')){
					$('.banner_move img').fadeOut(1000);
					$('.banner_move img').eq(i).fadeIn(1000);
					$('.move_btn li').css({background:'#cccccc'});
					$('.move_btn li').eq(i).css({background:'#58a8e5'});
				};	
			};
			n=i;
		});
	});
	

	//自动走
	timer = setInterval(function(){	
		//alert($('.banner_move img').length)
	if($('.banner_move img').eq(n).css('display') == 'none'){
		if(!$('.banner_move img').is(':animated')){
			$('.banner_move img').fadeOut(2000);
			$('.banner_move img').eq(n).fadeIn(2000);
			$('.move_btn li').css({background:'#cccccc'});
			$('.move_btn li').eq(n).css({background:'#58a8e5'});
		};	
	};
		n++;
		n%=len;
		//alert(n)
	},5000);
	

};


/*首页选项卡*/
function card(){
	var btn = $('.index_card_box dl dt span')
	var box = $('.index_card_box dl dd div')
	//alert(btn.length)
	//star
	box.eq(0).show();
	function btn_style(n){
		btn.eq(n).css({borderBottom: 'none', background: 'none'});
	};
	btn_style(0);
	
	btn.each(function(i){
		
		$(this).mouseover(function(){
		//alert(i)
			box.hide();
			box.eq(i).show();
			btn.css({borderBottom: '#dddddd 1px solid',background:' #f4f4f4'})
			btn_style(i);
		});
	});
	
};

/*adv 移动 首页*/
function adv_go(){
	var timer = null;
	
	/*var box_width = $('.move_adv img').length * 194 +'px';//滚动盒子的长度
	
	//alert(box_width)
	
	$('.move_adv').css({width:'box_width'})*/
	
	//alert(box.css('left'))
function go(){
	$('.move_adv').animate({left:'-194px'},1500,function(){
			
			if($('.move_adv').css('left') == '-194px'){
				
				$('.move_adv img:first').insertAfter($('.move_adv img:last'));
				$('.move_adv').css({left:'0px'})
			};
		});
};		
	
	
	
	timer = setInterval(function(){
		go();
		
	},4000);
		
		
	$('.index_adv').mouseover(function(){
		clearInterval(timer);
	});
	
	$('.index_adv').mouseout(function(){
		timer = setInterval(function(){
			go();
		
		},4000);
	});
};

/*个人中心—图片滑动-封装*/
function cen_go(){
	
		
	
	
	
};

/*菜单下拉——全部商品*/
function nav_down(){
	//$('.nav_index_left dl').css({height:'44px',overflow:'hidden'})
	$('.nav_index_left dl dd').css({display:'none'})
	$('.nav_index_left dl dt').mouseover(function(){
		$('.nav_index_left dl dd').stop(false,true).slideDown()
				//$('.nav_index_left').animate({height:'441px'})
				console.log(0)
	});
	/*$('.my_box_nav').mouseover(function(){
				$('.nav_index_left').animate({height:'441px'})
	});*/
	$('.my_box_nav').mouseleave(function(){
	
			$('.nav_index_left dl dd').stop(false,true).slideUp();
		//	$('.nav_index_left').animate({height:'40px'})
			
	});
			
				
		

	
	
};












/*去除各种样式*/
function style_out(){
	
	$('.centre_box01 dd a').eq(0).css({background:'none'})//个人中心页面
	$('.team_buybox dl:first-child').css({marginLeft:'0'})
	
	
	
	
};



























