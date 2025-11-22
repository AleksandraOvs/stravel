document.addEventListener("DOMContentLoaded", function () {
    // === Подменю ===
    const menuItems = document.querySelectorAll(".menu-item-has-children");
    menuItems.forEach(item => {
        const link = item.querySelector("a");
        const dropdown = item.querySelector(".dropdown-menu");
        if (!link || !dropdown) return;

        link.addEventListener("click", e => {
            const isOpen = dropdown.classList.contains("show");
            if (!isOpen) {
                e.preventDefault();
                document.querySelectorAll(".dropdown-menu.show").forEach(open => open.classList.remove("show"));
                dropdown.classList.add("show");
                body.classList.add("fixed");
            }
        });

        dropdown.addEventListener("mouseleave", () => {
            dropdown.classList.remove("show");
            if (!document.querySelector(".dropdown-menu.show")) body.classList.remove("fixed");
        });
    });

    document.addEventListener("click", e => {
        menuItems.forEach(item => {
            if (!item.contains(e.target)) {
                const dropdown = item.querySelector(".dropdown-menu");
                if (dropdown) dropdown.classList.remove("show");
            }
        });
        if (!document.querySelector(".dropdown-menu.show")) body.classList.remove("fixed");
    });

});