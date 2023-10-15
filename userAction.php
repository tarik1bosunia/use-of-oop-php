<?php
// Start session 
session_start();

// Include and initialize DB class 
require_once 'Json.class.php'; # __DIR__
$db = new Json();

// Set default redirect url 
$redirectURL = 'index.php';

if (isset($_POST['bookSubmit'])) {
    // Get form fields value 
    $id = $_POST['id'];
    $title = trim(strip_tags($_POST['title']));
    $author = trim(strip_tags($_POST['author']));
    $pages = trim(strip_tags($_POST['pages']));
    $available = trim(strip_tags($_POST['available']));
    $id_str = '';
    if (!empty($id)) {
        $id_str = '?id=' . $id;
    }

    $errorMsg = '';

    // Fields validation 
    $errorMsg = '';
    if (empty($title)) {
        $errorMsg .= '<p>Please enter book title.</p>';
    }
    if (empty($author)) {
        $errorMsg .= '<p>Please enter author name.</p>';
    }
    if (empty($pages)) {
        $errorMsg .= '<p>Please enter number of pages of this books</p>';
    }
    if (!isset($available)) {
        $errorMsg .= '<p>Please enter abailablity</p>';
    }

    // Submitted form data
    $bookData = array(
        'title' => $title,
        'author' => $author,
        'pages' => $pages,
        'available' => $available
    );

    // Store the submitted field value in the session
    $sessionData['bookData'] = $bookData;

    // Submit the form data
    if (empty($errorMsg)) {
        if (!empty($_POST['id'])) {
            // update book data
            $update = $db->update($bookData, $_POST['id']);
            if ($update) {
                $sessionData['status']['msg'] = 'Book data has been updated successfully.';
                $sessionData['status']['type'] = 'success';
                // Remove submitted fields value from session
                unset($sessionData['bookData']);
            } else {
                $sessionData['status']['type'] = 'error';
                $sessionData['status']['msg'] = 'Some problem occurred, please try again.';

                // Set redirect url 
                $redirectURL = 'addEdit.php' . $id_str;
            }
        } else {
            // Insert book data 
            $insert = $db->insert($bookData);

            if ($insert) {
                $sessionData['status']['type'] = 'success';
                $sessionData['status']['msg'] = 'Book data has been added successfully.';

                // Remove submitted fields value from session 
                unset($sessionData['bookData']);
            } else {
                $sessionData['status']['type'] = 'error';
                $sessionData['status']['msg'] = 'Some problem occurred, please try again.';

                // Set redirect url 
                $redirectURL = 'addEdit.php' . $id_str;
            }
        }
    }else{ 
        $sessionData['status']['type'] = 'error'; 
        $sessionData['status']['msg'] = '<p>Please fill all the mandatory fields.</p>'.$errorMsg; 
         
        // Set redirect url 
        $redirectURL = 'addEdit.php'.$id_str; 
    } 

    // Store status into the session 
    $_SESSION['sessionData'] = $sessionData; 

}elseif(($_REQUEST['action_type'] == 'delete') && !empty($_GET['id'])){
        // Delete data 
        $delete = $db->delete($_GET['id']); 
     
        if($delete){ 
            $sessionData['status']['type'] = 'success'; 
            $sessionData['status']['msg'] = 'Book data has been deleted successfully.'; 
        }else{ 
            $sessionData['status']['type'] = 'error'; 
            $sessionData['status']['msg'] = 'Some problem occurred, please try again.'; 
        } 
         
        // Store status into the session 
        $_SESSION['sessionData'] = $sessionData; 
}

// Redirect to the respective page 
header("Location:".$redirectURL); 
exit();
