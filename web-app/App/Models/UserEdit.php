<?php
// ============================================================================
// File:    UserEdit.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


class UserEdit
{
    public string   $code;
    public string   $username;
    public string   $email;
    public string   $name;
    public string   $surname;
    public string   $country;

    public function mergeFromForm(array $formData): array
    {
        $this->updateFromForm($formData["body"] ?? []);
        $formData["body"] = $this->toArray();
        return $formData;
    }

    private function UpdateFromForm(array $formData)
    {
        $this->code = $formData["code"] ?? $this->code;
        $this->username = $formData["username"] ?? $this->username;
        $this->email = $formData["email"] ?? $this->email;
        $this->name = $formData["name"] ?? $this->name;
        $this->surname = $formData["surname"] ?? $this->surname;
        $this->country = $formData["country"] ?? $this->country;
    }

    public function toArray()
    {
        return [
            "code" => $this->code,
            "username" => $this->username,
            "email" => $this->email,
            "name" => $this->name,
            "surname" => $this->surname,
            "country" => $this->country,
        ];
    }
}
