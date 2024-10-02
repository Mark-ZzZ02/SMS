<?php
session_start();
include('../config/dbcon.php');
include('../functions/myfunctions.php');

if(isset($_POST['add_category_btn']))
{
    $name = $_POST['name'];
    $case_id = $_POST['case_id'];
    $offense_id = $_POST['offense_id'];
    $student_id = $_POST['student_id'];
    $case_status = $_POST['case_status'];
    $date_reported = $_POST['date_reported'];
    $investigation_notes = $_POST['investigation_notes'];
    $last_updated = $_POST['last_updated'];
    $next_action = $_POST['next_action'];
    $assigned_staff = $_POST['assigned_staff'];
    $punishment_id = $_POST['punishment_id'];
    $reported_by = $_POST['reported_by'];
    $date_of_offense = $_POST['date_of_offense'];
    $description = $_POST['description'];
    $case_priority = $_POST['case_priority'];
    $punishment_type = $_POST['punishment_type'];
    $punishment_details = $_POST['punishment_details'];
    $date_assigned = $_POST['date_assigned'];
    $assigned_by = $_POST['assigned_by'];
    $completion_status = $_POST['completion_status'];
    $completion_date = $_POST['completion_date'];
    $date_added = $_POST['date_added'];
    $status = isset($_POST['status']) ? '1':'0' ;
    $popular = isset($_POST['popular']) ? '1':'0' ;

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $cate_query = "INSERT INTO categories 
    (name,case_id,offense_id,student_id,case_status,date_reported,investigation_notes,last_updated,next_action,assigned_staff,punishment_id,reported_by,date_of_offense,description,case_priority,punishment_type,punishment_details,date_assigned,
    assigned_by,completion_status,completion_date,date_added,status,popular,image)
    VALUES ('$name','$case_id','$offense_id','$student_id','$case_status','$date_reported','$investigation_notes','$last_updated',
    '$next_action','$assigned_staff','$punishment_id','$reported_by','$date_of_offense','$description','$case_priority',
    '$punishment_type','$punishment_details','$date_assigned','$assigned_by','$completion_status','$completion_date','$status','$date_added','$popular','$filename')";

    $cate_query_run = mysqli_query($con, $cate_query);

    if($cate_query_run)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);

        redirect("category.php", "Category Added Successfully");

    }
    else
    {
        redirect("category.php", "Something Went Wrong");

    }
}
else if(isset($_POST['update_category_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $case_id = $_POST['case_id'];
    $offense_id = $_POST['offense_id'];
    $student_id = $_POST['student_id'];
    $case_status = $_POST['case_status'];
    $date_reported = $_POST['date_reported'];
    $last_updated = $_POST['last_updated'];
    $next_action = $_POST['next_action'];
    $reported_by = $_POST['reported_by'];
    $date_of_offense = $_POST['date_of_offense'];
    $description = $_POST['description'];
    $case_priority = $_POST['case_priority'];
    $punishment_type = $_POST['punishment_type'];
    $assigned_by = $_POST['assigned_by'];
    $date_added = $_POST['date_added'];
    $status = isset($_POST['status']) ? '1':'0' ;
    $popular = isset($_POST['popular']) ? '1':'0' ;
    
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE categories SET name='$name', case_id='$case_id', offense_id='$offense_id', 
    student_id='$student_id', case_status='$case_status', date_reported='$date_reported', 
    last_updated='$last_updated', next_action='$next_action',
    reported_by='$reported_by', date_of_offense='$date_of_offense', description='$description', case_priority='$case_priority', 
    punishment_type='$punishment_type', assigned_by='$assigned_by', 
    date_added='$date_added', status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id' ";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("category.php?id=$category_id", "Category Upadated Successfully");

    }
    else
    {
        redirect("category.php", "Something Went Wrong");

    }


}
else if(isset($_POST['update_punishment_btn']))
{
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $case_status = $_POST['case_status'];
    $date_reported = $_POST['date_reported'];
    $investigation_notes = $_POST['investigation_notes'];
    $last_updated = $_POST['last_updated'];
    $next_action = $_POST['next_action'];
    $assigned_staff = $_POST['assigned_staff'];
    $punishment_id = $_POST['punishment_id'];
    $reported_by = $_POST['reported_by'];
    $case_priority = $_POST['case_priority'];
    $punishment_type = $_POST['punishment_type'];
    $punishment_details = $_POST['punishment_details'];
    $date_assigned = $_POST['date_assigned'];
    $assigned_by = $_POST['assigned_by'];
    $completion_status = $_POST['completion_status'];
    $completion_date = $_POST['completion_date'];
    $status = isset($_POST['status']) ? '1':'0' ;
    $popular = isset($_POST['popular']) ? '1':'0' ;
    
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if($new_image != "")
    {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE categories SET name='$name', student_id='$student_id', case_status='$case_status', date_reported='$date_reported', investigation_notes='$investigation_notes', 
    last_updated='$last_updated', next_action='$next_action', assigned_staff='$assigned_staff', punishment_id='$punishment_id', 
    reported_by='$reported_by', date_of_offense='$date_of_offense', case_priority='$case_priority', 
    punishment_type='$punishment_type', punishment_details='$punishment_details', date_assigned='$date_assigned', assigned_by='$assigned_by', 
    completion_status='$completion_status', completion_date='$completion_date', status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id' ";

    $update_query_run = mysqli_query($con, $update_query);

    if($update_query_run)
    {
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("punishment.php?id=$category_id", "Category Upadated Successfully");

    }
    else
    {
        redirect("punishment.php", "Something Went Wrong");

    }


}
else if(isset($_POST['delete_category_btn']))
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $category_query = "SELECT * FROM categories WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        redirect("category.php", "Category Deleted Successfully");
    }
    else
    {
        redirect("category.php", "Something Went Wrong");
    }
}
else if(isset($_POST['delete_punishment_btn']))
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $category_query = "SELECT * FROM categories WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        redirect("punishment.php", "punishment Deleted Successfully");
    }
    else
    {
        redirect("punishment.php", "Something Went Wrong");
    }
}
?>