<?php
require 'config.php';

//additional php code for this page goes here

?>

<?= template_header('Home') ?>
<?= template_nav() ?>

<!-- START PAGE CONTENT -->
<h1 class="title">Welcome to Blogster!</h1>
<p>Here's the latest...</p>
<hr> 
<?php
$mysqli = new mysqli('localhost', 'W01308982', 'Derekcs!', 'W01308982') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM blogpost ORDER BY timestamp DESC") or die($mysqli->error);
?>

<div class="row justify-content-center">

        <?php while ($row = $result->fetch_assoc()) : ?>

            <article class="media">
                <figure class="media-left">
                    <p class="image is-64x64">
                        <img src="https://bulma.io/images/placeholders/128x128.png">
                    </p>
                </figure>
                <div class="media-content">
                    <div class="content">
                        <p>
                            <strong><h4>@<?php echo $row['author']; ?></h4></strong> 
                            <br>
                            <strong><u><?php echo $row['title']; ?></u></strong>
                            <br>
                            <?php echo $row['story']; ?>
                        </p>
                    </div>
                    <nav class="level is-mobile">
                        <div class="level-left">
                            <a class="level-item">
                                <span class="icon is-small"><i class="fas fa-reply"></i></span>
                            </a>
                            <a class="level-item">
                                <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                            </a>
                            <a class="level-item">
                                <span class="icon is-small"><i class="fas fa-heart"></i></span>
                            </a>
                        </div>
                    </nav>
                </div>
            </article>
        <?php endwhile; ?>

</div>

<?php
function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>
<!-- END PAGE CONTENT -->

<?= template_footer() ?>