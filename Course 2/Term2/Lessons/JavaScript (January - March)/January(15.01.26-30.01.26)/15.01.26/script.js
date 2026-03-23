let a = 10;
let b = 20;
if(a<b){
    console.log('a меньше b');
}else if(a>b){
    console.log('a больше b');
}else{
    console.log('a равно b');
}

const readline = require('readline-sync'); //Ввод данных
const c = readline.question('Сколько негров тебя ебали сегодня? Ответ: ');