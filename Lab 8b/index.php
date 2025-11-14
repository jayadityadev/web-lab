<!-- Develop a PHP program (with HTML/CSS) to sort the student records which are stored in the database using selection sort. -->


<?php

$servername = "localhost";
$username = "phpuser";
$password = "php123";
$dbname = "college";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$students = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// SELECTION SORT by name
$n = count($students);

for ($i = 0; $i < $n - 1; $i++) {
    $min_index = $i;

    for ($j = $i + 1; $j < $n; $j++) {
        if (strcasecmp($students[$j]["name"], $students[$min_index]["name"]) < 0) {
            $min_index = $j;
        }
    }

    $temp = $students[$i];
    $students[$i] = $students[$min_index];
    $students[$min_index] = $temp;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sorted Student Records</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #0066cc;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background: #0066cc;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f9ff;
        }
    </style>
</head>
<body>

<h2>Student Records Sorted by Name (Selection Sort)</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>USN</th>
        <th>Branch</th>
        <th>Email</th>
        <th>Address</th>
    </tr>

    <?php foreach ($students as $s): ?>
        <tr>
            <td><?php echo $s["id"]; ?></td>
            <td><?php echo $s["name"]; ?></td>
            <td><?php echo $s["usn"]; ?></td>
            <td><?php echo $s["branch"]; ?></td>
            <td><?php echo $s["email"]; ?></td>
            <td><?php echo $s["address"]; ?></td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
