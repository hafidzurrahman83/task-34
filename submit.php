<?php
// Koneksi ke database
$host = "localhost"; // Sesuaikan dengan host database
$dbname = "contact_db"; // Nama database
$username = "root"; // Username database
$password = ""; // Password database

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Siapkan query untuk memasukkan data
        $sql = "INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)";
        $stmt = $pdo->prepare($sql);
        
        // Bind parameter
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Eksekusi query
        if ($stmt->execute()) {
            // Redirect ke halaman sukses
            header("Location: success.php");
            exit();
        } else {
            echo "Error: Tidak dapat menyimpan data.";
        }
    }
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
?>
