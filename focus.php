<!DOCTYPE html>
<html lang="en">
<?php include 'service/db-connection.php';
include 'service/bridge-function.php';
$focuspage = $db->prepare("SELECT * FROM analysis where analysis_id=:id");
$focuspage->execute(array(
    'id' => $_GET['analysis_id']
));
$focus = $focuspage->fetch(PDO::FETCH_ASSOC);
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
        <div class="seobridge-exp">
            <h1>SEOBridge </h1>
            <p>SEOBridge is an on-page seo tool made for free to use by <a target="_blank" href="https://forthes.com/"> forthes.com</a>.</p>
            <a href="index.php"> <button class="bridge-button">Main</button></a>
            <p><strong>Crawl Time : </strong>  <?php $published = date_create($focus['analysis_time']);
                                    echo date_format($published, 'M d, Y'); ?></p>
            <p><strong>Focused URL : <img src="https://s2.googleusercontent.com/s2/favicons?domain=<?php echo $focus['analysis_url'] ?>"> </strong><?php echo $focus['analysis_url']; ?></p>
            <p><strong>Canonical URL : <img src="https://s2.googleusercontent.com/s2/favicons?domain=<?php echo $focus['analysis_url'] ?>"> </strong><?php echo $focus['analysis_canonical']; ?></p>
            <p><strong>URL Title :  </strong><?php echo $focus['analysis_title']; ?> <strong>Title Lenght : </strong>  <?php echo strlen($focus['analysis_title']) ?></p>
        </div>
        <div class="seobridge-focus">
            <div>
            <h2>Image Alt Tags</h2>
            <?php
            $text = AltTextAnalyzer($focus['analysis_image'], $focus['analysis_imagealt']);
            if ($text['counter'] == 0) {
                echo "We are gucci. We didn't find any image without <strong> ALT TAG</strong>.";
            } else {
                echo "<strong>" . $text["items"] . "</strong> Missed ALT TAG :/ Lets fix that.";
            }
            ?>
            </div>
            <div>
 
            <h2>Language Tag</h2>
            <p><?php echo $focus['analysis_lang'] ?></p>
            </div>
           <div>
           <h2>Robots Tag</h2>
            <p><?php echo $focus['analysis_robots'] ?></p>
           </div>
          <div>
             <h2></h2>  
          </div>
        </div>
    </section>
</body>

</html>