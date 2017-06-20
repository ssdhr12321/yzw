<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="author" content="www.frebsite.nl" />
		<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />
		<?php if($category['id'] == null): ?><title>网站首页</title>
		<?php else: ?>
			<title><?php echo ($category['title']); ?></title><?php endif; ?>
		<link rel="stylesheet" type="text/css" href="/Public/mobile/css/common.css" />
		<link rel="stylesheet" type="text/css" href="/Public/mobile/css/swiper.min.css">
		<link rel="stylesheet" type="text/css" href="/Public/mobile/css/wheel_swiper.css" />
		<link type="text/css" rel="stylesheet" href="/Public/mobile/css/css99.css" />
		<link type="text/css" rel="stylesheet" href="/Public/mobile/css/css999.css" />
		<script type="text/javascript" src="/Public/mobile/js/jquery-1.11.0.js"></script>
		<script src="/Public/mobile/js/banner.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="/Public/mobile/js/jjs.js"></script>
		<script src="/Public/mobile/js/common.js" type="text/javascript" charset="utf-8"></script>
		<script src="/Public/mobile/js/jquery.SuperSlide.2.1.1.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(function() {
				$('nav#menu').mmenu({
					extensions: ['effect-slide-menu', 'pageshadow'],
					searchfield: true,
					counters: true,
					navbar: {
						title: '首页'
					},
					navbars: [{
						position: 'top',
						content: ['searchfield']
					}, {
						position: 'top',
						content: [
							'prev',
							//							'title',
							'close'
						]
					}, {
						position: 'bottom',
						content: [
							' WordPress plugin '
						]
					}]
				});
			});
		</script>
	</head>

	<body>
		<div id="page">
			<div class="focus">
				<div class="flexslider">
					<ul class="slides">
					<?php if(is_array($picture)): $i = 0; $__LIST__ = $picture;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><li><img src="<?php echo (get_img($p['cover_id'])); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div>
				<a href="#menu"></a>
			</div>
			<script type="text/javascript">
				$('.flexslider').flexslider({
					directionNav: true,
					pauseOnAction: false
				});
				$(".slides li img").css("height", $("img").width() * 208 / 375);
			</script>
			<div class="content">
				<div class="container">
					<div class="about_us">
						<div class="about_us_img">
							<img src="/Public/mobile/img/about_us_title.png" />
						</div>
					</div>
					<div class="about_us_text">
						<div class="about_us_text_img">
							<img src="<?php echo (get_img($syimg[0]['cover_id'])); ?>" />
						</div>
						<div class="about_us_text_content">
							<?php echo (get_content($gywm['id'])); ?>
							<a href="<?php echo U('Article/lists?category=39&gl=2');?>"><button class="read">阅读全文</button></a>
						</div>
					</div>
					<div class="about_us">
						<div class="about_us_img">
							<img src="/Public/mobile/img/field.png" />
						</div>
					</div>

					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<img src="/Public/mobile/img/jjpp_10.png" />
							</div>
							<div class="swiper-slide">
								<img src="/Public/mobile/img/jjpp_12.png" />
							</div>
							<div class="swiper-slide">
								<img src="/Public/mobile/img/jjpp_14.png" />
							</div>
							<div class="swiper-slide">
								<img src="/Public/mobile/img/jjpp_16.png" />
							</div>
							<div class="swiper-slide">
								<img src="/Public/mobile/img/jjpp_18.png" />
							</div>
							<div class="swiper-slide">
								<img src="/Public/mobile/img/jjpp_20.png" />
							</div>
							<div class="swiper-slide">
								<img src="/Public/mobile/img/jjpp_22.png" />
							</div>
							<div class="swiper-slide">
								<img src="/Public/mobile/img/jjpp_24.png" />
							</div>
						</div>
					</div>
					<script src="/Public/mobile/js/swiper.min.js"></script>
					<script type="text/javascript">
						var swiper = new Swiper('.swiper-container', {
							pagination: '.swiper-pagination',
							slidesPerView: 3,
							paginationClickable: true,
							spaceBetween: 30
						});
					</script>

					<div class="about_us">
						<div class="about_us_img">
							<img src="/Public/mobile/img/information_title.png" />
						</div>
					</div>
				<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><div class="information">
						<a href="<?php echo U('Article/detail?id='.$l['id']);?>">
							<div class="information_img">
								<img src="<?php echo (get_img($l['cover_id'])); ?>" />
							</div>
							<div class="information_text">
								<h2><?php echo ($l['title']); ?></h2>
								<p><?php echo ($l['descroption']); ?></p>
							</div>
						</a>
					</div>
					<?php if(($mod) == "0"): ?><div class="line">
							<img src="/Public/mobile/img/line.png" />
						</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
					<div class="about_us">
						<div class="about_us_img">
							<img src="/Public/mobile/img/team_title.png" />
						</div>
					</div>

					<div class="picMarquee-left">
						<div class="bd">
							<ul class="picList">
							<?php if(is_array($ls)): $i = 0; $__LIST__ = $ls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><li>
									<a href="<?php echo U('Article/detail?id='.$s['id']);?>">
										<div class="lawyer_team_img">
											<img src="<?php echo (get_img($s['cover_id'])); ?>" />
											<div class="lawyer_team_text">
												<p><?php echo ($s['title']); ?></p>
											</div>
										</div>
									</a>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>
					</div>

					<script type="text/javascript">
						jQuery(".picMarquee-left").slide({
							mainCell: ".bd ul",
							autoPlay: true,
							effect: "leftMarquee",
							vis: 4,
							interTime: 20
						});
					</script>

					<!--<a href="">-->
					<a href="<?php echo U('Article/lists?category=41');?>"><p class="more">
						查看更多
					</p></a>
					<!--</a>-->
				</div>
				<footer>
								<div class="foot">
						<ul>
							<li>地址：<?php echo ($lx['adds']); ?></li>
							<li>电话：<?php echo ($lx['phone']); ?></li>
							<li>传真：<?php echo ($lx['fax']); ?></li>
							<li>网址：<?php echo ($lx['webname']); ?></li>
							<li>E-mail:<?php echo ($lx['email']); ?></li>
							<li>技术支持：鼎龙信息科技&nbsp;&nbsp;&copy;2010黑ICP备10008072号</li>
						</ul>
					</div>
				</footer>
			</div>

				<nav id="menu">
				<ul>
      <li ><a href="<?php echo U('index/index');?>">网站首页</a></li>
      <li ><a href="<?php echo U('Article/lists?category=39');?>">关于佳鹏</a></li>
      <li ><a href="<?php echo U('Article/lists?category=41');?>">佳鹏团队</a></li>
      <li ><a href="<?php echo U('Article/lists?category=42');?>">经典案例</a></li>
      <li ><a href="<?php echo U('Article/lists?category=43');?>">佳鹏资讯</a></li>
      <li ><a href="<?php echo U('Article/lists?category=44');?>">关于联盟</a></li>
      <li ><a href="<?php echo U('Article/lists?category=46');?>">广纳贤才</a></li>
      <li ><a href="<?php echo U('Article/lists?category=47');?>">联系我们</a></li>
				</ul>
			</nav>
		</div>
	</body>

</html>