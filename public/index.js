



const itemsAndPrices = [
    { name: "decafe", price: 500 },
    { name: "capachino", price: 100 },
    { name: "La casa", price:80},
    { name: "capachino", price: 100 },
    { name: "La casa", price:80},
    { name: "da papel", price: 150} ]

const menuItems = document.getElementById('menuItems');
menuItems.innerHTML = "";

//displaying menu

menuItems.innerHTML = itemsAndPrices.map(item => {
    console.log("hello");
    return  (
        `<div class="row">
            <div class="col-6">
                <h2>${item.name}</h2>
            </div>
            <div class="col-6">
                <h2 >Rs ${item.price}</h2>
            </div>
         </div>`
    )
}).join("");

