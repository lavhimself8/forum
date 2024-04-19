<!doctype html>
<html lang="en">

<head>
    <!-- Meta tags for responsiveness -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title>Welcome to iDiscuss - Coding Forums</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        /* Custom styling for question container */
        #ques {
            min-height: 43px;
        }
    </style>
</head>

<body>
    <!-- Include database connection -->
    <?php include 'partials/_dbconnect.php'; ?>
    <!-- Include header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Slider starts here -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-interval="100">
        <div class="carousel-inner">
            <!-- Carousel items -->
            <div class="carousel-item active">
                <img src="img/slider-1.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="img/slider-2.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="img/slider-3.png" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="img/slider-4.png" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="img/slider-5.jpg" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="img/slider-6.jpg" class=" d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="img/slider-7.png" class=" d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="img/slider-8.png" class=" d-block w-100" alt="..." />
            </div>
        </div>
    </div>
    <!-- // https://source.unsplash.com/500x400/? -->

    <!-- Category container starts here -->
    <div class="container my-3" id="ques">
        <h2 class="text-center my-3">iDiscuss - Browse Categories</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Fetch all the categories and use a loop to iterate through categories -->
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['category_id'];
                $cat = $row['category_name'];
                $desc = $row['category_description'];
                echo '<div class="col">
                    <div class="card">
                        <img src="img/card-' . $id . '.jpg" class="card-img-top" alt="image for this category">
                        <div class="card-body">
                            <h5 class="card-title"><a href="threadlist.php?catid=' . $id . '">' . $cat . '</a></h5>
                            <p class="card-text">' . substr($desc, 0, 90) . '... </p>
                            <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary">View Threads</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Include footer -->
    <?php include 'partials/_footer.php'; ?>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>