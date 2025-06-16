<?php

class Matiere
{

    private $pdo;
    private int $nummat;
    private string $nommat;
    private string $coefmat;
    private int $nummod;

    /**
     * Constructeur d'une matière
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
        $this->nummat = 0;
        $this->nommat = "";
        $this->coefmat = 0;
        $this->nummod = 0;

        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Instancie les valeurs aux attributs de la matière
     *
     * Cette fonction prend en paramètre un tableau de données qui permet
     * d'instancier les attributs de la matière.
     *
     * @param array $data Tableau de données
     */
    public function hydrate($data)
    {
        $this->nummat = filter_var($data['nummat'], FILTER_VALIDATE_INT);
        $this->nommat = filter_var($data['nommat'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->coefmat = filter_var($data['coefmat'], FILTER_VALIDATE_INT);
        $this->nummod = filter_var($data['nummod'], FILTER_VALIDATE_INT);
    }

    /**
     * Permet de trouver des matières grâce à leurs attributs
     *
     * @param string $pdo Lien vers la base de données
     * @param array $filters Les filtres utilisé pour la recherche
     * @return array|null Un tableau de matière filtrés ou null s'il y a erreur
     */
    public static function find($pdo, $filters = [])
    {
        try {
            $query = "SELECT * FROM matieres";
            $conditions = [];
            $parameters = [];

            foreach ($filters as $key => $value) {
                if (in_array($key, ['nummat', 'nommat', 'coefmat', 'nummod'])) {
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
            $matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $list_matieres = [];

            foreach ($matieres as $matiere) {
                $list_matieres[] = new Matiere($pdo, $matiere);
            }

            return $list_matieres;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Récupération de toutes les matières
     *
     * Cette fonction prend en paramètre le lien vers la base de données
     * afin de pouvoir récupérer toutes les matières
     *
     * @param string $db Lien vers la base de données
     * @return array|null Un tableau de matière ou null s'il y a erreur
     */
    public static function fetchAll($db)
    {
        try {
            $list_matieres = [];
            $query = "SELECT * FROM matieres";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($matieres as $matiere) {
                $list_matieres[] = new Matiere($db, $matiere);
            }
            return $list_matieres;

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
            'nommat',
            'coefmat',
            'nummod',
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
     * Création d'une matière en base de données
     *
     * @return Matiere|null La matière créée ou null s'il y a erreur
     */
    public function create()
    {
        try {
//            $query = "INSERT INTO matieres (nommat, coefmat, nummod)
//                VALUES (:nommat, :coefmat, :nummod)";

            $query = "CALL ajout_matiere(:nommat, :coefmat, :nummod)";


            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nommat', $this->nommat, PDO::PARAM_STR);
            $stmt->bindParam(':coefmat', $this->coefmat, PDO::PARAM_INT);
            $stmt->bindParam(':nummod', $this->nummod, PDO::PARAM_INT);

            $stmt->execute();
            return $this;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Récupération d'une matière en particulier
     *
     * Cette fonction prend en paramètre le numéro d'une matière recherchée
     *
     * @param int $nummat Numéro de la matière
     * @return Matiere matière recherchée
     */
    public function fetch($nummat)
    {
        try {

            $stmt = $this->pdo->prepare("SELECT * FROM matieres WHERE nummat = :nummat");
            $stmt->bindParam(':nummat', $nummat, PDO::PARAM_INT);


            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->hydrate($data);

            if (!$data) {
                throw new Exception("Aucune matière trouvée avec les critères spécifiés.");
            }

            return $this;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Mise à jour d'une matière en base de données
     *
     * @return Boolean True si matière mise à jour sinon false
     */
    public function update()
    {
        try {
//            $query = "UPDATE matieres
//            SET  nommat = :nommat, coefmat = :coefmat, nummod = :nummod
//            WHERE nummat = :nummat;";

            $query = "CALL modif_matiere(
            :nummat, :nommat, :coefmat, :nummod
        )";

            $stmt = $this->pdo->prepare(
                $query
            );
            $stmt->bindParam(':nummat', $this->nummat, PDO::PARAM_INT);
            $stmt->bindParam(':nommat', $this->nommat, PDO::PARAM_STR);
            $stmt->bindParam(':coefmat', $this->coefmat, PDO::PARAM_INT);
            $stmt->bindParam(':nummod', $this->nummod, PDO::PARAM_INT);
            $stmt->execute();


            return true;
        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Suppression d'une matière en base de données
     *
     * @return Boolean True si matière supprimé sinon false
     */
    public function delete()
    {
        try {
            $query = "DELETE FROM matieres WHERE nummat = :nummat";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nummat', $this->nummat, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

}