console.log('Задание а')
const readline = require('readline-sync');
const n = Number(readline.question("Input n: "));
let s = 0;
let i = 1;
while (i<=n){
    s += i;
    i += 2;
}
console.log(s);

console.log('Задание б')
const readline = require('readline-sync');
const n1 = Number(readline.question("Input n: "));
let s1 = 0;
let i1 = 1;
while (i<=n){
    s1 += i1;
    i1 += 2;
}
console.log(s1);