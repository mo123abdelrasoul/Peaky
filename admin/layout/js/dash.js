/* Payment Method Paymob 

const API = 'ZXlKaGJHY2lPaUpJVXpVeE1pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SmpiR0Z6Y3lJNklrMWxjbU5vWVc1MElpd2ljSEp2Wm1sc1pWOXdheUk2T1RFeU9Ea3dMQ0p1WVcxbElqb2lNVFk1TmpjeE16YzRNeTR4TnprMU16Z2lmUS51Qjk1VG1vWmVWc1BvbTZGUUo5YjhEU0Q0VmpLZ2dTZThnV0IzT3pZcHV0eC1EWkFETmhlQUdteHJLNkNDM3ZTdUpXYWtETjFLMlliRVg1VldHQV9PQQ=='

document.getElementById('executeButton').addEventListener('click', firststep);


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
	let data = {
		"auth_token":  token,
		"delivery_needed": "false",
		"amount_cents": "100",
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
	let data = {
			"auth_token": token,
			"amount_cents": "100", 
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

Payment Method Paymob */
