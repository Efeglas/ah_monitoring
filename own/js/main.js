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

    addClickEventToAddSoldPruductBtn(addSoldProductBtn);
    let inputs = {
        productSelect: productSelect,
        countInput: countInput,
        priceInput: priceInput,
        depositeInput: depositeInput,
        ahCutInput: ahCutInput,
       
    }
    addClickEventToSaveSoldBtn(saveProductSoldBtn, inputs);

    $.post("./php/api.php", { mode: "getAllSoldProductData" }, (response) => {
        let parsedData = JSON.parse(response);
        console.log(parsedData);

        $('#mainDataTable').DataTable({
            data: parsedData.data,
            order: [[ 0, "desc" ]],
            columns: [
                {
                    title: "ID",
                    data: "id"
                },
                {
                    title: "Name",
                    data: "name",
                    "render": function (data, type, row, meta) {
                        let picture = "";
                        if (row.pic != null) {
                            picture = `<img class="mini-img" src="./data/imgs/${row.pic}">`;
                        }
                        return `<div class="flex-c">${picture}<b class="f-shadow" style='color:${row.color};'>${data}<b></div>`;
                     }
                },
                {
                    title: "Count",
                    data: "count"
                },
                {
                    title: "price",
                    data: "price",
                    "render": function (data, type, row, meta) {
                       return formatFloatToGoldSilverBronsPrice(data);
                    }
                },
                {
                    title: "Deposite",
                    data: "deposite",
                    "render": function (data, type, row, meta) {
                        return formatFloatToGoldSilverBronsPrice(data);
                     }
                },
                {
                    title: "AH cut",
                    data: "ah_cut",
                    "render": function (data, type, row, meta) {
                        return formatFloatToGoldSilverBronsPrice(data);
                     }
                },
                {
                    title: "Gain",
                    data: "gain",
                    "render": function (data, type, row, meta) {
                        return formatFloatToGoldSilverBronsPrice(data);
                     }
                },
                {
                    title: "Date of record",
                    data: "date"
                },

            ]
        });

        sumIncome.innerHTML = `All income: ${formatFloatToGoldSilverBronsPrice(parsedData.sum)}`;
        
        

    });

});