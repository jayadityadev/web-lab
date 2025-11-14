<!-- Develop a PHP program (with HTML/CSS) to keep track of the number of visitors visiting the web page and to display this count of visitors, with relevant headings. -->


<?php
$file = "counter.txt";

if (!file_exists($file)) {
    file_put_contents($file, "0", LOCK_EX);
}

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
if ($path === '/' || $path === '' || preg_match('#/index\.php$#', $path)) {
    $count = (int)file_get_contents($file);

    $count++;

    file_put_contents($file, (string)$count, LOCK_EX);
} else {
    $count = (int)file_get_contents($file);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Counter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .counter-box {
            background: #ffffff;
            padding: 25px 40px;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.2);
            text-align: center;
        }
        h1 {
            color: #0077cc;
            margin-bottom: 10px;
        }
        p {
            font-size: 1.3em;
            color: #444;
        }
        .count {
            font-size: 2.5em;
            color: #ff6600;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="counter-box">
        <h1>Website Visitor Counter</h1>
        <p>You are visitor number:</p>
        <div class="count"><?php echo $count; ?></div>
    </div>
</body>
</html>
