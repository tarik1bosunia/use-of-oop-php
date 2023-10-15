<link rel="stylesheet" href="style.css">

<?php 
// Start session 
session_start(); 
 
// Retrieve session data 
$sessionData = !empty($_SESSION['sessionData'])?$_SESSION['sessionData']:''; 
 
// Get member data 
$memberData = $bookData = array(); 
if(!empty($_GET['id'])){ 
    // Include and initialize JSON class 
    include 'Json.class.php'; 
    $db = new Json(); 
     
    // Fetch the member data 
    $memberData = $db->getSingle($_GET['id']); 
} 
$bookData = !empty($sessionData['bookData'])? $sessionData['bookData'] : $memberData; 
unset($_SESSION['sessionData']['bookData']); 
$actionLabel = !empty($_GET['id'])?'Edit':'Add'; 
 
// Get status message from session 
if(!empty($sessionData['status']['msg'])){ 
    $statusMsg = $sessionData['status']['msg']; 
    $statusMsgType = $sessionData['status']['type']; 
    unset($_SESSION['sessionData']['status']); 
} 
?>

<div class="flex flex-col items-center">
    <h5 class="font-bold text-5xl py-10"><?php echo $actionLabel; ?> Book</h5>
</div>

<!-- display status message -->
<?php  
if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <span class="font-medium"> <?php $statusMsgType ?></span> <?php echo $statusMsg; ?>
    </div>
<?php } 
elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
    
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium"><?php $statusMsgType ?> </span> <?php $statusMsg ?>
    </div>

<?php } ?>

<div class="flex justify-center items-center">
<form method="post" action="userAction.php" class="w-full max-w-sm">
  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="title">
        Title
      </label>
    </div>
    <div class="md:w-2/3">
      <input value="<?php echo !empty($bookData['title'])?$bookData['title']:''; ?>" required=""  class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="title" name="title" type="text" >
    </div>
  </div>
  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="author">
        Author
      </label>
    </div>
    <div class="md:w-2/3">
      <input value="<?php echo !empty($bookData['author'])?$bookData['author']:''; ?>" required=""  class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="author" name="author" type="text">
    </div>
  </div>

  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="pages">
        Number of Pages
      </label>
    </div>
    <div class="md:w-2/3">
      <input value="<?php echo !empty($bookData['pages'])?$bookData['pages']:''; ?>" required=""  class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="pages" name="pages" type="number">
    </div>
  </div>

  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="pages">
        Available
      </label>
    </div>
    <div class="md:w-2/3">
        
    <input type="number" name="available" value="<?php echo !empty($bookData['available'])?$bookData['available']:''; ?>"  class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
    </div>
  </div>


  <input type="hidden" name="id" value="<?php echo !empty($memberData['isbn'])?$memberData['isbn']:''; ?>">

  <div class="md:flex md:items-center">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
    <input type="submit" name="bookSubmit" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2" value="Submit">
    </div>
  </div>

</form>
</div>
<div class="flex flex-grow-0">

<a href="index.php" class="flex justify-center items-center text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2H7.825Z"/></svg>

  Go Back
</a>
</div>




