

const orders = [];
const itemsAndPrices = [
    { index: 0, name: "decafe", price: 500, img: "../images/item1.jpg" },
    { index: 1, name: "capachino", price: 100, img: "../images/item2.jpg" },
    { index: 2, name: "Lacasa", price: 80, img: "../images/item3.jpg" }
]

const coffeTray = document.getElementById('coffeTray');

console.log(coffeTray);


coffeTray.innerHTML = itemsAndPrices.map(item => {

    return (
        `
            <div class="col-sm">
                <div class="thumbnail" style="margin-top: 40px;">
                    <img src="${item.img}" alt="" width="100%">
                </div>
                <div class="container header">
                    <h2>${item.name}</h2>
                    <h2 style="color: green;">${item.price} Rs.</h2>
                </div>
                <div class="container header">
                    <p class="btn btn-success " onclick=buy("${item.name}")>Order</p>
                </div>
            </div>
        
`
    )
}).join("");





function buy(a) {

    alert(a + " Successfully added to the cart");

}














