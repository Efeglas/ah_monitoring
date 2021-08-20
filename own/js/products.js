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

    $.post("./php/api.php", { mode: "getAllProductsData" }, (response) => {
        let parsedData = JSON.parse(response);
        console.log(parsedData);

        $('#productsDataTable').DataTable({
            data: parsedData.data,
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
                    title: "Rarity",
                    data: "rarity"
                },
                {
                    title: "Category",
                    data: "category"
                },
                

            ]
        });

    });
});