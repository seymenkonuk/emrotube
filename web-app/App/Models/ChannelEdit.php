<?php
// ============================================================================
// File:    ChannelEdit.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Models;


class ChannelEdit
{
    public string   $code;
    public string   $name;
    public string   $title;
    public ?string  $description;
    public ?string  $instagram_url;
    public ?string  $twitter_url;
    public ?string  $facebook_url;
    public ?string  $linkedin_url;
    public ?string  $github_url;

    public function mergeFromForm(array $formData): array
    {
        $this->updateFromForm($formData["body"] ?? []);
        $formData["body"] = $this->toArray();
        return $formData;
    }

    private function UpdateFromForm(array $formData)
    {
        $this->code = $formData["code"] ?? $this->code;
        $this->name = $formData["name"] ?? $this->name;
        $this->title = $formData["title"] ?? $this->title;
        $this->description = $formData["description"] ?? $this->description;
        $this->instagram_url = $formData["instagram_url"] ?? $this->instagram_url;
        $this->twitter_url = $formData["twitter_url"] ?? $this->twitter_url;
        $this->facebook_url = $formData["facebook_url"] ?? $this->facebook_url;
        $this->linkedin_url = $formData["linkedin_url"] ?? $this->linkedin_url;
        $this->github_url = $formData["github_url"] ?? $this->github_url;
    }

    public function toArray()
    {
        return [
            "code" => $this->code,
            "name" => $this->name,
            "title" => $this->title,
            "description" => $this->description ?? null,
            "instagram_url" => $this->instagram_url ?? null,
            "twitter_url" => $this->twitter_url ?? null,
            "facebook_url" => $this->facebook_url ?? null,
            "linkedin_url" => $this->linkedin_url ?? null,
            "github_url" => $this->github_url ?? null,
        ];
    }
}
