<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
      <title>RDCC  | Homepage</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
      <!--Customer-link-->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://kit.fontawesome.com/6dca7d608b.js" crossorigin="anonymous"></script>
      <style type="text/css">
        header{
          background: #A93226;
        }
        .dataTables_wrapper nav a{
          background: #efe9e9;
          text-decoration: none;
          color: black;
          padding: 1rem;
          border-radius: 1rem;
        }
        .dataTables_wrapper table td .fa-trash{
          color: red;
        }

      </style>
</head>
<body>
  <?php 
    include('heading.php'); 
    include('connection.php'); 

    //create total
    $sql = "SELECT SUM(subtotal) AS total from tbl_cart where username = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) { 
        $total = $row['total'];
      }
    } 

    $sql = "SELECT * from tbl_cart where username = $id";
    $result = $conn->query($sql);

  ?>
      <center>
          <div class="dataTables_wrapper" style="width: 95%; margin-top:2rem; font-size: 1rem">
            <h1 class="mb-1" style="font-size: 40px;">Cart</h1> <hr class="mb-4">
          <?php if ($result->num_rows > 0) { ?>

            <table id="table" class="display" style="width:100%;">
                  <thead>
                        <tr id="header" style="background: var(--orange); color: white;">
                          
                          <th>Product</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Subtotal</th>
                          <th>Action</th>

                        </tr>
                  </thead>
                  <?php while($row = $result->fetch_assoc()) { ?>
                    <tbody>
                      <tr>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['price']; ?></td>
                          <td><?php echo $row['quantity']; ?></td>
                          <td><?php echo $row['subtotal']; ?></td>
                          <td>
                              <a href="student_profile.php?profile_id=<?php echo $row['id'] ?>"><i class="fas fa-eye"></i></a>
                              <a href="student_update.php?update_id=<?php echo $row['id'] ?>"><i class="fas fa-user-edit pr-3 pl-3"></i></a>
                              <a href="student_delete.php?delete_id=<?php echo $row['id'] ?>"><i class="fas fa-trash"></i></a>
                          </td>
                      </tr>
                  <?php } ?>
                       <tr>
                        <td colspan="2"></td>
                        <td><b>Total</b></td>
                        <td><b><?php echo $total; ?></b></td>
                        <td><button onclick="window.location.href='checkout.php?id=<?php echo $id; ?>'">Checkout</button></td>
                      </tr>
                </tbody>  
          <?php } else {
            echo 'empty!';
          } ?> 
              </table>
            </div>
          </center>

        
<script src='https://code.jquery.com/jquery-3.5.1.js'></script>
<script src='https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js'></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable();
} );
</script>

<!--table row click function--->
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
</script>



</body>
</html>