<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="messenger.css">
    <title>Messenger</title>
</head>
<body onload="window.scrollTo(0,document.body.scrollHeight);">
    <?php
        if (!empty($_REQUEST['date']) && !empty($_REQUEST['name']) && !empty($_REQUEST['message'])){
            $message = $_REQUEST['date'] . '•' . $_REQUEST['name'] . '•' . $_REQUEST['email'] . '•' . $_REQUEST['message'] . "\n";
            file_put_contents(__DIR__.'/messages.txt', $message, FILE_APPEND);
        }

        $messages = explode("\n", htmlspecialchars(file_get_contents(__DIR__.'/messages.txt')));
        array_pop($messages);
        foreach($messages as $message){
            $msg = explode("•", $message);

            echo "<div class='message'> $msg[0] <b>$msg[1]</b>";
            if($msg[2]==""){
                echo ": $msg[3] </div>";
            }else{
                echo " ($msg[2]): $msg[3] </div>";
            }
        }
    ?>
    <form action="messenger.php" method="post">
        <input type="hidden" name="date"    value="<?php echo date('d.m.Y H:i')?>">
        <input type="text"   name="name"    placeholder="Name" required>
        <input type="email"  name="email"   placeholder="Email">
        <input type="text"   name="message" placeholder="Message" required>
        <input type="submit" value="Send">
    </form>
</body>
</html>
