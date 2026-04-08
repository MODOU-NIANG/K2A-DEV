<?php
require_once 'database.php';

class User {
    private $con;
    private $table = 'utilisateurs';

    public function __construct() {
        $database = new Database();
        $this->con = $database->getConnection();

        // 🔹 Vérifie la connexion avant toute utilisation
        if (!$this->con) {
            die("
                <div style='color: red; font-family: monospace; background: #ffeeee; padding: 10px; border: 1px solid #cc0000;'>
                    ❌ Erreur : impossible d'établir une connexion à la base de données.<br>
                    Vérifie ton fichier <b>database.php</b> (identifiants, mot de passe, ou nom de base).
                </div>
            ");
        }
    }

    // 🔹 Créer un utilisateur
    public function createUser($nom, $prenom, $telephone, $email, $adresse) {
        try {
            $sql = "INSERT INTO {$this->table} (nom, prenom, telephone, email, adresse)
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $this->con->prepare($sql);
            if (!$stmt) {
                throw new Exception("Erreur de préparation : " . $this->con->error);
            }

            $stmt->bind_param("sssss", $nom, $prenom, $telephone, $email, $adresse);

            if ($stmt->execute()) {
                $last_id = $this->con->insert_id;
                $stmt->close();
                return $last_id;
            } else {
                throw new Exception("Erreur lors de l'insertion : " . $stmt->error);
            }
        } catch (Exception $e) {
            echo "
                <div style='color: red; font-family: monospace; background: #ffeeee; padding: 10px; border: 1px solid #cc0000;'>
                    ❌ Une erreur est survenue : {$e->getMessage()}
                </div>
            ";
        }
    }

    // 🔹 Lire tous les utilisateurs
    public function getAllUsers() {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->con->query($sql);

        $users = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        return $users;
    }

    // 🔹 Lire un utilisateur par ID
    public function getUserById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Erreur de préparation : " . $this->con->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $user;
    }

    // 🔹 Supprimer un utilisateur
    public function deleteUser($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->con->prepare($sql);
        if (!$stmt) {
            die("Erreur de préparation : " . $this->con->error);
        }

        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
}
?>
