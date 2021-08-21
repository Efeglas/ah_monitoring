//?INPUTS
let nameInput = document.getElementById("nameInput");
let raritySelect = document.getElementById("raritySelect");
let categorySelect = document.getElementById("categorySelect");
let picUpload = document.getElementById("picUpload");

//?Buttons
let saveProductAddBtn = document.getElementById("saveProductAddBtn");


$(document).ready(() => {
    generateOptionsForSelects(raritySelect, "getRaritiesForOptions", true);
    generateOptionsForSelects(categorySelect, "getCategoriesForOptions");

    let inputObjs = {
        nameInput: nameInput,
        raritySelect: raritySelect,
        categorySelect: categorySelect,
        picUpload: picUpload
    };
    addEventToSaveProductBtn(saveProductAddBtn, inputObjs);

    picUpload.addEventListener("change", (event) => {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(event.currentTarget.files[0]);

        oFReader.onload = function (oFREvent) {         
            document.getElementById("imgPreview").src = oFREvent.target.result;
        };
    });

    renderProductsTable();
});