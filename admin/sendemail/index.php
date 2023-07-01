<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
</head>
<body>
    <form action="send.php" method="post">
        Email <input type="text" name="email" id=""> <br>
        Subject <input type="text" name="subject"><br>
        Message <input type="text" name="message"><br>
        <button type="submit" name="send">Send</button>
    </form>
</body>
</html>