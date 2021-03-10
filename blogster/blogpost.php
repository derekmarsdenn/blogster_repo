<?php
require 'config.php';

//additional php code for this page goes here

$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);

$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();

$author = "";
?>

<?= template_header('Get Creative') ?>
<?= template_nav() ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="js/bulma.js"></script>
    <title>Get Creative</title>
</head>

<body>
    <?php require_once 'crud.php'; ?>

    <?php if(isset($_SESSION['message'])): ?>

    <div class="notification is-<?=$_SESSION['msg_type'] ?>">
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>

    <?php endif ?>

    <section class="section">
        <div class="container">

            <h1 class="title">
                Get Creative
            </h1>

            <form action="crud.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="field">
                    <label class="label">Title</label>
                    <div class="control">
                        <input name="title" class="input" type="text" value="<?php echo $title; ?>" placeholder="Today on Mars...">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Author</label>
                    <div class="control">
                        <input type="hidden" name="author" value="<?= $_SESSION['name'] ?>">
                        <?= $_SESSION['name'] ?>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Story</label>
                    <div class="control">
                        <textarea name="story" class="textarea" value="<?php echo $story; ?>" placeholder="I ran into a martian..."></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <?php if($update == true): ?>
                            <button type="submit" class="button is-info" name="update">Update</button>
                        <?php else: ?>
                            <button type="submit" class="button is-link" name="publish">Publish</button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>

        </div>
    </section>
</body>

</html>

<?= template_footer() ?>