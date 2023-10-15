<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD in JSON using PHP | Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php

    // start session
    session_start();

    // retrive session data
    $sessionData = !empty($_SESSION['sessionData']) ? $_SESSION['sessionData'] : '';

    // include and initialize Json Class
    require_once 'Json.class.php';
    $db = new Json();

    // featch the books data
    $books = $db->getRows();

    // get status message from session
    if (!empty($sessionData['status']['msg'])) {
        $statusMsg = $sessionData['status']['msg'];
        $statusMsgType = $sessionData['status']['type'];
        unset($_SESSION['sessionData']['status']);
    }

    ?>

    <main class="px-5 md:px-10">
        <div class="flex flex-col items-center">
            <h5 class="font-bold text-5xl py-10">Books</h5>
        </div>

        <!-- display status message -->
        <?php
        if (!empty($statusMsg) && ($statusMsgType == 'success')) { ?>
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium"> <?php $statusMsgType ?></span> <?php echo $statusMsg; ?>
            </div>
        <?php } elseif (!empty($statusMsg) && ($statusMsgType == 'error')) { ?>

            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                <span class="font-medium"><?php $statusMsgType ?> </span> <?php $statusMsg ?>
            </div>

        <?php } ?>



        <div class="">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="">
                            <th scope="col" class="px-3 md:px-6 py-">
                                Sl No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Author
                            </th>
                            <th scope="col" class="px-3 md:px-6 py-3">
                                Pages
                            </th>
                            <th scope="col" class="px-3 md:px-6 py-3">
                                Available
                            </th>
                            <th scope="col" class="px-3 md:px-6 py-3 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($books)) {
                            $count = 0;
                            foreach ($books as $row) {
                                $count++;

                        ?>

                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-3 md:px-6 py-4">
                                        <?php echo $count; ?>
                                    </td>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $row['title']; ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo $row['author']; ?>
                                    </td>
                                    <td class="px-3 md:px-6 py-4">
                                        <?php echo $row['pages']; ?>

                                    </td>
                                    <td class="px-6 py-4 ">
                                  
                                        <?php echo $row['available']; ?>
                                        
                                        <!-- <?php
                                        
                                        if($row['available'] >= 1) {  ?>

                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" class="text-green-500"><path fill="currentColor" d="M28.21 2.4a3.5 3.5 0 0 1 1.344 4.763l-11.51 20.554a4 4 0 0 1-6.135 1.047L3.186 21.08a3.5 3.5 0 0 1 4.628-5.252l5.936 5.23l9.696-17.314A3.5 3.5 0 0 1 28.21 2.4Z"/></svg>
                                        <?php } else  { ?>

                                        <svg  xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 64 64"><path fill="#ec1c24" d="M50.592 2.291L32 20.884C25.803 14.689 19.604 8.488 13.406 2.291c-7.17-7.17-18.284 3.948-11.12 11.12c6.199 6.193 12.4 12.395 18.592 18.592A32589.37 32589.37 0 0 1 2.286 50.595c-7.164 7.168 3.951 18.283 11.12 11.12c6.197-6.199 12.396-12.399 18.593-18.594l18.592 18.594c7.17 7.168 18.287-3.951 11.12-11.12c-6.199-6.199-12.396-12.396-18.597-18.594c6.2-6.199 12.397-12.398 18.597-18.596c7.168-7.166-3.949-18.284-11.12-11.11"/></svg>
                                        <?php } ?> -->
                                    </td>
                                    <td class="flex justify-center items-center py-2">
                                        <a href="addEdit.php?id=<?php echo $row['isbn']; ?>" class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            edit
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M5 23.7q-.825 0-1.413-.587T3 21.7v-14q0-.825.588-1.413T5 5.7h8.925l-2 2H5v14h14v-6.95l2-2v8.95q0 .825-.588 1.413T19 23.7H5Zm7-9Zm4.175-8.425l1.425 1.4l-6.6 6.6V15.7h1.4l6.625-6.625l1.425 1.4l-6.625 6.625q-.275.275-.638.438t-.762.162H10q-.425 0-.713-.288T9 16.7v-2.425q0-.4.15-.763t.425-.637l6.6-6.6Zm4.275 4.2l-4.275-4.2l2.5-2.5q.6-.6 1.438-.6t1.412.6l1.4 1.425q.575.575.575 1.4T22.925 8l-2.475 2.475Z"/></svg> -->
                                        </a>
                                        <a href="userAction.php?action_type=delete&id=<?php echo $row['isbn']; ?>" onclick="return confirm('Are you sure to delete?');" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-xs md:text-sm px-4 md:px-5 py-2.5 text-center mr-2 mb-2">
                                            delete
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7Zm2-4h2V8H9v9Zm4 0h2V8h-2v9Z"/></svg> -->
                                        </a>
                                    </td>
                                </tr>

                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6">No book(s) found...</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add New Book link -->
        <div class="flex justify-start m-4">
            <a href="addEdit.php" class="flex justify-center items-center text-3xl text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg px-5 py-2.5 text-center mr-2 mb-2" title="Add New Book">Add New Book <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M11 13H5v-2h6V5h2v6h6v2h-6v6h-2v-6Z" />
                </svg></a>

        </div>

    </main>

</body>

</html>