<!-- Bootstrap, Chart.js ve Feather Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/feather-icons"></script>

<script src="js/app.js"></script>

<!-- Feather ikonları sayfada değiştir -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (window.feather) feather.replace();
    });
</script>

<!-- Tema toggle güvenli JS -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("themeToggleBtn");
    const moon = toggle.querySelector(".moon");

    // Kaydedilmiş tema
    let currentTheme = localStorage.getItem("theme") || "dark";
    setTheme(currentTheme);

    toggle.addEventListener("click", () => {
        currentTheme = currentTheme === "dark" ? "light" : "dark";
        localStorage.setItem("theme", currentTheme);
        setTheme(currentTheme);
    });

    function setTheme(theme) {
        const elements = [
            document.body,
            document.querySelector(".navbar"),
            document.querySelector(".sidebar"),
            document.querySelector(".wrapper"),
            document.querySelector(".main"),
            document.querySelector(".footer"),
            document.querySelector(".body"),
            ...document.querySelectorAll(".card"),
            ...document.querySelectorAll(".table"),
            ...document.querySelectorAll(".dropdown-menu"),
            ...document.querySelectorAll("a"),
            ...document.querySelectorAll(".nav-link"),
            ...document.querySelectorAll(".dropdown-item")
        ];

        elements.forEach(el => {
            if(el) {
                el.classList.remove("light-mode", "dark-mode");
                el.classList.add(theme + "-mode");
            }
        });

        if(theme === "light") {
            toggle.classList.add("day");
        } else {
            toggle.classList.remove("day");
        }
    }
});

</script>

<!-- Alert kutusu JS -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let alertBox = document.getElementById("customAlert");
        if (alertBox) {
            setTimeout(() => {
                alertBox.classList.add("show");
            }, 100);

            setTimeout(() => {
                alertBox.classList.remove("show");
            }, 5000);

            let closeBtn = document.querySelector(".alert-close");
            if (closeBtn) {
                closeBtn.addEventListener("click", function () {
                    alertBox.classList.remove("show");
                });
            }
        }
    });
</script>