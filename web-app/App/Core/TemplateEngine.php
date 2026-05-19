<?php
// ============================================================================
// File:    TemplateEngine.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Core;


use Throwable;

use League\Plates\Engine;
use voku\helper\HtmlMin;


class TemplateEngine
{
    protected Engine $plates;
    protected HtmlMin $htmlMin;

    public function __construct()
    {
        // Template Engine Config
        $this->plates = new Engine(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Views");
        // Minifier Config
        $this->htmlMin = new HTMLMin();
        $this->htmlMin->doRemoveOmittedHtmlTags(false);
        $this->htmlMin->doOptimizeAttributes(true);
        $this->htmlMin->doRemoveComments(true);
        $this->htmlMin->doRemoveSpacesBetweenTags(true);
        $this->htmlMin->doSumUpWhitespace(true);
        $this->htmlMin->doRemoveWhitespaceAroundTags(true);
        $this->htmlMin->doRemoveOmittedQuotes(true);
        $this->htmlMin->doRemoveDeprecatedAnchorName(true);
        $this->htmlMin->doKeepHttpAndHttpsPrefixOnExternalAttributes(true);
        $this->htmlMin->doRemoveWhitespaceAroundTags(true);
    }

    public function render(string $name, array $data = []): string
    {
        try {
            $html = $this->plates->render($name, $data);
            $minifiedHtml = $this->htmlMin->minify($html);
            return $minifiedHtml;
        } catch (Throwable) {
            throw new TemplateException();
        }
    }
}
