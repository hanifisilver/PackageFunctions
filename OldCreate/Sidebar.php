<?php include 'SiteMasterHeadCSS.php'; ?>
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Yönetim Paneli</span>
        </a>

        <ul class="sidebar-nav">
    <li class="sidebar-header">
        Sayfalar
    </li>

    <li class="sidebar-item active">
        <a class="sidebar-link" href="index.php">
            <i class="align-middle" data-feather="home"></i> <span class="align-middle">Anasayfa</span>
        </a>
    </li>

    <!-- Teklif Oluştur Dropdown -->
    <li class="sidebar-item">
        <a class="sidebar-link" data-bs-toggle="collapse" href="#offerMenu" role="button" aria-expanded="false" aria-controls="offerMenu">
            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Teklif Oluştur</span>
        </a>
        <ul class="collapse list-unstyled ms-3" id="offerMenu">
            <li class="sidebar-item">
                <a class="sidebar-link" href="PagesOffer.php">Arazöz</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#PagesOffer.php?type=vidanjor">Vidanjör</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#PagesOffer.php?type=kanal">Kanal Açma</a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="#PagesOffer.php?type=kombine">Kombine</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link" href="Offers.php">
            <i class="align-middle" data-feather="send"></i> <span class="align-middle">Gönderilen Teklifler</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link" href="PagesProfile.php">
            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
        </a>
    </li>
</ul>

    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    const currentPage = window.location.pathname.split("/").pop();
    document.querySelectorAll('.sidebar-link').forEach(link => {
        if(link.getAttribute('href') === currentPage){
            link.parentElement.classList.add('active');
        } else {
            link.parentElement.classList.remove('active');
        }
    });
});
</script>