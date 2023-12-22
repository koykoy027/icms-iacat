function buildPagination(x) {

    var info = $('.' + x.info);
    var pagination = $('.' + x.pagination);

    var page = parseInt(x.data.page);
    var offset = parseInt(x.data.offset);
    var cnt = parseInt(x.data.count);

    // Check if offset is greater than content
    if (cnt < offset) {
        offset = cnt;
    }

    // info
    if (cnt >= 0) {
        info.text(' Showing ' + (((page - 1) * offset) + 1) + ' to ' + (page * offset) + ' of ' + cnt.toLocaleString() + ' matches ');
    } else {
        info.text('No matches shown');
    }


    // last page
    var last_page = Math.ceil((cnt / offset));
    // console.log(last_page);

    // pagination
    var p = '';
    pagination.html(p);


    if (page <= 1) {
        // goto first page
        p += '<li class="disabled"><a href="#!" class="page-link" data-page="' + 1 + '"><i class="jo-icon jo-icon-pagination jo-icon-12 jo-first-gray-12"></i></a></li>';
        // for left pagination arrow single 
        p += '<li class="disabled"><a href="#!"><i class="jo-icon jo-icon-pagination jo-icon-12 jo-previous-gray-12"></i></a></li> ';
    } else {
        // goto first page
        p += '<li class="waves-effect  px-1"><a href="#!" class="page-link" data-page="' + 1 + '"><i class="jo-icon jo-icon-pagination jo-icon-12 jo-first-black-12"></i></a></li>';
        // for left pagination arrow single 
        p += '<li class="waves-effect  px-1"><a href="#!" class="page-link" data-page="' + (page - 1) + '"><i class="jo-icon jo-icon-pagination jo-icon-12 jo-previous-black-12" aria-hidden="true" ></i></a></li> ';
    }

    var limit = 5;
    var page_length = 5;
    var page_margin = 2;
    if (page <= limit) {

        var i = 1;

        while (i <= page_length) {

            if (i <= last_page) {
                if (i == page) {
                    p += '<li class="active"><a href="#!" class="page-link" data-page="' + i + '" >' + i + '</a></li>';
                } else {
                    p += '<li class="waves-effect"><a href="#!" class="page-link"  data-page="' + i + '">' + i + '</a></li>';
                }
            }

            // increament
            i++;
        }

    } else {

        i = 1;
        var pg = (page - page_margin);
        while (i <= page_length) {


            if (pg <= last_page) {

                if (pg == page) {
                    p += '<li class="active"><a href="#!" class="page-link" data-page="' + pg + '" >' + pg + '</a></li>';
                } else {
                    p += '<li class="waves-effect"><a href="#!" class="page-link" data-page="' + pg + '">' + pg + '</a></li>';
                }
            }

            // increament
            i++;
            pg++;
        }

    }


    if (page >= last_page) {
        // for right pagination arrow single 
        p += '<li class="disabled"><a href="#!"><i class="jo-icon jo-icon-pagination jo-icon-12 jo-next-gray-12"></i></a></li> ';
        // goto last page
        p += '<li class="disabled"><a href="#!" class="page-link " data-page="' + last_page + '"><i class="jo-icon jo-icon-pagination jo-icon-12 jo-last-black-12"></i></a></li> ';
    } else {
        // for right pagination arrow single 
        p += '<li class="waves-effect"><a href="#!" class="page-link" data-page="' + (page + 1) + '"><i class="jo-icon jo-icon-pagination jo-icon-12 jo-next-black-12"></i></a></li> ';
        // goto last page
        p += '<li class="waves-effect"><a href="#!" class="page-link" data-page="' + last_page + '"><i class="jo-icon jo-icon-pagination jo-icon-12 jo-last-black-12"></i></a></li> ';
    }

    // supply
    pagination.html(p);


}

/*
 
 Inspired by Florin Pop's coding challenges, you can check them here: https://www.florin-pop.com/blog/2019/03/weekly-coding-challenge/
 
 = Pagination short logic description =
 
 We set collection of our pages as an array of objects.
 Each object is a page with properties:
 * id - used as identifier
 * text - HTML page content
 * active - flag for page that is currently rendered.
 
 Logic is to check which object is flagged active and render that page.
 
 Page gets flagged as active by button click events.
 
 Buttons are rendered according to pages - for every page we create one button with:
 * corresponding number as text
 * corresponding ID as a button title.
 
 Rest are button click events for switching pages.
 */

// Pages and their content
//let pages = [
//  {id: 1, text: "<h3>PAGE 1</h3> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti id impedit natus at! Necessitatibus voluptatem rerum repellat adipisci molestiae totam.</p>", active: true},
//  {id: 2, text: "<h3>PAGE 2</h3> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti id impedit natus at! Necessitatibus voluptatem rerum repellat adipisci molestiae totam.</p>", active: false},
//  {id: 3, text: "<h3>PAGE 3</h3> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti id impedit natus at! Necessitatibus voluptatem rerum repellat adipisci molestiae totam.</p>", active: false},
//  {id: 4, text: "<h3>PAGE 4</h3> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti id impedit natus at! Necessitatibus voluptatem rerum repellat adipisci molestiae totam.</p>", active: false},
//  {id: 5, text: "<h3>PAGE 5</h3> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti id impedit natus at! Necessitatibus voluptatem rerum repellat adipisci molestiae totam.</p>", active: false}
//];


// UI Elements
const pagesContainer = document.querySelector(".pages"),
        buttonsContainer = document.querySelector(".paginator"),
        numButtonsContainer = document.querySelector(".page-nums");


// Clear pages
function clearPages() {
    try {

        while (pagesContainer.firstChild) {
            pagesContainer.firstChild.remove();
        }
    } catch (e) {

    }

}

// Clear Buttons
function clearButtons() {
    while (numButtonsContainer.firstChild) {
        numButtonsContainer.firstChild.remove();
    }
}

// Render buttons
function renderButtons(activePage) {
    clearButtons();

    pages.forEach(function (current) {
        const button = document.createElement("button");
        button.className = "page-num";
        button.type = "button";
        button.title = current.id;
        button.textContent = current.id;

        if (current.id === activePage.id) {
            button.classList.add("active");
        } else {
            button.classList.remove("active");
        }

        numButtonsContainer.appendChild(button);
    })
}

// Main render
function render() {
    clearPages();
    try {
        let activePage = pages.find(function (current) {
            return current.active === true;
        })

        const div = document.createElement("div");
        div.className = "page";
        div.dataset.id = activePage.id;
        div.innerHTML = activePage.text;

        pagesContainer.appendChild(div);

        setTimeout(function () {
            div.classList.add("active");
        }, 10);

        renderButtons(activePage)
    } catch (e) {

    }
}

// Event listeners for button clicks

// Buttons with page numbers click event
try {
    numButtonsContainer.addEventListener("click", function (e) {
        if (e.target.classList.contains("page-num")) {

            const activePage = pages.find(function (current) {
                return current.active;
            })

            if (e.target.title != activePage.id) {

                pages.forEach(function (current) {
                    current.active = false;
                })

                pages[e.target.title - 1].active = true;
                render();
            }
        }
    })
} catch (e) {

}

// Arrow buttons click event
try {
    buttonsContainer.addEventListener("click", function (e) {
        let activePage = pages.find(function (current) {
            return current.active === true;
        });

        if (e.target.className === "arrow-left") {

            if (pages[0].active === true) {
                pages[activePage.id - 1].active = false;
                pages[pages.length - 1].active = true;
                render();

            } else {
                pages[activePage.id - 1].active = false;
                pages[(activePage.id - 1) - 1].active = true;
                render();
            }

        } else if (e.target.className === "arrow-right") {
            if (pages[pages.length - 1].active === true) {
                pages[activePage.id - 1].active = false;
                pages[0].active = true;
                render();

            } else {
                pages[activePage.id - 1].active = false;
                pages[(activePage.id - 1) + 1].active = true;
                render();
            }

        } else
            return;
    })
} catch (e) {

}


// Initial render of the app
render();