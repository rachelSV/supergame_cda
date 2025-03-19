<?php
class ViewHeader {
    private ?string $nav = '';

    public function getNav():string{
        return $this->nav;
    }
    public function setNav(string $nav):ViewHeader{
        $this->nav = $nav;
        return $this;
    }

    public function displayView(): string {
        ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Game</title>
</head>
<body>
    <header>
        <h1>Je suis le header de SuperGame</h1>
    </header>
    <main>
        
<?php
        return ob_get_clean();
    }
}