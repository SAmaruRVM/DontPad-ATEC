let darkTheme = false;
const noteText = document.getElementById("note__text");
document.getElementById("change-theme").addEventListener("click", function () {
  document
    .querySelectorAll("*")
    .forEach((el) =>
      el.setAttribute("data-dark-theme", darkTheme ? "off" : "on")
    );
  darkTheme = !darkTheme;
  this.innerHTML = !darkTheme
    ? "<i class='fas fa-moon'></i>"
    : "<i class='fas fa-sun'></i>";
});
noteText?.addEventListener("keyup", () => {
  const formData = new FormData();
  formData.append("id", window.document.title.split("|")[0].trim());
  formData.append("note", noteText.value);
  fetch("validations.php", {
    method: "POST",
    body: formData,
  });
});
noteText?.addEventListener("keydown", function (e) {
  if (e.key == "Tab") {
    e.preventDefault();
    const start = this.selectionStart;
    const end = this.selectionEnd;
    this.value =
      this.value.substring(0, start) + "\t" + this.value.substring(end);
    this.selectionStart = this.selectionEnd = start + 1;
  }
});
document.querySelector("form")?.addEventListener("submit", function (e) {
  e.preventDefault();
  window.location.href = `index.php?note=${this.querySelector("input").value}`;
});

setInterval(() => {
  const formData = new FormData();
  formData.append("id", window.document.title.split("|")[0].trim());
  formData.append("note", noteText.value);
  fetch("validations.php?update=yes", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((response) => (noteText.value = response));
}, 2000);
