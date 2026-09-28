(() => {
    const sections = [...document.querySelectorAll("[data-history-section]")];
    const links = [...document.querySelectorAll(".history-chapter-nav a")];
    let scheduled = false;
    let selectedChapter = null;
    function updateChapter() {
        scheduled = false;
        if (selectedChapter) return;
        const threshold = Math.min(innerHeight * 0.35, 220);
        let active = sections[0];
        for (const section of sections) {
            if (section.getBoundingClientRect().top <= threshold)
                active = section;
        }
        for (const link of links) {
            if (link.hash === `#${active.id}`)
                link.setAttribute("aria-current", "location");
            else link.removeAttribute("aria-current");
        }
    }
    window.addEventListener(
        "scroll",
        () => {
            if (!scheduled) {
                scheduled = true;
                requestAnimationFrame(updateChapter);
            }
        },
        { passive: true },
    );
    for (const link of links)
        link.addEventListener("click", () => {
            selectedChapter = link.hash;
            links.forEach((item) => item.removeAttribute("aria-current"));
            link.setAttribute("aria-current", "location");
        });
    for (const type of ["wheel", "touchstart"])
        window.addEventListener(type, () => { selectedChapter = null; }, { passive: true });
    window.addEventListener("keydown", event => {
        if (["ArrowDown", "ArrowUp", "PageDown", "PageUp", "Home", "End", " "].includes(event.key)) selectedChapter = null;
    });
    updateChapter();
    const form = document.querySelector(".history-search");
    const input = form.querySelector("input");
    const results = form.querySelector(".history-search-results");
    form.querySelector("button[type=submit]").addEventListener("click", () =>
        input.focus(),
    );
    form.addEventListener("submit", (event) => {
        event.preventDefault();
        const query = input.value.trim().toLocaleLowerCase("th");
        if (!query) return;
        const matches = sections.filter((section) =>
            section.textContent.toLocaleLowerCase("th").includes(query),
        );
        results.hidden = false;
        results.querySelector("p").textContent = matches.length
            ? `พบ ${matches.length} หัวข้อ`
            : "ไม่พบข้อมูลที่ค้นหา";
        const list = results.querySelector("ul");
        list.replaceChildren();
        for (const section of matches) {
            const item = document.createElement("li");
            const link = document.createElement("a");
            link.href = `#${section.id}`;
            link.textContent = section.querySelector("h2").textContent;
            link.addEventListener("click", () => {
                results.hidden = true;
            });
            item.append(link);
            list.append(item);
        }
    });
    form.querySelector(".history-search-close").addEventListener(
        "click",
        () => {
            results.hidden = true;
            input.focus();
        },
    );
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") results.hidden = true;
    });
    document.addEventListener("click", (event) => {
        if (!form.contains(event.target)) results.hidden = true;
    });
})();
