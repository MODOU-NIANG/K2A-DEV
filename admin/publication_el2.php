<div class="container">
    <h2>Ajouter une Publication</h2>
    <form action="process_publication.php" method="POST">
        <div class="form-group">
            <label for="title">Titre : k2a filtration est unentreprisie  de fabrication de produit automobile</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Contenu :</label>
            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Publier</button>
    </form>
</div>
