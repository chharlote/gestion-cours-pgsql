<?php

class Epreuve
{

    private $pdo;
    private int $numepr;
    private string $libepr;
    private int $ensepr;
    private int $matepr;
    private string $datepr;
    private int $coefepr;
    private int $annepr;

    /**
     * Constructeur d'une epreuves
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
        $this->numepr = 0;
        $this->libepr = "";
        $this->ensepr = 0;
        $this->matepr = 0;
        $this->datepr = "";
        $this->coefepr = 0;
        $this->annepr = 0;


        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Instancie les valeurs aux attributs de l'épreuve
     *
     * Cette fonction prend en paramètre un tableau de données qui permet
     * d'instancier les attributs de l'épruve.
     *
     * @param array $data Tableau de données
     */
    public function hydrate($data)
    {
        $this->numepr = filter_var($data['numepr'], FILTER_VALIDATE_INT);
        $this->libepr = filter_var($data['libepr'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->ensepr = filter_var($data['ensepr'], FILTER_VALIDATE_INT);
        $this->matepr = filter_var($data['matepr'], FILTER_VALIDATE_INT);
        $this->datepr = filter_var($data['datepr'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->coefepr = filter_var($data['coefepr'], FILTER_VALIDATE_INT);
        $this->annepr = filter_var($data['annepr'], FILTER_VALIDATE_INT);
    }

    /**
     * Permet de trouver des épreuves grâce à leurs attributs
     *
     * @param string $pdo Lien vers la base de données
     * @param array $filters Les filtres utilisé pour la recherche
     * @return array|null Un tableau d'épreuves filtrées ou null s'il y a erreur
     */
    public static function find($pdo, $filters = [])
    {
        try {
            $query = "SELECT * FROM epreuves";
            $conditions = [];
            $parameters = [];

            foreach ($filters as $key => $value) {
                if (in_array($key, ['numepr', 'libepr', 'ensepr', 'matepr', 'datepr', 'coerfpr', 'annepr'])) {
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
            $epreuves = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $list_epreuves = [];

            foreach ($epreuves as $epreuve) {
                $list_epreuves[] = new Epreuve($pdo, $epreuve);
            }

            return $list_epreuves;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return null;
        }
    }

    /**
     * Récupération de toutes les épreuves
     *
     * Cette fonction prend en paramètre le lien vers la base de données
     * afin de pouvoir récupérer toutes les épreuves
     *
     * @param string $db Lien vers la base de données
     * @return array|null Un tableau d'épreuve ou null s'il y a erreur
     */
    public static function fetchAll($db)
    {
        try {
            $query = "SELECT * FROM epreuves;";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $epreuves = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!$epreuves) {
                throw new Exception("Aucune épreuve trouvée !");
            }
            $list_epreuves = [];
            foreach ($epreuves as $epreuve) {
                $list_epreuves[] = new Epreuve($db, $epreuve);
            }
            return $list_epreuves;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return null;
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
            'libepr',
            'ensepr',
            'matepr',
            'datepr',
            'coefepr',
            'annepr'
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
     * Création d'une épreuve en base de données
     *
     * @return Epreuve|null L'épreuve créée ou null s'il y a erreur
     */
    public function create()
    {
        try {
//            $query = "INSERT INTO epreuves (libepr, ensepr, matepr, datepr, coefepr, annepr)
//                VALUES (:libepr, :ensepr, :matepr, :datepr, :coefepr, :annepr)";

            $query = "CALL ajout_epreuves(:libepr, :ensepr, :matepr, :datepr, :coefepr, :annepr)";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':libepr', $this->libepr, PDO::PARAM_STR);
            $stmt->bindParam(':ensepr', $this->ensepr, PDO::PARAM_INT);
            $stmt->bindParam(':matepr', $this->matepr, PDO::PARAM_INT);
            $stmt->bindParam(':datepr', $this->datepr, PDO::PARAM_STR);
            $stmt->bindParam(':coefepr', $this->coefepr, PDO::PARAM_INT);
            $stmt->bindParam(':annepr', $this->annepr, PDO::PARAM_INT);

            $stmt->execute();
            return $this;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return null;
        }
    }

    /**
     * Récupération d'une 2PREUVE en particulier
     *
     * Cette fonction prend en paramètre le numéro de l'épreuve recherchée
     *
     * @param int $numepr Numéro de l'épreuve
     * @return Epreuve|null épreuve recherchée sinon null
     */
    public function fetch(int $numepr): ?Epreuve
    {
        try {

            $stmt = $this->pdo->prepare("SELECT * FROM epreuves WHERE numepr = :numepr;");
            $stmt->bindParam(':numepr', $numepr, PDO::PARAM_INT);

            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->hydrate($data);

            return $this;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return null;
        }
    }

    /**
     * Mise à jour d'une épreuve en base de données
     *
     * @return Boolean True si épreuve mise à jour sinon false
     */
    public function update()
    {
        try {
//            $query = "UPDATE epreuves
//            SET  libepr = :libepr, ensepr = :ensepr, matepr = :matepr, datepr = :datepr, coefepr = :coefepr, annepr = :annepr
//            WHERE numepr = :numepr;";

            $query = "CALL modif_epreuve(
            :numepr, :libepr, :ensepr, :matepr, :datepr, :coefepr, :annepr
        )";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':numepr', $this->numepr, PDO::PARAM_INT);
            $stmt->bindParam(':libepr', $this->libepr, PDO::PARAM_STR);
            $stmt->bindParam(':ensepr', $this->ensepr, PDO::PARAM_INT);
            $stmt->bindParam(':matepr', $this->matepr, PDO::PARAM_INT);
            $stmt->bindParam(':datepr', $this->datepr, PDO::PARAM_STR);
            $stmt->bindParam(':coefepr', $this->coefepr, PDO::PARAM_INT);
            $stmt->bindParam(':annepr', $this->annepr, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Suppression d'une épreuve en base de données
     *
     * @return Boolean True si épreuve supprimé sinon false
     */
    public function delete()
    {
        try {
            $query = "DELETE FROM epreuves WHERE numepr = :numepr";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':numepr', $this->numepr, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

}