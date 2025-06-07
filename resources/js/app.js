import $ from 'jquery';
import 'jquery-validation';

window.$ = $;
window.jQuery = $;


document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.getElementById('carousel');
    const cardWidth = 18 * 16 + 16;

    document.getElementById('next')?.addEventListener('click', () => {
        carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
    });

    document.getElementById('prev')?.addEventListener('click', () => {
        carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
    });

    // Auto-submit on checkbox change
    const sortCheckbox = document.getElementById('sortCheckbox');
    sortCheckbox?.addEventListener('change', () => {
        document.getElementById('filterForm').submit();
    });
     // Auto-submit on checkbox change
    const managedCheckbox = document.getElementById('managedCheckbox');
    managedCheckbox?.addEventListener('change', () => {
        document.getElementById('filterForm').submit();
    });
     // Auto-submit on checkbox change
    const dutiesCheckbox = document.getElementById('dutiesCheckbox');
    dutiesCheckbox?.addEventListener('change', () => {
        document.getElementById('filterForm').submit();
    });

    
    $(".login-form-inner").validate({
        rules: {
            email: { required: true, email: true },
            password: { required: true }
        },
        messages: {
            email: {
                required: "Norādiet e-pastu...",
                email: "Nekorekts e-pasts."
            },
            password: {
                required: "Norādiet paroli..."
            }
        },
        
        errorPlacement: function(error, element) {
            element.siblings('.invalid-feedback').text(error.text()).show();
        },

        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
            $(element).siblings('.invalid-feedback').show();
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid').addClass('is-valid');
            $(element).siblings('.invalid-feedback').text('').hide();
        },


        onkeyup: function(element) {
            $(element).valid();
        },
        onfocusout: function(element) {
            $(element).valid();
        }
    });
    
    window.toggleForm = function(show) {
        const form = document.getElementById('createForm');
        const btnWrapper = document.getElementById('createBtnWrapper');

        if (!form || !btnWrapper) return;

        if (show) {
            form.classList.remove('hidden');
            btnWrapper.classList.add('hidden');
        } else {
            form.classList.add('hidden');
            btnWrapper.classList.remove('hidden');
        }
    }

    

});

