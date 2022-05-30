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
<body>
    <h1 class="m-8 p-5 flex flex-col align-middle text-center border border-indigo-60 text-zinc-600 p-2 font-bold">ALL SEARCHED CHARACTERS</h1>
    <a href="index.php">
        <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 ml-24 border border-blue-500 hover:border-transparent rounded">
           <-- Back to Search Page
        </button>
    </a>
    <div class="flex flex-row flex-wrap justify-start p-10 m-10">
<?php 
        foreach($characters as $data) {
?>
            <ul class="list-inside m-8 p-5 flex flex-col align-middle text-center border border-indigo-600 bg-indigo-50 hover:bg-slate-300">
                <li class="text-zinc-600 p-2 font-bold">Name: 
                    <span class="font-bold text-blue-600">
                        <?= $data["name"] ?>
                    </span>
                </li>
                <li class="text-zinc-600 p-2 font-bold">Height: 
                    <span class="font-bold text-blue-600">
                        <?= $data["height"] ?>
                    </span>
                </li>
                <li class="text-zinc-600 p-2 font-bold">Birth Year: 
                <span class="font-bold text-blue-600">
                    <?= $data["birth_year"] ?>
                    </span>
                </li>
                <li class="text-zinc-600 p-2 font-bold">Gender: 
                <span class="font-bold text-blue-600">
                    <?= $data["gender"] ?>
                    </span>
                </li>
                <li class="text-zinc-600 p-2 font-bold">Homeworld: 
                    <a href="<?= $data["homeworld"] ?>" class="inline-block" target="blank">
                        <p class="font-bold underline text-blue-600">
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