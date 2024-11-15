<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("header.php");
?>
<!-- Heading with background color -->


<div class="navbar">
    <h2 clas="text">All Records  <?php
    
    include("connection.php");
    $query="select count(*) as total_records from VoterRegistration";
    $result=mysqli_query($link,$query);
    if(!$result){
        die("connection failed");
    }
    else{
          $row=mysqli_fetch_assoc($result);
          $total_records=$row["total_records"];
          echo "".$total_records."";
    }
    ?> </h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD NEW USER</button>
</div>

<!-- Table -->
<div class="table-responsive mb-5">
    <table class="table table-bordered table-striped table-white">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Birthdate</th>
                <th>Gender</th>
                <th>GV Proof</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("connection.php");

            $query = "SELECT * FROM VoterRegistration";
            $result = mysqli_query($link, $query);
            if (!$result) {
                die("Connection failed: " . mysqli_error($link));
            }

            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['mobile_number']; ?></td>
                    <td><?php echo $row['birth_date']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['gv_proof']; ?></td>
                    <td><a href="update.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-success">Update</a></td>
                    <td><a href="delete.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-danger">Delete</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php
    if (isset($_GET['success_message'])) {

        $msg = htmlspecialchars($_GET['success_message']);
        echo "<div class= 'alert alert-success'>" . $msg;
    } else if (isset($_GET["delete_message"])) {
        $msg = htmlspecialchars($_GET["delete_message"]);
        echo "<div class= 'alert alert-danger'>" . $msg;
    }

    ?>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?php
            include('form.php');
            ?>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php



include("footer.php");
?>