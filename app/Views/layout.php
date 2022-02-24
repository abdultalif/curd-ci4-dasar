<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('/css/style.css'); ?>">
    <title>latihan CI4 | <?= $judul; ?></title>
</head>

<body>
    <?= $this->include('navbar'); ?>

    <?= $this->RenderSection('content'); ?>
</body>

<script src="<?= base_url('/js/bootstrap.min.js'); ?>"></script>

</html>