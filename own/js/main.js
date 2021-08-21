//? Buttons
let addSoldProductBtn = document.getElementById("addSoldProductBtn");
let saveProductSoldBtn = document.getElementById("saveProductSoldBtn");
//? INPUTS
let productSelect = document.getElementById("productSelect");
let countInput = document.getElementById("countInput");
let priceInput = document.getElementById("priceInput");
let depositeInput = document.getElementById("depositeInput");
let ahCutInput = document.getElementById("ahCutInput");

//?INCOME
let sumIncome = document.getElementById("sumIncome");

$(document).ready(function () {


    generateOptionsForSelects(productSelect, "getProductsForOptions");

    
    productSelect.addEventListener("change", (event) => {
        if (event.currentTarget.value == 15) {
            countInput.value = 1;
            depositeInput.value = 0;
            ahCutInput.value = 0;
        }
    });
    
    let inputs = {
        productSelect: productSelect,
        countInput: countInput,
        priceInput: priceInput,
        depositeInput: depositeInput,
        ahCutInput: ahCutInput,
        
    }
    addClickEventToAddSoldPruductBtn(addSoldProductBtn, inputs);
    addClickEventToSaveSoldBtn(saveProductSoldBtn, inputs);

    renderMainDatatableAndSumGold();

});