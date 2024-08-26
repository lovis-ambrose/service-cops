<?php
session_start();
require_once "header.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="container">
  <!-- Logout Button -->
  <div class="row">
    <div class="col-12 text-right mt-3">
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>

  <!-- Add Task Button and Modal -->
  <div class="row">
    <div class="col-8 m-auto">
      <h2 class="display-4 text-center">My To Do List</h2>
      
      <!-- Button to trigger modal -->
      <button type="button" class="btn btn-success btn-block mt-4" data-toggle="modal" data-target="#addTaskModal">
        Add Task
      </button>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form inside modal -->
          <form action="index_valid.php" method="post">
            <div class="form-group">
              <input class="form-control form-control-lg" type="text" name="task_name" placeholder="Enter your task" required>
            </div>
            <div class="form-group">
              <textarea class="form-control form-control-lg" name="task_description" placeholder="Enter task description" rows="3" required></textarea>
            </div>
            <div class="form-group">
              <input class="btn btn-success btn-block" type="submit" name="addtask" value="Add Task">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- ===================== show delete alert message ============= -->
  <?php if(isset($_SESSION['delete_success'])) { ?>
    <div class="alert alert-warning text-dark mx-auto mt-4" role="alert" style="width:66%;">
      <?=$_SESSION['delete_success'];?>
    </div>
    <?php unset($_SESSION['delete_success']); } ?>

  <!-- ===================== show update alert message ============= -->
  <?php if(isset($_SESSION['update_success'])) { ?>
    <div class="alert alert-warning text-dark mx-auto mt-4" role="alert" style="width:66%;">
      <?=$_SESSION['update_success'];?>
    </div>
    <?php unset($_SESSION['update_success']); } ?>

  <!-- =================================== table =========================== -->
  <table style="width:66%;" class="table table-sm table-borderless table-striped text-center mx-auto mt-3">
    <thead class="bg-dark text-white text-center">
      <tr>
        <th>Serial</th>
        <th>Task</th>
        <th>Added Date</th>
        <th>Added Time</th>
        <th>Action</th>
      </tr>
    </thead>

    <?php
    require_once "db.php";
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID

    // Fetch tasks specific to the logged-in user
    $task_show_query = "SELECT * FROM task_table WHERE user_id=?";
    $stmt = $dbcon->prepare($task_show_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows != 0) {
      $serial = 1;
      foreach ($result as $row) {
        $temp_date_time = explode(' ', $row['added_tiime']);
        $date = $temp_date_time[0];
        $time = $temp_date_time[1];
    ?>

    <tr>
      <td><?=$serial++?></td>
      <td><?=$row['task_name']?></td>
      <td><?=$date?></td>
      <td><?=$time?></td>
      <td>
        <div class="btn-group">
          <a class="btn btn-sm btn-warning" href="update.php?id=<?php echo base64_encode($row['id']); ?>">Update</a>
          <a class="btn btn-sm btn-danger" href="delete.php?id=<?php echo base64_encode($row['id']); ?>">Delete</a>
          <a class="btn btn-sm btn-success" href="view.php?id=<?php echo base64_encode($row['id']); ?>">View</a>
        </div>
      </td>
    </tr>

    <?php
      }
    } else {
    ?>
      <tr>
        <td colspan="20" class="text-center display-4">No tasks found</td>
      </tr>
    <?php
    }
    ?>
  </table>
</div>

<!-- Include Bootstrap JS, jQuery and Popper.js (if not already included) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
