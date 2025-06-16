<?php

class Etudiant
{
    /**
     * Class qui décrit un étudiant
     */

    private int $numetu;
    private string $prenometu;
    private string $nometu;
    private string $datnaietu;
    private string $datentetu;
    private int $annetu;
    private string $teletu;
    private string $remetu;
    private string $adretu;
    private int $cpetu;
    private string $viletu;
    private string $sexetu;
    private $pdo;

    private $sexes = ["F", "M"];
    private $annees = [1, 2];


    /**
     * Constructeur d'un etudiant
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
        $this->numetu = 0;
        $this->prenometu = "";
        $this->nometu = "";
        $this->adretu = "";
        $this->viletu = "";
        $this->cpetu = 0;
        $this->teletu = "";
        $this->datentetu = "";
        $this->annetu = 0;
        $this->remetu = "";
        $this->sexetu = "";
        $this->datnaietu = "";

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
        $this->numetu = filter_var($data['numetu'], FILTER_VALIDATE_INT);
        $this->prenometu = filter_var($data['prenometu'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->nometu = filter_var($data['nometu'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->datnaietu = filter_var($data['datnaietu'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->annetu = filter_var($data['annetu'], FILTER_VALIDATE_INT);
        $this->remetu = filter_var($data['remetu'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->sexetu = filter_var($data['sexetu'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->adretu = filter_var($data['adretu'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->cpetu = filter_var($data['cpetu'], FILTER_VALIDATE_INT);
        $this->viletu = filter_var($data['viletu'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->teletu = filter_var($data['teletu'], FILTER_FLAG_EMPTY_STRING_NULL);
        $this->datentetu = filter_var($data['datentetu'], FILTER_FLAG_EMPTY_STRING_NULL);
    }

    /**
     * Permet de trouver des étudiants grâce à leurs attributs
     *
     * @param string $pdo Lien vers la base de données
     * @param array $filters Les filtres utilisés pour la recherche
     * @return array|null Un tableau d'étudiants filtrés ou null s'il y a erreur
     */
    public static function find($db, $filters = [])
    {
        $sql = "SELECT * FROM etudiants";
        $conditions = [];
        $params = [];
        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $conditions[] = "$key = :$key";
                $params[":$key"] = $value;
            }
        }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $list_etudiants = [];
        foreach ($result as $row) {
            $list_etudiants[] = new Etudiant($db, $row);
        }

        return $list_etudiants;
    }

    /**
     * Récupération de tous les étudiants
     *
     * Cette fonction prend en paramètre le lien vers la base de données
     * afin de pouvoir récupérer tous les étudiants
     *
     * @param string $db Lien vers la base de données
     * @return array|null Un tableau d'étudiants ou null s'il y a erreur
     */
    public static function fetchAll($db)
    {

        $list_etudiants = [];
        $stmt = $db->prepare("SELECT * FROM etudiants;");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $list_etudiants[] = new Etudiant($db, $row);
        }
        return $list_etudiants;


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
     * Création d'un étudiant en base de données
     *
     * @return Etudiant|null L'étudiant créé ou null s'il y a erreur
     */
    public function create()
    {
        try {

//            $query = "INSERT INTO etudiants
//                ( prenometu, nometu, datnaietu, datentetu, annetu, teletu, remetu, adretu, cpetu, viletu, sexetu)
//                VALUES ( :prenometu, :nometu, :datnaietu, :datentetu, :annetu, :teletu, :remetu, :adretu, :cpetu, :viletu, :sexetu)";

            $query = "CALL ajout_etudiant(:nometu, :prenometu, :datnaietu, :datentetu, :teletu, :remetu, :adretu, :cpetu, :viletu, :sexetu, :annetu)";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':prenometu', $this->prenometu, PDO::PARAM_STR);
            $stmt->bindParam(':nometu', $this->nometu, PDO::PARAM_STR);
            $stmt->bindParam(':datnaietu', $this->datnaietu, PDO::PARAM_STR);
            $stmt->bindParam(':datentetu', $this->datentetu, PDO::PARAM_STR);
            $stmt->bindParam(':annetu', $this->annetu, PDO::PARAM_INT);
            $stmt->bindParam(':teletu', $this->teletu, PDO::PARAM_STR);
            $stmt->bindParam(':remetu', $this->remetu, PDO::PARAM_STR);
            $stmt->bindParam(':adretu', $this->adretu, PDO::PARAM_STR);
            $stmt->bindParam(':cpetu', $this->cpetu, PDO::PARAM_STR);
            $stmt->bindParam(':viletu', $this->viletu, PDO::PARAM_STR);
            $stmt->bindParam(':sexetu', $this->sexetu, PDO::PARAM_INT);

            $stmt->execute();
            return true;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Suppression d'un étudiant en base de données
     *
     * @return Boolean True si étudiant supprimé sinon false
     */
    public function delete()
    {
        try {

            $query = "DELETE FROM avoir_note WHERE numetu = :numetu";
            $stmtNote = $this->pdo->prepare($query);
            $stmtNote->bindParam(':numetu', $this->numetu, PDO::PARAM_INT);
            $stmtNote->execute();

            $query = "DELETE FROM etudiants WHERE numetu = :numetu";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':numetu', $this->numetu, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Récupération d'un étudiant en particulier
     *
     * Cette fonction prend en paramètre le numéro de l'étudiant recherché
     *
     * @param int $numeti Numéro de l'étudiant
     * @return Etudiant étudiant recherché
     */
    public function fetch($numetu = null)
    {
        try {

            if ($numetu !== null) {
                $stmt = $this->pdo->prepare("SELECT * FROM etudiants WHERE numetu = :numetu");
                $stmt->bindParam(':numetu', $numetu, PDO::PARAM_STR);
            } else {
                throw new Exception("Il n'y a aucun id.");

            }
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                throw new Exception("Aucun étudiant trouvé avec les critères spécifiés.");
            }

            $this->hydrate($data);

            return $this->numetu;

        } catch (Exception $e) {
            $_SESSION['mesgs']['errors'][] = 'ERREUR SQL : ' . $e->getMessage();
            return false;
        }


    }

    /**
     * Mise à jour d'un étudiant en base de données
     *
     * @return Boolean True si étudiant mis à jour sinon false
     */
    public function update()
    {
        try {

//            $query = "UPDATE etudiants
//                  SET numetu = :numetu, prenometu = :prenometu, nometu = :nometu, datnaietu = :datnaietu, datentetu = :datentetu, annetu = :annetu, teletu = :teletu, remetu = :remetu, adretu = :adretu, cpetu = :cpetu, viletu = :viletu, sexetu = :sexetu
//                  WHERE numetu = :numetu";

            $query = "CALL modif_etudiant(
            :numetu, :prenometu, :nometu, :datnaietu, :datentetu, :annetu, :teletu, :remetu, :adretu, :cpetu, :viletu, :sexetu
            )";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':numetu', $this->numetu, PDO::PARAM_INT);
            $stmt->bindParam(':prenometu', $this->prenometu, PDO::PARAM_STR);
            $stmt->bindParam(':nometu', $this->nometu, PDO::PARAM_STR);
            $stmt->bindParam(':datnaietu', $this->datnaietu, PDO::PARAM_STR);
            $stmt->bindParam(':datentetu', $this->datentetu, PDO::PARAM_STR);
            $stmt->bindParam(':annetu', $this->annetu, PDO::PARAM_INT);
            $stmt->bindParam(':teletu', $this->teletu, PDO::PARAM_STR);
            $stmt->bindParam(':remetu', $this->remetu, PDO::PARAM_STR);
            $stmt->bindParam(':adretu', $this->adretu, PDO::PARAM_STR);
            $stmt->bindParam(':cpetu', $this->cpetu, PDO::PARAM_STR);
            $stmt->bindParam(':viletu', $this->viletu, PDO::PARAM_STR);
            $stmt->bindParam(':sexetu', $this->sexetu, PDO::PARAM_INT);
            $stmt->execute();

            return true;
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
            'prenometu',
            'nometu',
            'datnaietu',
            'annetu',
            'sexetu',
            'adretu',
            'cpetu',
            'viletu',
            'teletu',
            'datentetu',
        ];

        foreach ($names as $name) {
            if (empty($this->$name)) {
                $errors[] = "Il manque une valeur pour $name.";
            }
        }

        if (!in_array($this->sexetu, $this->sexes)) {
            $errors[] = "Le sexe spécifié n'est pas valide. Sexes valides : " . implode(", ", $this->sexes) . ".";
        }
        if (!in_array($this->annetu, $this->annees)) {
            $errors[] = "L'année spécifiée n'est pas valide. Années valides : " . implode(", ", $this->annees) . ".";
        }


        if (!empty($errors)) {
            $_SESSION['mesgs']['errors'][] = "Erreurs de validation :\n" . implode("\n", $errors);
            return false;
        }

        return true;
    }
}