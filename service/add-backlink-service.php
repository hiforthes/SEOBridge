<?php
include 'db-connection.php';
if (isset($_POST['1more'])) {
    $save = $db->prepare("INSERT IGNORE INTO backlink_monitor SET
	backlink_url=:backlink_url,	
    backlink_domain=:backlink_domain
		");
    $insert = $save->execute(array(
        'backlink_url' => $_POST['backlink_url'],
        'backlink_domain' => $_POST['backlink_domain']

    ));
    if ($insert) {
        header("Location:../backlink-monitor.php?okey");
    } else {
        header("Location:../backlink-monitor.php?no");
    }
}
