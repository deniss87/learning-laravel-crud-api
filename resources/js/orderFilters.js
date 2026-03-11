function applyFilters() {
    const form = document.getElementById("filter-form");
    const searchInput = document.getElementById("order-search");
    const modal = document.getElementById("filter-modal");

    // Close the modal
    modal.classList.add("hidden");

    // Trigger HTML with form data + search
    htmx.trigger(searchInput, "search");

    // Updating the URL with filter parameters
    const formData = new FormData(form);
    const url = new URL(window.location);

    // Clearing old filter parameters
    url.searchParams.delete("statuses[]");
    url.searchParams.delete("date_from");
    url.searchParams.delete("date_to");

    formData.forEach((value, key) => {
        if (key !== "sort" && key !== "direction" && key !== "search") {
            url.searchParams.append(key, value);
        }
    });

    window.history.pushState({}, "", url);
}

function resetFilters() {
    const form = document.getElementById("filter-form");
    const modal = document.getElementById("filter-modal");
    const searchInput = document.getElementById("order-search");

    // Resetting checkboxes and dates
    form.querySelectorAll('input[type="checkbox"]').forEach((cb) => {
        cb.checked = false;
        cb.closest("label").classList.remove(
            "border-indigo-300",
            "bg-indigo-50",
        );
        cb.closest("label").classList.add("border-gray-100");
    });
    form.querySelectorAll('input[type="date"]').forEach((d) => (d.value = ""));

    modal.classList.add("hidden");

    // Updating the table
    htmx.trigger(searchInput, "search");

    // Clearing URLs from Filters
    const url = new URL(window.location);
    url.searchParams.delete("statuses[]");
    url.searchParams.delete("date_from");
    url.searchParams.delete("date_to");
    window.history.pushState({}, "", url);
}
