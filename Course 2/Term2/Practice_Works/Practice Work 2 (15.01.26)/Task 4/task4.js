const readline = require('readline-sync');
const a = Number(readline.question("Input a: "));
const b = Number(readline.question("Input b: "));
const c = Number(readline.question("Input c: "));
const x = Number(readline.question("Input x: "));
if (x<0){
    let y = (a+b);
    console.log(y);
}else if(x>0){
    let y = c/b;
    console.log(y);
}else{
    let y = c*(a+2*b);
    console.log(y);
}