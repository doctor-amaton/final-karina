/**
 * main.js
 *
 * Archivo principal para todas las funciones globales de JavaScript
 */

/**
 * Enviar una peticion al servidor para que guarde la informacion del lugar
 * En esta funcion estaremos usando JQuery
 *
 * TODO: implementar Axios (y webpack)
 */
function savePlace() {
	const payload = { gatos: 42 };	/* Esta es nuestra informacion en el formato correcto */

	$.ajax({
		type: "POST",
		url: "api/places",
		data: payload,
		dataType: "json",

		success: (response) => {
			/* El json seria algo como { "result": 42 } */
			console.log(response.result);
		},
		error: (response) => {
			/* Hay que revisar el mensaje que nos dio la respuesta */
			console.log("el servidor respondio con un error");
		},

	});
}

$(document).ready(() => {
	savePlace();
});
