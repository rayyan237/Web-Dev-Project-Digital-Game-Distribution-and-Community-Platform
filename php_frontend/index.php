<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Steam Navbar - Included PHP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">
</head>
<style>

</style>

<body style="background-color: #1b2838;">

    <?php include 'section-navbar.php'; ?>

    <section id="#hero">
        <?php include 'section-hero.php'; ?>
    </section>

    <div class="section-spacer"></div>

    <section id="dis">
        <?php include 'section-discounts.php'; ?>
    </section>

    <div class="section-spacer"></div>

    <section id="#cat">
        <?php include 'section-category_browse.php'; ?>
    </section>
    
    <div class="section-spacer"></div>

    <section id="rec">
        <?php include 'section-recommended_games.php'; ?>
    </section>

    <div class="section-spacer"></div>

    <section id="under">
        <?php include 'section-under-10.php'; ?>
    </section>

    <div class="section-spacer"></div>

    <?php include 'section-footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>