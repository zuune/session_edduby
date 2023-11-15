<?php 


    include_once("config.php");

    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }


    $id = $_GET["id"];

    $post = mysqli_query($conn, "SELECT * FROM blogs WHERE id = $id");
    $postingan = mysqli_fetch_assoc($post);


    if(isset($_POST["submit"])){
        // Ini untuk menyimpan data ke dalam variable
        $judul = htmlspecialchars($_POST["judul"]);
        $gambar = $_FILES["gambar"]["name"];
        $isi = htmlspecialchars($_POST["isi"]);
        $kategori = $_POST["kategori"];

        // Query
        $query = "UPDATE blogs SET
                    judul = '$judul',
                    gambar = '$gambar',
                    isi = '$isi',
                    kategori = '$kategori' WHERE id = $id
        ";

        mysqli_query($conn, $query);

        if(mysqli_affected_rows($conn) > 0){
            header("Location: index.php");
        }

    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">My Blog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
            </li>
            <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
            </li>
        </ul>
        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>

    <div class="container mt-5">

    <h1>Edit Postingan</h1>

    <form action="" method="POST" enctype="multipart/form-data">

    <div class="mb-3 mt-3">
        <label for="judul" class="form-label me-4">Judul :</label>
        <input type="text" class="form-control" placeholder="Judul" aria-label="Judul" name="judul" 
        value="<?= $postingan["judul"]; ?>">
    </div>

    <div class="mb-3">
        <label for="gambar" class="form-label me-4">Upload Gambar :</label>
        <input type="file" class="form-control" name="gambar" value="<?= $postingan["gambar"]; ?>">
        <p><?= $postingan["gambar"]; ?></p>
    </div>

    <div class="mb-3">
        <label for="isi" class="form-label me-4">Isi :</label>
        <textarea type="text" class="form-control" name="isi">
            <?= $postingan["isi"]; ?>
        </textarea>
    </div>

    <div class="mb-3">
        <label for="kategori" class="form-label me-4">Kategori Postingan</label>
        <select name="kategori" id="kategori" class="form-select" required>
            <option value="<?= $postingan["kategori"] ?>" hidden><?= $postingan["kategori"] ?></option>
            <option value="Coding">Coding</option>
            <option value="Design">Design</option>
            <option value="Personal">Personal</option>
        </select>
    </div>

    <a href="index.php" class="btn btn-secondary btn-lg">Back</a>
    <button type="submit" name="submit" class="btn btn-success btn-lg">Simpan</button>

    </form>



    </div>








    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>