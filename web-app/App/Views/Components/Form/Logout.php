<form
    action="/logout"
    method="POST"
    onsubmit="return addCsrfToken(this) && sanitizeForm(this)">
    <?= $this->insert("Components/Form/Elements/Submit", [
        "text" => "Çıkış Yap",
        "icon" => "bi-box-arrow-right",
        "color" => "bg-red-500",
        "hoverColor" => "bg-red-600",
        "textColor" => "text-white",
    ]); ?>
</form>