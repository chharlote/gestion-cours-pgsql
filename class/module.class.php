<?php

class Module
{
    /**
     * Class qui décrit un module
     */

    private $pdo;
    private int $nummod;
    private string $nommod;
    private int $coefmod;

    /**
     * Constructeur d'un ensaignants
     *
     * Cette fonction prend en paramètre un lien vers une base de données
     * et un tableau de données. Elle instancie les attributs en null avant
     *
     * @param string $pdo Lien vers la base de données
     * @param array $data Tableau de données
     */
    public function __construct($pdo, $data = [])
    {
        $this->pdo = $pdo;
        $this->nummod = 0;
        $this->nommod = "";
        $this->coefmod = 0;

        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Instancie les valeurs aux attributs du module
     *
     * Cette fonction prend en paramètre un tableau de données qui permet
     * d'instancier les attributs du module.
     *
     * @param array $data Tableau de données
     */
    public function hydrate($data)
    {
        $this->nummod = filter_var($data['nummod'], FILTER_VALIDATE_INT);
        $this->nommod = filter_var($data['nommod'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->coefmod = filter_var($data['coefmod'], FILTER_VALIDATE_INT);
    }

    /**
     * Permet de trouver des modules grâce à leurs attributs
     *
     * @param string $pdo Lien vers la base de données
     * @param array $filters Les filtres utilisé pour la recherche
     * @return array|null Un tableau de modules filtrés ou null s'il y a erreur
     */
    public static function find($pdo, $filters = [])
    {
        try {
            $query = "SELECT * FROM modules";
            $conditions = [];
            $parameters = [];

            foreach ($filters as $key => $value) {
                if (in_array($key, ['nummod', 'nommod', 'coefmod'])) {
                    $conditions[] = "$key = :$key";
                    $parameters[":$key"] = $value;
                }
            }

            if (!empty($conditions)) {
                $query .= " WHERE " . implode(" AND ", $conditions);
            }

            $stmt = $pdo->prepare($query);

            foreach ($parameters as $paramName => $value) {
                $stmt->bindParam($paramName, $value);
            }

            $stmt->execute();
            $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $list_modules = [];

            foreach ($modules as $module) {
                $list_modules[] = new Module($pdo, $module);
            }

            return $list_modules;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Récupération de tous les modules
     *
     * Cette fonction prend en paramètre le lien vers la base de données
     * afin de pouvoir récupérer tous les modules
     *
     * @param string $db Lien vers la base de données
     * @return array|null Un tableau de modules ou null s'il y a erreur
     */
    public static function fetchAll($db)
    {
        try {
            $list_modules = [];
            $stmt = $db->prepare("SELECT * FROM modules;");
            $stmt->execute();
            $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($modules as $module) {
                $list_modules[] = new Module($db, $module);
            }

            return $list_modules;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Valide les données avant de les instancier
     *
     * @@return  boolean true si les données sont valides sinon false si les données sont erronées
     */
    public function validate()
    {
        $names = [
            'nommod',
            'coefmod',
        ];

        foreach ($names as $name) {
            if (empty($this->$name)) {
                $errors[] = "Il manque une valeur pour $name.";
            }
        }

        if (!empty($errors)) {
            $_SESSION['mesgs']['errors'][] = "Erreurs de validation :\n" . implode("\n", $errors);
            return false;
        }


        return true;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    /**
     * Création d'un module en base de données
     *
     * @return Module|null Le module créé ou null s'il y a erreur
     */
    public function create()
    {

//        $query = "INSERT INTO modules (nommod, coefmod) VALUES (:nommod, :coefmod)";
        $query = "CALL ajout_module(:nommod, :coefmod)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':nommod', $this->nommod, PDO::PARAM_STR);
        $stmt->bindParam(':coefmod', $this->coefmod, PDO::PARAM_INT);

        $stmt->execute();
        return $this;

    }


    /**
     * Récupération d'un module en particulier
     *
     * Cette fonction prend en paramètre le numéro du module recherché
     *
     * @param int $nummod Numéro du module
     * @return Module module recherché
     */
    public function fetch($nummod)
    {
        try {

            $stmt = $this->pdo->prepare("SELECT * FROM modules WHERE nummod = :nummod");
            $stmt->bindParam(':nummod', $nummod, PDO::PARAM_INT);


            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->hydrate($data);

            if (!$data) {
                throw new Exception("Aucun module trouvé avec les critères spécifiés.");
            }

            return $this;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Mise à jour d'un module en base de données
     *
     * @return Boolean True si module mis à jour sinon false
     */
    public function update()
    {
        try {
//            $query = "UPDATE modules
//            SET  nommod = :nommod, coefmod = :coefmod
//            WHERE nummod = :nummod";

            $query = "CALL modif_module(:nummod, :nommod, :coefmod)";
            $stmt = $this->pdo->prepare(
                $query
            );
            $stmt->bindParam(':nummod', $this->nummod, PDO::PARAM_INT);
            $stmt->bindParam(':nommod', $this->nommod, PDO::PARAM_STR);
            $stmt->bindParam(':coefmod', $this->coefmod, PDO::PARAM_INT);
            $stmt->execute();


            return true;
        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }


    /**
     * Suppression d'un module en base de données
     *
     * @return Boolean True si module supprimé sinon false
     */
    public function delete()
    {
        try {
            $query = "DELETE FROM modules WHERE nummod = :nummod";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nummod', $this->nummod, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }


}