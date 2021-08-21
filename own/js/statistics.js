let productNode = document.getElementById('chartjs').getContext('2d');
let productChart = null;

let productSelect = document.getElementById("productSelect");

$.post("./php/api.php", { mode: "getProductsForOptions" }, (response) => {
    let parsedData = JSON.parse(response);
    //console.log(parsedData);
    productSelect.innerHTML = "";
    //productSelect.innerHTML += `<option value='-1'>Choose...</option>`;     
    
    for (const row of parsedData.data) {
        productSelect.innerHTML += `<option value='${row.id}'>${row.name}</option>`;
    }

    renderProductChart(productSelect.value);

    productSelect.addEventListener("change", (event) => {
        renderProductChart(productSelect.value, true);
    });
    
});

const renderProductChart = (product, rerender = false) => {

    if (rerender) {
        $.post("./php/api.php", { mode: "stat_test", product: product}, (response) => {
            let parsedData = JSON.parse(response);
            console.log(parsedData);
        
            productChart.data.labels = parsedData.date;
            productChart.data.datasets[0].label = parsedData.name;
            productChart.data.datasets[0].data = parsedData.price;

            productChart.update();
            
        });
    } else {

        $.post("./php/api.php", { mode: "stat_test", product: product}, (response) => {
            let parsedData = JSON.parse(response);
            console.log(parsedData);
        
            
            productChart = new Chart(productNode, {
                type: 'line',
                data: {
                    labels: parsedData.date,
                    datasets: [{
                        label: parsedData.name,
                        data: parsedData.price,  
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1,
                        fill: false,         
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    }
}



