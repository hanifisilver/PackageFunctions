<?php include 'SiteMasterHeadCSS.php'; ?>
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle text-light"><?= $lang->get('AdminPanel') ?></span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header text-light">
                <?= $lang->get('Pages') ?>
            </li>

            <li class="sidebar-item active">
                <a class="sidebar-link" href="index.php">
                    <i class="align-middle" data-feather="home"></i> <span
                        class="align-middle text-light"><?= $lang->get('Homepage') ?></span>
                </a>
            </li>
        </ul>

    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentPage = window.location.pathname.split("/").pop();
        document.querySelectorAll('.sidebar-link').forEach(link => {
            if (link.getAttribute('href') === currentPage) {
                link.parentElement.classList.add('active');
            } else {
                link.parentElement.classList.remove('active');
            }
        });
    });
</script>