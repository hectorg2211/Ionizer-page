let filter_window = document.querySelector(".window_filter");
let entry_window = document.querySelector(".entry_filter");
let overlay = document.querySelector(".overlay");
const btnCloseFilter = document.querySelectorAll(".close");
const btnOpenFilter = document.querySelector(".show_filter");
const btnOpenEntry = document.querySelector(".show_entry");
const hidden = document.querySelectorAll(".hidden");
const icon = document.querySelector(".icon");

console.log(hidden);

const hideWindow = function () {
  for (let element of hidden) {
    element.classList.add("hidden");
    // element.classList.remove("flex");
  }
};

btnOpenFilter.addEventListener("click", function () {
  hidden[0].classList.remove("hidden");
  hidden[2].classList.remove("hidden");
});

btnOpenEntry.addEventListener("click", function () {
  hidden[1].classList.remove("hidden");
  hidden[2].classList.remove("hidden");
});

btnCloseFilter[0].addEventListener("click", hideWindow);
btnCloseFilter[1].addEventListener("click", hideWindow);
overlay.addEventListener("click", hideWindow);
document.addEventListener("keydown", function (event) {
  if (event.key == "Escape") hideWindow();
});
