<?php
function encryptVigenere($text, $key)
{
    $result = "";
    $textLength = strlen($text);
    $keyLength = strlen($key);

    for ($i = 0; $i < $textLength; $i++) {
        $result .= chr((ord($text[$i]) + ord($key[$i % $keyLength])) % 256);
    }

    return base64_encode($result);
}

function decryptVigenere($encryptedText, $key)
{
    $encryptedText = base64_decode($encryptedText);
    $result = "";
    $textLength = strlen($encryptedText);
    $keyLength = strlen($key);

    for ($i = 0; $i < $textLength; $i++) {
        $result .= chr((ord($encryptedText[$i]) - ord($key[$i % $keyLength]) + 256) % 256);
    }

    return $result;
}

session_start();
include_once "koneksi.php";
if ($_SESSION['log'] != "login") {
    header('location:login.php');
}

// Enkripsi dan Dekripsi Username
$encryptedUsername = encryptVigenere($_SESSION['username'], 'admin');
$decryptedUsername = decryptVigenere($encryptedUsername, 'admin');

// Enkripsi dan Dekripsi Password
$encryptedPassword = encryptVigenere($_SESSION['password'], '1234');
$decryptedPassword = decryptVigenere($encryptedPassword, '1234');
?>

<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <!-- ... (tetap sama) ... -->
</head>

<body>
    <br>
    <br>
    <p class="text-center">
        <span><b>Selamat datang</b>, Anda berhasil Login sebagai <b><?= $decryptedUsername ?></b></span>
        <br>
        <a href="logout.php" class="btn btn-sm btn-primary">
            <span>logout</span>
        </a>
    </p>
</body>

</html>
