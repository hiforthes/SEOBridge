<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=seobridge;charset=utf8", "root", "");
} catch ( PDOException $e ){
     print $e->getMessage();
}
?>