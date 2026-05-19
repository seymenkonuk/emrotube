<?php
// ============================================================================
// File:    CommentController.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Controllers;

use Seymen\PhpMvcTemplate\Core\Controller;
use Seymen\PhpMvcTemplate\Services\AuthService;
use Seymen\PhpMvcTemplate\Services\CommentService;

class CommentController extends Controller
{
    private AuthService $authService;
    private CommentService $commentService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->commentService = new CommentService();
    }

    public function AddToVideo(string $videoCode)
    {
        return $this->Component("");
    }

    public function AddToShort(string $shortCode)
    {
        return $this->Component("");
    }

    public function AddToMusic(string $musicCode)
    {
        return $this->Component("");
    }

    public function Edit(string $commentCode)
    {
        return $this->Component("");
    }

    public function Delete(string $commentCode)
    {
        return $this->Component("");
    }

    public function Like(string $commentCode)
    {
        return $this->Component("");
    }

    public function Dislike(string $commentCode)
    {
        return $this->Component("");
    }
}
