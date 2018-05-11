<?php
date_default_timezone_set('Asia/Shanghai');
function _GET($n) { return isset($_GET[$n]) ? $_GET[$n] : NULL; }
function _SERVER($n) { return isset($_SERVER[$n]) ? $_SERVER[$n] : '[undefine]'; }
if (_GET('act') == 'phpinfo') {
if (function_exists('phpinfo')) phpinfo();
else echo 'phpinfo() Function has been disabled.';
exit;
}
$Info = array();
$Info['php_ini_file'] = function_exists('php_ini_loaded_file') ? php_ini_loaded_file() : '[undefine]';
function get_ea_info($name) { $ea_info = eaccelerator_info(); return $ea_info[$name]; }
function get_gd_info($name) { $gd_info = gd_info(); return $gd_info[$name]; }
function memory_usage() { $memory  = ( ! function_exists('memory_get_usage')) ? '0' : round(memory_get_usage()/1024/1024, 2).'MB'; return $memory;}
function micro_time_float() { $mtime = microtime(); $mtime = explode(' ', $mtime); return $mtime[1] + $mtime[0];}
define('YES', '<span style="color: #008000; font-weight : bold;">已开启</span>');
define('NO', '<span style="color: #e74c3c; font-weight : bold;">未开启</span>');
$up_start = micro_time_float();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP探针</title>
<style type="text/css">
<!--
*{margin:0px;padding:0px;}
body {background-color:#FFFFFF;color:#000000;margin:0px;font-family:"\5fae\8f6f\96c5\9ed1",tahoma,arial,sans-serif;}
input {text-align:center;width:200px;height:20px;padding:5px;}
a:link {color:#e74c3c; text-decoration:none;}
a:visited {color:#e74c3c;text-decoration:none;}
a:active {color:#ed776b;text-decoration:none;}
a:hover {color:#ed776b;text-decoration:none;}
table {border-collapse:collapse;margin:10px 0px;clear:both;}
.inp tr th, td {padding:2px 5px 2px 5px;vertical-align:center;text-align:center;height:30px; border:1px #FFFFFF solid;}
.head1 { background-color: #2c3e50; width: 100%; font-size: 36px; color: #ffffff; padding-top: 10px; text-align: center; font-family: Georgia, "Times New Roman", Times, serif; font-weight: bold; }
.head2 { background-color: #1abc9c; width: 100%; font-size: 18px; height: 18px; color: #ffffff; }
.el { text-align: center; background-color: #d3e1e5; }
.er { text-align: right; background-color: #d3e1e5; }
.ec { text-align: center; background-color: #1abc9c; font-weight: bold; color: #FFFFFF; }
.fl { text-align: left; background-color: #ecf0f1; color: #505050; }
.fr {text-align:right;background-color:#eeeeee;color:#505050;}
.fc { text-align: center; background-color: #ecf0f1; color: #505050; }
.ft {text-align:center;background-color: #D9F9DE;color:#060;}
a.arrow {font-family:webdings,sans-serif;font-size:10px;}
a.arrow:hover {color:#ff0000;text-decoration:none;}
-->
</style>
</head>
<body>
<div class="head1"><a href="http://php..net" style="color:#ffffff" >{  PHP 探针 }</a></div>
<div class="head2"></div>
<div style="margin:0 auto;width:1001px;overflow:hidden;">
<table width="100%" class="inp">
<tr>
<th colspan="2" class="ec" width="50%">服务器信息</th>
<th colspan="2" class="ec" width="50%">PHP功能组件开启状态</th>
</tr>
<tr>
<td class="er" width="12%">服务器域名</td>
<td class="fl" width="38%"><?=_SERVER('SERVER_NAME')?></td>
<td class="er" width="20%">MySQLi Client组件</td>
<td class="fc" width="30%"><?=function_exists('mysqli_close') ? YES : NO ?></td>
</tr>
<tr>
<td class="er">服务器端口</td>
<td class="fl"><?=_SERVER('SERVER_ADDR').':'._SERVER('SERVER_PORT')?></td>
<td class="er">SQLite Client组件</td>
<td class="fc"><?=phpversion('pdo_sqlite') ? YES : NO ?></td>
</tr>
<tr>
<td class="er">服务器环境</td>
<td class="fl"><?=stripos(_SERVER('SERVER_SOFTWARE'), 'PHP')?_SERVER('SERVER_SOFTWARE'):_SERVER('SERVER_SOFTWARE')?></td>
<td class="er">GD library组件</td>
<td class="fc"><?=function_exists('gd_info') ? YES : NO ?></td>
</tr>
<tr>
<td class="er">PHP运行环境</td>
<td class="fl"><?=PHP_SAPI .' PHP/'.PHP_VERSION?></td>
<td class="er">EXIF信息查看组件</td>
<td class="fc"><?=phpversion('exif') ? YES : NO ?></td>
</tr>
<tr>
<td class="er">PHP配置文件</td>
<td class="fl"><?=$Info['php_ini_file']?></td>
<td class="er">OpenSSL协议组件</td>
<td class="fc"><?=function_exists('openssl_open') ? YES : NO ?></td>
</tr>
<tr>
<td class="er">当前网站目录</td>
<td class="fl"><?=_SERVER('DOCUMENT_ROOT')?></td>
<td class="er">SendMail电子邮件支持</td>
<td class="fc"><?=phpversion('standard') ? YES : NO ?></td>
</tr>
<tr>
<td class="er">服务器标准时</td>
<td class="fl">
<?=gmdate('Y-m-d H:i:s', time() + 3600 * 8)?>
</td>
<td class="er" >详细信息</td>
<td class="fc">
    <a href='<?=htmlentities($_SERVER['PHP_SELF'])?>?act=phpinfo'>phpinfo()</a>
    <a href='http://72.php.localtest.me'>72</a>
    <a href='http://56.php.localtest.me'>56</a>
</td>
</tr>
</table>
<table width="100%" class="inp">
<tr>
<td colspan="2" class="ec" width="50%">PHP Zend解密组件</td>
<td colspan="3" class="ec" width="50%">PHP 缓存优化组件</td>
</tr>
<tr>
<td class="el">Zend Guard Loader</td>
<td class="el">ionCube Loader</td>
<td class="el">XCache</td>
<td class="el">ZendOPcache</td>
<td class="el">Memcache</td>
</tr>
<tr>
<td class="fc"><?=function_exists('zend_loader_version') ? YES : NO ?></td>
<td class="fc"><?=function_exists('ionCube_Loader_version') ? YES : NO ?></td>
<td class="fc"><?=phpversion('XCache') ? YES : NO ?></td>
<td class="fc"><?=phpversion('Zend OPcache') ? YES : NO ?></td>
<td class="fc"><?=function_exists('memcache_close') ? YES : NO ?></td>
</tr>
</table>
<table width="100%" class="inp">
<tr>
<th class="ec">PHP已编译模块检测</th>
</tr>
<tr>
<td class="fl" style="text-align:center;">
<?php
$able=get_loaded_extensions();
foreach ($able as $key=>$value) {
if ($key!=0 && $key%13==0) {
echo '<br />';
}
echo "$value&nbsp;&nbsp;&nbsp;&nbsp;";
}
?>
</td>
</tr>
</table>
<p style="color:#33384e;font-size:14px;text-align:center; margin-bottom:2px;">
<?php $up_time = sprintf('%0.6f', micro_time_float() - $up_start);?>页面执行时间 <?php echo $up_time?> 秒&nbsp;&nbsp;&nbsp;消耗内存 <?php echo memory_usage();?>
</p>
</div>
</body>
</html>
