<?php
include 'db.php';
class Blog extends DB {
    function outputBlog() {
        $data = $this->returnData('blogs');
        for($i = 1; $i < count($data); $i++) {
            $data[$i]["title"] = nl2br($data[$i]["title"]);
        }
        return $data;
    }
    function createBlog($data) {
        $data["title"] = htmlspecialchars($data["title"]);
        $data["description"] = htmlspecialchars($data["description"]);
        $titleLength = strlen($data["title"]);
        $descriptionLength = strlen($data["description"]);
        if($titleLength < 5) 
            return "Titulam jābūt vismaz 5 rakstu zīmēm";
        elseif($titleLength > 50)
            return "Titulam jābūt īsākam par 50 rakstu zīmēm";

        if($descriptionLength < 5) 
            return "Aprakstam jābūt vismaz 5 rakstu zīmēm";
        elseif($descriptionLength > 256)
            return "Aprakstam jābūt īsākam par 256 rakstu zīmēm";
        
        return $this->insert($data, "blogs");
    }
    
}

$blog = new Blog();
$method =  $_SERVER['REQUEST_METHOD'];

$data = $blog->outputBlog();

$errorMessage = "";

if($method == 'GET' && isset($_GET['action']) && $_GET['action'] = 'edit') {
    echo 'edit';
}elseif($method == 'GET' && isset($_GET['action']) && $_GET['action'] = 'delete') {
    echo 'delete';
}elseif($method == 'POST') {
    $errorMessage = $blog->createBlog($_POST);
}

?>