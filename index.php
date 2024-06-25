<?php

$insert = false;
$update = false;
$delete = false;

$servername = "localhost";
$username = "root";
$password = "";
$database = "inotes";

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn) {
  die("Sorry! We failed to connect!!" . mysqli_connect_error());
}

if(isset($_GET['delete'])) {
  
  $sno = $_GET['delete'];
  
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";

  $result = mysqli_query($conn, $sql);

  if($result) {
    $delete = true;
  }
}

if($_SERVER['REQUEST_METHOD'] === "POST") {

  if(isset($_POST['snoEdit'])) {
    
    $title = $_POST["titleEdit"];
    $description = $_POST["descEdit"];
    $sno = $_POST['snoEdit'];

    $sql = "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `sno` = $sno";
    // $sql = "UPDATE `notes` SET `title` = '$titleEdit', `description` = '$descriptionEdit' WHERE `sno` = $sno";

    $result = mysqli_query($conn, $sql);

    if($result) {
      $update = true;
    }

  }
  else {

    $title = $_POST["title"];
    $description = $_POST["desc"];
    

    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
    $result = mysqli_query($conn, $sql);

    if($result) {
      $insert = true;
    }
  }
}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP Crud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>

</head>

<body>

  <!-- Modal -->
  <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="EditModalLabel">Edit my iNote</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="index.php" method="post">
          <div class="modal-body">

            <input type="hidden" name="snoEdit" id="snoEdit">

            <div class="mb-3">
              <label for="title" class="form-label">iNote Title</label>
              <input type="text" name="titleEdit" class="form-control" id="titleEdit" aria-describedby="title">
            </div>
            <div class="mb-3">
              <label for="desc" class="form-label">iNote Description</label>
              <input type="textarea" name="descEdit" class="form-control" id="descEdit" style="height: 70px;" rows="3">
            </div>

            <!-- <button type="submit" class="btn btn-primary">Update iNote</button> -->

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><img src="/crud/logo.svg" height='30px' alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="\crud\index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <?php

  if($insert) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Sucess!</strong> Your iNote has been inserted sucessfully!!!.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
  }

  ?>

  <?php

  if($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Sucess!</strong> Your iNote has been updated sucessfully!!!.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
  }

  ?>

  <?php

  if($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Sucess!</strong> Your iNote has been deleted sucessfully!!!.
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
  }

  ?>

  <div class="container mt-4">
    <h3>Add a iNote</h3>
    <form action="index.php" method="post">

      <div class="mb-3">
        <label for="title" class="form-label">iNote Title</label>
        <input type="text" name="title" class="form-control" id="title" aria-describedby="title">
      </div>
      <div class="mb-3">
        <label for="desc" class="form-label">iNote Description</label>
        <input type="textarea" name="desc" class="form-control" id="desc" style="height: 70px;" rows="3">
      </div>

      <button type="submit" class="btn btn-primary">Add iNote</button>
    </form>
  </div>

  <div class="container mt-4 mb-4">

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $sql = "SELECT * FROM notes";

        $result = mysqli_query($conn, $sql);
        $sno =0;
        while($row = mysqli_fetch_row($result)){
        // while($row = mysql_fetch_assoc($result)) {
            $sno = $sno + 1;
            echo "<tr>
              <th scope='row'>$sno</th>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td><button type='button' class='edit btn btn-primary' id = '$row[0]' data-bs-toggle='modal' data-bs-target='#EditModal'>Edit</button> <button type='button' class='delete btn btn-danger' id = '$row[0]' >Delete</button></td>
            </tr>";
            
        }
        ?>

      </tbody>
    </table>
  </div>
  <hr>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("edit ", e.target.parentNode.parentNode);
        title = e.target.parentNode.parentNode.getElementsByTagName("td")[0].innerText;
        description = e.target.parentNode.parentNode.getElementsByTagName("td")[1].innerText;
        sno = e.target.id;
        snoEdit.value = sno;
        // console.log(sno);
        titleEdit.value = title;
        descEdit.value = description;

      })
    })

  </script>

  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("delete", e.target.id);
        sno = e.target.id;
        console.log(sno);

        if (confirm("Are you sure you want to delete this iNote!")) {
          console.log("yes");
          window.location = `/crud/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }

      })
    })

  </script>
</body>

</html>