(() => {
    const places = window.culturalPlaces;
    const panel = document.querySelector("#place-detail");
    const cards = [...document.querySelectorAll("[data-place]")];
    const mainImage = document.querySelector("#detail-main-image");
    const thumbnailButtons = [...document.querySelectorAll("[data-thumbnail]")];
    let selected = "H2";
    let lastCard = cards.find((card) => card.dataset.place === selected);
    function setImage(image, data) {
        image.src = data.src;
        image.alt = data.alt;
    }
    function selectPlace(id, focusPanel = false) {
        if (!places[id]) return;
        selected = id;
        const place = places[id];
        panel.hidden = false;
        document.querySelector("#detail-id").textContent = id;
        document.querySelector("#detail-title").textContent = place.title;
        const subtitle = document.querySelector("#detail-subtitle");
        subtitle.textContent = place.subtitle;
        subtitle.hidden = !place.subtitle;
        setImage(mainImage, place.image);
        document.querySelector("#detail-description").textContent =
            place.description;
        const cta = document.querySelector("#detail-cta");
        cta.href = place.url;
        cta.querySelector("span").textContent = place.cta;
        thumbnailButtons.forEach((button, index) => {
            setImage(button.querySelector("img"), place.thumbnails[index]);
            button.setAttribute("aria-pressed", "false");
        });
        cards.forEach((card) =>
            card.setAttribute(
                "aria-pressed",
                String(card.dataset.place === id),
            ),
        );
        lastCard = cards.find((card) => card.dataset.place === id);
        if (focusPanel) {
            panel.focus({ preventScroll: true });
            if (matchMedia("(max-width: 1100px)").matches)
                panel.scrollIntoView({
                    behavior: matchMedia("(prefers-reduced-motion: reduce)")
                        .matches
                        ? "instant"
                        : "smooth",
                    block: "start",
                });
        }
    }
    cards.forEach((card) =>
        card.addEventListener("click", () =>
            selectPlace(card.dataset.place, true),
        ),
    );
    thumbnailButtons.forEach((button, index) =>
        button.addEventListener("click", () => {
            setImage(mainImage, places[selected].thumbnails[index]);
            thumbnailButtons.forEach((item) =>
                item.setAttribute("aria-pressed", String(item === button)),
            );
        }),
    );
    document.querySelector(".detail-close").addEventListener("click", () => {
        panel.hidden = true;
        cards.forEach((card) => card.setAttribute("aria-pressed", "false"));
        lastCard.focus({ preventScroll: true });
    });
    document.querySelector("#restart-map").addEventListener("click", () => {
        selectPlace("H2");
        document
            .querySelector("#cultural-map")
            .scrollIntoView({
                behavior: matchMedia("(prefers-reduced-motion: reduce)").matches
                    ? "instant"
                    : "smooth",
            });
        lastCard.focus({ preventScroll: true });
    });
    const unavailableTikTok = document.querySelector(
        ".tiktok-button[aria-disabled]",
    );
    unavailableTikTok?.addEventListener("click", () => {
        document.querySelector("#tiktok-status").hidden = false;
    });
    const dialog = document.querySelector("#places-search-dialog");
    const queryInput = document.querySelector("#places-query");
    document
        .querySelector(".places-search-button")
        .addEventListener("click", () => {
            dialog.showModal();
            queryInput.focus();
        });
    document
        .querySelector("#close-places-search")
        .addEventListener("click", () => dialog.close());
    document
        .querySelector("#places-search-form")
        .addEventListener("submit", (event) => {
            event.preventDefault();
            const query = queryInput.value.trim().toLocaleLowerCase("th");
            const list = document.querySelector("#places-search-results");
            list.replaceChildren();
            if (!query) return;
            const matches = Object.entries(places).filter(([id, place]) =>
                `${id} ${place.title} ${place.subtitle} ${place.description}`
                    .toLocaleLowerCase("th")
                    .includes(query),
            );
            document.querySelector("#places-search-status").textContent =
                matches.length
                    ? `พบ ${matches.length} สถานที่`
                    : "ไม่พบสถานที่ที่ค้นหา";
            matches.forEach(([id, place]) => {
                const li = document.createElement("li");
                const button = document.createElement("button");
                button.type = "button";
                button.textContent = `${id} ${place.title}`;
                button.addEventListener("click", () => {
                    dialog.close();
                    selectPlace(id, true);
                });
                li.append(button);
                list.append(li);
            });
        });
})();
