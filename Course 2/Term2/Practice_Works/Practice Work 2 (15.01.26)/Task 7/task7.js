const readline = require('readline-sync');
const a = Number(readline.question('Input a: '));
const b = Number(readline.question('Input b: '));
var max;
if (a > b) {
    max = a;
} else {
    max = b;
}
let i = max;
while (true) {
    if (i % a == 0 && i % b == 0) {
        console.log(i);
        break;
    }
    i += max;
}