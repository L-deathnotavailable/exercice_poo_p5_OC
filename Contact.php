<?php

class Contact {
    private ?int $id = null;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $phone = null;
    // Ajoutez d'autres attributs selon votre structure de base de données
    public static function fromArray(array $array): Contact
    {
        $contact = new Contact();
        $contact->setId($array['id']);
        $contact->setName($array['name']);
        $contact->setEmail($array['email']);
        $contact->setPhone($array['phone_number']);
        return $contact;
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getEmail(): ?string {
        return $this->email;
    }
    public function getPhone(): ?string {
        return $this->phone;
    }

    // Setters
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setName(?string $name): void {
        $this->name = $name;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function setPhone(?string $phone_number): void {
        $this->phone = $phone_number;
    }

    // Méthode toString pour afficher le contact
    public function toString(): string {
        return "ID: $this->id, Name: $this->name, Email: $this->email, Phone: $this->phone\n";
    }

}

?>
