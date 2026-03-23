const readline = require('readline-sync');
function randomIntArray(minLen, maxLen, minVal, maxVal) {
    let len = Math.floor(Math.random() * (maxLen - minLen + 1)) + minLen;
    let array = [];
    let i = 0;
    while (i < len) {
        array[i] = Math.floor(Math.random() * (maxVal - minVal + 1)) + minVal;
        i++;
    }
    return array;
}
function bubbleSort(array) {
    let n = array.length;
    let i = 0;
    while (i < n) {
        let j = 0;
        while (j < n - i - 1) {
            if (array[j] > array[j + 1]) {
                let temp = array[j];
                array[j] = array[j + 1];
                array[j + 1] = temp;
            }
            j++;
        }
        i++;
    }
}
function binarySearch(array, target) {
    if (array.length === 0) return false;
    let left = 0;
    let right = array.length - 1;
    let candidate = -1;
    while (left <= right) {
        let mid = Math.floor((left + right) / 2);
        if (array[mid] === target) {
            candidate = mid;
            right = mid - 1;
        } else if (array[mid] < target) {
            left = mid + 1;
        } else {
            right = mid - 1;
        }
    }
    return candidate;
}
let originalArray = randomIntArray(10, 20, 0, 100);
console.log('Исходный:', originalArray);
bubbleSort(originalArray);
console.log('Отсортированный:', originalArray);
let target = +readline.question('Введите число для поиска: ');
let index = binarySearch(originalArray, target);
if (index !== false) {
    console.log(`Первый элемент ${target} на индексе ${index}: ${originalArray[index]}`);
} else {
    console.log(false);
}