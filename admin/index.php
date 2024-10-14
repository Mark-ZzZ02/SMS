<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
	<link href="./css/style1.css" rel="stylesheet">

          <div class="users">
            <div class="card">
              <img src="./css/profile-icon.png">
              <h4>REYMONDO</h4>
              <p>Ui designer</p>
              <div class="per">
                <table>
                  <tr>
                    <td><span>85%</span></td>
                    <td><span>87%</span></td>
                  </tr>
                  <tr>
                    <td>Month</td>
                    <td>Year</td>
                  </tr>
                </table>
              </div>
              <button>Profile</button>
            </div>
            <div class="card">
              <img src="./css/profile-icon.png">
              <h4>ARJAY</h4>
              <p>Progammer</p>
              <div class="per">
                <table>
                  <tr>
                    <td><span>82%</span></td>
                    <td><span>85%</span></td>
                  </tr>
                  <tr>
                    <td>Month</td>
                    <td>Year</td>
                  </tr>
                </table>
              </div>
              <button>Profile</button>
            </div>
             <div class="card">
              <img src="./css/profile-icon.png">
              <h4>MARK EDWIN</h4>
              <p>tester</p>
              <div class="per">
                <table>
                  <tr>
                    <td><span>94%</span></td>
                    <td><span>92%</span></td>
                  </tr>
                  <tr>
                    <td>Month</td>
                    <td>Year</td>
                  </tr>
                </table>
            </div>
            <button>Profile</button>
        </div>
        <!-- Additional user cards can go here -->
    </div>

    <div class="attendance">
        <div class="attendance-list">
            <h4 class="d-flex justify-content-between align-items-center">
                USER LIST             </h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover mt-3">
                    <thead class="table-light-blue">
                        <tr>
                            <th class="text-center">NAME</th>
                            <th class="text-center">EMAIL</th>
                            <th class="text-center">DATE CREATED</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_tbody">
                        <?php
                            $category = getAll("users");

                            if (mysqli_num_rows($category) > 0) {
                                foreach ($category as $item) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $item['name']; ?></td>
                                        <td class="text-center"><?= $item['email']; ?></td>
                                        <td class="text-center"><?= $item['create_at']; ?></td>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


<?php include('includes/footer.php');?>