<?php
function slug($text)
{


  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);


  $text = trim($text, '-');


  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);


  $text = strtolower($text);


  $text = preg_replace('~[^-\w]+~', '', $text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}


function isImage($file)
{
  $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/blog/assets/img/articleImages/";
  $fileName = basename($_FILES[$file]["name"]);
  $fileNameNoExtension = preg_replace("/\.[^.]+$/", "", $fileName);
  $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
  $fileName = md5(time()) . "." . $fileType;
  $targetFilePath = $uploadDir . $fileName;

  $fileTypes = array('jpg', 'png', 'jpeg');
  if(in_array($fileType, $fileTypes)){
  $file->$fileName = $fileName;
  $file->$targetFilePath = $targetFilePath;
  return $file;
}
else{
  echo 'File is not an image..!';
}
}
