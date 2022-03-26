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
                <a href="index.php"> <button class="bridge-button">Home</button> </a>
                <p>URLS Must be https://domain.com</p>
            </div>

            <form action="service/add-backlink-service.php" method="POST">
                <input name="backlink_url" type="text" placeholder="URL"><br>
                <input name="backlink_domain" type="text" placeholder="Domain"><br>
                <button name="1more" class="bridge-button">Submit</button>
            </form>

        </div>
    </section>
</body>

</html>