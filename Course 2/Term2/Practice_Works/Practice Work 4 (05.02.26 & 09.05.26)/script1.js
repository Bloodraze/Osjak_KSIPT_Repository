//09.02.26
//ЗАДАНИЕ 1
function randomIntArray(minLen, maxLen, minVal, maxVal) {
    let len = Math.floor(Math.random() * (maxLen - minLen + 1)) + minLen;
    let arr = [];
    let i = 0;
    while (i < len) {
        arr[i] = Math.floor(Math.random() * (maxVal - minVal + 1)) + minVal;
        i++;
    }
    return arr;
}

//ЗАДАНИЕ 2
const readline = require('readline-sync');
let arr1 = randomIntArray(15, 30, 0, 500);
let output = '';
let j = 0;
while (j < 10) {
    output += arr1[j] + ' ';
    j++;
}
console.log(output.trim() + ' ...' + arr1[arr1.length - 1]);
console.log(arr1.length);

//ЗАДАНИЕ 3
let arr2 = randomIntArray(10, 25, -100, 100);
let newArr = [];
let k = 0;
let m = 0;
while (k < arr2.length) {
    if (k % 2 === 1) {
        newArr[m++] = arr2[k];
    }
    k++;
}
console.log('Каждый второй:', newArr);

//ЗАДАНИЕ 4
let arr3 = randomIntArray(20, 40, 1, 200);
let evenArr = [];
let p = 0;
let q = 0;
while (p < arr3.length) {
    if (arr3[p] % 2 === 0) {
        evenArr[q++] = arr3[p];
    }
    p++;
}
console.log('Чётные:', evenArr);
console.log('Длина чётных:', evenArr.length);