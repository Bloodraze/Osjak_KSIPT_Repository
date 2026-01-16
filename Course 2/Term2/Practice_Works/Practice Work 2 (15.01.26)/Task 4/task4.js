const readline = require('readline-sync');
const a = Number(readline.question("Input a: "));
const b = Number(readline.question("Input b: "));
const c = Number(readline.question("Input c: "));
const x = Number(readline.question("Input x: "));
let y = 0;
if (x<0){
    y = a+b;
    console.log(y);
}else if(x>0){
    y = c/b;
    console.log(y);
}else{
    y = c*(a+2*b);
    console.log(y);
}