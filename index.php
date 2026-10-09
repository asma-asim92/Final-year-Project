<?php
include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title> Online Multi developer Code RepositoryE</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-MX44pNHMJrfiDtweyBb3KV58BV0vtGQ/hwYt0GZDYxnaDViXOZ1TJrd1vMkW4O8t4H4Ny4z4vL18MQit2DgXKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-MX44pNHMJrfiDtweyBb3KV58BV0vtGQ/hwYt0GZDYxnaDViXOZ1TJrd1vMkW4O8t4H4Ny4z4vL18MQit2DgXKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>

.intro {
  background: url('logo.jpg') no-repeat center center fixed;
  background-size: cover;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: white;
  text-align: center;
  font-size: 2em;
  font-weight: bold;
  animation: fadein 3s;
}

.social-media-icons {
  display: flex;
  justify-content: center;
  align-items: center;
}

.social-media-icons a {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 10px;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease-in-out;
}

.social-media-icons a:hover {
  background-color: #007bff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.social-media-icons i {
  color: #555;
  font-size: 28px;
  transition: all 0.3s ease-in-out;
}

.social-media-icons a:hover i {
  color: #fff;
  transform: scale(1.1);
}
 .card-body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
}

/* Style the "View" button */
.btn-primary {
  margin-top: 10px; /* Add space between description and button */
}

/* Limit the height of the category images and add some border radius */
.card-img-top {
  max-height: 200px; /* Adjust the value as needed */
  object-fit: cover; /* Maintain aspect ratio and cover */
  border-radius: 10px;

}

/* Add some shadow and hover effect to the card */
.card {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Customize the card title and description */
.card-title {
  font-size: 1.5rem;
}

.card-text {
  font-size: 1.1rem;
  color: #555;
}

  </style>
</head>
<body>
  <?php
  include 'nav.php';



?>
<div class="intro">
      
      <h1 style="font-family: 'Pacifico', cursive; font-size: 3rem; color: #333; text-align: center; margin-top: 50px; color:white;">Welcome to Our Online Store Website</h1>
  <p style="font-family: 'Roboto', sans-serif; font-size: 1.2rem; color: #555; text-align: center; margin-top: 20px;color:white;">Get Household plants that perfectly fits Fitness and health style</p>
  
          <button class="btn btn-primary" onclick="scrollToCategories()">VIEW CATEGORIES</button>
          <div class="social-media-icons mt-5">
    <a href="https://www.facebook.com/your-page-link-here" target="_blank"><i class="fa fa-facebook-f"></i></a>
    <a href="https://www.instagram.com/your-page-link-here" target="_blank"><i class="fa fa-instagram"></i></a>
    <a href="https://www.twitter.com/your-page-link-here" target="_blank"><i class="fa fa-twitter"></i></a>
  </div>
  
      </div>
  

  





<div class=" mt-5 border p-5 bg-light">
  <div class="row mb-4">
    <div class="col-md-6 mx-auto">
      <input type="text" id="categorySearch" class="form-control" placeholder="Search by category name">
    </div>
  </div>
    <div class="row" id="categories">
      <?php
     

        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-6 mb-4">';
            echo '<div class="card">';
            echo '<img src="admin/categories_images/' . $row['image'] . '" class="card-img-top" alt="' . $row['c_name'] . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['c_name'] . '</h5>';
            echo '<p class="card-text">' . $row['c_des'] . '</p>';
            echo '<a href="projects.php?id='.$row['id'].'" class="btn btn-primary">View</a>'; // Add View button
            echo '</div></div></div>';
          }
        } else {
          echo "No categories found.";
        }

        $conn->close();
      ?>
    </div>
  </div>
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('categorySearch');
    const cards = document.querySelectorAll('.card');

    searchInput.addEventListener('keyup', function () {
      const searchTerm = searchInput.value.toLowerCase();

      cards.forEach(function (card) {
        const title = card.querySelector('.card-title').innerText.toLowerCase();
        const description = card.querySelector('.card-text').innerText.toLowerCase();

        if (title.includes(searchTerm) || description.includes(searchTerm)) {
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
