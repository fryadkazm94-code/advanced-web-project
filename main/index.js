"use strict";

const ul = document.querySelector("ul");
const menuBtn = document.querySelector(".menu-btn");
const closeBtn = document.querySelector(".close-btn");
const copyRight = document.querySelector(".copyright");
const navLinks = document.querySelectorAll(".nav-links");
const heroSection = document.querySelector(".hero-section");

const observer = new IntersectionObserver(
  function (entries) {
    const ent = entries[0];

    console.log(ent);
    if (!ent.isIntersecting) {
      document.querySelector(".header").classList.add("sticky");
    } else {
      document.querySelector(".header").classList.remove("sticky");
    }
  },

  {
    // null means the view port
    root: null,
    // i will make an event as soon as 0% of the hero-section is appearing in the view port
    threshold: 0,
  }
);
observer.observe(heroSection);

function open() {
  if (ul.classList.contains("nav-list")) {
    ul.classList.remove("nav-list");

    if (!ul.classList.contains("nav-list")) {
      menuBtn.classList.add("hidden");
      closeBtn.style.display = "block";
    }
  }
}

function close() {
  if (menuBtn.classList.contains("hidden")) {
    ul.classList.add("nav-list");
    closeBtn.style.display = "none";
    menuBtn.classList.remove("hidden");
  }
}

for (let i = 0; i < navLinks.length; i++) {
  navLinks[i].addEventListener("click", close);
}

menuBtn.addEventListener("click", open);
closeBtn.addEventListener("click", close);

let date = new Date().getFullYear();
copyRight.textContent = date;
