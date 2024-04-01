document.addEventListener('DOMContentLoaded', function () {
    let xhr = new XMLHttpRequest();
    let xhrFavor = new XMLHttpRequest();
    let postsContainer = document.getElementById("posto");
    let favoritePosts = [];

    xhrFavor.open("GET", 'ajax.php?getFavorites=Y');
    xhrFavor.send();

    xhrFavor.onload = function () {
        favoritePosts = JSON.parse(xhrFavor.response);
    };

    xhr.open("GET", 'ajax.php');
    xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

    xhr.send();

    xhr.onload = function () {
        let response = JSON.parse(xhr.response)
        let cat = 1;

        while (response[cat] !== undefined) {
            let category = document.createElement("div");
            let categoriesCount = document.createElement("div");
            categoriesCount.innerText = 'Всего статей в категории: ' + response[cat].length;
            category.appendChild(categoriesCount);
            postsContainer.appendChild(category);

            for (let i = 0; i < response[cat].length; i++) {
                let addButtonText = 'Добавить в избранное';
                let addButtonAction = 'addToFavorite';
                let addButtonClass = 'addToFavoriteButton';

                if (inArray(response[cat][i].id, favoritePosts)) {
                    addButtonText = 'Удалить из избранного';
                    addButtonAction = 'removeFromFavorite';
                    addButtonClass = 'addToFavoriteButton remove';
                }

                let article = document.createElement("article");
                let addToFavoriteButton = document.createElement("div");
                addToFavoriteButton.setAttribute("class", addButtonClass);
                addToFavoriteButton.setAttribute("id", 'postItem_' + response[cat][i].id);
                addToFavoriteButton.setAttribute("onclick", addButtonAction + '(' + response[cat][i].id + ')');
                addToFavoriteButton.innerText = addButtonText;
                let title = document.createElement("h2");
                title.innerText = response[cat][i].title;
                let body = document.createElement("p");
                body.innerText = response[cat][i].body;
                let hr = document.createElement("hr");
                article.appendChild(title);
                article.appendChild(addToFavoriteButton);
                article.appendChild(body);
                article.appendChild(hr);
                article.appendChild(hr);
                category.appendChild(article);
            }

            cat += 1;
        }
    }
})

function addToFavorite(postId) {
    let xhr = new XMLHttpRequest();

    let postButton = document.getElementById('postItem_' + postId);

    xhr.open("GET", 'ajax.php?addToFavorite=' + postId)
    xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

    xhr.send();

    xhr.onload = function () {
        let response = JSON.parse(xhr.response)
        if (response) {
            postButton.setAttribute("class", 'addToFavoriteButton remove');
            postButton.innerText = 'Удалить из избранного';
        }
    };

}

function removeFromFavorite(postId) {
    let xhr = new XMLHttpRequest();

    let postButton = document.getElementById('postItem_' + postId);

    xhr.open("GET", 'ajax.php?removeFromFavorite=' + postId)
    xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

    xhr.send();

    xhr.onload = function () {
        let response = JSON.parse(xhr.response)
        if (response) {
            postButton.setAttribute("class", 'addToFavoriteButton');
            postButton.innerText = 'Добавить в избранное';
        }
    };
}
function inArray(needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}
