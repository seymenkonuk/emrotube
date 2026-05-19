<?php
// ============================================================================
// File:    CategoryEdit.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


class CategoryEdit
{
    public string   $code;
    public string   $title;
    public ?string  $description;

    public function mergeFromForm(array $formData): array
    {
        $this->updateFromForm($formData["body"] ?? []);
        $formData["body"] = $this->toArray();
        return $formData;
    }

    private function UpdateFromForm(array $formData)
    {
        $this->code = $formData["code"] ?? $this->code;
        $this->title = $formData["title"] ?? $this->title;
        $this->description = $formData["description"] ?? $this->description;
    }

    public function toArray()
    {
        return [
            "code" => $this->code,
            "title" => $this->title,
            "description" => $this->description ?? null,
        ];
    }
}
