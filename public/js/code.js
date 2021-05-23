const codeBookPages = document.querySelectorAll("[code_book_page]");
const overlay = document.querySelector(".overlay");

codeBookPages.forEach((codeBookPage) => {
    codeBookPage.addEventListener("click", (e) => {
        console.log(e.currentTarget.src);

        overlay.classList.remove("hidden");

        const img = document.createElement("img");
        img.src = e.currentTarget.src;

        overlay.appendChild(img);
    });
});

overlay.addEventListener("click", (e) => {
    if (e.target === e.currentTarget) {
        e.currentTarget.classList.add("hidden");
        e.currentTarget.innerHTML = "";
    }
});
