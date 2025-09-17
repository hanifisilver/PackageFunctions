<script src="js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const themeToggleBtn = document.getElementById("themeToggleBtn");
        const themeIcon = document.getElementById("themeIcon");
        const themeText = document.getElementById("themeText");

        // Kaydedilmiş tema varsa uygula
        let currentTheme = localStorage.getItem("theme") || "light";
        applyTheme(currentTheme);

        themeToggleBtn.addEventListener("click", () => {
            currentTheme = currentTheme === "light" ? "dark" : "light";
            localStorage.setItem("theme", currentTheme);
            applyTheme(currentTheme);
        });

        function applyTheme(theme) {
            const elements = [
                document.body,
                document.querySelector(".navbar"),
                document.querySelector(".sidebar"),
                document.querySelector(".wrapper"),
                document.querySelector(".main"),
                document.querySelector(".footer"),
                ...document.querySelectorAll(".card"),
                ...document.querySelectorAll(".table"),
                ...document.querySelectorAll(".dropdown-menu"),
                ...document.querySelectorAll("a"),
                ...document.querySelectorAll(".nav-link"),
                ...document.querySelectorAll(".dropdown-item")
            ];

            elements.forEach(el => {
                if (el) {
                    el.classList.remove("light-mode", "dark-mode");
                    el.classList.add(theme + "-mode");
                }
            });

            // Navbar içi icon ve yazı
            if (theme === "dark") {
                themeIcon.setAttribute("data-feather", "sun");
                themeText.textContent = "Light";
            } else {
                themeIcon.setAttribute("data-feather", "moon");
                themeText.textContent = "Dark";
            }

            if (window.feather) feather.replace();
        }
    });
</script>


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