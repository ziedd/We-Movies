import $ from 'jquery';
import 'bootstrap';
import 'autocomplete.js/dist/autocomplete.jquery';

const loaderHtml = `<div class="spinner-border text-primary" role="status">
<span class="sr-only">Loading...</span>
</div>`;

// detail button
$('#detailModal').on('show.bs.modal', function (event) {
    const movieId = event.relatedTarget?.dataset.id;
    const modal = $(this);

    if (!movieId) {
        return;
    }


    modal.find('.modal-body').html(loaderHtml);

    $.ajax({
        url: `/movie/${movieId}`,
        success: function (html) {
            modal.find('.modal-body').html(html);
        }
    });
})

// Autocomplete
$("#search").autocomplete({hint: false, minLength: 3}, [{
    source: function (query, cb) {
        $.ajax({
            url: '/movie/autocomplete' + '?term=' + query
        }).then(cb);
    },
    displayKey: "title",
    debounce: 500,
    templates: {
        suggestion: function (suggestion) {
            const baseUri = $("#search").data('image-host');
            return `<div class="suggestion">
                        <img src="${baseUri}${suggestion.posterPath}" alt="${suggestion.id}">
                        <span class="title">${suggestion.title}</span>
                    </div>`;
        }
    }
}]).on('autocomplete:selected', function(event, suggestion, dataset, context) {
    $('#detailModal').modal().find('.modal-body').html(loaderHtml);

    $.ajax({
        url: `/movie/${suggestion.id}`,
        success: function (html) {
            $('#detailModal').find('.modal-body').html(html);
        }
    });
});

// Filter
const filterForm = document.getElementById('filters');

filterForm?.addEventListener('change', event => {
    const checkboxs = filterForm.querySelectorAll('#filters input[type=checkbox]');
    let ids = [];

    checkboxs.forEach(checkbox => {
        if (checkbox.checked) {
            ids.push(checkbox.value);
        }
    });

    loadListByGenre (ids.join(','));
});

function loadListByGenre (genreIds) {
    $.ajax({
        url: "/movie/",
        type: "GET",
        data: {
            genreids: genreIds
        },
        beforeSend: function() {
            $('#loader').show();
        },
        complete: function(){
            $('#loader').hide();
        },
        success: function(response) {
            if (response) {
                $('#movie-list').html(response);
            }
        }
    });
}
