<?php
/*
名称:一言API纯净版
版本:1.0
最后更新时间:2017/10/04 15:57
作者:狂放
作者博客:https://www.iknet.top
作者地址:https://www.iknet.top/hitokoto.html
原作者:小霖
原作者博客:https://xiaolin.in/
原作者地址:https://xiaolin.in/read/hitokoto-api-xiaolin-edition.html
开发:二次开发,已取得原作者二次开发及开源授权
开源协议:GPL v3
GitHub项目地址:https://github.com/kfangf/hitokoto
码云项目地址:https://gitee.com/kfang/hitokoto
版权归作者及原作者所有，任何人不得未经授权修改版权，二次开发请遵守开源协议
版权所有，侵权必究
----------------------------------------------------------
2017-12-22
二次开发：@Guochengjie
https://guoch.xyz
*/ 
header('X-Powered-By:KFang API (api.iknet.top)');
header('access-control-allow-origin:*');
if ($_GET['charset']=='GBK' ||$_GET['charset']=='gbk' || $_GET['charset']=='gb2312'){
  $array=file('hitokoto.txt');
  $rand=rand(0,3385);
 
  function utf8_to_gbk($str){
    return mb_convert_encoding($str, 'gbk', 'utf-8');
}
    $string=$array[$rand];
	header('Content-Type: text/html; charset=GBK');
    if ($_GET['code']==='js' || $_GET['code']==='javascript' || $_GET['code']==='JavaScript') {
		header('Content-type: application/x-javascript; charset=GBK');
          echo "function kfanghitokoto(){document.write(\"";
          echo trim(utf8_to_gbk($string)) . "\");}";
		 } elseif ($_GET['code']==='array' || $_GET['code']==='Array' || $_GET['code']==='arr' || $_GET['code']==='Arr') {
			$arr = array(
			'code' => 200 ,
			'msg' => trim(utf8_to_gbk($string))
			);
			var_dump($arr);
	    }else{
          echo trim(utf8_to_gbk($string));
		}
    }else{ 

  $array=file('hitokoto.txt');
  $rand=rand(0,3385);
  $string=$array[$rand];
  function arrayToXml($arr,$dom=null,$node=null,$root='xml',$cdata=false){  
    if (!$dom){  
        $dom = new DOMDocument('1.0','utf-8');  
    }  
    if(!$node){  
        $node = $dom->createElement($root);  
        $dom->appendChild($node);  
    }  
    foreach ($arr as $key=>$value){  
        $child_node = $dom->createElement(is_string($key) ? $key : 'node');  
        $node->appendChild($child_node);  
        if (!is_array($value)){  
            if (!$cdata) {  
                $data = $dom->createTextNode($value);  
            }else{  
                $data = $dom->createCDATASection($value);  
            }  
            $child_node->appendChild($data);  
        }else {  
            arrayToXml($value,$dom,$child_node,$root,$cdata);  
        }  
    }  
    return $dom->saveXML();  
}  
header('Content-Type: text/html; charset=UTF-8');
    if ($_GET['code']==='js' || $_GET['code']==='javascript' || $_GET['code']==='JavaScript') {
		 header('Content-type: application/x-javascript; charset=UTF-8');
          echo "function kfanghitokoto(){document.write(\"";
          echo trim($string);
          echo "\");}";
		 } elseif ($_GET['code']==='json' || $_GET['code']==='JSON') {
			header('Content-type: application/json; charset=UTF-8');
			$json = json_encode(array(
			'code' => 200 ,
			'msg' => trim($string)
			));
			echo $json;
		} elseif ($_GET['code']==='xml' || $_GET['code']==='XML') {
		$xml = arrayToXml(array(
			'msg' => trim($string)
			));	
			echo $xml;
		 } elseif ($_GET['code']==='array' || $_GET['code']==='Array' || $_GET['code']==='arr' || $_GET['code']==='Arr') {
			$arr = array(
			'code' => 200 ,
			'msg' => trim($string)
			);
		var_dump($arr);
        }else{
          echo trim($string);
          }
	}
?>
