const form = document.querySelector("form");
const msg = document.querySelector("#msg");

form.addEventListener("submit", (e) => {
    e.preventDefault();

    const baseUrl = location.origin;

    const formData = new FormData(form);

    fetch(`${baseUrl}/apis/admin`, {
        method: "post",
        body: formData,
    })
        .then((res) => res.json())
        .then((json) => {
            console.log(json);
            if (json === "authentification réussite") {
                location.href = "/pages/dash";
            } else {
                msg.innerHTML = `
                    <p class="report invalid-input-report">${json}</p>
                `;
            }
        })
        .catch((err) => {
            throw err;
        });
});
