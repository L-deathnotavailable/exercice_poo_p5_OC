<?php 

class Command {
    private $manager;

    public function __construct()
    {
        $this->manager = new ContactManager();
    }

    public function help(): void {
        echo "help : affiche cette aide\n";
        echo "list : liste les contacts\n";
        echo "create [nom], [email], [telephone] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
        echo "quit : quitte le programme\n";
        echo "\n";
        echo "Attention à la syntaxe des commandes, les espaces, virgules et majuscules sont importantes.\n";
    }


    public function detail($id): void {
        $contact = $this->manager->findById($id);
        if (!$contact) {
            echo "Contact non trouvé\n";
            return;
        }
        echo $contact->toString();
    }

    public function list(): void
    {
        $contacts = $this->manager->findAll();
        // Si le tableau de contact est vide, on affiche un message et on arrête l'exécution de la méthode
        if (empty($contacts)) {
            echo "Aucun contact\n";
            return;
        }

        echo "Liste des contacts : \n";
        echo "id, nom, email, telephone\n";
        /** @var Contact  */
        foreach ($contacts as $contact) {
            echo $contact->toString();
        }
    }

    public function create($name, $email, $telephone): void
    {
        $contact = $this->manager->create($name, $email, $telephone);
        echo "Contact créé : " . $contact->toString();
    }

    public function delete($id): void
    {
        $this->manager->delete($id);
        echo "Contact supprimé\n";
    }

}