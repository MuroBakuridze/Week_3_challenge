<?php 

include('dataBase.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge #3</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-fixed bg-no-repeat bg-cover" style="background-image: url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1172&q=80')">
    <div class="h-48 w-full flex  items-center">
        <form class="h-48 w-full flex justify-center" name="form" action="" method="POST">
            <div class="flex  flex  items-center">
                <div class="flex flex-col">
                    <label class="p-3 block mb-2 text-lg font-medium text-blue-600 font-bold" for="subject">Enter Star Wars Character Name</label>
                    <input class="p-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="subject" id="subject" placeholder="Character Name" required>
                    <input class="cursor-pointer pl-3 mt-5 flex justify-start text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit" value="Request">
                </div>
            </div>
        </form>
    </div>
<?php
    if(isset($_POST['subject'])) {
        $urlIndex =  str_replace(" ", "%20", trim($_POST['subject']));
 
        $statement = $pdo->prepare('SELECT * FROM characters_data WHERE name LIKE ?');
        $statement->execute([
            str_replace("%20", " ", trim("%".$urlIndex."%"))
        ]);
        $name = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(count($name) == 0){
            $curlForRepo = curl_init();
            $repoUrl= "https://swapi.dev/api/people/?search=$urlIndex";

            curl_setopt_array($curlForRepo,[
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $repoUrl,
                CURLOPT_USERAGENT => 'Star Wars API'
            ]);
        
            if($e = curl_error($curlForRepo)){
                echo 'error';
            }else{
                $repoResponse = curl_exec($curlForRepo);
                $repoData = json_decode($repoResponse, true);
            }  
?>
            <div class="container mx-auto">
                <div class="links">
<?php
            if(!isset($repoData) && $repoData["count"] === NULL || $repoData["count"] == '') {
?>
                <p class="text-red-500">
                    Can't find character with Name: 
                    <span class="font-bold text-stone-700">
                        <?= str_replace("%20", " ", $urlIndex) ?>
                    </span>
                </p>
<?php
            }else {
                foreach($repoData as $item){
                    if(is_array($item) || is_object($item)) {
                        foreach ($item as $key => $value) {
?>
                    <div class="grid place-items-center m-10">
                        <ul class="list-inside p-5 w-fit flex flex-col align-middle text-center border border-indigo-600 bg-indigo-50 hover:bg-slate-300">
                            <li class="text-zinc-600 p-2 font-bold">Name: 
                                <span class="font-bold text-blue-600">
                                    <?= $value["name"] ?>
                                </span>
                            </li>
                            <li class="text-zinc-600 p-2 font-bold">Height: 
                                <span class="font-bold text-blue-600">
                                    <?= $value["height"] ?>
                                </span>
                            </li>
                            <li class="text-zinc-600 p-2 font-bold">Birth Year: 
                            <span class="font-bold text-blue-600">
                                <?= $value["birth_year"] ?>
                                </span>
                            </li>
                            <li class="text-zinc-600 p-2 font-bold">Gender: 
                            <span class="font-bold text-blue-600">
                                <?= $value["gender"] ?>
                                </span>
                            </li>
                            <li class="text-zinc-600 p-2 font-bold">Homeworld: 
                                <a href="<?= $value["homeworld"] ?>" class="inline-block" target="blank">
                                    <p class="font-bold underline text-blue-600">
                                        <?= $value["homeworld"] ?> 
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>                   
<?php
                            $statement = $pdo->prepare("INSERT INTO characters_data (name, height, birth_year, gender, homeworld)
                                            VALUES (:name, :height, :birth_year, :gender, :homeworld)");
                            $statement->bindValue(':name', $value["name"]);
                            $statement->bindValue(':height', $value["height"]);
                            $statement->bindValue(':birth_year', $value["birth_year"]);
                            $statement->bindValue(':gender', $value["gender"]);
                            $statement->bindValue(':homeworld', $value["homeworld"]);

                            $statement->execute();
                        }
                    }
                }
                curl_close($curlForRepo);
            }
        }else {
            foreach($name as $data) {
?>
                <div class="grid place-items-center m-10">
                    <ul class="list-inside p-5 w-fit flex flex-col align-middle text-center border border-indigo-600 bg-indigo-50 hover:bg-slate-300">
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
                </div>
<?php
            }
        } 
    }
?>
                </div>
            </div>
            <div class="grid place-items-center m-10">
                <a href="characters.php">
                    <button class="cursor-pointer pl-3 mt-5 flex justify-start text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Check ALL Searched Characters</button>
                </a>
            </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
