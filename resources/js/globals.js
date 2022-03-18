function createLocal(needle, value){
    localStorage.setItem(needle, value);
}

function getLocal(needle){
    return localStorage.getItem(needle)
}
