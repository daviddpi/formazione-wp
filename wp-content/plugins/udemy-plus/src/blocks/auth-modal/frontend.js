document.addEventListener('DOMContentLoaded', () => {
	const openModalBtn = document.querySelectorAll('.open-modal');
	const modal = document.querySelector('.wp-block-udemy-plus-auth-modal');
	const closeModal = document.querySelectorAll('.modal-overlay, .modal-btn-close, .bi.bi-x');

	openModalBtn.forEach(openModal => {
		openModal.onclick = (e) => {
			e.preventDefault();
			modal.classList.add('modal-show');
		}
	});

	closeModal.forEach(close => {
		close.onclick = () => {
			modal.classList.remove('modal-show');
		}
	});

	const tabs = document.querySelectorAll('.tabs a');
	const signinForm = document.querySelector('#signin-tab') ?? '';
	const signupForm = document.querySelector('#signup-tab') ?? '';

	tabs.forEach(tab => {
		tab.onclick = (e) => {
			e.preventDefault();
			tabs.forEach(currentTab => {
				currentTab.classList.remove('active-tab')
			});
			e.currentTarget.classList.add('active-tab');

			const activeTab = e.currentTarget.getAttribute('href');

			if (activeTab === '#signin-tab') {
				signinForm.style.display = 'block';
				signupForm.style.display = 'none';

			} else {
				signinForm.style.display = 'none';
				signupForm.style.display = 'block';
			}
		}
	})

	signupForm.addEventListener('submit', async (e) => {
		e.preventDefault();
		const signupFieldset = signupForm.querySelector('fieldset');
		signupFieldset.setAttribute('disabled', true);
		const status = signupForm.querySelector('#signup-status');
		status.innerHTML = `
			<div class="modal-status modal-status-info">
				Please wait! We are creating your account.
			</div>
		`;

		const formData = {
			username: signupForm.querySelector('#su-name').value ?? '',
			email: signupForm.querySelector('#su-email').value ?? '',
			password: signupForm.querySelector('#su-password').value ?? '',
		}

		const response = await fetch(up_auth_rest.signup, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(formData),
		});

		const responseJSON = await response.json();

		if (responseJSON.status === 'success') {
			status.innerHTML = `
				<div class="modal-status modal-status-success">
					Success! Your account has been created.
				</div>
			`;

			setTimeout(() => {
				location.reload();
			}, 600);
		} else {
			signupFieldset.removeAttribute('disabled');
			status.innerHTML = `
			<div class="modal-status modal-status-danger">
				Unable to create account! Please try again later.
			</div>
		`;
		}

	});

	signinForm.addEventListener('submit', async (e) => {
		e.preventDefault();
		const signinFieldset = signinForm.querySelector('fieldset');
		signinFieldset.setAttribute('disabled', true);
		const status = signinForm.querySelector('#signin-status');
		status.innerHTML = `
			<div class="modal-status modal-status-info">
				Please wait ...
			</div>
		`;

		const formData = {
			user_login: signinForm.querySelector('#si-email').value ?? '',
			password: signinForm.querySelector('#si-password').value ?? '',
		}

		const response = await fetch(up_auth_rest.signin, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(formData),
		});

		const responseJSON = await response.json();

		if (responseJSON.status === 'success') {
			status.innerHTML = `
				<div class="modal-status modal-status-success">
					Login success!.
				</div>
			`;

			setTimeout(() => {
				location.reload();
			}, 600);
		} else {
			signinFieldset.removeAttribute('disabled');
			status.innerHTML = `
			<div class="modal-status modal-status-danger">
				Unable to login! Email or password is incorrect. Please try again later.
			</div>
		`;
		}

	});

})