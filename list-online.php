<?php
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}
/*
 *Add By KingDragon
 *2016-04-19
 *To get the prev imgUrl
*/
$url = "http://app.itimepost.com/image/host";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_HEADER,0);
$output = curl_exec($ch);
curl_close($ch);
$output = json_decode($output,true);
$img_prev = $output["data"]["qiniu_host"];
$smarty->assign('prev',$img_prev);


if(isset($_POST["id"]))
{
	$mem_id = $_POST["id"];//用户id
}
else
{
	ecs_header("Location: ./\n");
    exit;
}
if(isset($_POST["token"]))
{
	$token = $_POST["token"];//token串
}
else
{
	ecs_header("Location: ./\n");
    exit;
}
if(isset($_POST["name"]))
{
	$user_name = $_POST["name"];//用户名
}
else
{
	ecs_header("Location: ./\n");
    exit;
}
if(isset($_POST["img"]))
{
	$user_img = $_POST["img"];//用户头像
}
else
{
	ecs_header("Location: ./\n");
    exit;
}

$smarty->assign('userimg',$img_prev.'/'.$user_img);
$smarty->assign('username',$user_name);
$smarty->assign('token',$token);

setcookie("prev",$img_prev,time()+3600);
setcookie('token',$token,time()+3600);
setcookie("userimg",$img_prev.'/'.$user_img,time()+3600);
setcookie("username",$user_name,time()+3600);
setcookie("userid",$mem_id,time()+3600);

/*
 *Add By KingDragon
 *2016-04-19
 *To get the user photo list info
*/

$page = isset($_GET["page"])?intval($_GET["page"]):1;
$url = "http://app.itimepost.com/album/list";
$post_data = array("member_id"=>$mem_id,"token"=>$token,"pagetotal"=>1,"page"=>$page);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
$output = curl_exec($ch);
curl_close($ch);
$output = json_decode($output,true);

$smarty->assign('photo_list',$output["data"]["album_list"]);


/* 初始化分页信息 */
$page = isset($_REQUEST['page'])   && intval($_REQUEST['page'])  > 0 ? intval($_REQUEST['page'])  : 1;
$size = isset($output["data"]["pageinfo"]["perPageSize"])  && intval($output["data"]["pageinfo"]["perPageSize"]) > 0 ? intval($output["data"]["pageinfo"]["perPageSize"]) : 10;
$smarty->assign('page_title',       $position['title']);    // 页面标题
$smarty->assign('ur_here',          $position['ur_here']);  // 当前位置
$smarty->assign('category',         $cat_id);
$smarty->assign('brand_id',         $brand);
$smarty->assign('price_max',        $price_max);
$smarty->assign('price_min',        $price_min);
$smarty->assign('filter_attr',      $filter_attr_str);
$smarty->assign('feed_url',         ($_CFG['rewrite'] == 1) ? "feed-c$cat_id.xml" : 'feed.php?cat=' . $cat_id); 

$count = $output["data"]["pageinfo"]["total"];
$max_page = $output["data"]["pageinfo"]["maxpage"];
$pages = array();
$counter = 1;
while($counter <= $max_page)
{
	array_push($pages,$counter);
	$counter++;
}
$smarty->assign("pages",$pages);
$smarty->assign("current_page",$page);
$smarty->display('list.dwt', $cache_id);
?>