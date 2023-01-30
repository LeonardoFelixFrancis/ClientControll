let btn = document.getElementsByClassName("filesbtn");
for (let i = 0; i < btn.length; i++) {
  btn[i].addEventListener("click", function () {
    let fileHoldId = "files." + btn[i].id;
    let fileHold = document.getElementById(fileHoldId);
    if (fileHold.classList.contains("closedfiles")) {
      fileHold.classList.remove("closedfiles");
      let closeBtnId = "files." + btn[i].id + "close";
      let closeBtn = document.getElementById(closeBtnId);
      let overlay = document.getElementById("overlay");
      overlay.classList.remove("hidden");
      closeBtn.addEventListener("click", function () {
        fileHold.classList.add("closedfiles");
        overlay.classList.add("hidden");
      });
    } else {
      fileHold.classList.add("closedfiles");
      overlay.classList.add("hidden");
    }
  });
}
