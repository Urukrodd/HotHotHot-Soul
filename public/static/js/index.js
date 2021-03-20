if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register('../serviceWorker.js').then(registration => {
        console.log("SW actif!");
        console.log(registration);
    }).catch(error => {
        console.log("SW non actif!");
        console.log(error);
    })
} else {

}
