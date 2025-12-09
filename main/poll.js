"use strict";

// Selecting elements
const btnAdd = document.getElementById("add-option-btn");
const optionsWrapper = document.getElementById("options-wrapper");

// Add new option
btnAdd.addEventListener("click", function () {
  // Create a new option container
  const newOption = document.createElement("div");
  newOption.classList.add("option-field");

  // HTML for the new option
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

  // Add new option to the list
  optionsWrapper.appendChild(newOption);

  // Selecting delete icon inside this new option
  const deleteBtn = newOption.querySelector(".delete-option");

  // Delete option when X is clicked
  deleteBtn.addEventListener("click", function () {
    newOption.remove();
  });
});
