<?php
require 'config.php';

//additional php code for this page goes here
$response = '';

if (isset($_POST['email'], $_POST['name'], $_POST['subject'], $_POST['msg'])) {
    var_dump($_POST);
    
    $to = 'derekcmarsden@gmail.com';
    $from = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['msg'];
    $headers = 'From: ' . $_POST['email'] . "\r\n" . 'Reply-To: ' . $_POST['email'] . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    mail($to, $subject, $message, $headers);

    $response = 'Message Sent!';
}
?>

<?= template_header('Home') ?>
<?= template_nav() ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="js/bulma.js"></script>
    <title>Contact us</title>
</head>

<body>
    <section class="section">
        <div class="container">

            <h1 class="title">
                Contact us
            </h1>
            <!-- message sent confirmation message goes here -->
            <?php if ($response) : ?>
                <div class="notification is-success">
                    <h2 class="title is-2"><?php echo $response; ?></h2>
                </div>

            <?php endif; ?>

            <form action="" method="post">
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left">
                        <input name="email" class="input" type="email" placeholder="e.g. alexsmith@gmail.com">
                        <span class="icon is-small is-left">
                            <i class="fas fa-at"></i>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input name="name" class="input" type="text" placeholder="e.g Alex Smith">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Message Subject</label>
                    <div class="control">
                        <input name="subject" class="input" type="text" placeholder="Example">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Message</label>
                    <div class="control">
                        <textarea name="msg" class="textarea" placeholder="Textarea"></textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button is-link">
                            <span class="icon">
                                <i class="fas fa-paper-plane"></i>
                            </span>
                            <span>
                                Send Message
                            </span>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </section>
</body>

</html>

<?= template_footer() ?>