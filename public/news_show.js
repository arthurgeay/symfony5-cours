const articleLike = document.querySelector('.like-article');
const heart = articleLike.children[0];
const likeCounter = document.querySelector('.like-counter');

articleLike.addEventListener('click', (event) => {
    event.preventDefault();
    heart.classList.toggle('far');
    heart.classList.toggle('fas');

    likeCounter.innerHTML = "0";

});