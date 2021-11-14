/*const getResourse = async url => {
	const res = await fetch(url);

	if (!res.ok) {
		throw new Error('Произошла ошибка: ' + res.status)
	}

	return res.json();
};*/

const openModal = function () {
	const overlay = document.getElementById('login-modal').closest('.overlay');
	document.body.classList.add("lock")
	overlay.style.display = 'block';
};

const closeModal = function (event) {
	const target = event.target,
				overlay = document.getElementById('login-modal').closest('.overlay'),
				closeButton = overlay.querySelector('.modal-close__btn');

	if (target === overlay || target === closeButton) {
		overlay.style.display = 'none';
		document.body.classList.remove("lock")
	}
};
if(document.querySelector('.tweet-form')){
	document.querySelector('.tweet-form').addEventListener('input', (e)=>{
		if(e.target.closest('.tweet-form__input')){
			validate(e.target);
		}

	})
}
if(document.getElementById('login-modal')) {
	document.getElementById('login-modal').addEventListener('input', (e) => {
		if (e.target.closest('.tweet-form__input')) {
			validate(e.target);
		}

	})
}
function validate(input) {
	input.value = input.value.trim().replace(/[^a-zA-Z0-9]/g, '').replace(/\s/g, '');

}
const loginModalShowButton = document.querySelector('.header__link_profile_fill'),
			loginModal = document.getElementById('login-modal'),
			imgButton = document.querySelector('.tweet-img__btn');

if (loginModalShowButton) {
	loginModalShowButton.addEventListener('click', openModal);
}

if (loginModal) {
	const loginModalOverlay = loginModal.closest('.overlay');
	loginModalOverlay.addEventListener('click', closeModal);
}

if (imgButton) {
	imgButton.addEventListener('click', () => {
		const imgInput = document.getElementById('image-path'),
					imgSpan = document.getElementById('image-span'),
					imgBox = document.createElement('img'),
					imgBoxBig = document.createElement('img');

		imgUrl = prompt('Введите адрес картинки');
		if(imgUrl !== 'null'){
			imgInput.value = imgUrl;
			imgSpan.innerHTML = ` 
				<img src="${imgUrl}" class="image-box">
				<img src="${imgUrl}" class="image-box-big">
			`
		}

		// imgSpan.innerText = imgUrl;
	});
}
	if(document.getElementById('image-span')){
		document.getElementById('image-span').addEventListener('click', (e)=>{
			if(e.target.closest('.image-box')) document.querySelector('.image-box').classList.toggle('active');
			if(!e.target.closest('.image-box')) document.querySelector('.image-box').classList.remove('active');
		})
	}



