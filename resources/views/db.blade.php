<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel database connection</title>
</head>
<body>
    <h1>Laravel database connection</h1>
    <?php
    if(DB::connection()->getDatabaseName() == 'nlms_project') {
        echo 'Database connection is working';
    } else {
        echo 'Database connection is not working';
    }
    ?>
</body>
</html>
