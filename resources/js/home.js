const toggle = document.querySelector(".menu-toggle");
const navigation = document.querySelector(".main-navigation");
function closeMenu() {
    toggle.setAttribute("aria-expanded", "false");
    toggle.setAttribute("aria-label", "เปิดเมนู");
    navigation.classList.remove("is-open");
}
toggle.addEventListener("click", () => {
    const open = toggle.getAttribute("aria-expanded") !== "true";
    toggle.setAttribute("aria-expanded", String(open));
    toggle.setAttribute("aria-label", open ? "ปิดเมนู" : "เปิดเมนู");
    navigation.classList.toggle("is-open", open);
});
navigation.addEventListener("click", (event) => {
    if (event.target.closest("a")) closeMenu();
});
document.addEventListener("keydown", (event) => {
    if (
        event.key === "Escape" &&
        toggle.getAttribute("aria-expanded") === "true"
    ) {
        closeMenu();
        toggle.focus();
    }
});
document.addEventListener("click", (event) => {
    if (!event.target.closest(".nav-container")) closeMenu();
});
window.matchMedia("(min-width: 769px)").addEventListener("change", closeMenu);
