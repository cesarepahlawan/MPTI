<?php 
$koneksi = mysqli_connect("localhost", "root", "", "braves");

function query($query, $types = null, ...$params)
{
    global $koneksi;

    $stmt = mysqli_prepare($koneksi, $query);

    if (!$stmt) {
        die('Query preparation error: ' . mysqli_error($koneksi));
    }

    if ($types && $params) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    $executionResult = mysqli_stmt_execute($stmt);

    if (!$executionResult) {
        die('Query execution error: ' . mysqli_error($koneksi));
    }

    // If it's a SELECT query, fetch the results
    if ($stmt->field_count > 0) {
        $result = mysqli_stmt_get_result($stmt);

        if ($result === false) {
            die('Get result failed: ' . mysqli_error($koneksi));
        }

        $array = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $array;
    }

    // For non-SELECT queries, return true on success
    mysqli_stmt_close($stmt);
    return true;
}



function enum($data){// ambil opsi enum
    global $koneksi;
$result = mysqli_query($koneksi,$data);
$row = mysqli_fetch_assoc($result);
$sproduk = $row['num'];
$enum = array();
preg_match("/^enum\(\'(.*)\'\)$/", $sproduk, $enum);
$vals = explode("','", $enum[1]);
return $vals;}


// function upload()
// {

//     $nama = $_FILES['gambar']['name'];
//     $tmpname = $_FILES['gambar']['tmp_name'];
//     $size = $_FILES['gambar']['size'];

//     $allowed = ['jpg', 'jpeg', 'png']; //Ekstensi yang diperbolehkan

//     if ($size > 40000000){
//         echo "<script>
//             alert('Gambar melebihi batas (40MB)');
//             </script>";
//         return false;
//     }

//     $ekstensi = pathinfo($nama, PATHINFO_EXTENSION); //$format menyimpan ekstensi file.
//     if (!in_array($ekstensi, $allowed)) {
//         echo "<script>
//             alert('Bukan gambar');
//             </script>";
//         return false;
//     }


//     $namas = mt_rand(10000,99999);
//     $namas .= '.';
//     $namas .= $ekstensi;

//     move_uploaded_file($tmpname, 'assets/img/' . $namas);
//     return $namas;
// }
function upload()
{
    $nama = $_FILES['gambar']['name'];
    $tmpname = $_FILES['gambar']['tmp_name'];
    $size = $_FILES['gambar']['size'];

    $allowed = ['jpg', 'jpeg', 'png']; // Ekstensi yang diperbolehkan

    if ($size > 40000000) {
        echo "<script>
            alert('Gambar melebihi batas (40MB)');
            </script>";
        return false;
    }

    $ekstensi = pathinfo($nama, PATHINFO_EXTENSION); // $format menyimpan ekstensi file.
    if (!in_array($ekstensi, $allowed)) {
        echo "<script>
            alert('Bukan gambar');
            </script>";
        return false;
    }

    $namas = mt_rand(10000, 99999);
    $namas .= '.';
    $namas .= $ekstensi;

    $uploadPath = 'assets/img/' . $namas;

    // Resize the image to a fixed width and height (adjust as needed)
    $fixedWidth = 150;
    $fixedHeight = 100;

    list($width, $height) = getimagesize($tmpname);

    $src = imagecreatefromstring(file_get_contents($tmpname));
    $dst = imagecreatetruecolor($fixedWidth, $fixedHeight);

    imagecopyresampled($dst, $src, 0, 0, 0, 0, $fixedWidth, $fixedHeight, $width, $height);

    imagedestroy($src);

    // Save the resized image
    imagepng($dst, $uploadPath); // Save as PNG, adjust as needed

    imagedestroy($dst);

    return $namas;
}


function tambahproduk($data)
{
    global $koneksi;

    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $harga = htmlspecialchars($data["harga"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO produk (nama, jenis, harga, gambar, deskripsi) VALUES (?, ?, ?, ?, ?)";
    $types = 'ssiss'; // Assuming jenis is a VARCHAR, harga is a VARCHAR, and produkid is an INT

    return query($query, $types, $nama, $jenis, $harga, $gambar, $deskripsi);
}

function editproduk($data)
{
    global $koneksi;
    $files = glob("assets/img/*.{jpg,jpeg,png}", GLOB_BRACE); //array nama file di folder
    $cut = array();

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $jenis = htmlspecialchars($data["jenis"]);
    $harga = htmlspecialchars($data["harga"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $old    = $data["old"];




    if ($_FILES['gambar']['error'] === 4) { //Gambar lama
        $gambar = $old;
    }else{
        $gambar = upload(); //Upload kalo bukan gambar lama
    }

    $row = query("SELECT * FROM produk WHERE produkid=$id");
    foreach ($row as $riw) {
        $file = $riw['gambar'];//ambil nama file di database
    }

    for($k=0; $k<count($files); $k++){
        $cut[$k]=substr($files[$k],4); //Simpan nama file tanpa nama folder
    }  

    if(!empty($cut)){ //Cek jika folder img terdapat file
        for($c=0; $c<count($files); $c++){
            if($file==$cut[$c]){ //Cek jika nama file database terdapat pada folder
                unlink('assets/img/' . $file); //Unlink gambar di folder yang sesuai dengan nama file database
            }
        }
    }

    
    $query = "UPDATE produk SET
              nama = '$nama',
              jenis = '$jenis',
              harga = '$harga',
              gambar = '$gambar',
              deskripsi = '$deskripsi'
              WHERE produkid = $id";


    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}



function hapusproduk($id)
{
    global $koneksi;
    $row = query("SELECT * FROM produk WHERE produkid=$id");
    foreach ($row as $riw) {
        $file = $riw['gambar'];
    }
    unlink('assets/img/' . $file);
    mysqli_query($koneksi, "DELETE FROM produk WHERE produkid=$id");
    return mysqli_affected_rows($koneksi);
}


function getProductsByType($type = 'all') {
    global $koneksi;

    if ($type === 'all') {
        $query = "SELECT * FROM produk";
    } else {
        $type = mysqli_real_escape_string($koneksi, $type);
        $query = "SELECT * FROM produk WHERE jenis = '$type'";
    }

    $result = query($query);

    return $result;
}


function generateWhatsAppLink($phoneNumber, $message)
{
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber); // Remove non-numeric characters
    $message = urlencode($message);
    return "https://api.whatsapp.com/send?phone={$phoneNumber}&text={$message}";
}


// Function to validate form data
function validateFormData($data, $fieldsToExclude = []) {
    foreach ($data as $key => $value) {
        // Skip validation for excluded fields
        if (in_array($key, $fieldsToExclude)) {
            continue;
        }

        // Validate non-excluded fields
        if (empty($value)) {
            return false; // Fail validation if any field is empty
        }
    }
    return true; // Passes validation
}

// Function to get the WhatsApp contact number from the admin table
function getAdminPhoneNumber() {
    global $koneksi;
    $query = "SELECT whatsapp_number FROM admin LIMIT 1";
    $result = query($query);
    return $result[0]['whatsapp_number'];
}

// Function to update the WhatsApp contact number in the admin table
function updateAdminPhoneNumber($newNumber) {
    global $koneksi;
    $query = "UPDATE admin SET whatsapp_number = ? LIMIT 1";
    $types = 's'; // Assuming the WhatsApp number is stored as VARCHAR
    return query($query, $types, $newNumber);
}
function formatRupiah($harga) {
    // Remove non-numeric characters
    $harga = preg_replace("/[^0-9]/", "", $harga);

    // Format the number into Rupiah currency
    return 'Rp ' . number_format($harga, 0, ',', '.');
}

// function.php

function validateName($nama) {
    return !empty($nama) && preg_match("/^[a-zA-Z ]+$/", $nama);
}

function validatePrice($harga) {
    return !empty($harga) && is_numeric($harga);
}

function validateType($jenis, $enum) {
    return !empty($jenis) && in_array($jenis, $enum);
}

function validateDescription($deskripsi) {
    return !empty($deskripsi);
}


?>