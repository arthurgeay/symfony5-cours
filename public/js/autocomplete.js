const data = ['Arthur', 'Antoine'];

new Autocomplete('#autocomplete', {
    search: input => {
        if (input.length < 1) { return [] }
        return data.filter(result => {
            return result.toLowerCase()
                .startsWith(input.toLowerCase())
        })
    }
})