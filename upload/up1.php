<?php
# 取得上傳檔案數量
$fileCount = count($_FILES['filen']['name']);
$jsonz =  $_POST["z"];
$objz =json_decode($jsonz,true);

for ($i = 0; $i < $fileCount; $i++) {
  # 檢查檔案是否上傳成功
  if ($_FILES['filen']['error'][$i] === UPLOAD_ERR_OK){
    echo '檔案名稱: ' . $_FILES['filen']['name'][$i] . '<br/>';
    // echo '檔案類型: ' . $_FILES['filen']['type'][$i] . '<br/>';
    // echo '檔案大小: ' . ($_FILES['filen']['size'][$i] / 1024) . ' KB<br/>';
    // echo '暫存名稱: ' . $_FILES['filen']['tmp_name'][$i] . '<br/>';
    $imgarr[0][] = $_FILES['filen']['name'][$i] ;
    $imgarr[1][] = 'upload/' . $_FILES['filen']['name'][$i] ;
    # 檢查檔案是否已經存在
    if (file_exists('upload/' . $_FILES['filen']['name'][$i])){
      echo '檔案已存在。<br/>';
    } else {
      $file = $_FILES['filen']['tmp_name'][$i];
      // $file1 = $_FILES['filen']['tmp_name'][$i];
      // echo $file['name'] . '<br>';
      

      $dest = 'upload/' . $_FILES['filen']['name'][$i];

      # 將檔案移至指定位置
      move_uploaded_file($file, $dest);
    }
  } else {
    echo '錯誤代碼：' . $_FILES['filen']['error'] . '<br/>';
  }


}


for ($i=0; $i < count($imgarr[0]) ; $i++) { 
  if($objz[$i]['value'] == $imgarr[0][$i])
    {
      $objz[$i]['value'] = $imgarr[1][$i];
    }
}

// print_r($objz);
echo json_encode($objz, JSON_UNESCAPED_UNICODE);
?>