<?php
include('dataBase.php');

$statement = $pdo->prepare('SELECT * FROM characters_data ORDER BY Id DESC');
$statement->execute();
$characters = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Characters</title>
</head>
<body class="bg-fixed bg-no-repeat bg-cover" style="background-image: url('https://images.unsplash.com/photo-1586861203927-800a5acdcc4d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=80')">
    <h1 class="m-8 p-5 flex flex-col align-middle text-center border border-indigo-60 text-yellow-400  p-2 font-bold">ALL SEARCHED CHARACTERS</h1>
    <a href="index.php">
        <button class="bg-transparent hover:bg-yellow-500 text-yellow-300 font-semibold hover:text-white py-2 px-4 ml-24 border border-yellow-500 hover:border-transparent rounded">
           <-- Back to Search Page
        </button>
    </a>
    <div class="flex flex-row flex-wrap justify-center p-10 m-10">
<?php 
        foreach($characters as $data) {
?>
            <ul class="list-inside m-8 p-5 flex flex-col align-middle text-center border border-indigo-600 bg-indigo-50 hover:bg-slate-300">
                <li class="text-zinc-600 p-2 font-bold">Name: 
                    <span class="font-bold text-yellow-500">
                        <?= $data["name"] ?>
                    </span>
                </li>
                <li class="text-zinc-600 p-2 font-bold">Height: 
                    <span class="font-bold text-yellow-500">
                        <?= $data["height"] ?>
                    </span>
                </li>
                <li class="text-zinc-600 p-2 font-bold">Birth Year: 
                <span class="font-bold text-yellow-500">
                    <?= $data["birth_year"] ?>
                    </span>
                </li>
                <li class="text-zinc-600 p-2 font-bold">Gender: 
                <span class="font-bold text-yellow-500">
                    <?= $data["gender"] ?>
                    </span>
                </li>
                <li class="text-zinc-600 p-2 font-bold">Homeworld: 
                    <a href="<?= $data["homeworld"] ?>" class="inline-block" target="blank">
                        <p class="font-bold underline text-yellow-500">
                            <?= $data["homeworld"] ?> 
                        </p>
                    </a>
                </li>
            </ul>
<?php
        }
?>
    </div>
</body>
</html>