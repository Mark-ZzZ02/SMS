<?php
session_start();
include('../config/dbcon.php');
include('../functions/myfunctions.php');

if (isset($_POST['add_category_btn'])) {  
    
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $case_id = mysqli_real_escape_string($con, $_POST['case_id']);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $program = mysqli_real_escape_string($con, $_POST['program']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $major = mysqli_real_escape_string($con, $_POST['major']);
    $sms_email = mysqli_real_escape_string($con, $_POST['sms_email']);
    $year_level = mysqli_real_escape_string($con, $_POST['year_level']);
    $statement = mysqli_real_escape_string($con, $_POST['statement']);
    $offense_type = mysqli_real_escape_string($con, $_POST['offense_type']);  

    
    $insert_query = "INSERT INTO categories (surname, first_name, case_id, student_id, program, section, major, sms_email, year_level, statement, offense_type) 
                     VALUES ('$surname', '$first_name', '$case_id', '$student_id', '$program', '$section', '$major', '$sms_email', '$year_level', '$statement', '$offense_type')";
    $insert_query_run = mysqli_query($con, $insert_query);

    if ($insert_query_run) {
        
        if ($offense_type == 'Minor') {
            header('Location: punishment.php');
            exit();
        } else if ($offense_type == 'Major' || $offense_type == 'Grave') {
            header('Location: parent.php');
            exit();
        }
    } else {
        redirect("category.php", "Something Went Wrong");
    }
}

else if (isset($_POST['update_category_btn'])) {
    $category_id = $_POST['category_id'];
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $case_id = mysqli_real_escape_string($con, $_POST['case_id']);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $program = mysqli_real_escape_string($con, $_POST['program']);
    $section = mysqli_real_escape_string($con, $_POST['section']);
    $major = mysqli_real_escape_string($con, $_POST['major']);
    $sms_email = mysqli_real_escape_string($con, $_POST['sms_email']);
    $year_level = mysqli_real_escape_string($con, $_POST['year_level']);
    $statement = mysqli_real_escape_string($con, $_POST['statement']);
    $parent_name = mysqli_real_escape_string($con, $_POST['parent_name']);
    $parent_contact = mysqli_real_escape_string($con, $_POST['parent_contact']);
    $date_meeting = mysqli_real_escape_string($con, $_POST['date_meeting']);
    $case_status = mysqli_real_escape_string($con, $_POST['case_status']);
    $attendees = mysqli_real_escape_string($con, $_POST['attendees']);
    $conclusions = mysqli_real_escape_string($con, $_POST['conclusions']);
    $offense_type = mysqli_real_escape_string($con, $_POST['offense_type']);
    $offense_id = mysqli_real_escape_string($con, $_POST['offense_id']);
    $sanction_type = mysqli_real_escape_string($con, $_POST['sanction_type']);
    $sanction = mysqli_real_escape_string($con, $_POST['sanction']);
    
    $completion_status = mysqli_real_escape_string($con, $_POST['completion_status']);
    $completion_date = mysqli_real_escape_string($con, $_POST['completion_date']);
    $warning = mysqli_real_escape_string($con, $_POST['warning']);

    $update_query = "UPDATE categories SET surname='$surname', first_name='$first_name', case_id='$case_id', student_id='$student_id', 
    program='$program', section='$section', major='$major', sms_email='$sms_email', year_level='$year_level', 
    statement='$statement', parent_name='$parent_name', parent_contact='$parent_contact', 
    date_meeting='$date_meeting', case_status='$case_status', attendees='$attendees', conclusions='$conclusions', 
    offense_type='$offense_type', offense_id='$offense_id', sanction_type='$sanction_type', sanction='$sanction', 
    completion_status='$completion_status', completion_date='$completion_date', warning='$warning' 
    WHERE id='$category_id'";

    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        redirect("category.php?id=$category_id", "Student Updated Successfully");
    } else {
        redirect("category.php", "Something Went Wrong");
    } 
}




else if (isset($_POST['update_parent_btn'])) {
    $category_id = $_POST['category_id'];
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']); 
    $surname = mysqli_real_escape_string($con, $_POST['surname']); 
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']); 
    $statement = mysqli_real_escape_string($con, $_POST['statement']); 
    $parent_name = mysqli_real_escape_string($con, $_POST['parent_name']); 
    $parent_contact = mysqli_real_escape_string($con, $_POST['parent_contact']); 
    $date_meeting = mysqli_real_escape_string($con, $_POST['date_meeting']); 
    $case_status = mysqli_real_escape_string($con, $_POST['case_status']); 
    $attendees = mysqli_real_escape_string($con, $_POST['attendees']); 
    $conclusions = mysqli_real_escape_string($con, $_POST['conclusions']); 

    $update_query = "UPDATE categories SET student_id='$student_id', surname='$surname', first_name='$first_name', 
    statement='$statement', parent_name='$parent_name', parent_contact='$parent_contact', 
    date_meeting='$date_meeting', case_status='$case_status', attendees='$attendees', 
    conclusions='$conclusions'
    WHERE id='$category_id'";

    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        redirect("parent.php?id=$category_id", "Parent Updated Successfully");
    } else {
        redirect("parent.php", "Something Went Wrong");
    } 
}




else if (isset($_POST['update_punishment_btn'])) {

    $category_id = $_POST['category_id'];
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $first_name = mysqli_real_escape_string($con, $_POST['first_name']);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $statement = mysqli_real_escape_string($con, $_POST['statement']);
    $case_id = mysqli_real_escape_string($con, $_POST['case_id']);
    $offense_type = mysqli_real_escape_string($con, $_POST['offense_type']);
    $offense_id = mysqli_real_escape_string($con, $_POST['offense_id']);
    $sanction_type = mysqli_real_escape_string($con, $_POST['sanction_type']);
    $sanction = mysqli_real_escape_string($con, $_POST['sanction']);
    $conclusions = mysqli_real_escape_string($con, $_POST['conclusions']);
    $case_status = mysqli_real_escape_string($con, $_POST['case_status']);
    $completion_date = mysqli_real_escape_string($con, $_POST['completion_date']);
    $warning = mysqli_real_escape_string($con, $_POST['warning']);

    $update_query = "UPDATE categories SET 
        surname='$surname', 
        first_name='$first_name', 
        student_id='$student_id', 
        statement='$statement', 
        case_id='$case_id', 
        offense_type='$offense_type', 
        offense_id='$offense_id', 
        sanction_type='$sanction_type', 
        sanction='$sanction', 
        conclusions='$conclusions', 
        case_status='$case_status',
        warning='$warning', 
        completion_date='$completion_date' 
        WHERE id='$category_id'";

    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        redirect("punishment.php?id=$category_id", "Punishment Updated Successfully");
    } else {
        redirect("punishment.php", "Something Went Wrong: " . mysqli_error($con)); 
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
        redirect("punishment.php", "Punishment Deleted Successfully");
    }
    else
    {
        redirect("punishment.php", "Something Went Wrong");
    }
}
?>