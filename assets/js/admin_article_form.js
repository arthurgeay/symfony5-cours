const locationSelect = document.querySelector('.js-article-form-location');
const specificLocationUrl = locationSelect.dataset.specificLocationUrl;

const specificLocationTarget = document.querySelector('.js-specific-location-target');


locationSelect.addEventListener('change', (e) => {
    fetch(specificLocationUrl + `?location=${e.target.value}`)
        .then(data => data.text())
        .then(result => {
            if(!result) {
                const select = specificLocationTarget.children[0].querySelector('select');
                specificLocationTarget.children[0].removeChild(select);
                specificLocationTarget.classList.add('d-none');

                return;
            }

            specificLocationTarget.innerHTML = result;
            specificLocationTarget.classList.remove('d-none');
        })
});