<?php
$title = "My PHP Page";
$intro_text = "An introductory text.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>

<main>

    <section aria-labelledby="intro">
        <h2 id="intro">Introduction</h2>
        <p><?php echo $intro_text; ?></p>
    </section>

</main>

</body>
</html>
