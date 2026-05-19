function sanitizeForm(form) {
    for (let element of form.elements) {
        const isEmpty = (element.type === "file") ?
            element.files.length === 0 :
            !element.value.trim();

        if (!element.required && isEmpty) {
            element.removeAttribute("name");
        }
    }
    return true;
}