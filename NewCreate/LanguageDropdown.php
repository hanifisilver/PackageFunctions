
<?php
$currentLang = $_SESSION['lang'] ?? 'tr';

$languages = [
    'tr' => ['name' => 'Türkçe', 'flag' => 'img/flags/tr.svg'],
    'en' => ['name' => 'English', 'flag' => 'img/flags/en.svg'],
    'de' => ['name' => 'Deutsch', 'flag' => 'img/flags/de.svg'],
    'ru' => ['name' => 'Русский', 'flag' => 'img/flags/ru.svg'],
    'ar' => ['name' => 'العربية', 'flag' => 'img/flags/ar.svg'],
];

$selectedFlag = $languages[$currentLang]['flag'] ?? 'img/flags/tr.svg';
$selectedName = $languages[$currentLang]['name'] ?? 'Türkçe';
?>
<style>
    /* Dropdown buton ve bayrak stili */
    .lang-dropdown .dropdown-toggle {
        padding: 4px 10px;
        font-size: 20px;
        display: flex;
        align-items: center;
        gap: 6px;
        /* Bayrak ile yazı arası boşluk */
        border: none;
        /* border kaldır */
    }

    .lang-dropdown .dropdown-toggle img {
        width: 30px;
        height: 30px;
        border-radius: 3px;
        /* hafif oval kenar */
        border: none;
        /* border kaldır */
    }

    /* Dropdown menüde bayraklar */
    .lang-dropdown .dropdown-item img {
        width: 18px;
        height: 18px;
        border-radius: 3px;
        margin-right: 8px;
        object-fit: cover;
    }
</style>

<div class="dropdown lang-dropdown">
    <a class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center"
       href="#" id="langDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="<?= $selectedFlag ?>" alt="<?= $selectedName ?> Flag">
        <span><?= strtoupper($currentLang) ?></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="langDropdown">
        <?php foreach ($languages as $code => $info): ?>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="?lang=<?= $code ?>">
                    <img src="<?= $info['flag'] ?>" alt="<?= $info['name'] ?> Flag">
                    <?= $info['name'] ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>