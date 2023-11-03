<?php

include 'handle.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <title>ABLOGUS</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>ABLOGUS</header>
    <main>
        <form method="post">
            <label for="title">Tituls:</label>
            <input type="title">
            <label for="description">Apraksts:</label>
            <textarea name="description" rows="1"></textarea>
            <button>pievienot <i class="fa-solid fa-thumbs-up"></i></button>
        </form>
        <div class="wrapper">
            <form class="blog">
                <div class="content">
                    <h2>title</h2>
                    <p>descriptoion</p>
                </div>
                <button class="edit"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="delete"><i class="fa-solid fa-eraser"></i></button>
            </form>
        </div>

    </main>
    <footer>
        the simplest blogging website
    </footer>
    <script>
        const textarea = document.querySelectorAll('textarea');
        for (elem of textarea) {
            elem.addEventListener('input', function() {
                this.style.height = 'auto';
                const height =  this.scrollHeight + this.offsetHeight - this.clientHeight;
                this.style.height = height + 'px';
            });
        }
    </script>
</body>

</html>