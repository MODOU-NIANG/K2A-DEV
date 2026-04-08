<?php
// Connexion à la base de données
$getDocuments = $con->query("SELECT * FROM documentheques");
$getTypes = $con->query("SELECT * FROM types");

$update = 0;
$id_document = '';
$titre = '';
$description = '';
$lien = '';
$code_type = '';

if (isset($_GET['edit'])) {
  $update = 1;
  $id = $_GET['edit'];
  $titre_form = "Modifier le document";
  $reqEdit = $con->query("SELECT * FROM documentheques WHERE id='$id'");
  if ($row = mysqli_fetch_array($reqEdit)) {
    $id_document = $row['id'];
    $code_type = $row['code_type'];
    $titre = $row['titre'];
    $description = $row['description'];
    $lien = $row['lien'];
  }
}

if (isset($_GET['delete'])) {
  $update = 2;
  $id = $_GET['delete'];
  $titre_form = "Supprimer le document";
  $reqEdit = $con->query("SELECT * FROM documentheques WHERE id='$id'");
  if ($row = mysqli_fetch_array($reqEdit)) {
    $id_document = $row['id'];
    $code_type = $row['code_type'];
    $titre = $row['titre'];
    $description = $row['description'];
    $lien = $row['lien'];
  }
}

if (isset($_GET['add'])) {
  $update = 3;
  $titre_form = "Ajouter un document";
}
?>

<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">
      <div class="page-header">
        <h1 class="page-title">Documents</h1>
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Document</a></li>
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
                <h3 class="card-title"><?php echo $titre_form; ?></h3>
              </div>
              <div class="card-body">
                <form action="controllers/documenthequeController" method="POSt" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" class="form-control" name="titre" value="<?php echo $titre ?? ''; ?>" <?php echo $update == 2 ? 'readonly' : ''; ?> required>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="5" name="description" <?php echo $update == 2 ? 'readonly' : ''; ?>><?php echo $description; ?></textarea>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="lien">Lien</label>
                        <input type="file" class="form-control" name="lien" <?php echo $update == 2 ? 'readonly' : ''; ?>>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="code_type">Code Type</label>
                        <select class="form-control" name="code_type" <?php echo $update == 2 ? 'readonly' : ''; ?>>
                          <?php while ($type = mysqli_fetch_array($getTypes)) { ?>
                            <option value="<?php echo $type['code_type']; ?>" <?php echo ($code_type == $type['code_type']) ? 'selected' : ''; ?>><?php echo $type['titre']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-end">
                    <?php if ($update == 1) { ?>
                      <button type="submit" name="editDocument" class="btn btn-warning my-1"><strong>Modifier le document</strong></button>
                      <input type="hidden" name="id_document" value="<?php echo $id_document; ?>">
                    <?php } elseif ($update == 2) { ?>
                      <button type="submit" name="deleteDocument" class="btn btn-danger my-1"><strong>Supprimer le document</strong></button>
                      <input type="hidden" name="id_document" value="<?php echo $id_document; ?>">
                    <?php } elseif ($update == 3) { ?>
                      <button type="submit" name="addDocument" class="btn btn-success my-1"><strong>Ajouter un document</strong></button>
                    <?php } ?>
                    <button type="button" onclick="window.location.href='documents'" class="btn btn-primary my-1">Annuler</button>
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
              <h3 class="card-title">Liste des documents</h3>
              <a class="btn btn-primary" href="?add=1"><strong>Ajouter un document</strong></a>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="example2" class="table border text-nowrap text-md-nowrap table-striped mb-0">
                  <thead>
                    <tr>
                      <th>Code Type</th>
                      <th>Titre</th>
                      <th>Description</th>
                      <th>Lien</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($getDocuments)) { ?>
                      <tr>
                        <td><?php echo $row['code_type']; ?></td>
                        <td><?php echo $row['titre']; ?></td>
                        <td><?php echo substr($row['description'], 0, 100) ? substr($row['description'], 0, 100) . "..." : '' ?></td>
                        <td><a href="<?php echo $row['lien']; ?>" target="_blank">Document</a></td>
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