<?php
    require_once 'Contact.php';
    require_once 'DBConnect.php';
    require_once 'Command.php';
    require_once 'ContactManager.php';
    // while (true) {
    //     $line = readline("Entrez votre commande : ");
    //     if ($line === "list"){
    //         echo "affichage de la liste\n";
    //     } else {
    //         echo "Vous avez saisi : $line\n";
    //     }
    // }

    // Instantiate the DBConnect class
    $dbConnect = new DBConnect();

    // Get the PDO instance
    $pdo = $dbConnect->getPDO();

    // Test the PDO instance
    //var_dump($pdo);

    // $contactManager = new ContactManager();
    // var_dump("<pre>",$contactManager->findAll());
    //   $contactManager->findOneById(2);

    require_once 'ContactManager.php';
    $manager = new ContactManager();
    $contacts = $manager->findAll();


    $commandClass = new Command();

    while (true) {

        $line = readline("Entrez votre commande (help, list, detail, create, delete, quit) : ");


        if ($line == "help") {
            $commandClass->help();
            continue;
        }


        if ($line == "quit") {
            // On sort de la boucle. Le programme s'arrête
            break;
        }

        if (preg_match("/^detail (.*)$/", $line, $matches)) {
            // Exemple : detail 1
            $commandClass->detail($matches[1]);
            continue;
        }

        if ($line == 'list') {
            $commandClass->list();
            continue;
        }

        if (preg_match("/^create (.*), (.*), (.*)$/", $line, $matches)) {
            // Exemple : create nom, mail@provider.com, 0102030405
            $commandClass->create($matches[1], $matches[2], $matches[3]);
            continue;
        }

        if (preg_match("/^delete (.*)$/", $line, $matches)) {
            // Exemple : delete 1
            $commandClass->delete($matches[1]);
            continue;
        }

        echo "Commande non valide : $line\n";
    }
        

