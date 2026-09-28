(() => {
    const dialog = document.querySelector("#legend-search");
    const trigger = document.querySelector(".legend-search-button");
    const input = document.querySelector("#legend-query");
    const results = document.querySelector("#search-results");
    const status = document.querySelector("#search-status");
    const sections = [
        ...document.querySelectorAll("main section[id], main article[id]"),
    ];
    trigger.addEventListener("click", () => {
        dialog.showModal();
        input.focus();
    });
    dialog
        .querySelector(".search-close")
        .addEventListener("click", () => dialog.close());
    document
        .querySelector("#legend-search-form")
        .addEventListener("submit", (event) => {
            event.preventDefault();
            results.replaceChildren();
            const query = input.value.trim().toLocaleLowerCase("th");
            if (!query) {
                status.textContent = "กรุณาระบุคำค้นหา";
                return;
            }
            const matches = sections.filter((section) =>
                section.textContent.toLocaleLowerCase("th").includes(query),
            );
            status.textContent = matches.length
                ? `พบ ${matches.length} ส่วนที่เกี่ยวข้อง`
                : "ไม่พบข้อความที่ค้นหา";
            for (const section of matches) {
                const item = document.createElement("li");
                const link = document.createElement("a");
                link.href = `#${section.id}`;
                link.textContent =
                    section.querySelector("h1,h2,h3").textContent;
                link.addEventListener("click", () => dialog.close());
                item.append(link);
                results.append(item);
            }
        });
})();
