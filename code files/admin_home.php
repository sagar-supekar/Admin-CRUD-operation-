<?php
session_start();
if (!isset($_SESSION['username'])) {
  // If not logged in, redirect to sign-in page
  header("Location: /Admin Panel/session.php");
  exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("header.php");
?>



<div class="navbar">
    <h2 class="text mx-3">All Records  <?php

    include("connection.php");
    $query="select count(*) as total_records from VoterRegistrationTable";
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
   <a href="form.php" class="btn btn-success mx-3">Add New User</a>
</div>

<!-- Table -->
<div class="table-responsive mb-5 mx-3 ">
    <table class="table table-bordered table-striped table-white">
        <thead class="thead-dark">
            <tr>
                <th>Sr No</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile Number</th>
                <th>Birth Date</th>
                <th>Gender</th>
                <th>Update</th>
                <th>Delete</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include("connection.php");
            $query = "SELECT * FROM VoterRegistrationTable  ORDER BY id DESC";
            $result = mysqli_query($link, $query);
            if (!$result) {
                die("Connection failed: " . mysqli_error($link));
            }
            else{
                $count=1;
            }

            while ($row = mysqli_fetch_array($result)) {
                
            ?>
                <tr>
                    <td><?php echo $count++;?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['mobile_number']; ?></td>
                    <td><?php echo $row['birth_date']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><a href="update.php?id=<?php echo urlencode($row['id']); ?>" class="btn btn-success">Update</a></td>
                    <td><a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $row['id']; ?>">Delete</a></td>
                    <td><a href="view.php?id=<?php echo urlencode($row['id']); $_SESSION['user_id']=$row['id'];?>" class="btn btn-primary">view</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    

</div>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <h4 class="text-danger">Are you sure you want to delete this record?</h4>
        <p>Please confirm your decision.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a href="#" id="deleteRecordLink" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>
<?php



include("footer.php");
?>
