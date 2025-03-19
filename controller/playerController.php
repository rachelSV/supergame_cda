<?php
//LE CONTROLLER pour la class PlayerController

class PlayerController extends AbstractController {
    private ?ViewPlayer $player;

    public function __construct(?ViewHeader $header, ?ViewFooter $footer, ?ViewPlayer $player, ?InterfaceModel $model) {
        parent::__construct($header, $footer, $model);
        $this->player = $player;
    }

    // GETTERS & SETTERS
    public function getView(): ?ViewPlayer {
        return $this->player;
    }
    public function setView(ViewPlayer $player): self {
        $this->player = $player;
        return $this;
    }

    //METHOD
    public function addPlayer(): string {
        //Vérifier que l'on reçoit le formaulire d'inscription
        if (isset($_POST['Inscription'])) {
            //Vérifier que les champs obligatoires sont rempli
            if (empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['score'])) {
                return "Veuillez remplir tous les champs";
            }
            // Vérifier le format de l'email
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                return "Email non valide";
            }
            // Nettoyer les données
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
            $score = intval($_POST['score']);
            //Hasher le mot de passe
            $password = password_hash($password, PASSWORD_DEFAULT);

            // Vérifier si l'email est disponible
            if ($this->getModel()->setEmail($email)->getByEmail()) {
                return "Cet email est déjà utilisé.";
            }

            //Enregistre l'user en BDD
            $this->getModel()->setPseudo($pseudo)->setEmail($email)->setPassword($password)->setScore($score)->add();

            return "Ok";
        }
        return "rien";
    }

    //FONCTION RENDER affichage
    public function render(): void {
        //traitement des données
        $message = $this->addPlayer();

        // Récupérer la liste des joueurs ??? A vérifier !!
        $players = $this->getModel()->getAll();
        $this->player->setPlayersList($players);

        //puis affichage
        echo $this->getHeader()->displayView();
        echo $this->getView()->setSignUpMessage($message)->displayView();
        echo $this->getFooter()->displayView();
    }
    
}
?>
