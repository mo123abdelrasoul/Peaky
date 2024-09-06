// function search(){
// 	let searchBar = document.querySelector('.search-input').value.toUpperCase();
// 	let productList = document.querySelector('.search-list');
// 	let product = document.querySelectorAll('.list');
// 	let productName = document.getElementsByTagName('h2');

// 	for(let i = 0; i<productName.length; i++){
// 		if(productName[i].innerHTML.toUpperCase().indexOf(searchBar) >= 0){
// 			product[i].style.display = "";
// 		}else{
// 			product[i].style.display = "none";
// 		}
// 	}
// }


/* Search For Products */


function search() {
    let searchBar = document.querySelector('.search-input').value.toUpperCase();
    let product = document.querySelectorAll('.list');
    let productName = document.getElementsByTagName('h2');

    for (let i = 0; i < productName.length; i++) {
        if (productName[i].innerHTML.toUpperCase().indexOf(searchBar) >= 0) {
            product[i].style.display = "flex"; // إظهار المنتج إذا تم العثور على تطابق
        } else {
            product[i].style.display = "none"; // إخفاء المنتج إذا لم يتم العثور على تطابق
		}
    }

}

/* Search For Products */

/*
const search = () =>{
	const searchbox = document.getElemtntById("search-item").value.toUpperCase();
	const storeitems = document.getElemtntById("search-list")
	const item = document.querySelectorAll(".list")
	const itemName = document.getElemtntByTagName("h2")

	for(var i=0; i < itemName.length; i++){
		let match = item[i].getElemtntByTagName('h2')[0];

		if(match){
			let textvalue = match.textContent || match.innerHTML

			if(textvalue.toUpperCase().indexOf(searchbox) > -1){
				item[i].style.display = "";
			}else{
				item[i].style.display = "none";
			}
		}
	}
}
*/





/* Payment Method Paymob */

const API = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2T1RFeU9Ea3dMQ0p1WVcxbElqb2lNVFk1TmpjeE16YzRNeTR4TnprMU16Z2lmUS51Qjk1VG1vWmVWc1BvbTZGUUo5YjhEU0Q0VmpLZ2dTZThnV0IzT3pZcHV0eC1EWkFETmhlQUdteHJLNkNDM3ZTdUpXYWtETjFLMlliRVg1VldHQV9PQQ=='

/* document.getElementById('executeButton').addEventListener('click', firststep);*/
    const total = document.getElementById("total");


async function firststep () {
	let data = {
		"api_key": API
	}
	
	let request = await fetch('https://accept.paymob.com/api/auth/tokens' , {
		method : 'post',
		headers : {'Content-Type' : 'application/json'},
		body : JSON.stringify(data)
	})

	let response = await request.json()

	let token = response.token

	secondstep(token)

}
async function secondstep (token) {
        let amountCents = total.getAttribute("data-amount-cents");

	let data = {
		"auth_token":  token,
		"delivery_needed": "false",
		"amount_cents": amountCents,
		"currency": "EGP",
		"items": [],
		}

	let request = await fetch('https://accept.paymob.com/api/ecommerce/orders' , {
		method : 'post',
		headers : {'Content-Type' : 'application/json'},
		body : JSON.stringify(data)
	})

	let response = await request.json()

	let id = response.id
	thirdstep(token , id)
}

async function thirdstep (token , id) {
        let amountCents = total.getAttribute("data-amount-cents");

	let data = {
			"auth_token": token,
			"amount_cents": amountCents, 
			"expiration": 3600, 
			"order_id": id,
			"billing_data": {
			"apartment": "803", 
			"email": "claudette09@exa.com", 
			"floor": "42", 
			"first_name": "Clifford", 
			"street": "Ethan Land", 
			"building": "8028", 
			"phone_number": "+86(8)9135210487", 
			"shipping_method": "PKG", 
			"postal_code": "01898", 
			"city": "Jaskolskiburgh", 
			"country": "CR", 
			"last_name": "Nicolas", 
			"state": "Utah"
			}, 
			"currency": "EGP", 
			"integration_id": 4250566
		}

	let request = await fetch('https://accept.paymob.com/api/acceptance/payment_keys' , {
		method : 'post',
		headers : {'Content-Type' : 'application/json'},
		body : JSON.stringify(data)
	})

	let response = await request.json()

	let TheToken = response.token

	cardpayment(TheToken)


}

async function cardpayment (token) {

	let iframeURL = `https://accept.paymob.com/api/acceptance/iframes/791174?payment_token=${token}`

	location.href = iframeURL

}

/* Payment Method Paymob */
