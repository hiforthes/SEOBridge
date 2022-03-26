<?php
include 'db-connection.php';
function AltTextAnalyzer($ImageList,$AltTextList) {
    $search_map = array('["','"]');
    $replace_map = array('','');
    $cleaned_Images_List = str_replace($search_map,$replace_map,$ImageList);
    $cleaned_Images_Array = explode('", "',$cleaned_Images_List);
    $cleaned_AltText_List = str_replace($search_map,$replace_map,$AltTextList);
    $cleaned_AltText_Array = explode('", "',$cleaned_AltText_List);
    $counter = 0;
    $resultset = "";
    foreach($cleaned_AltText_Array as $key=>$item){
      if($item == "Alt missing") {
        $resultset .= $cleaned_Images_Array[$key];
        $counter++;
      }
    }
    return [
            "items"=>$resultset,
            "counter"=>$counter
          ];
  }
  if(isset($_POST['cleardb'])) {
      $delete = $db->prepare("TRUNCATE TABLE analysis");
      $delete->execute();
      header("Location:../index.php");
  }
?>