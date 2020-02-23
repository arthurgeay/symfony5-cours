const articleLike = document.querySelector('.like-article');
const linkApi = articleLike.href;
const heart = articleLike.children[0];
const likeCounter = document.querySelector('.like-counter');

articleLike.addEventListener('click', (event) => {
    event.preventDefault();
    heart.classList.toggle('far');
    heart.classList.toggle('fas');

    fetch(linkApi, { method: 'post' })
        .then(data => data.json())
        .then(result => likeCounter.innerHTML = result.hearts)


});