
<script src="js/app.js"></script>

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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const CurrencySelect = document.getElementById("Currency");
        const RateArea = document.getElementById("RateArea");
        const ExchangeRateInput = document.getElementById("ExchangeRate");

        let secilenKur = 1;

        // API'den kur getir
        async function kurGetir(Currency) {
            if (Currency === "TRY") return 1;

            try {
                let apiUrl = "https://open.er-api.com/v6/latest/" + Currency;
                let response = await fetch(apiUrl);
                let data = await response.json();
                return data.rates.TRY; // TRY karşılığını döndür
            } catch (e) {
                console.error("Kur alınamadı", e);
                return 1;
            }
        }

        function formatNumber(num) {
            return num.toLocaleString("tr-TR", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function parseNumber(val) {
            if (!val) return 0;
            return parseFloat(val.replace(/\./g, "").replace(",", "."));
        }

        function hesapla() {
            // Önce CurrencySelect ve secilenKur kontrolü
            if (!CurrencySelect) return;

            const Currency = CurrencySelect.value;
            const kur = secilenKur || 1;

            let genelAraToplam = 0;
            let genelKdv = 0;
            let genelToplam = 0;
            let genelTry = 0;

            // Ürün satırlarını dön
            document.querySelectorAll(".urun-satiri").forEach(satir => {
                if (!satir) return;

                const adetInput = satir.querySelector(".adet");
                const fiyatInput = satir.querySelector(".birimFiyat");
                const araToplamInput = satir.querySelector(".araToplam");
                const kdvInput = satir.querySelector(".kdv");
                const tryValueSpan = satir.querySelector(".tryValue");
                const tryKarsilikDiv = satir.querySelector(".tryKarsilik");

                if (!adetInput || !fiyatInput) return;

                const adet = parseFloat(adetInput.value) || 0;
                const fiyat = parseNumber(fiyatInput.value) || 0;

                const araToplam = adet * fiyat;
                const kdv = araToplam * 0.20;
                const toplam = araToplam + kdv;

                if (araToplamInput) araToplamInput.value = formatNumber(araToplam) + " " + Currency;
                if (kdvInput) kdvInput.value = formatNumber(kdv) + " " + Currency;
                if (tryValueSpan) tryValueSpan.textContent = formatNumber(toplam * kur) + " ₺";
                if (tryKarsilikDiv) tryKarsilikDiv.style.display = (Currency === "TRY") ? "none" : "block";

                genelAraToplam += araToplam;
                genelKdv += kdv;
                genelToplam += toplam;
                genelTry += toplam * kur;
            });

            // Genel alanları güncelle
            const genelAraToplamInput = document.getElementById("genelAraToplam");
            const genelKdvInput = document.getElementById("genelKdv");
            const genelToplamInput = document.getElementById("genelToplam");
            const genelTryValueSpan = document.getElementById("genelTryValue");
            const tryKarsilikGenelDiv = document.querySelector(".tryKarsilikGenel");

            if (genelAraToplamInput) genelAraToplamInput.value = formatNumber(genelAraToplam) + " " + Currency;
            if (genelKdvInput) genelKdvInput.value = formatNumber(genelKdv) + " " + Currency;
            if (genelToplamInput) genelToplamInput.value = formatNumber(genelToplam) + " " + Currency;
            if (genelTryValueSpan) genelTryValueSpan.textContent = formatNumber(genelTry) + " ₺";
            if (tryKarsilikGenelDiv) tryKarsilikGenelDiv.style.display = (Currency === "TRY") ? "none" : "block";
        }

        // Birim fiyat inputları
        document.querySelectorAll(".birimFiyat").forEach(el => {
            el.addEventListener("focus", function (e) {
                let val = parseNumber(e.target.value);
                if (!isNaN(val) && val > 0) {
                    e.target.value = val.toString().replace(".", ",");
                } else {
                    e.target.value = "";
                }
            });

            el.addEventListener("blur", function (e) {
                let val = parseNumber(e.target.value);
                if (!isNaN(val)) {
                    e.target.value = formatNumber(val);
                } else {
                    e.target.value = "";
                }
                hesapla();
            });

            el.addEventListener("input", hesapla);
        });

        // Adet değişince hesapla
        document.querySelectorAll(".adet").forEach(el => {
            el.addEventListener("input", hesapla);
        });
        // Para birimi değişince API'den kur getir
        if (CurrencySelect) {
            CurrencySelect.addEventListener("change", async function () {
                const Currency = CurrencySelect.value;

                if (Currency === "TRY") {
                    RateArea.style.display = "none";
                    secilenKur = 1;
                } else {
                    RateArea.style.display = "block";
                    secilenKur = await kurGetir(Currency);
                    ExchangeRateInput.value = new Intl.NumberFormat("tr-TR", {
                        minimumFractionDigits: 4,
                        maximumFractionDigits: 4
                    }).format(secilenKur);
                }

                hesapla();
            });
        }

        // disabled yapıyoruz, kullanıcı değiştiremeyecek
        if (ExchangeRateInput) {
            ExchangeRateInput.setAttribute("disabled", true);
        }

        // İlk çalıştırma (TRY default)
        if (RateArea) {
            RateArea.style.display = "none";
            ExchangeRateInput.value = "";
            hesapla();
        }
    });
</script>


<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
        gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
        // Line chart
        new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: "line",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Sales ($)",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: window.theme.primary,
                    data: [
                        2115,
                        1562,
                        1584,
                        1892,
                        1587,
                        1923,
                        2566,
                        2448,
                        2805,
                        3438,
                        2917,
                        3327
                    ]
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    intersect: false
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 1000
                        },
                        display: true,
                        borderDash: [3, 3],
                        gridLines: {
                            color: "rgba(0,0,0,0.0)"
                        }
                    }]
                }
            }
        });
    });
</script> -->
<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: ["Chrome", "Firefox", "IE"],
                datasets: [{
                    data: [4306, 3801, 1689],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.warning,
                        window.theme.danger
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });
    });
</script> -->
<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "This year",
                    backgroundColor: window.theme.primary,
                    borderColor: window.theme.primary,
                    hoverBackgroundColor: window.theme.primary,
                    hoverBorderColor: window.theme.primary,
                    data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                    barPercentage: .75,
                    categoryPercentage: .5
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        stacked: false,
                        ticks: {
                            stepSize: 20
                        }
                    }],
                    xAxes: [{
                        stacked: false,
                        gridLines: {
                            color: "transparent"
                        }
                    }]
                }
            }
        });
    });
</script> -->
<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        var markers = [{
            coords: [31.230391, 121.473701],
            name: "Shanghai"
        },
        {
            coords: [28.704060, 77.102493],
            name: "Delhi"
        },
        {
            coords: [6.524379, 3.379206],
            name: "Lagos"
        },
        {
            coords: [39.524379, 35.379206],
            name: "Turkey"
        },
        {
            coords: [35.689487, 139.691711],
            name: "Tokyo"
        },
        {
            coords: [23.129110, 113.264381],
            name: "Guangzhou"
        },
        {
            coords: [40.7127837, -74.0059413],
            name: "New York"
        },
        {
            coords: [34.052235, -118.243683],
            name: "Los Angeles"
        },
        {
            coords: [41.878113, -87.629799],
            name: "Chicago"
        },
        {
            coords: [51.507351, -0.127758],
            name: "London"
        },
        {
            coords: [40.416775, -3.703790],
            name: "Madrid "
        }
        ];
        var map = new jsVectorMap({
            map: "world",
            selector: "#world_map",
            zoomButtons: true,
            markers: markers,
            markerStyle: {
                initial: {
                    r: 9,
                    strokeWidth: 7,
                    strokeOpacity: .4,
                    fill: window.theme.primary
                },
                hover: {
                    fill: window.theme.primary,
                    stroke: window.theme.primary
                }
            },
            zoomOnScroll: false
        });
        window.addEventListener("resize", () => {
            map.updateSize();
        });
    });
</script> -->
<!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
        var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
        document.getElementById("datetimepicker-dashboard").flatpickr({
            inline: true,
            prevArrow: "<span title=\"Previous month\">&laquo;</span>",
            nextArrow: "<span title=\"Next month\">&raquo;</span>",
            defaultDate: defaultDate
        });
    });
</script> -->