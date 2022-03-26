<!DOCTYPE html>
<html lang="en">
<?php include 'service/db-connection.php';
include 'service/bridge-function.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/theme.css">
    <title>SEOBridge by Forthes.com</title>
</head>

<body>
    <section>
        <div class="seobridge">
            <div class="seobridge-exp">
                <h1>SEOBridge </h1>
                <p>SEOBridge is an on-page seo tool made for free to use by <a target="_blank" href="https://forthes.com/"> forthes.com</a>.</p>
                    <a href="index.php"><button class="bridge-button">Home</button></a>
              <a href="add-backlink.php"><button class="bridge-button">Add Backlink</button></a>
             
            </div>
            
            <div class="seobridge-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Backlink URL</th>
                            <th>Control URL</th>
                            <th>Robots</th>
                            <th>Alive?</th>
                            <th>Delete</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $alive = $db->prepare("SELECT * from backlink_monitor ORDER BY backlink_id DESC");
                        $alive->execute();
                        while ($ornot = $alive->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                            <td><?php echo $ornot['backlink_id'] ?></td>
                            <td><?php echo $ornot['backlink_url'] ?></td>
                            <td><?php echo $ornot['backlink_domain'] ?></td>
                            <td><?php echo $ornot['backlink_robots'] ?></td>
                            <td><?php echo $ornot['backlink_alive'] ?></td>
                            <td><a class="bridge-button" href="service/delete-backlink.php?backlink_id=<?php echo $ornot['backlink_id'] ?>&delete=ok">Delete</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
           
        </div>
    </section>
</body>

</html>