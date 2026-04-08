<form action=" config/process_ajout_produit.php" method="POST" enctype="multipart/form-data">
    <label>Nom du produit :</label>
    <input type="text" name="nom_produit" required>

    <label>Référence / Code produit :</label>
    <input type="text" name="code_produit" required>

    <label>Catégorie :</label>
    <select name="categorie" required>
        <option value="1">Filtre à huile</option>
        <option value="2">Filtre à air</option>
        <option value="1">Filtre gasoil</option>
        <option value="2">Filtre hydroligue</option>
        <!-- Autres catégories -->
    </select>

    <label>Description détaillée :</label>
    <textarea name="description"></textarea>

    <label>Image :</label>
    <input type="file" name="image">

    <label>Prix :</label>
    <input type="number" name="prix" step="0.01" required>

    <label>Stock disponible :</label>
    <input type="number" name="stock" required>

    <button type="submit">Ajouter le produit</button>
</form>