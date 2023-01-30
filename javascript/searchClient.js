let searchBtn = document.getElementById("searchClient");
searchBtn.addEventListener("click", function () {
  let searchHold = document.getElementById("clientSearchHold");

  if (searchHold.classList.contains("hidden")) {
    let overlay = document.getElementById("overlay");
    searchHold.classList.remove("hidden");
    overlay.classList.remove("hidden");
    let closeSearchBtn = document.getElementById("closeBtnSearchClient");
    closeSearchBtn.addEventListener("click", function () {
      searchHold.classList.add("hidden");
      overlay.classList.add("hidden");
    });
  } else {
    searchHold.classList.add("hidden");
    overlay.classList.add("hidden");
  }
});
