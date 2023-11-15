<?php 


    include_once("config.php");

    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }


    $blogs = [];


    if(isset($_POST["search"])){
        $searchPost = htmlspecialchars($_POST["searchPost"]);

        $queryBlog = mysqli_query($conn, "SELECT * FROM blogs WHERE
                                            judul LIKE '%$searchPost%' OR
                                            kategori LIKE '%$searchPost%'
                                        ");

        while ($blog = mysqli_fetch_assoc($queryBlog)) {
            $blogs[] = $blog;
        }
    } else {
        $queryBlog = mysqli_query($conn, "SELECT * FROM blogs");
    
        while ($blog = mysqli_fetch_assoc($queryBlog)) {
            $blogs[] = $blog;
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
            <a class="nav-link active" aria-current="page" href="">Home</a>
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

        </div>
    </div>
    </nav>

    <div class="container mt-5">

    <h1>Daftar Postingan</h1>



    <a href="tambah.php" class="btn btn-outline-success btn-lg mt-5">Tambah Postingan</a>

    <form action="" method="POST">
        <div class="row mt-5">
            <div class="col-8">
                <input type="text" class="form-control" name="searchPost">
            </div>
            <div class="col-4">
                <button class="btn btn-success" name="search">Search</button>
            </div>
        </div>

    </form>

    <table class="table mt-5">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Judul</th>
            <th scope="col">Gambar</th>
            <th scope="col">Isi</th>
            <th scope="col">Kategori</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        <?php $i = 1; ?>
        <?php foreach($blogs as $blog) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?php echo $blog["judul"] ?></td>
                <td><img width="150px" src="<?php echo $blog["gambar"] ?>" alt=""></td>
                <td><?php echo $blog["isi"] ?></td>
                <td><?php echo $blog["kategori"] ?></td>
                <td>
                    <a href="hapus.php?id=<?php echo $blog["id"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete it?')">Hapus</a>

                    <a href="edit.php?id=<?php echo $blog["id"]; ?>" class="btn btn-primary">Edit</a>  
                    
                </td>
            </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>








    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>