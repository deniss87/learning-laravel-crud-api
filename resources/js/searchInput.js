document.addEventListener("DOMContentLoaded", function () {
    const searchInput =
        document.getElementById("customer-search") ??
        document.getElementById("order-search");
    const clearButton = document.getElementById("clear-button");

    if (!searchInput || !clearButton) return;

    searchInput.addEventListener("input", function () {
        if (this.value.length > 0) {
            clearButton.classList.remove("hidden");
            clearButton.classList.add("flex");
        } else {
            clearButton.classList.add("hidden");
            clearButton.classList.remove("flex");
        }
    });

    clearButton.addEventListener("click", function () {
        searchInput.value = "";
        clearButton.classList.add("hidden");
        clearButton.classList.remove("flex");
        htmx.trigger(searchInput, "search");
        const url = new URL(window.location);
        url.searchParams.delete("search");
        window.history.pushState({}, "", url);
    });

    if (searchInput.value.length > 0) {
        clearButton.classList.remove("hidden");
        clearButton.classList.add("flex");
    }
});
