<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    /* --- Sidebar Styling --- */
    .app-sidebar {
        background: #fff;
        color: #333;
        width: 240px;
        min-height: 100vh;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        position: fixed;
        left: 0;
        top: 0;
        transition: all 0.3s ease;
    }
    .side-header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        text-align: center;
    }
    .side-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .side-menu li {
        margin: 2px 0;
    }
    .side-menu__item {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        color: #333;
        font-size: 15px;
        font-weight: 500;
        text-decoration: none;
        transition: background 0.3s ease, color 0.3s;
        border-radius: 6px;
        margin: 3px 10px;
    }
    .side-menu__item:hover {
        background: #f3f6f9;
        color: #007bff;
    }
    .side-menu__icon {
        margin-right: 12px;
        font-size: 18px;
        color: #666;
    }
    .side-menu__item:hover .side-menu__icon {
        color: #007bff;
    }
    .side-menu__label {
        flex-grow: 1;
    }
    .slide-menu {
        list-style: none;
        padding-left: 25px;
        display: none;
    }
    .slide-menu li a {
        font-size: 14px;
        padding: 8px 15px;
        display: flex;
        align-items: center;
        color: #555;
        transition: 0.3s;
        border-radius: 4px;
    }
    .slide-menu li a:hover {
        color: #007bff;
        background: #f8f9fa;
    }
    .angle {
        transition: transform 0.3s;
        color: #888;
    }
    .slide.open .angle {
        transform: rotate(90deg);
    }
    .slide.open .slide-menu {
        display: block;
    }
</style>

<div class="app-sidebar">
    <div class="side-header">
        <a href="index.php">
            <img src="assets/images/brand/finlex_logodark.png" alt="logo" style="max-width:150px;">
        </a>
    </div>
    <ul class="side-menu">

        <!-- Accueil -->
        <li class="slide">
            <a href="index.php" class="side-menu__item">
                <i class="fa-solid fa-house side-menu__icon"></i>
                <span class="side-menu__label">Accueil</span>
            </a>
        </li>

        <!-- Produits -->
        <li class="slide">
            <a href="javascript:void(0)" class="side-menu__item" onclick="toggleMenu(this)">
                <i class="fa-solid fa-box side-menu__icon"></i>
                <span class="side-menu__label">Produits</span>
                <i class="fa-solid fa-chevron-right angle"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="liste_produits.php"><i class="fa fa-list"></i>&nbsp; Liste des produits</a></li>
                <li><a href="ajout_produit.php"><i class="fa fa-plus-circle"></i>&nbsp; Ajouter produit</a></li>
            </ul>
        </li>

        <!-- Catégories -->
        <li class="slide">
            <a href="javascript:void(0)" class="side-menu__item" onclick="toggleMenu(this)">
                <i class="fa-solid fa-layer-group side-menu__icon"></i>
                <span class="side-menu__label">Catégories</span>
                <i class="fa-solid fa-chevron-right angle"></i>
            </a>
            <ul class="slide-menu">
                <li><a href="categories.php"><i class="fa fa-tags"></i>&nbsp; Gérer les catégories</a></li>
            </ul>
        </li>

        <!-- Commandes -->
        <!-- <li class="slide">
            <a href="commandes.php" class="side-menu__item">
                <i class="fa-solid fa-shopping-cart side-menu__icon"></i>
                <span class="side-menu__label">Commandes</span>
            </a>
        </li> -->

        <!-- Utilisateurs -->
        <li class="slide">
            <a href="utilisateurs.php" class="side-menu__item">
                <i class="fa-solid fa-users side-menu__icon"></i>
                <span class="side-menu__label">Utilisateurs</span>
            </a>
        </li>

    </ul>
</div>

<script>
    function toggleMenu(el) {
        let parent = el.parentElement;
        parent.classList.toggle("open");
    }
</script>
