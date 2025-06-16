<?php

class Enseignant
{

    /**
     * Class qui décrit un enseignant
     */

    private int $numens;
    private string $nomens;
    private string $preens;
    private string $foncens;
    private string $adrens;
    private string $vilens;
    private int $cpens;
    private string $telens;
    private string $datnaiens;
    private string $datembens;
    private $pdo;
    private $fonctions = ["MAITRE DE CONFERENCES", "AGREGE", "CERTIFIE", "VACATAIRE"];

    /**
     * Constructeur d'un enseignants
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
        $this->numens = 0;
        $this->nomens = "";
        $this->preens = "";
        $this->foncens = "";
        $this->adrens = "";
        $this->vilens = "";
        $this->cpens = 0;
        $this->telens = "";
        $this->datnaiens = "";
        $this->datembens = "";

        if (!empty($data)) {
            $this->hydrate($data);
        }

    }

    /**
     * Instancie les valeurs aux attributs de l'enseignant
     *
     * Cette fonction prend en paramètre un tableau de données qui permet
     * d'instancier les attributs de l'enseignants.
     *
     * @param array $data Tableau de données
     */
    public function hydrate($data)
    {
        $this->numens = filter_var($data['numens'], FILTER_VALIDATE_INT);
        $this->nomens = filter_var($data['nomens'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->preens = filter_var($data['preens'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->foncens = filter_var($data['foncens'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->adrens = filter_var($data['adrens'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->vilens = filter_var($data['vilens'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->cpens = filter_var($data['cpens'], FILTER_VALIDATE_INT);
        $this->telens = filter_var($data['telens'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->datnaiens = filter_var($data['datnaiens'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->datembens = filter_var($data['datembens'], FILTER_FLAG_EMPTY_STRING_NULL);
    }

    /**
     * Permet de trouver des enseignants grâce à leurs attributs
     *
     * @param string $pdo Lien vers la base de données
     * @param array $filters Les filtres utilisé pour la recherche
     * @return array|null Un tableau d'enseignants filtrés ou null s'il y a erreur
     */
    public static function find($pdo, $filters = [])
    {
        try {
            $query = "SELECT * FROM enseignants ";
            $conditions = [];
            $parameters = [];

            foreach ($filters as $key => $value) {
                if (in_array($key, ['numens', 'nomens', 'preens', 'foncens', 'adrens', 'vilens', 'cpens', 'telens', 'datnaiens', 'datembens'])) {
                    $conditions[] = "$key = :$key";
                    $parameters[":$key"] = $value;
                }
            }

            if (!empty($conditions)) {
                $query .= " WHERE " . implode(" AND ", $conditions);
            }

            $stmt = $pdo->prepare($query);

            foreach ($parameters as $paramName => $value) {
                $stmt->bindValue($paramName, $value);
            }

            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $list_enseignants = [];

            foreach ($result as $row) {
                $list_enseignants[] = new Enseignant($pdo, $row);
            }

            return $list_enseignants;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return null;
        }
    }

    /**
     * Récupération de tous les enseignants
     *
     * Cette fonction prend en paramètre le lien vers la base de données
     * afin de pouvoir récupérer tous les enseignants
     *
     * @param string $db Lien vers la base de données
     * @return array|null Un tableau d'enseignants ou null s'il y a erreur
     */
    public static function fetchAll($db)
    {
        try {
            $list_enseignants = [];
            $stmt = $db->prepare("SELECT * FROM enseignants;");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $list_enseignants[] = new Enseignant($db, $row);
            }
            return $list_enseignants;


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
            'nomens',
            'preens',
            'foncens',
            'adrens',
            'vilens',
            'cpens',
            'telens',
            'datnaiens',
            'datembens',
        ];

        foreach ($names as $name) {
            if (empty($this->$name)) {
                $errors[] = "Il manque une valeur pour $name.";
            }
        }

        if (!in_array($this->foncens, $this->fonctions)) {
            $errors[] = "La fonction spécifiée n'est pas valide. Fonctions valides : " . implode(", ", $this->fonctions) . ".";
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
     * Création d'un enseignant en base de données
     *
     * @return Enseignant|null L'enseignant créé ou null s'il y a erreur
     */
    public function create()
    {
        try {

//            $query = "INSERT INTO enseignants
//                (nomens, preens, foncens, adrens, vilens, cpens, telens, datnaiens, datembens )
//                VALUES ( :nomens, :preens, :foncens, :adrens, :vilens, :cpens, :telens, :datnaiens, :datembens)";
            $query = "CALL ajout_enseignant(:nomens, :preens, :foncens, :adrens, :vilens, :cpens, :telens, :datnaiens, :datembens)";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':nomens', $this->nomens, PDO::PARAM_STR);
            $stmt->bindParam(':preens', $this->preens, PDO::PARAM_STR);
            $stmt->bindParam(':foncens', $this->foncens, PDO::PARAM_STR);
            $stmt->bindParam(':adrens', $this->adrens, PDO::PARAM_STR);
            $stmt->bindParam(':vilens', $this->vilens, PDO::PARAM_STR);
            $stmt->bindParam(':cpens', $this->cpens, PDO::PARAM_INT);
            $stmt->bindParam(':telens', $this->telens, PDO::PARAM_STR);
            $stmt->bindParam(':datnaiens', $this->datnaiens, PDO::PARAM_STR);
            $stmt->bindParam(':datembens', $this->datembens, PDO::PARAM_STR);

            $stmt->execute();
            return $this;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return null;
        }
    }

    /**
     * Mise à jour d'un enseignant en base de données
     *
     * @return Boolean True si enseignant mis à jour sinon false
     */
    public function update()
    {
        try {

//            $query = "UPDATE enseignants
//            SET numens = :numens, nomens = :nomens, preens = :preens,
//                foncens = :foncens, adrens = :adrens, vilens = :vilens,
//                cpens = :cpens, telens = :telens, datnaiens = :datnaiens,
//                datembens = :datembens
//            WHERE numens = :numens";
            $query = "CALL modif_enseignant(
            :numens, :nomens, :preens, :foncens, :adrens, :vilens, :cpens, :telens, :datnaiens, :datembens
        )";


            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':numens', $this->numens, PDO::PARAM_STR);
            $stmt->bindParam(':nomens', $this->nomens, PDO::PARAM_STR);
            $stmt->bindParam(':preens', $this->preens, PDO::PARAM_STR);
            $stmt->bindParam(':foncens', $this->foncens, PDO::PARAM_STR);
            $stmt->bindParam(':adrens', $this->adrens, PDO::PARAM_STR);
            $stmt->bindParam(':vilens', $this->vilens, PDO::PARAM_STR);
            $stmt->bindParam(':cpens', $this->cpens, PDO::PARAM_STR);
            $stmt->bindParam(':telens', $this->telens, PDO::PARAM_INT);
            $stmt->bindParam(':datnaiens', $this->datnaiens, PDO::PARAM_STR);
            $stmt->bindParam(':datembens', $this->datembens, PDO::PARAM_STR);

            $stmt->execute();

            return true;
        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }


    /**
     * Suppression d'un enseignant en base de données
     *
     * @return Boolean True si enseignant supprimé sinon false
     */
    public function delete()
    {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM enseignants WHERE numens = :numens;");
            $stmt->bindParam(':numens', $this->numens, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Récupération d'un enseignant en particulier
     *
     * Cette fonction prend en paramètre le numéro de l'enseignant recherché
     *
     * @param int $numens Numéro de l'enseignant
     * @return Enseignant enseignant recherché
     */
    public function fetch($numens)
    {
        try {
            if ($numens !== null) {

                $query = "SELECT * FROM enseignants WHERE numens = :numens;";
                $stmt = $this->pdo->prepare($query);
                $stmt->bindParam(':numens', $numens, PDO::PARAM_STR);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $this->hydrate($data);
            }


            return $this;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

}