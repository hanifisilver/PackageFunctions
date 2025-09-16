<?php
//***************************************************************//
//****** Girilen TR Karakterleri EN Formatına Uygun Yapar *******//
//***************************************************************//
function ENFormatText($name, $pdo)
{
    // Türkçe karakterleri ASCII karşılıklarına çevir
    $turkish = ['Ç', 'ç', 'Ğ', 'ğ', 'İ', 'ı', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü'];
    $english = ['C', 'c', 'G', 'g', 'I', 'i', 'O', 'o', 'S', 's', 'U', 'u'];
    $name = str_replace($turkish, $english, $name);

    // Noktaları ve özel karakterleri alt tireye çevir
    $name = preg_replace('/[^A-Za-z0-9_\- ]+/', '_', $name);

    // Birden fazla alt tireyi tek alt tireye indir
    $name = preg_replace('/_+/', '_', $name);

    // Baştaki/sondaki boşluk veya alt tireleri kırp
    $name = trim($name, " _-");

    // Eğer tamamen boş kaldıysa fallback kullan → user + 6 haneli random sayı
    if ($name === '') {
        do {
            $randomNum = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $candidate = "user" . $randomNum;

            // Database içinde var mı kontrol et
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $stmt->execute([$candidate]);
            $count = $stmt->fetchColumn();
        } while ($count > 0);

        $name = $candidate;
    }

    // Küçük harfe çevir
    $name = strtolower($name);

    return $name;
}
//*************************************************//



//*********************************************//
//****** Alert Mekanizmasını Çalıştırır *******//
//*********************************************//
function showAlert()
{
    if (!isset($_SESSION['alert']))
        return;

    $alert = $_SESSION['alert'];
    ?>
    <div id="customAlert" class="alert-box <?= htmlspecialchars($alert['type']); ?>">
        <span class="alert-close">&times;</span>
        <?php
        if (is_array($alert['message'])) {
            echo "<ul>";
            foreach ($alert['message'] as $msg) {
                echo "<li>" . htmlspecialchars($msg) . "</li>";
            }
            echo "</ul>";
        } else {
            echo htmlspecialchars($alert['message']);
        }
        ?>
    </div>
    <?php
    // Alert gösterildikten sonra session temizle
    unset($_SESSION['alert']);
}
//*************************************************//



//*************************************************//
//****** SüperUser Mekanizmasını Çalıştırır *******//
//*************************************************//
function isSuperUser()
{
    return isset($_SESSION['Type']) && $_SESSION['Type'] === 1;
}
//*************************************************//

?>