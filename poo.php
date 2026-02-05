<?php 

// POO en PHP : Programmation Orientée Objet
// Les classes comportent des attributs et des méthodes -> en fait des variables et des fonctions +
// Dans l'exemple de User on regroupe au sein de cette classe tous les attributs et fonctoins liées au user

// Les classes permettenty de générer des objets 

// Le nom des classes doit etre en PascalCase (à ne pas confondre avec le camelCase)

class User {
    // Attributs ou propriétés cad des variables associées au User

    // Ici le private est la portée de notre prorpriété. Ces propriétés peuvent etre : 
    // public, protected ou private
    public $name = "Patrick";
    public $age = 23;
    public $email;


    // Méthodes qui sont en fait des fonctions liées au User
    public function sayHello() {
        return "Bonjour $this->name tu as $this->age ans";
    }

}

class SuperUser extends User {
    public $avatar;
}


// Pour générer un objet on doit "instancier" notre classe
// Ici je génère un objet "$patrick" à partir de la classe User avec le mot clé new
$patrick = new User;

echo $patrick->name; // Censé m'afficher "Patrick"
echo $patrick->sayHello(); // Affiche "Bonjour"

