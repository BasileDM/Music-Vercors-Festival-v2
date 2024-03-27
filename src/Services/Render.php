<?php

namespace src\Services;

trait Render {
    public function render(string $view, array $data = ['section' => '', 'action' => '']) {
        // Create variables for each key/value pairs
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                ${$key} = $value;
            }
        }
        if (!isset($section)) {
            $section = '';
        }
        if (!isset($action)) {
            $action = '';
        }
        include_once __DIR__ . '/../Views/' . $view . '.php';
    }
}
