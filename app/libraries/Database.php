<?php
/*
 *
 */
class Database
{

    protected $Root;

    protected function connexion(string $user_name, string $user_password)
    {
        $cnx = new PDO('mysql:host=' . 'localhost' . ';dbname=' . 'ae', $user_name, $user_password);

        $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cnx->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $cnx->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $cnx->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);

        return $cnx;
    }

    /**
     * Used inside Model's constructors
     * Set the empty inherited properties $Selector, $Insertor and $Updator
     * to become PDO connections with MySQL users. Using the connexion() method
     */
    protected function set_db_users(): void
    {
        $this->Root = $this->connexion('root', '');
    }

}
