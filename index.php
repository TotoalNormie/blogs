<?php

include 'handle.php';

$title = !empty($_POST) ? $_POST['title'] : "";
$description = !empty($_POST) ? $_POST['description'] : "";

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
        <title>ABLOGUS</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <header>ABLOGUS</header>
        <main>
            <form method="post">
                <label for="title">Tituls:</label>
                <input type="text" name="title" value="<?= $title ?>">
                <label for="description">Apraksts:</label>
                <textarea name="description" rows="1"><?= $description ?></textarea>
                <span>
                    <?= $errorMessage ?>
                </span>
                <button>Pievienot <i class="fa-solid fa-thumbs-up"></i></button>
            </form>
            <h2>List of blogs: </h2>
            <div class="wrapper">
                <!-- <form class="blog">
                    <div class="content">
                        <h2>title</h2>
                        <p>descriptoion</p>
                    </div>
                    <button class="edit" name="action" value="edit"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="delete"><i class="fa-solid fa-eraser"></i></button>
                </form> -->

                <?php
                if(empty($data)) echo "<h3>Sorry, no blogs available</h3>";
                 foreach ($data as $blog) {
                    $isEdit = isset($_GET["id"]) && $blog["id"] == $_GET["id"] && $_GET["action"] == 'edit' ? true : false;
                    // echo "isEdit: " . ($isEdit ?"true":"false");
                    ?>
                    <form class="blog">
                        <div class="content">
                            <input type="hidden" name="id" value="<?= $blog["id"] ?>">
                            <?php if ($isEdit) { ?>
                                <label for="title">Tituls:</label>
                                <input type="title" name="title" value="<?= strip_tags($blog["title"]) ?>">
                                <label for="description">Apraksts:</label>
                                <textarea name="description" rows="1"><?= strip_tags($blog["description"]) ?></textarea>
                                <span>
                                    <?= $editErrorMessage ?>
                                </span>
                            <?php } else { ?>
                                <h2>
                                    <?= $blog["title"] ?>
                                </h2>
                                <p>
                                    <?= $blog["description"] ?>
                                </p>
                            <?php } ?>
                        </div>
                        <button class="edit" name="action" value="<?= $isEdit ? "update" : "edit" ?>">
                            <i class=" fa-solid fa-pen-to-square"></i>
                        </button>
                        <button class="delete" name="action" value="delete">
                            <i class="fa-solid fa-eraser"></i>
                        </button>
                    </form>
                <?php } ?>
            </div>

        </main>
        <footer>
            the simplest blogging website
        </footer>
        <script>
            window.onload = () => {
                const textarea = document.querySelectorAll('textarea');
                for (elem of textarea) {
                    elem.autoTextarea = autoTextarea;
                    elem.addEventListener('input', elem.autoTextarea);
                    elem.autoTextarea();
                }
            }
            function autoTextarea() {
                console.log(this);
                this.style.height = 'auto';
                const height = this.scrollHeight + this.offsetHeight - this.clientHeight + 2;
                this.style.height = height + 'px';
            }
        </script>
    </body>

</html>