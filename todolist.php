<?php
/** 
 * Getting data via API 
 * */
/** start */
    // Set your token and URL
    $token = '80461adcc862e002e4801ed58be0833633699989';
    $url = 'https://api.todoist.com/rest/v2/tasks?project_id=2312105822';

    // Initialize cURL
    $ch = curl_init();

    // Set the cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $token
    ));

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        echo 'cURL Error: ' . curl_error($ch);
    }

    // Close the cURL handle
    curl_close($ch);

    // Display the response
    $response;


    $response_data = json_decode($response);

    $html = '';
    foreach($response_data as $data){
        if(empty($data->section_id)){
        }
        $html .= '<li>'.$data->content.'</li>';
    }
/** end */
/**
 * Insert query
 */
/** start */
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        // Set API endpoint URL
        $api_endpoint = "https://api.todoist.com/rest/v2/tasks";
        
        // Set data to be inserted
        $data = array(
            'content' => $title
        );
        
        // Initialize cURL
        $curl = curl_init($api_endpoint);
        
        // Set the cURL options
        curl_setopt($curl, CURLOPT_URL, $api_endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $token
        ));
        // Set cURL options
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        // Execute cURL request
        $response = curl_exec($curl);
        
        // Check for errors
        if(curl_errno($curl)) {
            echo 'Error: ' . curl_error($curl);
        } else {
            // echo $response;
        }
        
        // Close cURL
        curl_close($curl);
        header("Refresh: 0");
    }
/** end */




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoist</title>
</head>
<body>
  

<div id="myDIV" class="header">
  <h2>My To Do List</h2>
    <form action="todolist.php" method="post">
        <input type="text" name="title" placeholder="Title...">
        <button type="submit" name="submit">Add</button>
    </form>
</div>

<ul id="myUL">
    <?php 
        echo $html;
    ?>
</ul>




</body>
</html>

























     