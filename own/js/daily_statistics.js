let addByStringTextarea = document.getElementById("addByStringTextarea");

let chartDivRowCardContainer = document.getElementById("chartDivRowCardContainer");
/*
168583:546400
170554:170400
168589:262200
168586:297000
171315:174100
169701:39900
171832:129400
171829:100000
171830:379900
171831:216800
171828:73600
171841:29300
171833:586400
*/

addByStringTextarea.addEventListener("change", (event) => {
    let saveDataString = event.currentTarget.value;
    event.currentTarget.value = "";
    let split = saveDataString.split("\n");
    let obj = {};
    
    //console.log(split);

    for (const data of split) {
        if (data != "") {
            
            let splittedData = data.split(":");
            let itemID = splittedData[0];
            let price = splittedData[1];
            obj[itemID] = price;
        }
    }

    //console.log(obj);

    $.post("./php/api.php", { mode: "insertDailyPrice", data: obj}, (response) => {
        let parsedData = JSON.parse(response);
        console.log(parsedData);

        if (parsedData.msg == 'success') {
            Toast.fire({
                icon: 'success',
                title: 'Successfully processed!'
            });
            location.reload();
        } else {
            Toast.fire({
                icon: 'error',
                title: 'Unexpected error ERRxIDPs'
            });
        }
        
        
    });
});

const renderCard = (data) => {
    let html = `<div class="col-md-4">

    <div class="card">
      <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
          <span id=""></span>
        </h3>
        <div class="card-tools">

        </div>
      </div>
      <div class="card-body">

        <canvas id="chartCanvas"></canvas>

      </div>
    </div>
  </div>`;

  let div = document.createElement("div");
  div.innerHTML = html;
  let innerNode = div.firstChild;

  let chart = innerNode.querySelector("#chartCanvas");
  let chartResult = new Chart(chart, {
    type: 'line',
    data: {
        labels: data.labels,
        datasets: [{
            label: data.name,
            data: data.data,  
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

    return innerNode;
}

const generateRow = () => {
    let div = document.createElement("div");
    div.classList.add("row");
    return div;
}

$.post("./php/api.php", { mode: "getStatForDailyPrices"}, (response) => {
    let parsedData = JSON.parse(response);
    console.log(parsedData);

    let counter = 1;

    for (let i = 0; i < 5; i++) {
        let row = generateRow();
        for (let j = 0; j < 3; j++) {
            if (parsedData.data[counter] != undefined) {
                
                row.appendChild(renderCard(parsedData.data[counter]));
                counter++;      
            }
        }    
        chartDivRowCardContainer.appendChild(row);
    }

});
