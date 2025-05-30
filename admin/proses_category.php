<?php
{
    global $mysql;

    $nama = $_POST['name'];
    $deskripsi = $_POST['description'];
    $image = $_POST['image'];
    $created_at = $_POST['created_at'];

    $sql = "INSERT INTO categories (name,description,image,created_at) VALUES (?,?,?,?)";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("ss", $name, $description, $image, $created_at);

    if ($stmt->execute()) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>