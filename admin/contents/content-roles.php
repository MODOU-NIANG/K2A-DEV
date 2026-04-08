<?php
// Connexion à la base de données
$getRoles = $con->query("SELECT * FROM roles");

$update = 0;
$id_role = '';
$role = '';

if (isset($_GET['edit'])) {
  $update = 1;
  $id = $_GET['edit'];
  $titre = "Modifier le rôle";
  $reqEdit = $con->query("SELECT * FROM roles WHERE id='$id'");
  if ($row = mysqli_fetch_array($reqEdit)) {
    $id_role = $row['id'];
    $role = $row['role'];
  }
}

if (isset($_GET['delete'])) {
  $update = 2;
  $id = $_GET['delete'];
  $titre = "Supprimer le rôle";
  $reqEdit = $con->query("SELECT * FROM roles WHERE id='$id'");
  if ($row = mysqli_fetch_array($reqEdit)) {
    $id_role = $row['id'];
    $role = $row['role'];
  }
}

if (isset($_GET['add'])) {
  $update = 3;
  $titre = "Ajouter un rôle";
}
?>

<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">
      <div class="page-header">
        <h1 class="page-title">Rôles</h1>
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Rôle</a></li>
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
                <form action="controllers/roleController.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="role">Rôle</label>
                        <input type="text" class="form-control" name="role" value="<?php echo $role ?? ''; ?>" <?php echo $update == 2 ? 'readonly' : ''; ?> required>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-end">
                    <?php if ($update == 1) { ?>
                      <button type="submit" name="editRole" class="btn btn-warning my-1"><strong>Modifier le rôle</strong></button>
                      <input type="hidden" name="id_role" value="<?php echo $id_role; ?>">
                    <?php } elseif ($update == 2) { ?>
                      <button type="submit" name="deleteRole" class="btn btn-danger my-1"><strong>Supprimer le rôle</strong></button>
                      <input type="hidden" name="id_role" value="<?php echo $id_role; ?>">
                    <?php } elseif ($update == 3) { ?>
                      <button type="submit" name="addRole" class="btn btn-success my-1"><strong>Ajouter un rôle</strong></button>
                    <?php } ?>
                    <button type="button" onclick="window.location.href='roles.php'" class="btn btn-primary my-1">Annuler</button>
                  </div>
                </form>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>

      <div class="row">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header d-flex justify-content-between">
              <h3 class="card-title">Liste des rôles</h3>
              <a class="btn btn-primary" href="?add=1"><strong>Ajouter un rôle</strong></a>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="example2" class="table border text-nowrap text-md-nowrap table-striped mb-0">
                  <thead>
                    <tr>
                      <th>Rôle</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($getRoles)) { ?>
                      <tr>
                        <td><?php echo $row['role']; ?></td>
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