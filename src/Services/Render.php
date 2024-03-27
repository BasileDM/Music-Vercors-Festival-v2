<?php

namespace src\Services;

trait Render {
    public function render(string $view, array $data = []) {
        include_once __DIR__ . '/../Views/' . $view . '.php';
    }
}
