<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>
	<link href="./css/stylesec.css" rel="stylesheet">
    <div class="home-content p-3">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Student</div>
            <?php
                $dash_category_query = "SELECT * from categories";
                $dash_category_query_run = mysqli_query($con, $dash_category_query);

                if($category_total = mysqli_num_rows($dash_category_query_run))
                {
                  echo '<h4 class="number"> '.$category_total.'</h4>';
                }
                else
                {
                  echo '<h4 class="number"> 0 </h4>';
                }

            ?>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Update</span>
            </div>
          </div>
          <i class='bx bx-cart-alt cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Active case</div>
            <?php
                $dash_category_active_query = "SELECT * from categories WHERE completion_status='open' ";
                $dash_category_active_query_run = mysqli_query($con, $dash_category_active_query);

                if($categoryActive_total = mysqli_num_rows($dash_category_active_query_run))
                {
                  echo '<h4 class="number"> '.$categoryActive_total.'</h4>';
                }
                else
                {
                  echo '<h4 class="number"> 0 </h4>';
                }

            ?>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Update</span>
            </div>
          </div>
          <i class='bx bxs-cart-add cart two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">UnderInvestigation</div>
            <?php
                $dash_category_investigation_query = "SELECT * from categories WHERE completion_status='Under_Investigation' ";
                $dash_category_investigation_query_run = mysqli_query($con, $dash_category_investigation_query);

                if($categoryinvestigation_total = mysqli_num_rows($dash_category_investigation_query_run))
                {
                  echo '<h4 class="number"> '.$categoryinvestigation_total.'</h4>';
                }
                else
                {
                  echo '<h4 class="number"> 0 </h4>';
                }

            ?>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Update</span>
            </div>
          </div>
          <i class='bx bx-cart cart three' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">closed Case</div>
            <?php
                $dash_category_closed_query = "SELECT * from categories WHERE completion_status='closed' ";
                $dash_category_closed_query_run = mysqli_query($con, $dash_category_closed_query);

                if($categoryclosed_total = mysqli_num_rows($dash_category_closed_query_run))
                {
                  echo '<h4 class="number"> '.$categoryclosed_total.'</h4>';
                }
                else
                {
                  echo '<h4 class="number"> 0 </h4>';
                }

            ?>
            <div class="indicator">
              <i class='bx bx-down-arrow-alt down'></i>
              <span class="text">Update</span>
            </div>
          </div>
          <i class='bx bxs-cart-download cart four' ></i>
        </div>
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

    


<?php include('includes/footer.php');?><?php 
