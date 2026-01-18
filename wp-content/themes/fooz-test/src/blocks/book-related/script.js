import {__} from '@wordpress/i18n';

function renderBookItem(book) {
    const { link = '#', title = {}, excerpt = {}, formatted_date, _embedded } = book;
    const bookTitle = title.rendered || '';
    const bookExcerpt = excerpt.rendered || '';

    const item = document.createElement('div');
    item.className = 'c-book';

    const a = document.createElement('a');
    a.href = link;
    a.className = 'c-book__link';

    const thumbDiv = document.createElement('div');
    thumbDiv.className = 'c-book__thumb-container';
    a.appendChild(thumbDiv);

    const media = _embedded?.['wp:featuredmedia']?.[0];
    const sizes = media?.media_details?.sizes;

    const thumbUrl = sizes?.thumbnail?.source_url;
    if (thumbUrl) {
        const img = document.createElement('img');
        img.src = thumbUrl;

        if (sizes) {
            const srcsetParts = [];

            Object.keys(sizes).forEach(function (key) {
                const size = sizes[key];
                if (size.source_url && size.width) {
                    srcsetParts.push(size.source_url + ' ' + size.width + 'w');
                }
            });

            img.srcset = srcsetParts.join(', ');
            img.sizes = '(max-width: 640px) 50vw, (max-width: 1024px) 20vw, 200px';
        }

        img.alt = bookTitle;
        img.className = 'c-book__thumb';
        img.loading = 'lazy';
        thumbDiv.appendChild(img);
    }

    const h3 = document.createElement('h3');
    h3.className = 'c-book__title';
    h3.textContent = bookTitle;
    a.appendChild(h3);

    if (formatted_date) {
        const dateElement = document.createElement('time');
        dateElement.className = 'c-book__date';
        dateElement.textContent = formatted_date;
        a.appendChild(dateElement);
    }

    const terms = _embedded?.['wp:term'] || [];
    const genres = terms.flat().filter(term => term.taxonomy === 'genre');

    if (genres.length > 0) {
        const genresDiv = document.createElement('div');
        genresDiv.className = 'c-book__genres';

        genres.forEach(genre => {
            const span = document.createElement('span');
            span.className = 'c-book__genre-tag';
            span.textContent = genre.name;
            genresDiv.appendChild(span);
        });

        a.appendChild(genresDiv);
    }

    const divExcerpt = document.createElement('div');
    divExcerpt.innerHTML = bookExcerpt;
    divExcerpt.className = 'c-book__excerpt';
    a.appendChild(divExcerpt);

    item.appendChild(a);

    return item;
}

async function loadBooks() {
    const container = document.querySelector('.b-book-related .b-book-related__list');
    if (!container) return;

    const currentId = container.closest('.b-book-related').dataset.currentId;

    try {
        const res = await fetch('/wp-json/wp/v2/book?per_page=20&exclude=' + currentId + '&_embed');
        if (!res.ok) throw new Error('Network response was not ok');

        const books = await res.json();
        container.innerHTML = '';

        if (!books.length) {
            const p = document.createElement('p');
            p.textContent = __('There are no other books', 'fooz-test');
            container.appendChild(p);
            return;
        }

        books.forEach(book => {
            container.appendChild(renderBookItem(book));
        });
    } catch (err) {
        console.error(err);
        const p = document.createElement('p');
        p.textContent = __('Could not load newest books', 'fooz-test');
        container.innerHTML = '';
        container.appendChild(p);
    }
}

document.addEventListener("DOMContentLoaded", loadBooks);