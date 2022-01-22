<a id="scrollUp" href="#top"><i class="fa fa-angle-up"></i></a>

<link rel="stylesheet" href="__TPL__/css/date.css" />

<style>
#scrollUp {
    position: fixed;
    z-index: 100;
	border-radius:100%;
	background-color: #777;
	color: #eee;
	font-size: 40px;
	line-height: 1;
    text-align: center;
    text-decoration: none;
    bottom: 2em;
    right: 10px;
    overflow: hidden;
    width: 46px;
	height: 46px;
	border: none;
	opacity: 0.6;
}
</style>

<script type="text/javascript" src="__TPL__/js/jquery-1.8.3.min.js" ></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.json.js" ></script> 
<script type="text/javascript" src="__PUBLIC__/js/common.js?222"></script>
<script type="text/javascript" src="__PUBLIC__/js/jquery.more.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/utils.js" ></script>
<script type="text/javascript" src="__TPL__/js/date.js" ></script>
<script src="__TPL__/js/TouchSlide.1.1.js"></script>

<script src="__TPL__/js/jquery.timer.js"></script>
<script src="__TPL__/js/ectouch_gpl.js"></script> 
<script src="__TPL__/js/simple-inheritance.min.js"></script> 
<script src="__TPL__/js/code-photoswipe-1.0.11.min.js"></script> 
<script src="__PUBLIC__/bootstrap/js/bootstrap.min.js"></script> 
<script src="__TPL__/js/jquery.scrollUp.min.js"></script> 
<script type="text/javascript" src="__PUBLIC__/js/validform.js" ></script>

<script type="text/javascript">
$(function () {
    $('#endTime').date({theme:"datetime"});

});
</script>
<script language="javascript">
	/*banner滚动图片*/
		TouchSlide({
			slideCell : "#focus",
			titCell : ".hd ul", // 开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
			mainCell : ".bd ul",
			effect : "left",
			autoPlay : true, // 自动播放
			autoPage : true, // 自动分页
			delayTime: 200, // 毫秒；切换效果持续时间（执行一次效果用多少毫秒）
			interTime: 2500, // 毫秒；自动运行间隔（隔多少毫秒后执行下一个效果）
			switchLoad : "_src" // 切换加载，真实图片路径为"_src"
		});
	/*弹出评论层并隐藏其他层*/
	function openSearch(){
		if($(".con").is(":visible")){
			$(".con").hide();
			$(".search").show();
		}
	}
	function closeSearch(){
		if($(".con").is(":hidden")){
			$(".con").show();
			$(".search").hide();
		}
	}
</script>
