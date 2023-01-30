let closeBtn = document.getElementById("closeOpenClient");
let openClient = document.getElementById("clientOpenHold");
let overlay = document.getElementById("overlay");

if (closeBtn != null) {
  closeBtn.addEventListener("click", function () {
    openClient.classList.add("hidden");
    overlay.classList.add("hidden");
  });

  if (!openClient.classList.contains("hidden")) {
    overlay.classList.remove("hidden");
  }
}
