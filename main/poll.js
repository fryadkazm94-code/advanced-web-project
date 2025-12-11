"use strict";

// Selecting elements
const btnAdd = document.getElementById("add-option-btn");
const optionsWrapper = document.getElementById("options-wrapper");

btnAdd.addEventListener("click", function () {
  const newOption = document.createElement("div");
  newOption.classList.add("option-field");

  newOption.innerHTML = `
    <input 
      type="text" 
      class="option-input" 
      name="options[]" 
      placeholder="New option"
      required
    />
    <ion-icon 
      name="close-circle-outline" 
      class="delete-option">
    </ion-icon>
  `;

  optionsWrapper.appendChild(newOption);

  const deleteBtn = newOption.querySelector(".delete-option");

  deleteBtn.addEventListener("click", function () {
    newOption.remove();
  });
});
