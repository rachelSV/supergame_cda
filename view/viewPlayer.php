<?php
//LA VIEW POUR LA CLASS ViewPlayer

class ViewPlayer {
    private ?string $signUpMessage = '';
    private ?array $playersList = [];

    /**
     * Get the value of signUpMessage
     *
     * @return ?string
     */
    public function getSignUpMessage(): ?string {
        return $this->signUpMessage;
    }

    /**
     * Set the value of signUpMessage
     *
     * @param ?string $signUpMessage
     *
     * @return self
     */
    public function setSignUpMessage(?string $signUpMessage): self {
        $this->signUpMessage = $signUpMessage;
        return $this;
    }

    /**
     * Get the value of playersList
     *
     * @return ?string
     */
    public function getPlayersList(): ?array {
        return $this->playersList;
    }

    /**
     * Set the value of playersList
     *
     * @param ?string $playersList
     *
     * @return self
     */
    public function setPlayersList(?array $playersList): self {
        $this->playersList = $playersList;
        return $this;
    }

    // METHOD
    public function displayView(): string {
        ob_start();
?>

        <h3>Formulaire d'inscription Joueur</h3>
        <form action="" method="post">
        <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" placeholder="Votre pseudo" >
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Votre email" >
            <label for="password">Mot de passe</label>
            <input type="text" name="password" placeholder="Votre mot de passe" >
            <label for="score">Score</label>
            <input type="text" name="score" placeholder="Votre Score">
            <input type="submit" name="Inscription">
        </form>
<?php
    echo $this->signUpMessage;
?>
        
        <h2>Liste des Joueurs</h2>
        <section>
            <?php foreach ($this->playersList as $player): ?>
                <p>Pseudo : <? ($player['pseudo']); ?></p>
                <p>Score : <? ($player['score']); ?></p>
            <?php endforeach; ?>
        </section>
        
<?php
    echo $this->playersList;
    return ob_get_clean();
    }
}
?>
