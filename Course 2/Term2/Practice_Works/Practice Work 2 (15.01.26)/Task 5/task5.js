const readline = require('readline-sync');
const a = Number(readline.question("Input a: "));
const b = Number(readline.question("Input b: "));
let sum = 0;
let i = a;
while (i <= b) {
    sum += i;
    i += 1;
}
console.log(sum);