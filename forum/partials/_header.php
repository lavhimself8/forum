<?php
session_start();
echo '
<div class="container-fluid p-0">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/forum">iDiscuss</a>
            <!-- Navbar Toggler Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Collapsible Content -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar Items -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <!-- Dropdown Menu for Top Categories -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Top Categories
                        </a>
                        <!-- Dropdown Content -->
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
// Fetch top categories from database
$sql = "SELECT category_name, category_id FROM `categories` LIMIT 3";
$result = mysqli_query($conn, $sql);
// Display top categories in dropdown
while ($row = mysqli_fetch_assoc($result)) {
    echo '<a class="dropdown-item" href="threadlist.php?catid=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';
}
echo '              </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>';
// Display login/logout and search form
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '<form class="d-flex my-2 my-lg-0" method="get" action="search.php">
                    <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                    <p class="text-light my-0 mx-2">Welcome ' . $_SESSION['useremail'] . ' </p>
                    <a href="partials/_logout.php" class="btn btn-outline-success">Logout</a>
                    </form>';
} else {
    echo '<form class="d-flex my-2 my-lg-0">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                    </form>
                    <button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>';
}
echo '      </div>
        </div>
    </nav>';

// Include login and signup modals
include 'partials/_loginModal.php';
include 'partials/_signupModal.php';

// Display signup success alert
if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success!</strong> You can now login
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
?>
</div> <!-- Close container-fluid -->

<!-- Bootstrap JavaScript Library -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-uvMgtRxVaZRZG+8z+bF4+Ud74rxYB1djyS9Z5k9xztEW3pzs7U5EXklMZyOTC1Vp" crossorigin="anonymous">
    </script>