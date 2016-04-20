<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8">
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />
<title><?php echo $this->_var['page_title']; ?></title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/fonts.css" rel="stylesheet">
<link href="css/animation.css" rel="stylesheet">
<link href="css/photo-list.css" rel="stylesheet">
<?php echo $this->smarty_insert_scripts(array('files'=>'jquery.min.js,bootstrap.min.js')); ?>
<style>
.img{position:relative;}
.img .hover{display:none; position:absolute; left:0; top:0; bottom:0; right:0; background:rgba(0,0,0,0.3); text-align:center; color:#fff; padding-top:50%; font-size:16px;}
.img:hover{cursor:pointer;}
.img:hover .hover{display:block;}

/*gallery*/
.gallery_back{position:absolute; left:0; right:0; top:0; bottom:0; background:rgba(0,0,0,0.7); z-index:100; display:none;}
.gallery{overflow:auto; margin:0 auto;}
.gallery img{max-height:100%; margin:0 auto; display:block;}
.gallery_close{position:absolute; top:10px; right:10px; cursor:pointer;}
</style>

</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>


<div class="cover-img" style="background-image:url(<?php echo $this->_var['prev']; ?>/<?php echo $this->_var['cover']; ?>); margin-top:20px; margin-bottom:20px;"></div>

<center>
	<h1>《<?php echo $this->_var['name']; ?>》</h1>
    <p class="f16">作者：<?php echo $this->_var['username']; ?></p>
    <p style="max-width:400px;" class="line-height-24 f14">
    	<?php echo $this->_var['desc']; ?>
    </p>
    <p class="mt-40 mb-40">
        <span><a href="#" class="mylabel-666 f14">上传照片</a></span>
        <span><a href="#" class="mylabel-900 f14">制作纪念册</a></span>
    </p>
</center>
<div class="liner"></div>



	<div class="container mb-40">
    	<ul class="list-group">
        	<li class="list-unstyled mt-20 mb-20 text-center height-auto">
            	<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                	<img src="<?php echo $this->_var['userimg']; ?>" class="img-responsive myborder img-circle"/>
                    <!--
                    <span class="f36 font2">18</span><br>
                    <span class="f30 font2">3月</span>
                    -->
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 height-auto" style="border-bottom:2px solid #ccc; padding-bottom:30px;" id="list">
                <?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from AS $this->_var['picture']):
        $this->_foreach['list']['iteration']++;
?>
                	<?php if ($this->_foreach['list']['iteration'] < 5): ?>
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-5 img" style="background:url(<?php echo $this->_var['prev']; ?>/<?php echo $this->_var['picture']['original']; ?>) center center no-repeat; background-size:cover; border:5px solid #fff;">
                    </div>
                    <?php else: ?>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-5 img hide" style="background:url(<?php echo $this->_var['prev']; ?>/<?php echo $this->_var['picture']['original']; ?>) center center no-repeat; background-size:cover; border:5px solid #fff;">
                    </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 f16 f-gray" style="text-align:left">
                    <?php echo $this->_var['username']; ?>：<?php echo $this->_var['mem_desc']; ?>
                </div>
                </div>
            </li>
        </ul>
    </div>


<div class="gallery_back">
	<div class="gallery_close" onclick="close_gallery()"><img src="img/close.png" width="24" height="24"/></div>
	<div class="gallery">
    		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" onclick="gallery_pre()">
    			<img src="img/left.png"/>
            </div>
    	<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');$this->_foreach['list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['list']['total'] > 0):
    foreach ($_from AS $this->_var['picture']):
        $this->_foreach['list']['iteration']++;
?>
        	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 img-list">
        		<img src="<?php echo $this->_var['prev']; ?>/<?php echo $this->_var['picture']['original']; ?>" class="img-responsive"/>
            </div>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" onclick="gallery_next()">
        		<img src="img/right.png"/>
            </div>
    </div>
</div>




<?php echo $this->fetch('library/page_footer.lbi'); ?>     
     
     
</body>

<script type="text/javascript">
	$().ready(function(e) {
		num=0;
		total=0;
        $(".img").each(function(index, element) {
            $(this).height($(this).width());
			num++;
			total++;
        });
		var temp = "<div class='hover' onclick='gallery()'><img src='img/right.png' width='21' height='38'/>&nbsp;&nbsp;";
		if(num>4)
		{
			temp += num-4;
		}
		temp += "</div>";
		if(num>4)
		{
			num = 4; 
		}
		$("#list div.img:nth-child("+num+")").html(temp);
		//init gallery
		$(".gallery div.img-list").each(function(index, element) {
            if(index!=(num-1))
			{
				$(this).hide();
			}
        });
		current = num-1;
		//init img height
		$(".gallery img").css("max-height",$(window).height()-20);
		//init ctr arrow
		
    });
	function gallery()
	{
		$("body").css("overflow","hidden");
		$(".gallery_back").css("top",$(document).scrollTop());
		$(".gallery_back").css("height",$(window).height());
		$(".gallery_back").show();
		set_center();
		//current = 3;
	}
	function gallery_pre()
	{
		if(current > 0)
		{
			current--;
			$(".gallery div.img-list").each(function(index, element) {
                $(this).hide();
				if(index == current)
				{
					$(this).fadeIn(600);
				}
            });
		}
		else
		{
			current = total;
			gallery_pre();
		}
		set_center();
	}
	function gallery_next()
	{
		if(current < total-1)
		{
			current++;
			$(".gallery div.img-list").each(function(index, element) {
                $(this).hide();
            });
			$(".gallery div.img-list:nth-child("+current+")").fadeIn(600);
		}
		else
		{
			current = 1;
			gallery_next();
		}
		set_center();
	}
	function set_center()
	{
		var back_height = $(".gallery_back").height();
		var height = $(".gallery").height();
		$(".gallery").css("margin-top",(back_height-height)/2);
		$(".gallery div:first-child").css("margin-top",(height-$(".gallery div:first-child").height())/2);
		$(".gallery div:last-child").css("margin-top",(height-$(".gallery div:first-child").height())/2);
	}
	function close_gallery()
	{
		$("body").css("overflow","");
		$(".gallery_back").hide();
	}
</script>

</html>
