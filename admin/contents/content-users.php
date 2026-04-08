<?php
// Connexion à la base de données
$reqUsers = $con->query("SELECT users.*, roles.role FROM users JOIN roles ON users.role_id = roles.id");

$update = 0;
$id_users = '';
$prenom = '';
$nom = '';
$email = '';
$role_id = '';
$pwd1 = '';
$pwd2 = '';

if (isset($_GET['edit'])) {
    $update = 1;
    $id = $_GET['edit'];
    $titre = "Modifier l'utilisateur";
    $reqEdit = $con->query("SELECT * FROM users WHERE id='$id'");
    if ($row = mysqli_fetch_array($reqEdit)) {
        $id_users = $row['id'];
        $prenom = $row['prenom'];
        $nom = $row['nom'];
        $email = $row['email'];
        $role_id = $row['role_id'];
    }
}

if (isset($_GET['delete'])) {
    $update = 2;
    $id = $_GET['delete'];
    $titre = "Supprimer l'utilisateur";
    $reqEdit = $con->query("SELECT * FROM users WHERE id='$id'");
    if ($row = mysqli_fetch_array($reqEdit)) {
        $id_users = $row['id'];
        $prenom = $row['prenom'];
        $nom = $row['nom'];
        $email = $row['email'];
        $role_id = $row['role_id'];
    }
}

if (isset($_GET['add'])) {
    $update = 3;
    $titre = "Ajouter un utilisateur";
}


?>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">Utilisateurs</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Utilisateurs</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="container-fluid">
                    <?php if (isset($_SESSION['message']) && $_SESSION['successMsg']) { ?>
                        <div class="alert alert-success">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>
                    <?php } ?>

                    <?php if (isset($_SESSION['message']) && $_SESSION['errorMsg']) { ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>
                    <?php } ?>
                    <?php if ($update != 0) { ?>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php echo $titre; ?></h3>
                            </div>
                            <div class="card-body">
                                <form action="controllers/userController.php" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="prenom">Prénom</label>
                                                <input type="text" class="form-control" name="prenom" value="<?php echo $prenom ?? ''; ?>" <?php echo $update == 2 ? 'readonly' : ''; ?> required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nom">Nom</label>
                                                <input type="text" class="form-control" name="nom" value="<?php echo $nom ?? ''; ?>" <?php echo $update == 2 ? 'readonly' : ''; ?> required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email" value="<?php echo $email ?? ''; ?>" <?php echo $update == 2 ? 'readonly' : ''; ?> required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="role_id">Rôle</label>
                                                <select class="form-control" name="role_id" <?php echo $update == 2 ? 'disabled' : ''; ?> required>
                                                    <?php
                                                    $reqRoles = $con->query("SELECT * FROM roles");
                                                    while ($role = mysqli_fetch_array($reqRoles)) {
                                                        echo "<option value='{$role['id']}'" . (($role['id'] == $role_id) ? " selected" : "") . ">{$role['role']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if ($update == 1 || $update == 3) { ?>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="pwd1">Mot de passe</label>
                                                    <input type="password" class="form-control" name="pwd1" <?php echo $update == 3 ? 'required' : '' ?>>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="pwd2">Confirmer le mot de passe</label>
                                                    <input type="password" class="form-control" name="pwd2" <?php echo $update == 3 ? 'required' : '' ?>>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="card-footer text-end">
                                        <?php if ($update == 1) { ?>
                                            <button type="submit" name="editCompte" class="btn btn-warning my-1"><strong>Modifier l'utilisateur</strong></button>
                                            <input type="hidden" name="id_users" value="<?php echo $id_users; ?>">
                                        <?php } elseif ($update == 2) { ?>
                                            <button type="submit" name="deleteCompte" class="btn btn-danger my-1"><strong>Supprimer l'utilisateur</strong></button>
                                            <input type="hidden" name="id_users" value="<?php echo $id_users; ?>">
                                        <?php } elseif ($update == 3) { ?>
                                            <button type="submit" name="addCompte" class="btn btn-success my-1"><strong>Ajouter un utilisateur</strong></button>
                                        <?php } ?>
                                        <button type="submit" name="cancel" class="btn btn-primary my-1">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Liste des utilisateurs</h3>
                            <a class="btn btn-primary" href="?add=1"><strong>Ajouter un utilisateur</strong></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table border text-nowrap text-md-nowrap table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Prénom(s)</th>
                                            <th>Nom</th>
                                            <th>Email</th>
                                            <th>Rôle</th>
                                            <th>Statut</th>
                                            <th>Date de création</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($reqUsers)) { ?>
                                            <tr>
                                                <td><?php echo $row['prenom']; ?></td>
                                                <td><?php echo $row['nom']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['role']; ?></td>
                                                <td>
                                                    <?php if ($row['statut'] == 1) { ?>
                                                        <?php if ($row['role'] == 'administrateur') { ?>
                                                            <a href="controllers/publicationController?toggleStatus=<?php echo $row['id']; ?>" style="color:#1C9E74;"><i class="fa fa-toggle-on" style="font-size:30px;"></i></a>
                                                        <?php } else { ?>
                                                            <i class="fa fa-toggle-on" style="font-size:30px;color:#1C9E74;"></i>
                                                        <?php } ?>
                                                    <?php } else { ?>
                                                        <?php if ($row['role'] == 'administrateur') { ?>
                                                            <a href="controllers/publicationController?toggleStatus=<?php echo $row['id']; ?>" style="color:#cccccc;"><i class="fa fa-toggle-off" style="font-size:30px;"></i></a>
                                                        <?php } else { ?>
                                                            <i class="fa fa-toggle-off" style="font-size:30px;color:#cccccc;"></i>
                                                    <?php }
                                                    } ?>
                                                </td>
                                                <td><?php echo $row['date_c']; ?></td>
                                                <td>
                                                    <div class="d-flex g-2">
                                                        <a class="btn text-primary bg-primary-transparent btn-icon py-1 me-2" href="?edit=<?php echo $row['id']; ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="bi bi-pencil-square fs-16"></span></a>
                                                        <a class="btn text-danger bg-danger-transparent btn-icon py-1 me-2" href="?delete=<?php echo $row['id']; ?>" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="bi bi-trash fs-16"></span></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>