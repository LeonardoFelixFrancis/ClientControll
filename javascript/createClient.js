let createBtn = document.getElementById("createClient");
createBtn.addEventListener("click", function () {
  let clientHold = document.getElementById("clientCreateHold");
  if (clientHold.classList.contains("hidden")) {
    clientHold.classList.remove("hidden");
    let overlay = document.getElementById("overlay");
    overlay.classList.remove("hidden");
    let closeCreateBtn = document.getElementById("closeCreateClient");
    closeCreateBtn.addEventListener("click", function () {
      clientHold.classList.add("hidden");
      overlay.classList.add("hidden");
    });
  } else {
    clientHold.classList.add("hidden");
    overlay.classList.add("hidden");
  }
});
