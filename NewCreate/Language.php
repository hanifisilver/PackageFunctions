<?php

class Language {
    private $texts = [];
    private $lang;

    public function __construct($lang = null) {
        // Session’dan dil al, yoksa varsayılan 'tr'
        $this->lang = strtolower($lang ?? ($_SESSION['lang'] ?? 'tr'));
        $_SESSION['lang'] = $this->lang; // ilk yüklemede TR'yi garantiye al

        $file = __DIR__ . "/Language/{$this->lang}.json"; // <-- küçük harfli dosya isimleri

        if (file_exists($file)) {
            $this->texts = json_decode(file_get_contents($file), true);
        }
    }

    public function get($key) {
        return $this->texts[$key] ?? $key;
    }

    public function setLanguage($lang) {
        $this->lang = strtolower($lang);
        $_SESSION['lang'] = $this->lang;

        $file = __DIR__ . "/Language/{$this->lang}.json";
        if (file_exists($file)) {
            $this->texts = json_decode(file_get_contents($file), true);
        }
    }
}
