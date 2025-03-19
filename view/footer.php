<?php
class ViewFooter{
    public function displayView():string{
        ob_start();
?>

    </main>
    <footer>
        <p>&copy; 2025 - Tous droits réservés</p>
    </footer>
</body>
</html>

<?php
        return ob_get_clean();
    }
}