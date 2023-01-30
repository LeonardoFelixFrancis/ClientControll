let rows = document.getElementsByClassName("clientRow");
let selectedCount = 0;
let inpDel = document.getElementById("delclientinp");
let idStr = "";
for (let i = 0; i < rows.length; i++) {
  rows[i].addEventListener("click", function (e) {
    if (!rows[i].classList.contains("clientSelected")) {
      rows[i].classList.add("clientSelected");
      console.log(rows[i].dataset.id);
      selectedCount++;
      idStr += rows[i].dataset.id + ".";
    } else {
      rows[i].classList.remove("clientSelected");
      selectedCount--;
      idStr = idStr.replace(rows[i].dataset.id + ".", "");
    }
    if (selectedCount != 0) {
      document.getElementById("delBtnHolder").classList.remove("hidden");
    } else {
      document.getElementById("delBtnHolder").classList.add("hidden");
    }

    if (selectedCount == 1) {
      document.getElementById("openClientBtnHold").classList.remove("hidden");
      document.getElementById("clientidhold").value = rows[i].dataset.id;
    } else {
      document.getElementById("openClientBtnHold").classList.add("hidden");
      document.getElementById("clientidhold").value = 0;
    }
    e.stopPropagation();
    console.log(idStr);
    inpDel.value = idStr;
  });
}
