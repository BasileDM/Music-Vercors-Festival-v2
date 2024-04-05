<?php

namespace src\Services;

trait Hydration {

    public function __construct(array $data = []) {
        $this->hydrate($data);
    }

    public function __set($name, $value) {
        $this->hydrate([$name => $value]);
    }

    private function hydrate(array $data): void {
        // Turn database column name into camelCase...
        // ...to match classes properties.
        $setter = "set";
        foreach ($data as $key => $value) {
            $parts = explode("_", $key);
            foreach ($parts as $part) {
                $part = strtolower($part);
                $part = ucfirst($part);
                $setter .= $part;
            }
            $this->$setter($value);
        }
    }
}
