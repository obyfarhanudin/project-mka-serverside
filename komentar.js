document.getElementById('postKomentar').addEventListener('submit', function (e) {
	e.preventDefault();

	const name = document.getElementById('name').value;
	const email = document.getElementById('email').value;
	const pesan = document.getElementById('pesan').value;

	const data = new URLSearchParams();
	data.append('name', name);
	data.append('email', email);
	data.append('pesan', pesan);

	const scriptURL =
		'https://script.google.com/macros/s/AKfycbwP9b3ue7fYIKMp_MZOB_f3jOreG6LQBLOoanxZJgXii3NaHoczq6mq4haejN28cCIxsw/exec';

	// Tampilkan pesan loading
	document.querySelector('.loading').style.display = 'block';
	document.querySelector('.error-message').style.display = 'none';
	document.querySelector('.sent-message').style.display = 'none';

	fetch(scriptURL, {
		method: 'POST',
		body: data,
	})
		.then((response) => response.text())
		.then((data) => {
			console.log('Success:', data);

			// Mengosongkan input
			document.getElementById('name').value = '';
			document.getElementById('email').value = '';
			document.getElementById('pesan').value = '';

			// Sembunyikan pesan loading dan tampilkan pesan sukses
			document.querySelector('.loading').style.display =
				'none';
			document.querySelector('.sent-message').style.display =
				'block';
		})
		.catch((error) => {
			console.error('Error:', error);

			// Sembunyikan pesan loading dan tampilkan pesan error
			document.querySelector('.loading').style.display =
				'none';
			document.querySelector(
				'.error-message'
			).style.display = 'block';
		});
});
