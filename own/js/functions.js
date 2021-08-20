const addClickEventToAddSoldPruductBtn = (button) => {
    button.addEventListener("click", (event) => {
        
        $('#reservationdatetime').datetimepicker({
            icons: {
                time: 'far fa-clock'
            },
            format: "YYYY.MM.DD HH:mm:ss"
        });
        $("#modal-addSold").modal();
    });
}

const addClickEventToSaveSoldBtn = (button, inputs) => {
    button.addEventListener("click", (event) => {
        console.log(inputs);

        let dataObj = {
            product: inputs.productSelect.value,
            count: inputs.countInput.value,
            price: inputs.priceInput.value,
            deposite: depositeInput.value,
            ahCut: inputs.ahCutInput.value,
            
        }
        $.post("./php/api.php", { mode: "insertSoldPruduct", data: dataObj }, (response) => {
            //let parsedData = JSON.parse(response);
            //console.log(parsedData);
            Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
            });
            $("#modal-addSold").modal('hide');
            inputs.productSelect.value = "-1";
            inputs.countInput.value = "";
            inputs.priceInput.value = "";
            inputs.depositeInput.value = "";
            inputs.ahCutInput.value = "";
            
        });
    });
}

const formatFloatToGoldSilverBronsPrice = (data) => {
    //console.log(data);
    let splitted = data.toString().split(".");
    let silver = 0;
    let bronz = 0;
    if (splitted[1] != undefined) {

        switch (splitted[1].length) {
            case 1:
                silver = splitted[1];
                break;
            case 2:
                silver = splitted[1];
                break;
            case 3:
                silver = splitted[1].slice(0, 2);
                bronz = splitted[1].slice(2);
                break;
            case 4:
                silver = splitted[1].slice(0, 2);
                bronz = splitted[1].slice(2);
                break;

            default:
                break;
        }


    }
    return `${splitted[0]} <i class="fas fa-circle g"></i> ${silver} <i class="fas fa-circle s"></i> ${bronz} <i class="fas fa-circle b"></i>`;
}

const getProducts = async () => {
    $.post("./php/api.php", { mode: "getProductsForOptions" }, (response) => {
        let parsedData = JSON.parse(response);
        //console.log(parsedData);
        return parsedData;
    });
}

//?PRODUCT, RARITY, CATEGORY OPTIONS
const generateOptionsForSelects = async (select, mode, color = false) => {
    $.post("./php/api.php", { mode: mode }, (response) => {
        let parsedData = JSON.parse(response);
        //console.log(parsedData);
        select.innerHTML = "";
        select.innerHTML += `<option value='-1'>Choose...</option>`;
        if (color) {
            for (const row of parsedData.data) {
                select.innerHTML += `<option value='${row.id}' style='color:${row.color};'>${row.name}</option>`;
            }
        } else {

            for (const row of parsedData.data) {
                select.innerHTML += `<option value='${row.id}'>${row.name}</option>`;
            }
        }
    });
}

/* $.post("./php/api.php", {mode: "insertSoldPruduct"}, (response) =>{
    console.log(response);
}); */
const getTodaysDateString = () => {
    let date = new Date();
    let dateString = `${date.getFullYear()}.${date.getMonth() < 10 ? "0" + date.getMonth() : date.getMonth()}.${date.getDate() < 10 ? "0" + date.getDate() : date.getDate()} ${date.getHours() < 10 ? "0" + date.getHours() : date.getHours()}:${date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes()}:${date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds()}`;
    return dateString;
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

//! products

const addEventToSaveProductBtn = (button, inputs) => {
    button.addEventListener("click", (event) => {

        if (inputs.picUpload.files.length > 0) {
            
            let formData = new FormData();
    
            formData.append('mode', "saveProduct");
            formData.append('image', inputs.picUpload.files[0]);
            formData.append('name', inputs.nameInput.value);
            formData.append('rarity', inputs.raritySelect.value);
            formData.append('category', inputs.categorySelect.value);
    
            $.ajax({
                url: './php/api.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    let parsedData = JSON.parse(response);
                    console.log(parsedData);
                    if (parsedData.msg == "success") {
                        Toast.fire({
                            icon: 'success',
                            title: 'Successfully added!'
                        });
                        inputs.picUpload.value = "";
                        inputs.nameInput.value = "";
                        inputs.raritySelect.value = "-1";
                        inputs.categorySelect.value = "-1";
                        document.getElementById("imgPreview").src = "./data/imgs/inv_placeholder.png";
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Unknown error!!!'
                        });
                    }
                },
             }); 

        } else {
            Toast.fire({
                icon: 'error',
                title: 'Empty field!'
            });
        }

    });
}