<?php 

function removeDirectoryAndFiles($directory)
{
    foreach(glob("{$directory}/*") as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }
    rmdir($directory);
}

function encodeData($data){

    return urlencode(base64_encode($data));
}
function decodeData($data){
    
return base64_decode(urldecode($data));
}

?>