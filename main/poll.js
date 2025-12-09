"use strict";

// selecting the elements needed to add and delete options
const addBtn = document.getElementById("add-option-btn");
const wrapper = document.getElementById("options-wrapper");

// creating an eventlistener to delete an option whenever the icon(butotn is clicked)
addBtn.addEventListener("click", () => {
  const div = document.createElement("div");
  div.classList.add("option-field");

  div.innerHTML = `
        <input type="text" class="option-input" placeholder="New option" />
        <ion-icon name="close-circle-outline" class="delete-option"></ion-icon>
    `;

  wrapper.appendChild(div);

  // DELETE OPTION ICON
  const del = div.querySelector(".delete-option");

  del.addEventListener("click", () => {
    div.remove();
  });
});
