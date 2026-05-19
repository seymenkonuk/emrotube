<?php
// ============================================================================
// File:    MediaEdit.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


class MediaEdit
{
    public string   $code;
    public string   $title;
    public ?string  $description;
    public int      $view_type;
    public int      $comment_type;
    public ?string  $transcript;

    public function mergeFromForm(array $formData): array
    {
        $this->updateFromForm($formData["body"] ?? []);
        $formData["body"] = $this->toArray();
        return $formData;
    }

    private function updateFromForm(array $formData)
    {
        $this->code = $formData["code"] ?? $this->code;
        $this->title = $formData["title"] ?? $this->title;
        $this->description = $formData["description"] ?? $this->description;
        $this->view_type = $formData["view_type"] ?? $this->view_type;
        $this->comment_type = $formData["comment_type"] ?? $this->comment_type;
        $this->transcript = $formData["transcript"] ?? $this->transcript;
        return $this;
    }

    public function toArray()
    {
        return [
            "code" => $this->code,
            "title" => $this->title,
            "description" => $this->description ?? null,
            "view_type" => $this->view_type,
            "comment_type" => $this->comment_type,
            "transcript" => $this->transcript ?? null,
        ];
    }
}
