
(function () {
    "use strict";

    /* tooltip */
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    /* popover  */
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))


    /* for theme background */
    const nanoThemes1 = [
        [
            'nano',
            {

                defaultRepresentation: 'RGB',
                components: {
                    preview: true,
                    opacity: false,
                    hue: true,

                    interaction: {
                        hex: false,
                        rgba: true,
                        hsva: false,
                        input: true,
                        clear: false,
                        save: false
                    }
                }
            }
        ]
    ];
    /* for theme background */


    /* Choices JS */
    document.addEventListener('DOMContentLoaded', function () {
        var genericExamples = document.querySelectorAll('[data-trigger]');
        for (let i = 0; i < genericExamples.length; ++i) {
            var element = genericExamples[i];
            new Choices(element, {
                allowHTML: true,
                placeholderValue: 'This is a placeholder set in the config',
                searchPlaceholderValue: 'Search',
            });
        }
    });
    /* Choices JS */

    /* footer year */
    document.getElementById("year").innerHTML = new Date().getFullYear();
    /* footer year */

    /* card with close button */
    let DIV_CARD = '.card';
    let cardRemoveBtn = document.querySelectorAll('[data-bs-toggle="card-remove"]');
    cardRemoveBtn.forEach(ele => {
        ele.addEventListener('click', function (e) {
            e.preventDefault();
            let $this = this;
            let card = $this.closest(DIV_CARD);
            card.remove();
            return false;
        })
    })
    /* card with close button */

    /* card with fullscreen */
    let cardFullscreenBtn = document.querySelectorAll('[data-bs-toggle="card-fullscreen"]');
    cardFullscreenBtn.forEach(ele => {
        ele.addEventListener('click', function (e) {
            let $this = this;
            let card = $this.closest(DIV_CARD);
            card.classList.toggle('card-fullscreen');
            card.classList.remove('card-collapsed');
            e.preventDefault();
            return false;
        });
    });
    /* card with fullscreen */

    /* count-up */
    var i = 1
    setInterval(() => {
        document.querySelectorAll(".count-up").forEach((ele) => {
            if (ele.getAttribute("data-count") >= i) {
                i = i + 1
                ele.innerText = i
            }
        })
    }, 10);
    /* count-up */


})();

/* toggle switches */
let customSwitch = document.querySelectorAll('.toggle');
customSwitch.forEach(e => e.addEventListener('click', () => {
    e.classList.toggle("on");
}));
/* toggle switches */

/* header dropdown close button */


/* for notifications dropdown */
const headerbtn1 = document.querySelectorAll('.dropdown-item-close1');
headerbtn1.forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        button.parentNode.parentNode.parentNode.parentNode.remove();
        document.getElementById("notifiation-data").innerText = `${document.querySelectorAll('.dropdown-item-close1').length} Unread`;
        document.getElementById("notification-icon-badge").innerText = `${document.querySelectorAll('.dropdown-item-close1').length}`;
        if (document.querySelectorAll('.dropdown-item-close1').length == 0) {
            let elementHide1 = document.querySelector(".empty-header-item1")
            let elementShow1 = document.querySelector(".empty-item1")
            elementHide1.classList.add("d-none")
            elementShow1.classList.remove("d-none")
        }
    });
});
/* for notifications dropdown */






