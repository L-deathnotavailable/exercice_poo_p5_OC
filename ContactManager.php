<?php

require_once 'DBConnect.php';

class ContactManager {
    private $pdo;

    // Constructeur pour initialiser l'instance PDO
    public function __construct() {
        $dbConnect = new DBConnect();
        $this->pdo = $dbConnect->getPDO();
    }

    // Méthode pour récupérer tous les contacts
    public function findAll(): array {
        $contacts = [];

        try {
            // Requête SQL pour récupérer tous les contacts
            $query = $this->pdo->query("SELECT * FROM contact");
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            // Créer des objets Contact pour chaque ligne de résultat
            foreach ($results as $row) {
                $contact = new Contact();
                $contact->setId($row['id']);
                $contact->setName($row['name']);
                $contact->setEmail($row['email']);
                $contact->setPhone($row['phone_number']);
                // Configurer les autres attributs ici

                $contacts[] = $contact;
            }

            // Affichage de debug pour vérifier les objets Contact
            //var_dump($contacts);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des contacts : " . $e->getMessage();
        }

        return $contacts;
    }

    /**
     * Méthode permettant de récupérer un contact par son id
     * @param int $id : l'id du contact à récupérer
     * @return Contact|null : le contact correspondant à l'id, ou null si aucun contact n'est trouvé
     */
    function findById(int $id): ?Contact
    {
        $query = $this->pdo->prepare("SELECT * FROM contact WHERE id = :id");
        $query->execute(["id" => $id]);
        $contact = $query->fetch(PDO::FETCH_ASSOC);
        if (!$contact) {
            return null;
        }
        $contact = Contact::fromArray($contact);
        return $contact;
    }

    /**
     * Méthode permettant de créer un contact dans la base de données
     * @param string $name : le nom du contact
     * @param string $email : l'email du contact
     * @param string $phone_number : le téléphone du contact
     * @return Contact : le contact qui vient d'être créé
     */
    function create(string $name, string $email, string $phone_number): Contact
    {
        $query = $this->pdo->prepare("INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)");
        $query->execute(["name" => $name, "email" => $email, "phone_number" => $phone_number]);
        // Récupération du dernier id inséré. 
        $id = $this->pdo->lastInsertId();
        // On retourne le contact que l'on vient juste de créer
        return $this->findById($id);
    }

    /**
     * Méthode permettant de supprimer un contact de la base de données
     * @param int $id : l'id du contact à supprimer
     */
    function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM contact WHERE id = :id");
        $query->bindParam(":id", $id);
        $query->execute();
    }
}