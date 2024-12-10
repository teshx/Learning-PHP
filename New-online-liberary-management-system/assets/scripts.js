const menuToggle = document.querySelector(".menu-toggle");
const navLinks = document.querySelector(".nav-links");
const navItems = document.querySelectorAll(".nav-links a");

// Toggle the menu when the menu icon is clicked
menuToggle.addEventListener("click", () => {
  navLinks.classList.toggle("active");
});

// Close the menu when a navigation link is clicked
navItems.forEach((item) => {
  item.addEventListener("click", () => {
    navLinks.classList.remove("active");
  });
});
