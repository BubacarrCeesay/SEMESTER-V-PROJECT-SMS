let prof = document.querySelectorAll(".prof-btn");
let profshow = document.querySelectorAll(".sub");
let arrow = document.querySelectorAll(".arrow");

let len = prof.length;

for (let i = 0; i < len; i++) {
  prof[i].addEventListener("click", function (event) {
    profshow[i].classList.toggle("show");
    arrow[i].classList.toggle("rotate");
  });
}

let canshow = document.querySelector(".canshow");
let nav = document.querySelector(".nav");
let resizemain = document.querySelector(".main");

if (canshow && nav && resizemain) {
  canshow.addEventListener("click", (event) => {
    nav.classList.toggle("pop");
    resizemain.classList.toggle("resize");
  });
} else {
  console.error("One or more elements are not found in the DOM.");
}
