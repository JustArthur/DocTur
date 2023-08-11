const openPhoto = document.getElementById('openPhotoChanger');
const closePhoto = document.getElementById('closePhotoChanger');
const divPhoto = document.getElementById('divPhoto');
// const divInfo = document.getElementById('divInfo');
// const divMdp = document.getElementById('divMdp');
const body = document.querySelector('body');

function openPhotoChanger() {
    divPhoto.style.display = "flex";
    body.style.overflow = "hidden";
    divInfo.style.display = "none";
    divMdp.style.display = "none";
}

function closePhotoChanger() {
    divPhoto.style.display = "none";
    body.style.overflow = "auto";
    location.reload();
}

// function openInfoChanger() {
//     divInfo.style.display = "flex";
//     body.style.overflow = "hidden";
//     divPhoto.style.display = "none";
//     divMdp.style.display = "none";
// }

// function closeInfoChanger() {
//     divInfo.style.display = "none";
//     body.style.overflow = "auto";
// }

// function openMdpChanger() {
//     divMdp.style.display = "flex";
//     body.style.overflow = "hidden";
//     divPhoto.style.display = "none";
//     divInfo.style.display = "none";
// }

// function closeMdpChanger() {
//     divMdp.style.display = "none";
//     body.style.overflow = "auto";
// }