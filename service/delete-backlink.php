
<?php
include 'db-connection.php';
if($_GET['delete']== 'ok') {
    $delete = $db->prepare("DELETE from backlink_monitor where backlink_id=:id");
    $controller = $delete->execute(array(
        'id' => $_GET['backlink_id']
    ));
    if ($controller) {
        header("Location:../backlink-monitor.php?true");
    } else {
        header("Location:../backlink-monitor.php?wrong");
    }
}
?>