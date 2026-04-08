<?php
// Connexion à la base de données


$getCategories = $con->query("SELECT * FROM categories");

$update = 0;
$code_cat = '';
$categorie = '';
$description = '';
$couleur = '';

if (isset($_GET['edit'])) {
  $update = 1;
  $id = $_GET['edit'];
  $titre = "Modifier la catégorie";
  $reqEdit = $con->query("SELECT * FROM categories WHERE code_cat='$id'");
  if ($row = mysqli_fetch_array($reqEdit)) {
    $code_cat = $row['code_cat'];
    $categorie = $row['type'];
  //  $description = $row['description'];
  //  $couleur = $row['couleur'];
  }
}

if (isset($_GET['delete'])) {
  $update = 2;
  $id = $_GET['delete'];
  $titre = "Supprimer la catégorie";
  $reqEdit = $con->query("SELECT * FROM categories WHERE code_cat='$id'");
  if ($row = mysqli_fetch_array($reqEdit)) {
    $code_cat = $row['code_cat'];
    $categorie = $row['type'];
    // $description = $row['description'];
    // $couleur = $row['couleur'];
  }
}

if (isset($_GET['add'])) {
  $update = 3;
  $titre = "Ajouter une catégorie";
}
?>

<div class="main-content app-content mt-0">
  <div class="side-app">
    <!-- CONTAINER -->
    <div class="main-container container-fluid">
      <!-- PAGE-HEADER -->
      <div class="page-header">
        <h1 class="page-title">Catégories</h1>
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Catégorie</a></li>
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

          <!-- Error Message -->
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
                <form action="controllers/publicationController.php" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <label for="categorie">Catégorie</label>
                        <input type="text" class="form-control" name="type" value="<?php echo $categorie; ?>" <?php echo $update == 2 ? 'readonly' : ''; ?> required>
                      </div>
                    </div>
                    <!-- <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="5" name="description" <?php // echo $update == 2 ? 'readonly' : ''; ?> required><?php // echo $description; ?></textarea>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <div class="form-group">
                        <label for="couleur">Couleur</label>
                        <input type="color" class="form-control" name="couleur" value="<?php // echo $couleur ?? '#000000'; ?>" <?php // echo $update == 2 ? 'readonly' : ''; ?> required>
                      </div>
                    </div> -->
                  </div>
                  <div class="card-footer text-end">
                    <?php if ($update == 1) { ?>
                      <button type="submit" name="editCategorie" class="btn btn-warning my-1"><strong>Modifier la catégorie</strong></button>
                      <input type="hidden" name="code_cat" value="<?php echo $code_cat; ?>">
                    <?php } elseif ($update == 2) { ?>
                      <button type="submit" name="deleteCategorie" class="btn btn-danger my-1"><strong>Supprimer la catégorie</strong></button>
                      <input type="hidden" name="code_cat" value="<?php echo $code_cat; ?>">
                    <?php } elseif ($update == 3) { ?>
                      <button type="submit" name="addCategorie" class="btn btn-success my-1"><strong>Ajouter une catégorie</strong></button>
                    <?php } ?>
                    <button type="submit" name="cancel" class="btn btn-primary my-1">Annuler</button>
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
              <!-- <h3 class="card-title">Liste des catégories</h3> -->
              <a class="btn btn-primary" href="?add=1"><strong>Ajouter une catégorie</strong></a>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table id="example2" class="table border text-nowrap text-md-nowrap table-striped mb-0">
                  <thead>
                    <tr>
                      <th>Catégorie</th>
                      <!-- <th>Description</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($getCategories)) { ?>
                      <tr>
                        <td ><?php echo $row['type']; ?></td>
                        <!-- <td><?php // echo $row['description']; ?></td> -->
                        <td>
                          <div class="d-flex g-2">
                            <a class="btn text-primary bg-primary-transparent btn-icon py-1 me-2" href="?edit=<?php echo $row['code_cat']; ?>" data-bs-toggle="tooltip" data-bs-original-title="Edit"><span class="bi bi-pencil-square fs-16"></span></a>
                            <a class="btn text-danger bg-danger-transparent btn-icon py-1 me-2" href="?delete=<?php echo $row['code_cat']; ?>" data-bs-toggle="tooltip" data-bs-original-title="Delete"><span class="bi bi-trash fs-16"></span></a>
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