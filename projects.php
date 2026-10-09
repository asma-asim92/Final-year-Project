<?php
include 'connection.php';
error_reporting(0);
?>

<!DOCTYPE html>
<html>
<head>
  <title> ONLINE PLANT STORE</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-MX44pNHMJrfiDtweyBb3KV58BV0vtGQ/hwYt0GZDYxnaDViXOZ1TJrd1vMkW4O8t4H4Ny4z4vL18MQit2DgXKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-MX44pNHMJrfiDtweyBb3KV58BV0vtGQ/hwYt0GZDYxnaDViXOZ1TJrd1vMkW4O8t4H4Ny4z4vL18MQit2DgXKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>

.project-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 20px;
        transition: transform 0.2s;
    }

    .project-card:hover {
        transform: scale(1.02);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .project-card .card-body {
        padding: 15px;
    }

    .project-card .card-title {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .project-card .card-language {
        color: #6c757d;
        font-size: 1.2rem;
        margin-top: 10px;
    }

    .project-card .card-category {
        color: #6c757d;
        font-size: 1.2rem;
        margin-top: 10px;
    }

    .project-card .card-download {
        color: #28a745;
        font-size: 1.2rem;
        margin-top: 10px;
    }

    .project-card .card-rating {
        color: #ffc107;
        font-size: 1.2rem;
        margin-top: 10px;
    }

    .project-card .action-buttons {
        margin-top: 20px;
    }

    .action-buttons a {
        margin-right: 10px;
    }
  </style>
</head>
<body>
<?php
include 'nav.php';


?>

  




<div class="mt-5 border p-5 bg-light">
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <input type="text" id="projectSearch" class="form-control" placeholder="Search by project name">
        </div>
    </div>
    <div class="row" id="projects">
    <?php
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $sql = "SELECT p.*, AVG(f.rating) AS avg_rating 
            FROM projects p
            LEFT JOIN Feedback f ON p.id = f.project_id
            WHERE p.category_id='$id'
            GROUP BY p.id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $p_id = $row['id'];

            // Calculate the total download_count for a specific project_id
            $select5 = "SELECT SUM(download_count) AS total_count FROM project_download_count WHERE project_id='$p_id'";
            $result5 = mysqli_query($conn, $select5);

            if ($result5) {
                $download_count_row = mysqli_fetch_assoc($result5);
                $total_count = $download_count_row['total_count'];
            } else {
                // Handle the case where the query fails
                $total_count = 0; // Set a default value or handle the error as needed
            }
    ?>

            <!-- Project Card -->
            <div class="col-md-6 mb-4">
                <div class="card project-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['project_name']; ?></h5>
                        <p class="card-language"><?php echo $row['language']; ?></p>
                        <p class="card-category"><?php echo $row['category_name']; ?></p>
                        <p class="card-download">DOWNLOADS(<?php echo $total_count; ?>)</p>
                        <p class="card-rating">Average Rating: <?php echo number_format($row['avg_rating'], 2); ?></p>

                        <div class="action-buttons">
                            <a href="files.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">DOWNLOAD</a>
                            <a href="feedback.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">FEEDBACK</a>
                        </div>
                    </div>
                </div>
            </div>

    <?php
        }
    } else {
        echo "No projects found.";
    }

    $conn->close();
    ?>
</div>

</div>

  <script>
 document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('projectSearch');
    const cards = document.querySelectorAll('.card');

    searchInput.addEventListener('keyup', function () {
        const searchTerm = searchInput.value.toLowerCase();

        cards.forEach(function (card) {
            const title = card.querySelector('.card-title').innerText.toLowerCase();
            const language = card.querySelector('.card-language').innerText.toLowerCase();
            
            if (title.includes(searchTerm) || language.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>



<script>
        function scrollToCategories() {
            // Get the categories section
            const categories = document.getElementById("categories");
            // Scroll to the categories section
            categories.scrollIntoView({ behavior: "smooth" });
        }
    </script>


 
<br>


 <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-F+20wtrv1ITZNoJ7Vb9MkHr7rKSmzroeuGJyB+j72fEtbYVZJbNnBDq+6E9OK6N2k6R5U+VjjGXn0bA6YIdD+A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
