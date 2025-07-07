<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

        <style>
            .notification {
                box-shadow: rgba(99, 99, 99, 0.2) 0 2px 8px 0;
                margin: 10px 0;
                padding: 10px;
            }

            .notification.success {
                background: #43c243;
            }

            .notification.error {
                background: #b44141;
            }
        </style>
    </head>
    <body>
        <h1>Hello world</h1>

        <?php echo \App\Notification\NotificationManager::dispatchAll(); ?>
    </body>
</html>
