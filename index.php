<?php
session_start();
require_once ("utils.php");
require_once ("data-service.php");

$_SESSION["errors"] = [];

$config = [
    "link" => "http://domain.com/index.php?user=",
    "tableHeaders" => ["Name", "Address", "Email", "Gender", "Created"],
    "itemsPerPage" => 10
];

$page = $_GET["page"] ?? 1;

$users = DataService::getUsers();

$pagination = new Pagination($users, $config["itemsPerPage"]);

list(
    "items" => $items,
    "next" => $next,
    "prev" => $prev,
    "pagesTotal" => $pagesTotal
) = $pagination->getPage($page);

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script src="https://cdn.tailwindcss.com?plugins=typography,aspect-ratio"></script>
</head>

<body class="bg-slate-100">
    <div class="container p-8 mx-auto">
        <h1 class="text-slate-600 text-3xl font-bold px-8 pb-4">
            <a href="./index.php">Users</a>
        </h1>

        <?php if (true) { ?>
            <div class='text-red-600 px-8 pb-4'>
                <?php foreach ($_SESSION["errors"] as $error) {
                    echo "<p>{$error}</p>";
                } ?>
            </div>
        <?php } ?>

        <?php include ('paginator.php'); ?>

        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-slate-600 bg-slate-100">
                <tr class="text-base"><?php foreach ($config["tableHeaders"] as $header) {
                    echo "<th scope='col' class='px-6 py-6 border border-slate-300'>{$header}</th>";
                } ?></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $user) {
                    include ('row.php');
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>