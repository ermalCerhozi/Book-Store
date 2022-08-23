<!-- <style>
    li {
        font-size: 20px;
    }
</style> -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background: #435d7d;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="margin-left: 50px;">Book Store</a>
        <button  id="navbar-button" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../Admin/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../book/Books.php">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Subscritpions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../UsersCrud/users.php">Users</a>
                </li>
            </ul>
            <div>
                <a class="btn btn-outline-primary" aria-current="page" style="color: black;" href="../User/MyProfileIndex.php">Hello! <?php echo $_SESSION["user_email"]  ?> <i class="material-icons">person</i></a>
            </div>
            <div>
                <a href="../Authentification/logout.php" class="btn btn-outline-danger" type="submit" style="margin-right: 50px; margin-left: 50px; height: 40px;color: black;">
                    <i class="material-icons">exit_to_app</i> LOG OUT</a>
            </div>
        </div>
    </div>
</nav>