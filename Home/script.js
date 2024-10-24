let nav = document.getElementById("nav");
let cls = document.getElementById("close");
let menubar = document.getElementById("iconbar");

menubar.addEventListener("click", (event) => {
  menubar.style.display = "none";
  nav.style.display = "flex";
  cls.style.display = "flex";
});

cls.addEventListener("click", (event) => {
  cls.style.display = "none";
  nav.style.display = "none";
  menubar.style.display = "flex";
});

menubar.style.display = "flex";
