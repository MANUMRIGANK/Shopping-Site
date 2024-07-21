
<?php 

global $conn;
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `users` WHERE user_id = $user_id";
$execution = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($execution)) {

?>

<form action="../template/front/update.php" method='post'>
                    <div class='row'>

                    
                        <div class='col-sm-6'>
                            <label for="fname">Full Name:</label>
                            <input type="text" name='fname' value="<?php echo $row['name']?>" class="form-control" required>
                            <label for="email">Email:</label>
                            <input type="email" name='email' value="<?php echo $row['email']?>" class="form-control" required>
                            <label for="number">Number:</label>
                            <input type="text" name='number' value="<?php echo $row['number']?>" class="form-control" required>
                            <label for="Address">Address:</label>
                            <textarea type="text" name='Address' class="form-control"><?php echo $row['address']?> </textarea>
                        </div>
                        <div class='col-sm-6'>
                            <label for="username">Username:</label>
                            <input type="text" name='username' value="<?php echo $row['username']?>" class="form-control" required>
                           

                            <div class="row">
                                <div class="col-sm-6">
                                <label for="city">City:</label>
                                <input type="text" name='city' value="<?php echo $row['city']?>" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                <label for="state">State:</label>
                                <input type="text" name='state' value="<?php echo $row['state']?>" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    
                    <?php }?>
                    </div>

                    <div style="margin-top: 20px;" class="col-lg-12 text-center">
                        <div id="success">
                        <button type="submit" class="btn btn-primary"> Update </button>
                        </div>
                    </div>
                </form>