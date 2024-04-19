<!DOCTYPE html>
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
    #maincontainer {
        min-height: 100vh;
    }
    </style>
</head>

<body>
    <!-- Include database connection -->
    <?php include 'partials/_dbconnect.php'; ?>
    <!-- Include header -->
    <?php include 'partials/_header.php'; ?>

    <!-- Search Results -->
    <div class="container">
        <?php
        $noresults = true;
        $query = $_GET["search"];
        $sql = "SELECT * FROM threads WHERE MATCH (thread_title, thread_desc) AGAINST ('$query')";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['thread_title'];
                $desc = $row['thread_desc'];
                $thread_id = $row['thread_id'];
                $url = "thread.php?threadid=" . $thread_id;
                $noresults = false;

                // Display the search result
                echo '<div class="result">
                        <h3><a href="' . $url . '" class="text-dark">' . $title . '</a></h3>
                        <p>' . $desc . '</p>
                      </div>';
            }
        } else {
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="display-4">No Results Found</p>
                        <p class="lead"> Suggestions: <ul>
                                <li>Make sure that all words are spelled correctly.</li>
                                <li>Try different keywords.</li>
                                <li>Try more general keywords. </li></ul>
                        </p>
                    </div>
                  </div>';
        }
        ?>
    </div>

    <!-- Include footer -->
    <?php include 'partials/_footer.php'; ?>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>