<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

ob_start();
error_reporting(0); //E_ALL ^ E_NOTICE ^ E_DEPRECATED
ini_set('display_errors', 0);

$response = array();


if($_SERVER["REQUEST_METHOD"] == "GET")
{ 
    $type = $_GET['contentType'];
    if($type == 4) { $path = 'vda-funmunch/videos'; }
    else { $path = 'vda-funmunch'; }
     
    $response = getCategory($path,$type);
}
else
{
	header("HTTP/1.0 404 Not Found");
	die;
}

echo json_encode($response,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

function getCategory($path,$type)
{
    $dir          = $path; //path
    $contentarray = array(); //main array
    $finalarray = array();
    
    if(is_dir($dir))
    { 
        if($dh = opendir($dir))
        {
            while(($file = readdir($dh)) != false)
            {
                if($file == "." or $file == "..")
                { //... 
                } 
                else 
                { 
                    if($type == 4)
                    { 
                        $finalData = getContent($path,$file,$type);
                        $contentarray1 = array('categoryName' => $file,"content" => array($finalData));
                    } 
                    else {  $contentarray1 = array('contentType' => $file); } 

                    array_push($contentarray, $contentarray1);
                    shuffle($contentarray);
                }
            }
        }
    return $return_array = array('message'=> "success", 'status'=>true, 'data'=> $contentarray);
    } 
}
function getContent($path,$path1,$type)
{ 
    //echo $path; echo '<br>'; echo $path1;
    $domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];
    $finalarray = array();
    $dir    = $path.'/'.$path1;
    $files = scandir($dir, 1);
    shuffle($files);
    foreach($files as $filename)
    {
       if($filename == "." or $filename == "..") { // ...  
       } 
       else 
       { 
            if($type == 4)
            {
                $finalarray = getVideoContent($dir,$filename,$type);
            }
            else 
            { 
                $name = substr($filename, 0, strrpos($filename, ".")); // get file name
		        //echo $domain.'/'.$dir.'/'.$filename;
                //$finalarray = array('title' => $name,"fileContent" => $domain.'/riccha_dev/'.$dir.'/'.$filename);
		        $finalarray = array('title' => $name,"fileContent" => $domain.'/'.$dir.'/'.$filename);
            }
            
       }
    }
    
    return $finalarray;
}

function getVideoContent($path,$path1,$type)
{  
    $additional_url ='';
    $doc = $_SERVER['DOCUMENT_ROOT']; 
    $domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'];
    $finalarray1 = array();
    $dir    = $path.'/'.$path1; 
    $files = scandir($dir, 1);
    shuffle($files);
    
	$img = "";
	$imgpath = "";
	foreach($files as $filename)
    {
        if($filename == "." or $filename == "..")
        { // ...  
        } 
        else 
        {   //echo $doc.'/'.$additional_url.$dir.'/'.$filename;
            $mime = mime_content_type($doc.'/'.$additional_url.$dir.'/'.$filename);
            if($type == 4) 
            {
                if(strstr($mime, "video/"))
                {  $vid = $filename;} 
                elseif(strstr($mime, "image/"))
                {  $img = $filename;  $imgpath = $domain.'/'.$dir.'/'.$img;}
            }
            if($type == 4) 
            {
                $finalarray1 = array('title' => $path1, "thumbnail" => $imgpath , "fileContent" => $domain.'/'.$dir.'/'.$vid);
            }
        }
    }
    //print_r($finalarray1);
    return $finalarray1;
}





?>