"use strict";

document.documentElement.classList.add("js");
const ul = document.querySelector("header ul");
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
    root: null,
    threshold: 0,
  }
);

if (heroSection) {
  observer.observe(heroSection);
}

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

if (copyRight) {
  copyRight.textContent = date;
}
