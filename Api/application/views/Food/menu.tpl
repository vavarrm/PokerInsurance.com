<html lang="zh-cn">
<head>
	<{include file="frontend/meta.tpl"}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/6.0.0/normalize.min.css">
	<{include file="frontend/css.tpl"}>
	<link rel="stylesheet" href="/css/food/menu.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<{include file="frontend/meta.tpl"}>
    <title><{$language.website_name}></title>
</head>
<body>
	<{include file="frontend/navigation.tpl"}>
	<br>
	<br>
	<div class="wrap">
		<div id="sidebar">
			<div id="cart">
				<div class="header">購物車</div>
				<div class="middle">
					<div>您的購物車中有 0 件商品</div>
					<div>
						<a type="button"  href="/Food/shopCar" class="btn btn-default"><{$foodLanguageAry.food_menu_check}></a>
					</div>
				</div>
			</div>
		</div>
		
		<div class="menu">
			<div class="mini-menu">
				<ul>
					<{foreach from = $foodClassList item=parent key=$k}>
					<li class="<{if $parent}>sub<{/if}>">
						<a href="#"><{$k}></a>
						<{if $parent}>
						<ul>
							<{foreach from=$parent item=sub}>
								<li><a href="#"><{$sub.sub_name}></a></li>
							<{/foreach}>
						</ul>
						<{/if}>
					</li>
					<{/foreach}>
				</ul>
			</div>
			
			<div class="menu-colors menu-item">
				<div class="header-item" >Colors</div>
				<ul class="color-row1">
					<li class="color-circle" style="background:#4286f4"></li>
					<li class="color-circle" style="background:#2acc4b"></li>
					<li class="color-circle" style="background:#343534"></li>
					<li class="color-circle" style="background:#5f605f"></li>
					<li class="color-circle" style="background:#929392"></li>
				</ul>
				<ul class="color-row2">
					<li class="color-circle" style="background:#9e8045"></li>
					<li class="color-circle" style="background:#d3d3d3"></li>
					<li class="color-circle" style="background:#6b6666"></li>
					<li class="color-circle" style="background:#999797"></li>
					<li class="color-circle" style="background:#923476"></li>
				</ul>
			</div>
			
			<div class="menu-size menu-item">
				<div class="header-item" ><{$foodLanguageAry.food_menu_size}></div>
				<ul class="color-row1">
					<li class="color-circle size-circle" ><p class="sizedouble">XS</p></li>
					<li class="color-circle size-circle" style="background-color:#343534" ><p style="color:#999" class="size">S</p></li>
					<li class="color-circle size-circle" ><p class="size">M</p></li>
					<li class="color-circle size-circle" ><p class="size">L</p></li>
					<li class="color-circle size-circle" ><p class="sizedouble">XL</p></li>
				</ul>
			</div>
			<div class="menu-price menu-item">
				<div class="header-item" ><{$foodLanguageAry.food_menu_price}></div>
				<p>
					<!--<label for="amount">Price range:</label>-->
					<input type="text" readonly id="amount"  style="border:0; color:#f6931f; font-weight:bold;">
				</p>
				<div id="slider-range"></div>
			</div>
			
		</div>
		
		<div class="items">
			<div class="items">
				<{foreach from =$foodList item=row}>
				<div data-price="<{$row.food_us_price}>" class="item">
					<img src="http://placehold.it/130x147" alt="jacket" class="img-item"></img>
						<div class="info">
							<h3><{$row.food_name}></h3>
							<p class="descroption"><{$row.food_description}></p>
							<h5>
								$<{$row.food_us_price}>
								<input type="number"  style="width: 40px; padding: 1px" min="0"  max="99" value="0"> 
								<button type="button"  data-price="<{$row.food_us_price}>" class="btn  btn-block addCar"><{$foodLanguageAry.food_menu_addcar}></button>								
							</h5>
						</div>
				</div>
				<{/foreach}>
			<button class="loadmore">Load More</button>
			</div>
		</div>
		<div class="container">
			<!-- Footer -->
			<{include file="frontend/footer.tpl"}>
		</div>
	</div>
    <!-- /.container -->
	<{include file="frontend/js.tpl"}>
</body>
</html>
  <script type="text/javascript">
    $(document).ready(function () 
	{
		var shopCar =[];
		var temp_ary =[];
		<!-- $.cookie('shopCar', '' , { path: '/' });	 -->
		if( $.cookie('shopCar'))
		{  
			var cookie_temp = unescape($.cookie('shopCar')).split('|');
			$.each(cookie_temp,function(i,e){
				if (typeof e === 'string') {
					temp_ary.push((JSON.parse(e))); 
				}
				
			})
			shopCar = cookie_temp;   
		} 
		 console.log(shopCar); 
        $(".sub > a").click(function() {
            var ul = $(this).next(),
                    clone = ul.clone().css({"height":"auto"}).appendTo(".mini-menu"),
                    height = ul.css("height") === "0px" ? ul[0].scrollHeight + "px" : "0px";
            clone.remove();
            ul.animate({"height":height});
            return false;
        });
           $('.mini-menu > ul > li > a').click(function(){
           $('.sub a').removeClass('active');
           $(this).addClass('active');
        }),
           $('.sub ul li a').click(function(){
           $('.sub ul li a').removeClass('active');
           $(this).addClass('active');
        });
   
    
		$( "#slider-range" ).slider({
		  range: true,
		  min: 0,
		  max: 10,
		  values: [ 1, 5 ],
		  slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
				var mi = ui.values[0];
				var mx = ui.values[1];
				filterSystem(mi, mx);
			
		  }
		});
		
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
		  " - $" + $( "#slider-range" ).slider( "values", 1 ) );
		
		$('.addCar').bind('click', function(e){
			e.preventDefault() ;
			var menu_obj ={
				'id':'1',
				'price':'1'
			};
			shopCar.push(JSON.stringify(menu_obj));
			$.cookie('shopCar', escape(shopCar.join('|')));
			<!-- console.log(unescape($.cookie('shopCar'))); -->
			<!-- var cookie_temp = unescape($.cookie('shopCar')).split('|'); -->
			<!-- console.log(cookie_temp); -->
			
		})
	});
	
	function getCookie()
	{
		unescape($.cookie('shopCar')).split('|');
		var cookie_temp = unescape($.cookie('shopCar')).split('|');
		var ary_temp =[];
		$.each(cookie_temp, function(i,e){
			
			ary_temp.push(JSON.parse(e));
		})
		
		return ary_temp;
	}
	
	function setCookie()
	{
		$.cookie('shopCar', escape(shopCar.join(',')));
	}
	
	function addShopCar()
	{
	}
	
	function filterSystem(minPrice, maxPrice) 
	{
      $(".items div.item").hide().filter(function () 
	  {
		var price = parseInt($(this).data("price"), 10);
		return price >= minPrice && price <= maxPrice;
      }).show();
	}
	

	
</script>