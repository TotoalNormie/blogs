<?php
include 'db.php';
class Blog extends DB
{
    function outputBlog()
    {
        $data = $this->returnData('blogs');
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]["title"] = nl2br($data[$i]["title"]);
            $data[$i]["description"] = nl2br($data[$i]["description"]);
        }
        return $data;
    }
    function createBlog($data)
    {
        $data["title"] = htmlspecialchars($data["title"]);
        $data["description"] = htmlspecialchars($data["description"]);
        $titleLength = strlen($data["title"]);
        $descriptionLength = strlen($data["description"]);
        if ($titleLength < 5)
            return "Titulam jābūt vismaz 5 rakstu zīmēm";
        elseif ($titleLength > 50)
            return "Titulam jābūt īsākam par 50 rakstu zīmēm";

        if ($descriptionLength < 5)
            return "Aprakstam jābūt vismaz 5 rakstu zīmēm";
        elseif ($descriptionLength > 256)
            return "Aprakstam jābūt īsākam par 256 rakstu zīmēm";

        return $this->insert($data, "blogs");
    }
    function updateBlog($data, $id)
    {
        $data["title"] = htmlspecialchars($data["title"]);
        $data["description"] = htmlspecialchars($data["description"]);
        $titleLength = strlen($data["title"]);
        $descriptionLength = strlen($data["description"]);
        if ($titleLength < 5)
            return "Titulam jābūt vismaz 5 rakstu zīmēm";
        elseif ($titleLength > 50)
            return "Titulam jābūt īsākam par 50 rakstu zīmēm";
        if ($descriptionLength < 5)
            return "Aprakstam jābūt vismaz 5 rakstu zīmēm";
        elseif ($descriptionLength > 256)
            return "Aprakstam jābūt īsākam par 256 rakstu zīmēm";
        return $this->update($data, "blogs", $id);
    }
    function deleteBlog($id)
    {
        return $this->delete("blogs", $id);
    }

}

$blog = new Blog();
$method = $_SERVER['REQUEST_METHOD'];

$data = $blog->outputBlog();

$errorMessage = "";
$editErrorMessage = "";
$getData = $_GET;

if ($method == 'GET' && isset($getData['action'])) {
    $action = $getData['action'];
    unset($getData['action']);
    if ($action == 'update') {
        echo 'upadte<br>';
        $id = $getData['id'];
        unset($getData['id']);
        $editErrorMessage = $blog->updateBlog($getData, $id);
        checkError($editErrorMessage);
    } elseif ($action == 'delete') {
        echo 'delete<br>';
        $editErrorMessage = $blog->deleteBlog($getData['id']);
        checkError($editErrorMessage);
    }
} elseif ($method == 'POST') {
    $errorMessage = $blog->createBlog($_POST);
    checkError($errorMessage);
}

function checkError($errorMessage)
{
    if (!$errorMessage) {
        header("Location: index.php");
        die();
    }
}
?>