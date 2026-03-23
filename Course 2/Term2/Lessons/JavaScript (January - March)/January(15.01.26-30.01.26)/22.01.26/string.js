// const str = 'Привет!';
// const str1 = "Привет, ${fname}!";
// const fname = "Вася";
// const str2 = `Привет, ${fname}!`;
// const str3 = 'Привет,' + fname;

// console.log(str);
// console.log(str1);
// console.log(str2);
// console.log(str3);

//СЛОЖЕНИЕ СТРОК
// const res = 5 + 5 + '22';
// const res = 5 * 'w';
// console.log(res);

//МАССИВ
// const str = 'World';
// console.log(str)

//СПЕЦСИМВОЛЫ И ВЫВОД ТИПА ДАННЫХ
// "use strict"
// const b = 'www';
// const specb = null;
// const specb1 = undefined;
// typeof 'www'; //определение типа данных
// typeof('www'); //определение типа данных
// console.log(specb);
// console.log(specb1);
// console.log(typeof b); //вывод типа данных

//"use strict"
//const b = 5 * true; //выведет 5, т.к. true = 1
//const b = 5 * false; // выведет 0, т.к. false = 0
//const b = 5 * ' '; //выведет 0, т.к. false = 0
//const b = String(5); //переобразоварие в строку
//const b = Number('5'); //преобразование в число
//const b = Boolean('5'); //выведет true
//const b = Boolean('0'); //тоже выведет true, т.к. строка не пустая
//const b = Boolean(''); //тоже выведет false, т.к. строка пустая
//const b = 5 == '5'; //выведет true
//const b = 5 === '5'; //выведет false, т.к. разные типы данных
//const u = undefined;
//console.log(b);

// "use strict"
// let a = true;
// let b = false;
// let res = a + b + 5;
// res = a && b && 5; //При выводе будет false
// res = a || b;
// res = !a;
// console.log(res);

// "use strict"
// let a = true;
// let b = false;
// let res = (a == b) ? 5 :7; //если не выполняется условие, то выведет 7
// console.log(res);