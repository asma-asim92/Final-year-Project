<?php

include 'connection.php';
$project_id=$_GET['id'];



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..//css/manage_users.css">
    <link rel="stylesheet" href="..//css/color.css">

    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 200px;
            background-color: #ffffff;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }
        .feedback-card {
            background-color: #f2f2f2;
            border: 1px solid #d6d6d6;
            margin-bottom: 20px;
        }
        .feedback-card .card-body {
            position: relative;
        }
        .reply-form {
            margin-top: 50px;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #f9f9f9;
            padding: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <?php
include 'nav.php';
    ?>
    <div class="container mt-5">
        <h1 class="mb-4">Feedback Page</h1>

        <!-- Add Feedback Form -->
        <div class="mb-4">
            <h3 class="mb-3">Add Feedback</h3>
            <form action="feedback.php" method="POST">
            <input type="hidden" class="form-control"  name="project_id" value="<?php  echo $project_id; ?>">

                <div class="mb-3">
                    <label for="feedback_text" class="form-label">Feedback Text</label>
                    <textarea class="form-control" id="feedback_text" name="feedback_text" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                </div>
                <button type="submit" name="add_feedback" class="btn btn-primary">Add Feedback</button>
            </form>
        </div>

        <?php
$project_id = $_GET['id'];
$sql = "SELECT f.*, r.username, p.developer_id
        FROM Feedback f
        LEFT JOIN register r ON f.reviewer_id = r.id
        LEFT JOIN projects p ON f.project_id = p.id
        WHERE f.project_id = $project_id";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    // Check if the logged-in user is the developer of the project
  
?>
    <div class="card feedback-card">
        <div class="card-body">
            <h5 class="card-title">Project: <?php echo $row['project_id']; ?></h5>
            <p class="card-text">Reviewer: <?php echo $row['username']; ?></p>
            <p class="card-text">Feedback: <?php echo $row['feedback_text']; ?></p>
            <p class="card-text">Rating: <?php echo $row['rating']; ?></p>
            <p class="card-text">Date Submitted: <?php echo $row['date_submitted']; ?></p>

            <!-- Display reply if available -->
            <?php if (!empty($row['reply'])) { ?>
                <h6 class="card-subtitle mb-2 text-muted">Reply:</h6>
                <p class="card-text"><?php echo $row['reply']; ?></p>
            <?php }?>
        </div>
    </div>
<?php } ?>


    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
