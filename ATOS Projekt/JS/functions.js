function stringToDate(dateString) {
    var dateParts = dateString.split("-");
    return new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
}

function dateToString(date) {
    var month = date.getMonth() + 1;
    if (month < 10) {
        month = "0" + month;
    }
    var day = date.getDate();
    if (day < 10) {
        day = "0" + day;
    }
    var year = date.getFullYear();
    return day + "." + month + "." + year;
}

function localStorageToPHP(){

    var localStorage = window.localStorage;
    var localStorageKeys = Object.keys(localStorage);
    var localStorageKeysStr = JSON.stringify(localStorageKeys);
    var localStorageValues = Object.values(localStorage);
    var localStorageValuesStr = JSON.stringify(localStorageValues);
    var localStorageLength = localStorage.length;

    var localStorageToPHP = [localStorageKeysStr, localStorageValuesStr];

    return localStorageToPHP;
    }