const body = document.querySelector("body"),
  nav = document.querySelector(".nav-menu");

// Change color on scroll //
window.addEventListener("scroll", function (e) {
  const lastPosition = window.scrollY;
  if (lastPosition > 100) {
    nav.classList.add("scroll-active");
  } else if (nav.classList.contains("scroll-active")) {
    nav.classList.remove("scroll-active");
  } else {
    nav.classList.remove("scroll-active");
  }
});
