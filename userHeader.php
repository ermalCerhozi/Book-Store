<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="home.php" style="margin-left: 50px;">Book Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="books.php">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="myBooksIndex.php">My Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="subscriptionIndex.php">Subscriptions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="seatIndex.php">Seat</a>
                </li>
            </ul>
            <div>
                <a class="nav-link active" aria-current="page" href="MyProfileIndex.php" style="color: white;">Hello <?php echo $_SESSION["user_email"] ?>!</a>
            </div>
            <div>
                <a class="btn btn-outline-success" type="submit" href="shoppingCartIndex.php">
                    <i class="material-icons" style="color: white">shopping_cart</i>
                </a>
            </div>
             &nbsp; 
            <div>
            <a href="../Authentification/logout.php" class="btn btn-outline-danger" type="submit" style="color:white">
                    <i class="material-icons">exit_to_app</i> LOG OUT</a>
            </div>
        </div>
    </div>
</nav>