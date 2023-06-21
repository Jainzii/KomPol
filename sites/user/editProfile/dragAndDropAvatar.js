let container = document.querySelector(".changeDetails");
let input = document.querySelector("#avatarInput");
let error = document.getElementById("error");


const elementList = document.querySelectorAll("*");
elementList.forEach(e => {
    dragEnter(e);
    dragLeave(e);
    dragDrop(e);
})

function dragEnter(element) {
    element.addEventListener(
        "dragenter",
        (e) => {
            e.preventDefault();
            e.stopPropagation();
            element.classList.add("active");
        },
        false
    );
}

function dragLeave(element) {
    element.addEventListener(
        "dragleave",
        (e) => {
            e.preventDefault();
            e.stopPropagation();
            element.classList.remove("active");
        },
        false
    );
}

function dragOver(element) {
    element.addEventListener(
        "dragover",
        (e) => {
            e.preventDefault();
            e.stopPropagation();
            element.classList.add("active");
        },
        false
    );
}

function dragDrop(element) {
    element.addEventListener(
        "drop",
        (e) => {
            e.preventDefault();
            e.stopPropagation();
            element.classList.remove("active");
            let draggedData = e.dataTransfer;
            let files = draggedData.files;
            input.files = files;
        },
        false
    );
}

// only dragOver for container to prevent stutter
container.addEventListener(
    "dragover",
    (e) => {
        e.preventDefault();
        e.stopPropagation();
        container.classList.add("active");
    },
    false
);