<?php
require 'config.php';

session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

//query the database
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);

$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<?= template_header('Profile') ?>
<?= template_nav() ?>

<!-- START PAGE CONTENT -->
<div class="button is-success is-pulled-right">
    <a href="blogpost.php" class="button is-success">
        <span>Create Blog Post</span>
    </a>
</div>
<h1 class="title">@<?= $_SESSION['name'] ?></h1>

<figure class="media-left">
    <p class="image is-64x64">
        <img src="https://bulma.io/images/placeholders/128x128.png">
    </p>
</figure>
<hr>

<?php
$mysqli = new mysqli('localhost', 'W01308982', 'Derekcs!', 'W01308982') or die(mysqli_error($mysqli));
$result = $mysqli->query("SELECT * FROM blogpost ORDER BY timestamp DESC") or die($mysqli->error);
?>

<div class="row justify-content-center">



    <?php while ($row = $result->fetch_assoc()) : ?>
    <?php if($_SESSION['name'] == $row['author']): ?>

        <article class="media">
            
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>
                            <h4>@<?php echo $row['author']; ?></h4>
                        </strong>
                        <br>
                        <strong><u><?php echo $row['title']; ?></u></strong>
                        <br>
                        <?php echo $row['story']; ?>
                    </p>
                </div>
                <a class="button is-info is-pulled-right" href="blogpost.php?edit=<?php echo $row['id']; ?>">Edit</a>
                <a class="button is-danger is-pulled-right" href="crud.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </div>
        </article>
        <?php endif; ?>
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