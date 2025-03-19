<?php
//MODEL POUR LA CLASS ModelPlayer

class ModelPlayer implements InterfaceModel {
    private ?PDO $bdd;
    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;
    private ?int $score;

    public function __construct() {
        $this->bdd = connect(); 
    }

    //GETTER SETTER
  
    public function getBdd(): ?PDO {
        return $this->bdd;
    }
    public function setBdd(?PDO $bdd): self {
        $this->bdd = $bdd;
        return $this;
    }
    public function getId():?int{
        return $this->id;
    }
    public function setId(?int $id):ModelPlayer{
        $this->id = $id;
        return $this;
    }
    public function getPseudo():?string{
        return $this->pseudo;
    }
    public function setPseudo(?string $pseudo):ModelPlayer{
        $this->pseudo = $pseudo;
        return $this;
    }
    public function getEmail():?string{
        return $this->email;
    }
    public function setEmail(?string $email):ModelPlayer{
        $this->email = $email;
        return $this;
    }
    public function getPassword():?string{
        return $this->password;
    }
    public function setPassword(?string $password):ModelPlayer{
        $this->password = $password;
        return $this;
    }
    public function getScore():?int{
        return $this->score;
    }
    public function setScore(?int $score):ModelPlayer{
        $this->score = $score ?? 0;
        return $this;
    }



    //METHOD
    // Ajouter un joueur en BDD
    public function add(): string {
        try {
            //Préparer la requête
            $req = $this->getBdd()->prepare('INSERT INTO players (pseudo, email, `psswrd`, score) VALUES (?,?,?,?)');

            //Récup des valeurs
            $pseudo = $this->getPseudo();
            $email = $this->getEmail();
            $password = $this->getPassword();
            $score = $this->getScore();
            //Bind Param
            $req->bindParam(1, $pseudo, PDO::PARAM_STR);
            $req->bindParam(2, $email, PDO::PARAM_STR);
            $req->bindParam(3, $password, PDO::PARAM_STR);
            $req->bindParam(4, $score, PDO::PARAM_INT);
            
            $req->execute();
            
            return "Utilisateur ajouté avec succès.";
        } catch (PDOException $e) {
            return "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }
    

    // Récupérer tous les joueurs
    public function getAll(): array {
        try {
            //Préparer la requête
            $req = $this->getBdd()->query("SELECT pseudo, score FROM players ORDER BY score DESC");
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    //Récupère un jour par l'email
    public function getByEmail():array | null {
        try {
            $req = $this->getBdd()->prepare('SELECT id, pseudo, email, psswrd FROM players WHERE email = ?');
    
            $email = $this->getEmail();
            $req->bindParam(1, $email, PDO::PARAM_STR);
            $req->execute();
    
            $user = $req->fetch(PDO::FETCH_ASSOC);
            return $user ?: null;
        } catch (Exception $error) {
            return null;
        }
    }
}
?>
