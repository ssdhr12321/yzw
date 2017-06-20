<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($hd['0']['value']); ?></title>
<meta name='keyword' content="<?php echo ($hd['2']['value']); ?>" />
<meta name='description' content="<?php echo ($hd['1']['value']); ?>" />
<link rel="stylesheet" type="text/css" href="/Public/Home/css/style.css"/>
<link rel="stylesheet" href="/Public/Home/css/datouwang.css">
<link rel="stylesheet" type="text/css" href="http://www.hot80.com/demo/css/wxs.page.css">
<script src="/Public/Home/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="/Public/Home/js/jquery.FainPic.js" type="text/javascript"></script>
<script type="text/javascript" src="/Public/Home/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="/Public/Home/js/gundongM.js"></script>
<script type="text/javascript">
$(function(){
   $.ScrollPic({
    ele: '.yiz-slider-1',   //插件应用div
    Time:'3000',          //自动切换时间
    autoscrooll:true,       //设置是否自动渐变
  });
})
</script>

<!--切换开始-->
<script>
/*!
 * SlideTrans
 * Copyright (c) 2010 cloudgamer
 * Blog: http://cloudgamer.cnblogs.com/
 * Date: 2008-7-6
 */



var $$ = function (id) {
    return "string" == typeof id ? document.getElementById(id) : id;
};

var Extend = function(destination, source) {
    for (var property in source) {
        destination[property] = source[property];
    }
    return destination;
}

var CurrentStyle = function(element){
    return element.currentStyle || document.defaultView.getComputedStyle(element, null);
}

var Bind = function(object, fun) {
    var args = Array.prototype.slice.call(arguments).slice(2);
    return function() {
        return fun.apply(object, args.concat(Array.prototype.slice.call(arguments)));
    }
}

var forEach = function(array, callback, thisObject){
    if(array.forEach){
        array.forEach(callback, thisObject);
    }else{
        for (var i = 0, len = array.length; i < len; i++) { callback.call(thisObject, array[i], i, array); }
    }
}

var Tween = {
    Quart: {
        easeOut: function(t,b,c,d){
            return -c * ((t=t/d-1)*t*t*t - 1) + b;
        }
    },
    Back: {
        easeOut: function(t,b,c,d,s){
            if (s == undefined) s = 1.70158;
            return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
        }
    },
    Bounce: {
        easeOut: function(t,b,c,d){
            if ((t/=d) < (1/2.75)) {
                return c*(7.5625*t*t) + b;
            } else if (t < (2/2.75)) {
                return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
            } else if (t < (2.5/2.75)) {
                return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
            } else {
                return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
            }
        }
    }
}


//容器对象,滑动对象,切换数量
var SlideTrans = function(container, slider, count, options) {
    this._slider = $$(slider);
    this._container = $$(container);//容器对象
    this._timer = null;//定时器
    this._count = Math.abs(count);//切换数量
    this._target = 0;//目标值
    this._t = this._b = this._c = 0;//tween参数
    
    this.Index = 0;//当前索引
    
    this.SetOptions(options);
    
    this.Auto = !!this.options.Auto;
    this.Duration = Math.abs(this.options.Duration);
    this.Time = Math.abs(this.options.Time);
    this.Pause = Math.abs(this.options.Pause);
    this.Tween = this.options.Tween;
    this.onStart = this.options.onStart;
    this.onFinish = this.options.onFinish;
    
    var bVertical = !!this.options.Vertical;
    this._css = bVertical ? "top" : "left";//方向
    
    //样式设置
    var p = CurrentStyle(this._container).position;
    p == "relative" || p == "absolute" || (this._container.style.position = "relative");
    this._container.style.overflow = "hidden";
    this._slider.style.position = "absolute";
    
    this.Change = this.options.Change ? this.options.Change :
        this._slider[bVertical ? "offsetHeight" : "offsetWidth"] / this._count;
};
SlideTrans.prototype = {
  //设置默认属性
  SetOptions: function(options) {
    this.options = ,//开始转换时执行
        onFinish:   function(){},//完成转换时执行
        Tween:      Tween.Quart.easeOut//tween算子
    };
    Extend(this.options, options || {});
  },
  //开始切换
  Run: function(index) {
    //修正index
    index == undefined && (index = this.Index);
    index < 0 && (index = this._count - 1) || index >= this._count && (index = 0);
    //设置参数
    this._target = -Math.abs(this.Change) * (this.Index = index);
    this._t = 0;
    this._b = parseInt(CurrentStyle(this._slider)[this.options.Vertical ? "top" : "left"]);
    this._c = this._target - this._b;
    
    this.onStart();
    this.Move();
  },
  //移动
  Move: function() {
    clearTimeout(this._timer);
    //未到达目标继续移动否则进行下一次滑动
    if (this._c && this._t < this.Duration) {
        this.MoveTo(Math.round(this.Tween(this._t++, this._b, this._c, this.Duration)));
        this._timer = setTimeout(Bind(this, this.Move), this.Time);
    }else{
        this.MoveTo(this._target);
        this.Auto && (this._timer = setTimeout(Bind(this, this.Next), this.Pause));
    }
  },
  //移动到
  MoveTo: function(i) {
    this._slider.style[this._css] = i + "px";
  },
  //下一个
  Next: function() {
    this.Run(++this.Index);
  },
  //上一个

  Previous: function() {
    this.Run(--this.Index);
  },
  //停止
  Stop: function() {
    clearTimeout(this._timer); this.MoveTo(this._target);
  }
};</script><script>
new SlideTrans("idContainer", "idSlider", 3, { Vertical: false }).Run();
</script>
<!--切换结束-->
</head>

<body>
<div class="top">
  <div class="logo"><img src="/Public/Home/images/jjpp_02.png"></div>
  <div class="nav">
    <ul>
      <a href="<?php echo U('index/index');?>"><li class="boxone">网站首页</li></a>
      <a href="<?php echo U('Article/lists?category=39');?>"><li <?php if($category['id'] == 39): ?>class="boxone"<?php endif; ?> >关于佳鹏</li></a>
      <a href="<?php echo U('Article/lists?category=41');?>"><li <?php if($category['id'] == 41): ?>class="boxone"<?php endif; ?> >佳鹏团队</li></a>
      <a href="<?php echo U('Article/lists?category=42');?>"><li <?php if($category['id'] == 42): ?>class="boxone"<?php endif; ?> >经典案例</li></a>
      <a href="<?php echo U('Article/lists?category=43');?>"><li <?php if($category['id'] == 43): ?>class="boxone"<?php endif; ?> >佳鹏资讯</li></a>
      <a href="<?php echo U('Article/lists?category=44');?>"><li <?php if($category['id'] == 44): ?>class="boxone"<?php endif; ?> >关于联盟</li></a>
      <a href="<?php echo U('Article/lists?category=46');?>"><li <?php if($category['id'] == 46): ?>class="boxone"<?php endif; ?> >广纳贤才</li></a>
      <a href="<?php echo U('Article/lists?category=47');?>"><li <?php if($category['id'] == 47): ?>class="boxone"<?php endif; ?> >联系我们</li></a>
    </ul>
  </div>
</div>
<!--banner-->
<div class="focus">
  <div class="flexslider">
    <ul class="slides">
    <?php if(is_array($picture)): $i = 0; $__LIST__ = $picture;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pic): $mod = ($i % 2 );++$i;?><li style="background:url(<?php echo (get_img($pic['cover_id'])); ?>) 50% 0 no-repeat;"></li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>

  <script type="text/javascript">
    $('.flexslider').flexslider({
                    directionNav: true,
                    pauseOnAction: false
                });

  </script>
</div>
<!--main-->
<div class="gy"><img src="/Public/Home/images/gy.png"></div>
<div class="main1">
  <div class="main1_A">
<div class="datouwang">
    <div class="yiz-slider-1">
        <ul>
          <?php if(is_array($syimg)): $i = 0; $__LIST__ = $syimg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$i): $mod = ($i % 2 );++$i;?><li><img src="<?php echo (get_img($i['cover_id'])); ?>"/></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>

  </div>
  <div class="main1_B">
    <div class="main1_B1"><p><?php echo (get_content($gywm['id'])); ?></p></div>
    <div class="main1_B2"><p><a href="<?php echo U('Article/lists?category=39&gl=2');?>">阅读全文</a></p></div>
  </div>
</div>
<div class="yw"><img src="/Public/Home/images/yw.png"></div>
<div class="main2">
  <li><a href=""><img src="/Public/Home/images/jjpp_10.png"></a></li>
  <li><a href=""><img src="/Public/Home/images/jjpp_12.png"></a></li>
  <li><a href=""><img src="/Public/Home/images/jjpp_14.png"></a></li>
  <li><a href=""><img src="/Public/Home/images/jjpp_16.png"></a></li>
  <li><a href=""><img src="/Public/Home/images/jjpp_18.png"></a></li>
  <li><a href=""><img src="/Public/Home/images/jjpp_20.png"></a></li>
  <li><a href=""><img src="/Public/Home/images/jjpp_22.png"></a></li>
  <li><a href=""><img src="/Public/Home/images/jjpp_24.png"></a></li>
</div>
<div class="zx"><img src="/Public/Home/images/zx.png"></div>

<div class="main3">  
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><li>
     <a href="<?php echo U('Article/detail?id='.$l['id']);?>">
        <img src="<?php echo (get_img($category[$l['category_id']]["icon"])); ?>">
        <p class="p1"><?php echo ($l['title']); ?></p>
        <p><?php echo ($l['description']); ?></p>
        <span class="p2">查看详情>></span> 
     </a>
  </li><?php endforeach; endif; else: echo "" ;endif; ?>
</div>

<div class="more"><a href="<?php echo U('Article/lists?category=43');?>"><p>查看更多</p></a></div>
<div class="td"><img src="/Public/Home/images/td.png"></div>
<div class="main4">
  <div class="cp_B">
    <div id="demoM">
      <div id="indemoM">
        <div id="demo1M">
          <?php if(is_array($ls)): $i = 0; $__LIST__ = $ls;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="cheliang_tupianM"><a href="<?php echo U('Article/detail?id='.$item['id']);?>" ><img src="<?php echo (get_img($item["cover_id"])); ?>"/></br><p>律师团队</p></a></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div id="demo2M"></div>
      </div>
    </div>  

  </div>
</div>
<!--页脚-->
<div class="footer">
  <div class="clear"></div>
  <div class="footer1">
    <p>
    地址：<?php echo ($lx["adds"]); ?>&nbsp;&nbsp;&nbsp;电话：<?php echo ($lx["phone"]); ?></br>
传真：<?php echo ($lx["fax"]); ?>&nbsp;&nbsp;&nbsp;网址：<?php echo ($lx["webname"]); ?>&nbsp;&nbsp;&nbsp;E-mail：<?php echo ($lx["email"]); ?> </br>
技术支持：鼎龙信息科技&nbsp;&nbsp;&nbsp;©2010 黑ICP备10008072号 
    </p>
  </div>
</div>
</body>
</html>