const input = document.querySelector('.autocomplete-input');
const url = input.dataset.autocompleteUrl;


new Autocomplete('#autocomplete', {
    search: input => {
        return new Promise(resolve => {
            if (input.length < 3) {
                return resolve([]);
            }

            fetch(url + `?query=${input}`)
                .then(response => response.json())
                .then(data => {
                    resolve(data)
                })
        });
    },
    getResultValue: result => result.email,
    debounceTime: 500
});
