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


                <form action="service/bridge-function.php" method="POST"> <button name="cleardb" class="bridge-button">Clear DB</button> </form>
                <br>
                <a class="bridge-button" href="backlink-monitor.php">Backlink Monitor</a>
            </div>

            <div class="seobridge-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Crawled URL</th>
                            <th>Page Title</th>
                            <th>Title Lenght</th>
                            <th>H1 Count</th>
                            <th>H2 Count</th>
                            <th>H3 Count</th>
                            <th>H4 Count</th>
                            <th>H5 Count</th>
                            <th>H6 Count</th>
                            <th>Canonical</th>
                            <th>Image Alt Tag</th>
                            <th>Robots</th>
                            <th>Time</th>
                            <th>Focus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $analysis = $db->prepare("SELECT * from analysis ORDER BY analysis_id DESC");
                        $analysis->execute();
                        while ($bring_data = $analysis->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td><?php echo $bring_data['analysis_id'] ?></td>
                                <td><?php echo mb_strimwidth($bring_data['analysis_url'], 0, 35, ".."); ?></td>
                                <td><?php echo $bring_data['analysis_title'] ?></td>

                                <?php if (strlen($bring_data['analysis_title']) < 60) { ?>
                                    <td> <?php echo strlen($bring_data['analysis_title']) ?> </td>
                                <?php  } else { ?> <td class="bridge-bad"> <?php echo strlen($bring_data['analysis_title']) ?> </td> <?php }  ?>

                                <!-- H TAG ANALYSIS NEED TOO MUCH 'development' -->

                                <?php if ($bring_data['analysis_h1'] == 1) { ?>
                                    <td><?php echo $bring_data['analysis_h1'] ?></td>
                                <?php } elseif ($bring_data['analysis_h1'] != 1) { ?>
                                    <td class="bridge-bad"><?php echo $bring_data['analysis_h1'] ?></td>
                                <?php } ?>


                                <?php if ($bring_data['analysis_h2'] == 0 and $bring_data['analysis_h3'] > $bring_data['analysis_h2']) { ?>
                                    <td class="bridge-bad"><?php echo $bring_data['analysis_h2'] ?></td>
                                <?php  } else { ?>
                                    <td><?php echo $bring_data['analysis_h2'] ?></td>
                                <?php  }
                                ?>
                                <?php if ($bring_data['analysis_h3'] == 0 and $bring_data['analysis_h4'] > $bring_data['analysis_h3']) {  ?>
                                    <td class="bridge-bad"><?php echo $bring_data['analysis_h3'] ?></td>
                                <?php } else { ?>
                                    <td><?php echo $bring_data['analysis_h3'] ?></td>
                                <?php } ?>
                                <?php if ($bring_data['analysis_h4'] == 0 and $bring_data['analysis_h5'] > $bring_data['analysis_h4']) {  ?>
                                    <td class="bridge-bad"><?php echo $bring_data['analysis_h4'] ?></td>
                                <?php } else { ?>
                                    <td><?php echo $bring_data['analysis_h4'] ?></td>
                                <?php } ?>

                                <?php if ($bring_data['analysis_h5'] == 0 and $bring_data['analysis_h6'] > $bring_data['analysis_h5']) { ?>
                                    <td class="bridge-bad"><?php echo $bring_data['analysis_h5'] ?></td>
                                <?php   } else { ?>
                                    <td><?php echo $bring_data['analysis_h5'] ?></td>
                                <?php } ?>
                                <td><?php echo $bring_data['analysis_h6'] ?></td>

                                <!-- H TAG ANALYSIS NEED TOO MUCH 'development' -->
                                <?php if (strcasecmp($bring_data['analysis_url'], $bring_data['analysis_canonical']) == 0) {
                                ?> <td><?php echo mb_strimwidth($bring_data['analysis_canonical'], 0, 35, ".."); ?></td> <?php
                                                                                                                        } else {
                                                                                                                            ?> <td class="bridge-bad"><?php echo mb_strimwidth($bring_data['analysis_canonical'], 0, 35, ".."); ?></td> <?php
                                                                                                                                                                                                                                        } ?>
                                <?php
                                $text = AltTextAnalyzer($bring_data['analysis_image'], $bring_data['analysis_imagealt']);
                                if ($text["counter"] != 0) { ?>
                                    <td class="bridge-bad"> <?php echo $text["counter"] . " Missed Alt Tag"; ?> </td>
                                <?php  } else { ?>
                                    <td class="bridge-good">Good</td>
                                <?php  }
                                ?>
                                <td><?php echo $bring_data['analysis_robots']; ?></td>
                                <td>
                                    <?php $published = date_create($bring_data['analysis_time']);
                                    echo date_format($published, 'M d, Y'); ?>
                                </td>
                                <td> <a href="focus.php?analysis_id=<?php echo $bring_data['analysis_id']; ?>"> <button class="bridge-button">Focus</button></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>

</html>